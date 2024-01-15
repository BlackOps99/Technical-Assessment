<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemsStoreRequest;
use App\Http\Requests\Items\ItemsUpdateRequest;
use App\Http\Resources\ItemsResource;
use App\Models\Items;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->only(['store', 'update', 'destroy']);
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $items = Items::withAll()->latest()->paginate(15);

        return ItemsResource::collection($items);
    }

    public function store(ItemsStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $item = Items::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Item created successfully',
            'data' => new ItemsResource($item)
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {

            $item = Items::withAll()->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => new ItemsResource($item)
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 404);
        }
    }

    public function update(ItemsUpdateRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();

            $item = Items::withOutAll()->findOrFail($id);

            $item->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Item updated successfully',
                'data' => new ItemsResource($item)
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 404);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {

            $item = Items::withAll()->findOrFail($id);

            $item->delete();

            return response()->json([
                'status' => true,
                'message' =>  'Item delete successfully'
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 404);
        }
    }
}
