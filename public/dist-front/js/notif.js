// require("../../../resources/js/bootstrap.js");

const notificationCount = document.getElementById("jumlah-notif");

if (notificationCount) {
    const channel = window.Pusher.subscribe(
        "private-App.User." + notificationCount.dataset.userId
    );

    channel.bind(
        "Illuminate\\Notifications\\Events\\BroadcastNotificationCreated",
        function (data) {
            notificationCount.textContent =
                parseInt(notificationCount.textContent) + 1;
        }
    );

    channel.bind("App\\Events\\SnoozeNotifications", function (data) {
        notificationCount.textContent =
            parseInt(notificationCount.textContent) - data.count;
    });
}
