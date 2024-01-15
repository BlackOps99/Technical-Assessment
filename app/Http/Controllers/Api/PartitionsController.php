<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partitions\PartitionsStoreRequest;
use App\Http\Requests\Partitions\PartitionsUpdateRequest;
use App\Http\Resources\PartitionsResource;
use App\Models\Partitions;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PartitionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->only(['store', 'update', 'destroy']);
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $partitions = Partitions::withAll()->latest()->paginate(15);

        return PartitionsResource::collection($partitions);
    }

    public function store(PartitionsStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $partition = Partitions::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Partition created successfully',
            'data' => new PartitionsResource($partition)
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {

            $partition = Partitions::withAll()->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => new PartitionsResource($partition)
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Partition not found'
            ], 404);
        }
    }

    public function update(PartitionsUpdateRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();

            $partition = Partitions::withOutAll()->findOrFail($id);

            $partition->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Partition updated successfully',
                'data' => new PartitionsResource($partition)
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Partition not found'
            ], 404);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {

            $partition = Partitions::withAll()->findOrFail($id);

            $partition->items()->delete();

            $partition->delete();

            return response()->json([
                'status' => true,
                'message' =>  'Partition delete successfully'
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Partition not found'
            ], 404);
        }
    }
}
