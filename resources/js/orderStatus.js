window.Echo.private('order.' + orderId)
    .listen('OrderStatusUpdated', (event) => {
        console.log('Trạng thái đơn hàng đã được cập nhật:', event);
        // Cập nhật giao diện với trạng thái mới
        document.getElementById('status-' + event.id).innerText = event.trang_thai_don_hang;
    });