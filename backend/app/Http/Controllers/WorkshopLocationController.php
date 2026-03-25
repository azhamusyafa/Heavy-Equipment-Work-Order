<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkshopLocation\PatchWorkshopLocationRequest;
use App\Http\Requests\WorkshopLocation\StoreWorkshopLocationRequest;
use App\Http\Requests\WorkshopLocation\UpdateWorkshopLocationRequest;
use App\Http\Resources\WorkshopLocationResource;
use App\Models\WorkshopLocation;
use Illuminate\Http\JsonResponse;

class WorkshopLocationController extends Controller
{
    public function index(): JsonResponse
    {
        $locations = WorkshopLocation::all();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data lokasi workshop',
            'data'    => WorkshopLocationResource::collection($locations),
        ]);
    }

    public function store(StoreWorkshopLocationRequest $request): JsonResponse
    {
        $location = WorkshopLocation::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Lokasi workshop berhasil disimpan',
            'data'    => new WorkshopLocationResource($location),
        ], 201);
    }

    public function update(UpdateWorkshopLocationRequest $request, WorkshopLocation $workshopLocation): JsonResponse
    {
        $workshopLocation->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Lokasi workshop berhasil disimpan',
            'data'    => new WorkshopLocationResource($workshopLocation),
        ]);
    }

    public function patch(PatchWorkshopLocationRequest $request, WorkshopLocation $workshopLocation): JsonResponse
    {
        $workshopLocation->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Lokasi workshop berhasil disimpan',
            'data'    => new WorkshopLocationResource($workshopLocation),
        ]);
    }

    public function destroy(WorkshopLocation $workshopLocation): JsonResponse
    {
        $workshopLocation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lokasi workshop berhasil dihapus',
            'data'    => null,
        ]);
    }
}