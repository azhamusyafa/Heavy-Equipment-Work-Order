<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentCategory\PatchEquipmentCategoryRequest;
use App\Http\Requests\EquipmentCategory\StoreEquipmentCategoryRequest;
use App\Http\Requests\EquipmentCategory\UpdateEquipmentCategoryRequest;
use App\Http\Resources\EquipmentCategoryResource;
use App\Models\EquipmentCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class EquipmentCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = EquipmentCategory::all();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data kategori alat berat',
            'data'    => EquipmentCategoryResource::collection($categories),
        ]);
    }

    public function store(StoreEquipmentCategoryRequest $request): JsonResponse
    {
        $path = $request->file('manual_book')->store('equipment-manuals', 'public');

        $category = EquipmentCategory::create([
            'category_name'         => $request->category_name,
            'is_active'             => $request->is_active,
            'manual_book_file_path' => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori alat berat berhasil disimpan',
            'data'    => new EquipmentCategoryResource($category),
        ], 201);
    }

    public function update(UpdateEquipmentCategoryRequest $request, EquipmentCategory $equipmentCategory): JsonResponse
    {
        $path = $equipmentCategory->manual_book_file_path;

        if ($request->hasFile('manual_book')) {
            if ($path) Storage::disk('public')->delete($path);
            $path = $request->file('manual_book')->store('equipment-manuals', 'public');
        } else {
            $path = null;
        }

        $equipmentCategory->update([
            'category_name'         => $request->category_name,
            'is_active'             => $request->is_active,
            'manual_book_file_path' => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori alat berat berhasil disimpan',
            'data'    => new EquipmentCategoryResource($equipmentCategory),
        ]);
    }

    public function patch(PatchEquipmentCategoryRequest $request, EquipmentCategory $equipmentCategory): JsonResponse
    {
        $data = $request->only(['category_name', 'is_active']);

        if ($request->hasFile('manual_book')) {
            if ($equipmentCategory->manual_book_file_path) {
                Storage::disk('public')->delete($equipmentCategory->manual_book_file_path);
            }
            $data['manual_book_file_path'] = $request->file('manual_book')->store('equipment-manuals', 'public');
        }

        $equipmentCategory->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori alat berat berhasil disimpan',
            'data'    => new EquipmentCategoryResource($equipmentCategory),
        ]);
    }

    public function destroy(EquipmentCategory $equipmentCategory): JsonResponse
    {
        $equipmentCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori alat berat berhasil dihapus',
            'data'    => null,
        ]);
    }
}