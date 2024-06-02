<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cars::all()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth()->user();
        $carData = $request->validate([
            'carModel' => 'required',
            'tags' => 'required',
            'src' => 'required',
            'available' => 'required',
            'description' => 'required',
            'rental_price_per_day' => 'required',
            'location' => 'required'
        ]);

        $carData['user_id'] = $user->id;

        $car = Cars::create($carData);

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cars::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cars $car)
    {
        $user = Auth()->user();

        if($car->user_id == $user->id) {
            $carData = $request->validate([
                'carModel' => 'required',
                'tags' => 'required',
                'src' => 'required',
                'available' => 'required',
                'description' => 'required',
                'rental_price_per_day' => 'required',
                'location' => 'required'
            ]);
            $carData['user_id'] = $user->id;
    
            $updatedCar = $car->create($carData);
    
            return response()->json($updatedCar, 201);
        }
        abort(403, 'Unauthorized');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cars $car)
    {
        if($car->user_id == Auth()->id()) {
            $deletedCar = $car->carModel;

            $car->delete();
            return response()->json([
                'message'=> 'deleted succesfully',
                'deleted car'=> $deletedCar
            ], 200);
        }
        abort(403, 'Unauthorized');
    }

        /**
     * search in cars
     */
    public function search(string $name)
    {
        return Cars::where('carModel', 'like', '%'.$name.'%')->get();
    }


    //show users cars
    public function myCars() {
        $user = Auth()->user();
        $cars = Cars::where('user_id', $user->id)->paginate(2);
        return response()->json($cars, 200);
    }
}
