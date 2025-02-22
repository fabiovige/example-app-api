<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Http\Requests\StoreKidRequest;
use App\Http\Requests\UpdateKidRequest;

class KidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKidRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kid $kid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKidRequest $request, Kid $kid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kid $kid)
    {
        //
    }
}
