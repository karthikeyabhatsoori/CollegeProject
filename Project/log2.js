const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const formbox = document.getElementById('registration');
const redirection = document.getElementById('redirection');
console.log(redirection);
loginLink.addEventListener("click", (event)=>{
    event.preventDefault();
    const loginForm = document.querySelector(".wrapper .form-box.login");
    loginForm.style.display = "block";
    formbox.style.display = "none"
});

redirection.addEventListener("click", () => {
    // Redirect to the desired URL
    console.log("Event triggered")
    window.location.href = "p2.html"; // Replace "p2.html" with the URL you want to redirect to
});



