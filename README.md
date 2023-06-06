# MealShare - A Food Donation Platform

## Table of Contents
1. [Problem Statement](#problem-statement)
2. [Tools Used](#tools-used)
3. [Functionality](#functionality)
4. [Code Structure](#code-structure)
5. [Getting Started](#getting-started)

## Problem Statement
MealShare addresses the issue of food waste and lack of access to nutritious food for vulnerable populations. Restaurants and grocery stores often have excess food that goes to waste, while food banks and other charitable organizations struggle to provide adequate nutrition to those in need. This platform aims to streamline the donation process, reducing food waste and providing nutritious food to those who need it most.

## Tools Used
- Laravel Framework for backend development.
- MySQL as the database system.
- Bootstrap for frontend development.

## Functionality
1. **Request Portal:** Food banks can open requests to ask for donations with requirements.
2. **Scheduling Portal:** Restaurants and grocery stores can accept requests and schedule donations. These schedules will be updated for food banks.
3. **Inventory Management:** Inventory will be managed on the food banks' side.
4. **History Management:** All history of the donations and requests will be kept on the food banks' side.

## Code Structure
Our code structure is modular and flexible, organized into models, views, controllers, and components.

### Models
- Donations: Represents the details of donations received by the food banks.
- FoodItems: Contains details of the inventory of food banks.
- Requests: Contains details of donations requested by food banks.
- Users: Contains all information about the users registered in this platform.

### Controllers
We use controllers to manage CRUD operations of the respective database tables:
- Donation Controller
- FoodItem Controller
- Request Controller
- User Controller

### Components
We use components to create reusable UI elements and make the code easy to read and reusable.

### Views
Views handle the rendering of the user interface. For instance:
- Dashboard: Shows user-specific information.
- Login: Handles user login.
- Profile setting: Allows users to update their personal details.
- Register: Handles user registration.
- Requests, Inventory, Donations: Provide information about ongoing and past events.

### Routes
We use routes to pass data to views and controllers flexibly.

## Getting Started
### Prerequisites
- PHP
- MySQL
- Composer
- Laravel Framework

### Installation
1. Clone the repo `git clone https://github.com/your_username_/MealShare.git`
2. Navigate to project folder `cd MealShare`
3. Install Composer dependencies `composer install`
4. Create a copy of your `.env` file `cp .env.example .env`
5. Generate an app encryption key `php artisan key:generate`
6. Create an empty database for our application
7. In the `.env` file, add database information
8. Migrate the database `php artisan migrate`
9. Start the local development server `php artisan serve`

### Usage
Visit `http://localhost:8000` in your web browser.

## Contributing
We appreciate your contributions! Please follow these steps:
1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Contact
Muhammad Sunaam - msunaam2002@gmail.com
