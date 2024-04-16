<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Patron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PatronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patron = Patron::all();
        return $patron;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->messages()], 422);
        }
        $patron = Patron::create($request->all());
        return response()->json(['message' => " you add a new patron successfully", 'data' => $patron], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patron $patron)
    {
        return $patron;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patron $patron)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->messages()], 422);
        }

        $patron->update($request->all());

        return response()->json(['message' => "Patron details updated successfully", 'data' => $patron], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patron $patron)
    {
        $patron->delete();

        return response()->json(['message' => "Patron deleted successfully"], 204);
    }
}
