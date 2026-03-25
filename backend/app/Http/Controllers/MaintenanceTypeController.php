<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceType\PatchMaintenanceTypeRequest;
use App\Http\Requests\MaintenanceType\StoreMaintenanceTypeRequest;
use App\Http\Requests\MaintenanceType\UpdateMaintenanceTypeRequest;
use App\Http\Resources\MaintenanceTypeResource;
use App\Models\MaintenanceType;
use Illuminate\Http\JsonResponse;

class MaintenanceTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $types = MaintenanceType::all();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data tipe maintenance',
            'data'    => MaintenanceTypeResource::collection($types),
        ]);
    }

    public function store(StoreMaintenanceTypeRequest $request): JsonResponse
    {
        $type = MaintenanceType::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tipe maintenance berhasil disimpan',
            'data'    => new MaintenanceTypeResource($type),
        ], 201);
    }

    public function update(UpdateMaintenanceTypeRequest $request, MaintenanceType $maintenanceType): JsonResponse
    {
        $data = $request->validated();

        if (!$request->has('description')) {
            $data['description'] = null;
        }

        $maintenanceType->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Tipe maintenance berhasil disimpan',
            'data'    => new MaintenanceTypeResource($maintenanceType),
        ]);
    }

    public function patch(PatchMaintenanceTypeRequest $request, MaintenanceType $maintenanceType): JsonResponse
    {
        $data = $request->validated();

        if ($request->has('description')) {
            $data['description'] = $request->input('description');
        }

        $maintenanceType->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Tipe maintenance berhasil disimpan',
            'data'    => new MaintenanceTypeResource($maintenanceType),
        ]);
    }

    public function destroy(MaintenanceType $maintenanceType): JsonResponse
    {
        $maintenanceType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tipe maintenance berhasil dihapus',
            'data'    => null,
        ]);
    }
}