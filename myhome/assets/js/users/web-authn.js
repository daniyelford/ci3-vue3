// Registration example
async function register() {
    const options = await fetch('/webauthn/register').then(response => response.json());

    const credential = await navigator.credentials.create({ publicKey: options });

    const response = await fetch('/webauthn/registerCallback', {
        method: 'POST',
        body: JSON.stringify(credential),
        headers: { 'Content-Type': 'application/json' }
    });

    const result = await response.json();
    if (result.status === "success") {
        alert("Registration successful!");
    }
}

// Authentication example
async function authenticate() {
    const options = await fetch('/webauthn/authenticate').then(response => response.json());

    const assertion = await navigator.credentials.get({ publicKey: options });

    const response = await fetch('/webauthn/authenticateCallback', {
        method: 'POST',
        body: JSON.stringify(assertion),
        headers: { 'Content-Type': 'application/json' }
    });

    const result = await response.json();
    if (result.status === "success") {
        alert("Authentication successful!");
    }
}
