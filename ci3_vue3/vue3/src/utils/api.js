import { BASE_URL } from '@/config';
export async function sendApi(data = {}) {
    try {
        const tokenRes = await fetch(`${BASE_URL}/create_token`, {
            method: 'GET',
            credentials: 'include'
        });
        const tokenJson = await tokenRes.json();
        if (!tokenJson.token) {
            throw new Error('توکن دریافت نشد');
        }
        const token = tokenJson.token;
        const response = await fetch(`${BASE_URL}/api`, {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify({ data })
        });
        const result = await response.json();
        if (!response.ok) throw result;
        return result;
    } catch (err) {
        console.error('API Error:', err);
        throw err;
    }
}