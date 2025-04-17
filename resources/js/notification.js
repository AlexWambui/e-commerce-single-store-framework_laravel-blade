function dismissNotifications() {
    setTimeout(function () {
        document.querySelectorAll('.notification').forEach(function (notification) {
            notification.remove();
        });
    }, 4000);
}

document.addEventListener('DOMContentLoaded', dismissNotifications);

// 💡 Listen for Livewire SPA-style navigation
document.addEventListener('livewire:navigated', dismissNotifications);
