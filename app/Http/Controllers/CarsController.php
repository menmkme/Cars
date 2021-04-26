<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValidationRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;
use App\Rules\Uppercase;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth',['except' => ['index','show']]);
     }
    public function index()
    {
        $cars = Car::all();
       // $cars = Car::where('name', '=', 'Benz')->get();


        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // $car = new Car;
        // $car->name = $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');
        // $car->save();

        //Method we can use on request
        //guesExtention(),getMimeType(),store(),asStore(),storePublicly(),getClientOriginalName()
        //getSize(),getError(),isValid(),move()
        //$test = $request->file('image')->isValid();
        //dd($test);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(\public_path('images'), $newImageName);

        //Validations

       $request->validate([
        'name' => 'required|unique:cars',
        'founded' => 'required|integer|min:0|max:2021',
        'description' => 'required',
        //'image' => 'required|mimes:png,jpg,jpeg|max:5784'
       ]);


        //if its valid it will proceed.
        //if its not valid, through a validation Exception.

        // pass as array
        $car = Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'img_path' => $newImageName,
            'user_id' => auth()->user()->id

        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        // To many relationship
        // $Product = Product::find($id);
        // print_r($Product);
        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valition
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(\public_path('images'), $newImageName);
        //$request->validated();
        $car = Car::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'founded' => $request->input('founded'),
                    'description' => $request->input('description'),
                    'img_path' => $newImageName

                ]);

        return redirect('/cars');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();

        return redirect('/cars');
    }
}
