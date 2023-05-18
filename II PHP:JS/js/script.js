const login_button = document.querySelector("#login_form button");

document.getElementById("login_form").addEventListener("submit", (event) => {
    event.preventDefault();
    const form = event.target;
    const username = form.username.value;
    const password = form.password.value;

    login_button.disabled = true;

    fetch(form.action, {
        method: "POST",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                display_success_message();
                setTimeout(() => {
                    hide_success_message();
                }, 10000);
                fetch_user_data();
            } else {
                display_error_message(data.message);
            }
            login_button.disabled = false;
        })
        .catch(() => {
            display_error_message("Server error");
            login_button.disabled = false;
        });
});

function display_error_message(message) {
    const error_container = document.getElementById("error_container");
    error_container.innerHTML = message;
    error_container.style.display = "block";
}

function display_success_message() {
    const success_container = document.getElementById("success_container");
    success_container.style.display = "block";
}

function hide_success_message() {
    const success_container = document.getElementById("success_container");
    success_container.style.display = "none";
}

function fetch_user_data() {
    fetch("profile.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user_data_container = document.getElementById("user_data_container");
                user_data_container.innerHTML = data.html;
            } else {
                display_error_message(data.message);
            }
        })
        .catch(() => {
            display_error_message("Server error");
        });
}
