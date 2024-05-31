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
        return Cars::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth()->user();
        $request->validate([
            'carModel' => 'required',
            'tags' => 'required',
            'src' => 'required',
            'available' => 'required',
            'description' => 'required',
            'rental_price_per_day' => 'required',
            'user_id' => $user->id,
            'location' => 'required'
        ]);

        return Cars::create($request->all());
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
    public function update(Request $request, string $id)
    {
        $car = Cars::find($id);
        $car->update($request->all());

        return $car;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Cars::destroy($id);
    }

        /**
     * search in cars
     */
    public function search(string $name)
    {
        return Cars::where('carModel', 'like', '%'.$name.'%')->get();
    }
}
