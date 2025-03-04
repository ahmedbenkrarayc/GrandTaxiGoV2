const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

navigator.geolocation.watchPosition(
    (position) => {
        fetch('/driver/location', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                latitude : position.coords.latitude,
                longitude : position.coords.longitude
            })
        })
        .then(response => response.json())
        .then(data => console.log('Success:', data))
        .catch(error => console.error('Error:', error))
    },
    (error) => {
        console.error("Error getting location:", error.message);
    },
    {
        enableHighAccuracy: true,
        maximumAge: 0,
        timeout: 5000
    }
)
