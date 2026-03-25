<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrder\AssignMechanicRequest;
use App\Http\Requests\WorkOrder\CompleteWorkOrderRequest;
use App\Http\Requests\WorkOrder\InspectWorkOrderRequest;
use App\Http\Requests\WorkOrder\StoreWorkOrderRequest;
use App\Http\Resources\WorkOrderResource;
use App\Models\WorkOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class WorkOrderController extends Controller
{
    public function index(): JsonResponse
    {
        $workOrders = WorkOrder::with(['maintenanceType', 'equipmentCategory', 'workshopLocation'])
            ->cursorPaginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar Work Order',
            'data'    => WorkOrderResource::collection($workOrders),
        ]);
    }

    public function store(StoreWorkOrderRequest $request): JsonResponse
    {
        $photoPath = $request->file('damage_photo')->store('work-orders/photos', 'public');

        $workOrder = WorkOrder::create([
            ...$request->safe()->except('damage_photo'),
            'damage_photo_path' => $photoPath,
            'wo_number'         => $this->generateWoNumber(),
            'status'            => 'OPEN',
            'created_by_ip'     => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work order berhasil dibuat',
            'data'    => new WorkOrderResource($workOrder),
        ], 201);
    }

    public function inspect(InspectWorkOrderRequest $request, WorkOrder $workOrder): JsonResponse
    {
        if ($workOrder->status !== 'OPEN') {
            return response()->json([
                'success' => false,
                'message' => 'Work Order harus berstatus OPEN untuk dapat diinspeksi.',
            ], 422);
        }

        $workOrder->update([
            'inspection_notes'      => $request->inspection_notes,
            'estimated_repair_cost' => $request->estimated_repair_cost,
            'status'                => 'INSPECTED',
            'inspected_at'          => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Inspeksi Work Order berhasil dicatat',
            'data'    => new WorkOrderResource($workOrder),
        ]);
    }

    public function assignMechanic(AssignMechanicRequest $request, WorkOrder $workOrder): JsonResponse
    {
        if ($workOrder->status !== 'INSPECTED') {
            return response()->json([
                'success' => false,
                'message' => 'Work Order harus berstatus INSPECTED untuk dapat ditugaskan mekanik.',
            ], 422);
        }

        $workOrder->update([
            'lead_mechanic_name' => $request->lead_mechanic_name,
            'status'             => 'IN_PROGRESS',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mekanik berhasil ditugaskan',
            'data'    => new WorkOrderResource($workOrder),
        ]);
    }

    public function complete(CompleteWorkOrderRequest $request, WorkOrder $workOrder): JsonResponse
    {
        if ($workOrder->status !== 'IN_PROGRESS') {
            return response()->json([
                'success' => false,
                'message' => 'Work Order harus berstatus IN_PROGRESS untuk dapat diselesaikan.',
            ], 422);
        }

        $workOrder->update([
            'actual_repair_cost'  => $request->actual_repair_cost,
            'replaced_parts_log'  => $request->replaced_parts_log,
            'status'              => 'COMPLETED',
            'completed_at'        => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work Order berhasil diselesaikan',
            'data'    => new WorkOrderResource($workOrder),
        ]);
    }

    private function generateWoNumber(): string
    {
        $prefix = 'WO-' . now()->format('Ym');
        $last = WorkOrder::withTrashed()
            ->where('wo_number', 'like', $prefix . '-%')
            ->orderByDesc('wo_number')
            ->first();

        $increment = $last
            ? (int) substr($last->wo_number, strrpos($last->wo_number, '-') + 1) + 1
            : 1;

        return $prefix . '-' . str_pad($increment, 3, '0', STR_PAD_LEFT);
    }
}