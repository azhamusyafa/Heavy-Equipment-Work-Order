import axios, { type AxiosInstance, type AxiosError } from 'axios'

const BASE_URL = import.meta.env.PUBLIC_API_URL ?? 'http://localhost:8000/api'
const USERNAME = import.meta.env.PUBLIC_API_USERNAME ?? 'admin'
const PASSWORD = import.meta.env.PUBLIC_API_PASSWORD ?? 'Rahasia123'

const api: AxiosInstance = axios.create({
  baseURL: BASE_URL,
  headers: {
    Accept: 'application/json',
  },
  auth: {
    username: USERNAME,
    password: PASSWORD,
  },
})

const RETRY_STATUS = [503, 504]
const MAX_RETRIES = 3
const RETRY_DELAY = 1000

const delay = (ms: number) => new Promise((resolve) => setTimeout(resolve, ms))

api.interceptors.response.use(
  (response) => response,
  async (error: AxiosError) => {
    const config = error.config as typeof error.config & { _retryCount?: number }

    if (error.response && RETRY_STATUS.includes(error.response.status)) {
      config._retryCount = config._retryCount ?? 0

      if (config._retryCount < MAX_RETRIES) {
        config._retryCount++
        await delay(RETRY_DELAY)
        return api(config)
      }
    }

    return Promise.reject(error)
  }
)

export default api