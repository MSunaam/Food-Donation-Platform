<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodItemController extends Controller
{
    //
    public function index()
    {
        $foodItems = FoodItem::all();
        return compact('foodItems');
    }
    public function add(Request $request){

        $item = $request->validate([
            'food_name' => 'required|min:3|string',
            'food_category' => 'required|string',
            'expiration_date' => 'required|date',
            'quantity' => 'integer|required',
            'unit' => 'required|string',
            'foodBankId' => 'required|integer'
        ]);

        $food_name = $request->input('food_name');
        $food_category = $request->input('food_category');
        $expiration_date = $request->input('expiration_date');
        $quantity = $request->input('quantity');
        $unit = $request->input('unit');
        $foodBankId = $request->input('foodBankId');
        $created_at = Carbon::now()->toDateString();
        $updated_at = Carbon::now()->toDateString();

        $data = [
            'food_name' => $food_name,
            'food_category' => $food_category,
            'expiration_date' => $expiration_date,
            'quantity' => $quantity,
            'unit' => $unit,
            'foodBankId' => $foodBankId,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];

        DB::table('food_items')->insert($data);

        return response()->json([
            "error" => false,
            "message" => "Successfully Entered Data"
        ]);
    }

    public function getCategoryInfo(Request $request) {

        $id = Auth::user()->id;

        $categories = DB::table('food_items')
            ->select(DB::raw('sum(quantity) as quantity, food_category'))
            ->where('foodBankId', '=', $id)
            ->groupBy('food_category')->get();

        $schedules = DB::table('donations')
            ->join('users', 'users.id', '=', 'donations.donor_id')
            ->select('donations.food_name as food_name', 'users.name as donor_name', 'donations.status as status', 'donations.id as donations_id')
            ->where('receiver_id', Auth::user()->id)
            ->reorder('donations.scheduled_pickup_time', 'desc')
            ->limit(10)
            ->get();

        if($request->ajax()){
            return ['quantities' => $categories, 'schedules' => $schedules];
        }
//        return "hello";

        return view('users.foodBank.dashboard', ['quantities' => $categories, 'schedules' => $schedules]);

    }

    public function show_inventory(){
        $data = FoodItem::all(); // Retrieve data from the database

        return view('users.foodBank.inventory', ['data' => $data]);
    }
    public function get_food_data(){
        $data = FoodItem::orderBy('expiration_date', 'asc')->get();

        return response()->json($data);
    }

    public function sortquantity(){
        $data = FoodItem::orderBy('quantity', 'desc')->get();

        return response()->json($data);
    }

    public function sortcategory(){
        $data = FoodItem::orderBy('food_category')->get();

        return response()->json($data);
    }

    
}

