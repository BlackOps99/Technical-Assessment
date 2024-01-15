<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoriesStoreRequest;
use App\Http\Requests\Categories\CategoriesUpdateRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Categories;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->only(['store', 'update', 'destroy']);
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = Categories::withAll()->latest()->paginate(15);

        return CategoriesResource::collection($categories);
    }

    public function store(CategoriesStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $cat = Categories::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => new CategoriesResource($cat)
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {

            $category = Categories::withAll()->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => new CategoriesResource($category)
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }

    public function update(CategoriesUpdateRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();

            $category = Categories::withOutAll()->findOrFail($id);

            $category->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
                'data' => new CategoriesResource($category)
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {

            $category = Categories::withAll()->findOrFail($id);

            $category->delete();

            return response()->json([
                'status' => true,
                'message' =>  'Category delete successfully'
            ]);

        } catch (ModelNotFoundException) {

            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }
}
