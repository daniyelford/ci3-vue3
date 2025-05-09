
    // JavaScript code for WebAuthn Registration/Login

    async function registerWebAuthn() {
        const publicKey = {
            challenge: new Uint8Array(16), // Fill with a challenge from server
            rp: { name: "WebAuthn" },
            user: { id: new Uint8Array(16), name: "user@example.com", displayName: "User" },
            pubKeyCredParams: [{ type: "public-key", alg: -7 }]
        };

        const credential = await navigator.credentials.create({ publicKey });

        // Send credential to your server for registration
    }

    async function loginWebAuthn() {
        const publicKey = {
            challenge: new Uint8Array(16), // Fill with a challenge from server
            rpId: "example.com",
            allowCredentials: [{
                type: "public-key",
                id: new Uint8Array(16)
            }]
        };

        const credential = await navigator.credentials.get({ publicKey });

        // Send credential to your server for verification
    }
