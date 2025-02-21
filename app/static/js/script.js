// document.addEventListener("DOMContentLoaded", function () {
// document.querySelector("#loginBtn").addEventListener("click", loginUser);
// document.querySelector("#registerBtn").addEventListener("click", registerUser);
// login();
// });

// function loginUser(event) {
//     event.preventDefault();

//     let email = document.querySelector("#login input[placeholder='Username or Email']").value.trim();
//     let password = document.querySelector("#login input[placeholder='Password']").value.trim();

//     if (email === "" || password === "") {
//         alert("Please fill in all fields.");
//         return;
//     }

//     fetch("../user/login_action.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify({ email: email, password: password })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert("Login successful!");
//             window.location.href = "index.php"; 
//         } else {
//             alert(data.message);
//         }
//     })
//     .catch(error => console.error("Error:", error));
// }

// function registerUser(event) {
//     event.preventDefault();

//     let firstName = document.querySelector("#register input[placeholder='Firstname']").value.trim();
//     let lastName = document.querySelector("#register input[placeholder='Lastname']").value.trim();
//     let email = document.querySelector("#register input[placeholder='Email']").value.trim();
//     let password = document.querySelector("#register input[placeholder='Password']").value.trim();

//     if (firstName === "" || lastName === "" || email === "" || password === "") {
//         alert("Please fill in all fields.");
//         return;
//     }

//     fetch("../user/login_action.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify({ firstName: firstName, lastName: lastName, email: email, password: password })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert("Registration successful! Please log in.");
//             login(); 
//         } else {
//             alert(data.message);
//         }
//     })
//     .catch(error => console.error("Error:", error));
// }

function login() {
    document.getElementById("login").style.display = "block";
    document.getElementById("register_div").style.display = "none";
}

function register() {
    document.getElementById("login").style.display = "none";
    document.getElementById("register_div").style.display = "block";
}
function showLogin() {
    document.getElementById("login").style.display = "block";
    document.getElementById("register_div").style.display = "none";
}

function showRegister() {
    document.getElementById("login").style.display = "none";
    document.getElementById("register_div").style.display = "block";
}