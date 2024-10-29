// realtime-voucher
import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Assign Pusher to the window object for global access
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    wsHost: process.env.MIX_PUSHER_HOST || `ws-${process.env.MIX_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: process.env.MIX_PUSHER_PORT || 443,
    wssPort: process.env.MIX_PUSHER_PORT || 443,
    enabledTransports: ["ws", "wss"],
});

window.Echo.channel("khuyen-mai")
    .listen("KhuyenMaiMoiEvent", (e) => {
        console.log("Khuyen mai updated:", e.khuyen_mai);
        // Add code here to update the page content or show notifications
    });
