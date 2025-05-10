<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function index()
    {
        return response()->json(Vehicles::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicles_name' => 'required|string',
            'plate_number' => 'required|string',
            'model' => 'required|string',
            'fuel_type' => 'required|string',
            'price_per_day' => 'required|numeric',
            'location' => 'required|string',
        ]);

        $vehicle = Vehicles::create([
            'users_id' => Auth::id(),
            'vehicles_name' => $request->vehicles_name,
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'fuel_type' => $request->fuel_type,
            'price_per_day' => $request->price_per_day,
            'location' => $request->location,
        ]);

        return response()->json($vehicle, 201);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicles::findOrFail($id);

        $this->authorize('update', $vehicle);

        $vehicle->update($request->only(['vehicles_name', 'plate_number', 'model', 'fuel_type', 'price_per_day', 'location']));

        return response()->json($vehicle);
    }

    public function destroy($id)
    {
        $vehicle = Vehicles::findOrFail($id);

        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted successfully']);
    }
}
