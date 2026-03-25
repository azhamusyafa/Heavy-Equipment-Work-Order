export interface MaintenanceType {
  id: number
  code: string
  name: string
  description: string | null
  created_at: string
  updated_at: string
}

export interface EquipmentCategory {
  id: number
  category_name: string
  manual_book_file_path: string | null
  is_active: boolean
  created_at: string
  updated_at: string
}

export interface WorkshopLocation {
  id: number
  site_code: string
  location_name: string
  address: string
  created_at: string
  updated_at: string
}

export interface WorkOrder {
  id: string
  wo_number: string
  equipment_serial_number: string
  current_hour_meter: number
  reporter_name: string
  breakdown_symptom: string
  reported_at: string
  scheduled_date: string | null
  is_machine_down: boolean
  damage_photo_path: string
  estimated_repair_cost: number | null
  actual_repair_cost: number | null
  status: 'OPEN' | 'INSPECTED' | 'IN_PROGRESS' | 'COMPLETED'
  inspection_notes: string | null
  lead_mechanic_name: string | null
  replaced_parts_log: string | null
  inspected_at: string | null
  completed_at: string | null
  created_at: string
  maintenance_type: Pick<MaintenanceType, 'id' | 'code' | 'name'>
  equipment_category: Pick<EquipmentCategory, 'id' | 'category_name'>
  workshop_location: Pick<WorkshopLocation, 'id' | 'site_code' | 'location_name'>
}

export interface ApiResponse<T> {
  success: boolean
  message: string
  data: T
}

export interface ApiErrorResponse {
  success: false
  message: string
  errors: Record<string, string[]>
}

export interface CursorPagination<T> {
  data: T[]
  next_cursor: string | null
  prev_cursor: string | null
}