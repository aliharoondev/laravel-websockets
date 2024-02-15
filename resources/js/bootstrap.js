/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const {
    VITE_PUSHER_APP_KEY,
    VITE_PUSHER_APP_CLUSTER,
    VITE_PUSHER_PORT
} = import.meta.env;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: VITE_PUSHER_APP_KEY,
    cluster: VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: '127.0.0.1',
    wsPort: VITE_PUSHER_PORT ?? 80,
    wssPort: VITE_PUSHER_PORT ?? 443,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
    // authEndpoint: `http://127.0.0.1:8000/api/broadcasting/auth`,
    // auth: {
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //     }
    // }
});

