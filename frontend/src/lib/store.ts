import { atom, map } from 'nanostores'
import type { WorkOrder, EquipmentCategory, MaintenanceType, WorkshopLocation } from '../types'

export const workOrders = atom<WorkOrder[]>([])
export const nextCursor = atom<string | null>(null)
export const isLoadingWorkOrders = atom<boolean>(false)

export const equipmentCategories = atom<EquipmentCategory[]>([])
export const maintenanceTypes = atom<MaintenanceType[]>([])
export const workshopLocations = atom<WorkshopLocation[]>([])

export const formErrors = map<Record<string, string[]>>({})
export const globalMessage = atom<{ type: 'success' | 'error'; text: string } | null>(null)

export function setFormErrors(errors: Record<string, string[]>) {
  formErrors.set(errors)
}

export function clearFormErrors() {
  formErrors.set({})
}

export function setGlobalMessage(type: 'success' | 'error', text: string) {
  globalMessage.set({ type, text })
  setTimeout(() => globalMessage.set(null), 4000)
}