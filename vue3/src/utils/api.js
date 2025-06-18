import { BASE_URL, API_SECRET_KEY } from '@/config';
let isLoggingOut = false;
export async function sendApi(data = {}) {
  try {
    const tokenRes = await fetch(`${BASE_URL}/create_token`, {
      method: 'GET',
      credentials: 'include',
      headers: {
        'X-API-KEY': API_SECRET_KEY
      }
    });
    const tokenJson = await tokenRes.json();
    if (!tokenJson.token || tokenJson.error || tokenJson.status==='error') {
      if (!isLoggingOut) {
        isLoggingOut = true;
        console.warn('نشست منقضی شده. هدایت به صفحه ورود...');
        localStorage.clear();
        window.location.href = `${BASE_URL}`;
      }
      throw new Error('Unauthorized');
    }
    const token = tokenJson.token;
    const response = await fetch(`${BASE_URL}/api`, {
      method: 'POST',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'X-API-KEY': API_SECRET_KEY
      },
      body: JSON.stringify(data)
    });
    const result = await response.json();
    if (result.code === 401 || result.message === 'توکن نامعتبر است') {
      if (!isLoggingOut) {
        isLoggingOut = true;
        console.warn('نشست منقضی شده. هدایت به صفحه ورود...');
        localStorage.clear();
        window.location.href = `${BASE_URL}`;
      }
      throw new Error('Unauthorized');
    }
    return result;
  } catch (err) {
    console.error('API Error:', err);
    throw err;
  }
}
