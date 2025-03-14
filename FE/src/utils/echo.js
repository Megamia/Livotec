import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Khởi tạo Laravel Echo
const echo = new Echo({
  broadcaster: "pusher",
  key: "39fb1bb26c9026f8e279",
  cluster: "mt1",
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
});

// Log khi kết nối thành công
echo.connector.pusher.connection.bind("connected", () => {
  console.log("✅ WebSocket Connected!"); // Log khi kết nối WebSocket thành công
});

// Log khi kết nối bị ngắt
echo.connector.pusher.connection.bind("disconnected", () => {
  console.log("⚠️ WebSocket Disconnected!"); // Log khi WebSocket bị ngắt kết nối
});

// Log khi WebSocket kết nối lại
echo.connector.pusher.connection.bind("reconnected", () => {
  console.log("🔄 WebSocket Reconnected!"); // Log khi WebSocket kết nối lại
});

// Log khi WebSocket kết nối lại thất bại
echo.connector.pusher.connection.bind("error", (error) => {
  console.error("❌ WebSocket Connection Error:", error); // Log khi có lỗi kết nối WebSocket
});

export default echo;
