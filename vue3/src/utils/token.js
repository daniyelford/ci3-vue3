import { BASE_URL, API_SECRET_KEY } from '@/config'
let tokenCache = null
let tokenExpireAt = 0
let tokenPromise = null
export async function getToken() {
  const now = Date.now()
  if (tokenCache && now < tokenExpireAt) {
    return tokenCache
  }
  if (tokenPromise) {
    return tokenPromise
  }
  tokenPromise = fetch(`${BASE_URL}/create_token`, {
    method: 'GET',
    credentials: 'include',
    headers: {
      'X-API-KEY': API_SECRET_KEY
    }
  })
    .then(res => res.json())
    .then(tokenJson => {
      if (tokenJson.status === 'error') {
        window.location.reload();
        throw new Error('Unauthorized')
      }
      tokenCache = tokenJson
      tokenExpireAt = Date.now() + 110 * 1000
      return tokenJson
    })
    .catch(err => {
      tokenCache = null
      tokenExpireAt = 0
      throw err
    })
    .finally(() => {
      tokenPromise = null
    })
  return tokenPromise
}