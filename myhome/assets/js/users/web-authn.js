function webauthnRegister() {
    // 1. گرفتن گزینه‌ها از سرور
    $.getJSON('webauthn_register_options', function(options) {
        options.challenge = base64ToBuffer(options.challenge);
        options.user.id = base64ToBuffer(options.user.id);
        navigator.credentials.create({ publicKey: options })
            .then(function(credential) {
                // 2. ارسال پاسخ به سرور
                $.ajax({
                    url: 'webauthn_verify_register',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(prepareCredentialForServer(credential)),
                    success: function(response) {
                        alert('ثبت با موفقیت انجام شد!');
                    }
                });
            })
            .catch(function(error) {
                console.error(error);
                alert('خطا در ثبت');
            });
    });
}
function webauthnLogin() {
    // 1. گرفتن challenge و allowCredentials از سرور
    $.getJSON('webauthn_login_options', function(options) {
        options.challenge = base64ToBuffer(options.challenge);
        options.allowCredentials = options.allowCredentials.map(function(cred) {
            cred.id = base64ToBuffer(cred.id);
            return cred;
        });

        navigator.credentials.get({ publicKey: options })
            .then(function(assertion) {
                // 2. ارسال پاسخ به سرور
                $.ajax({
                    url: 'webauthn_verify_login',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(prepareAssertionForServer(assertion)),
                    success: function(response) {
                        alert('ورود موفق بود!');
                        // مثلا بری به داشبورد
                        window.location.href = '/dashboard';
                    }
                });
            })
            .catch(function(error) {
                console.error(error);
                alert('خطا در ورود');
            });
    });
}
// 👇 تبدیل base64 به ArrayBuffer
function base64ToBuffer(base64) {
    base64 = base64.replace(/-/g, '+').replace(/_/g, '/');
    const pad = base64.length % 4 ? 4 - base64.length % 4 : 0;
    base64 += '='.repeat(pad);
    const binary = atob(base64);
    const buffer = new ArrayBuffer(binary.length);
    const view = new Uint8Array(buffer);
    for (let i = 0; i < binary.length; i++) {
        view[i] = binary.charCodeAt(i);
    }
    return buffer;
}

// 👇 تبدیل ArrayBuffer به base64url
function bufferToBase64(buffer) {
    let binary = '';
    const bytes = new Uint8Array(buffer);
    for (let i = 0; i < bytes.byteLength; i++) {
        binary += String.fromCharCode(bytes[i]);
    }
    return btoa(binary).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '');
}

// 👇 آماده کردن داده ثبت (برای سرور)
function prepareCredentialForServer(cred) {
    return {
        id: cred.id,
        rawId: bufferToBase64(cred.rawId),
        type: cred.type,
        response: {
            attestationObject: bufferToBase64(cred.response.attestationObject),
            clientDataJSON: bufferToBase64(cred.response.clientDataJSON)
        }
    };
}

// 👇 آماده کردن داده ورود (برای سرور)
function prepareAssertionForServer(assertion) {
    return {
        id: assertion.id,
        rawId: bufferToBase64(assertion.rawId),
        type: assertion.type,
        response: {
            authenticatorData: bufferToBase64(assertion.response.authenticatorData),
            clientDataJSON: bufferToBase64(assertion.response.clientDataJSON),
            signature: bufferToBase64(assertion.response.signature),
            userHandle: assertion.response.userHandle ? bufferToBase64(assertion.response.userHandle) : null
        }
    };
}
