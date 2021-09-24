Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: PUSHER_KEY,
    cluster: PUSHER_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    authEndpoint: "api/custom_auth",
    disableStats: true,
});

window.Echo.channel("test").listen("Test", (e) => {
    alert("listened");
    console.log(e);
});

window.Echo.channel("private-user-signed-up." + SOME_ID).listen(
    "UserSignedUp",
    (e) => {
        console.log(e);
        document.getElementById("new-user-alert").style.display = "block";
        document.getElementById("new-user-response").innerHTML = e.message;
        setTimeout(() => {
            document.getElementById("new-user-alert").style.display = "none";
        }, 10000);
    }
);
