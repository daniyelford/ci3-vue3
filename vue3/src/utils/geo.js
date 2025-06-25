export async function fullAddress(lat, lng){
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`
    const response = await fetch(url, {
        headers: {
            'Accept': 'application/json',
            'User-Agent': 'YourAppName/1.0 (29danialfrd69@gmail.com)'
        }
    })
    return await response.json()
}