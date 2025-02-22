<?php

namespace App\Services;

use App\Constants\Messages;
use App\Repositories\Interfaces\KidRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class KidService
{
    protected $kidRepository;

    public function __construct(KidRepositoryInterface $kidRepository)
    {
        $this->kidRepository = $kidRepository;
    }

    public function getAllKids(array $filters = []): JsonResponse
    {
        try {
            $kids = $this->kidRepository->getAll($filters);

            return response()->json([
                'data' => $kids,
                'message' => Messages::get('success', 'listed')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => Messages::get('error', 'listing'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createKid(array $data): JsonResponse
    {
        try {
            $kid = $this->kidRepository->create($data);

            return response()->json([
                'data' => $kid,
                'message' => Messages::get('success', 'created')
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => Messages::get('error', 'creating'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateKid(int $id, array $data): JsonResponse
    {
        try {
            $kid = $this->kidRepository->findById($id);

            if (!$kid) {
                throw new Exception(Messages::get('error', 'not_found'));
            }

            $updatedKid = $this->kidRepository->update($kid, $data);

            return response()->json([
                'data' => $updatedKid,
                'message' => Messages::get('success', 'updated')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => Messages::get('error', 'updating'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteKid(int $id): JsonResponse
    {
        try {
            $deleted = $this->kidRepository->delete($id);

            if (!$deleted) {
                throw new Exception(Messages::get('error', 'not_found'));
            }

            return response()->json([
                'message' => Messages::get('success', 'deleted')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => Messages::get('error', 'deleting'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function findKid(int $id): JsonResponse
    {
        try {
            $kid = $this->kidRepository->findById($id);

            if (!$kid) {
                throw new Exception(Messages::get('error', 'not_found'));
            }

            return response()->json([
                'data' => $kid,
                'message' => Messages::get('success', 'found')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => Messages::get('error', 'finding'),
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
