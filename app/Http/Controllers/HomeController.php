<?php

namespace App\Http\Controllers;
use App\Models\Car;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        // $cars = Car::where('name', '=', 'Benz')->get();


         return view('cars.index', [
             'cars' => $cars
         ]);
        return view('cars.index');
    }
}
