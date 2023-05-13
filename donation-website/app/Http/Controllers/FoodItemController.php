<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    //
    public function index()
    {
        $foodItems = FoodItem::all();
        return compact('foodItems');
    }
}

