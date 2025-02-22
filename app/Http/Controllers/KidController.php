<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Services\KidService;
use App\Constants\Messages;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KidController extends Controller
{
    protected $kidService;

    public function __construct(KidService $kidService)
    {
        $this->kidService = $kidService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only([
            'search',
            'name',
            'gender',
            'birth_date',
            'order_by',
            'order_direction',
            'per_page'
        ]);

        return $this->kidService->getAllKids($filters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:100',
        ]);

        return $this->kidService->createKid($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        return $this->kidService->findKid($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:100',
        ]);

        return $this->kidService->updateKid($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        return $this->kidService->deleteKid($id);
    }
}
