<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Http\Requests\StoreKidRequest;
use App\Http\Requests\UpdateKidRequest;
use Illuminate\Http\Request;

class KidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kid::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:100',
        ]);

        return Kid::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Kid $kid)
    {
        return $kid;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kid $kid)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:100',
        ]);

        $kid->update($request->all());
        return $kid;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kid $kid)
    {
        return $kid->delete();
    }
}
