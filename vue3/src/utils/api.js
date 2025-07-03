import { getToken } from '@/utils/token'
import { BASE_URL, API_SECRET_KEY } from '@/config'
import router from '@/router'
let isLoggingOut = false
export async function sendApi(data = {}) {
  try {
    const token = await getToken()
    const response = await fetch(`${BASE_URL}/api`, {
      method: 'POST',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token.token}`,
        'X-API-KEY': API_SECRET_KEY,
        'X-API-KEY-BACK': token.key,
      },
      body: JSON.stringify(data)
    })
    const result = await response.json()
    if (result.code === 401 && result.status === 'error') {
      if (!isLoggingOut) {
        isLoggingOut = true
        localStorage.clear()
        router.push('/')
      }
      throw new Error('Unauthorized')
    }
    return result
  } catch (err) {
    console.error('API Error:', err)
    throw err
  }
}