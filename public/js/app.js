const showPasswordButtons = document.querySelectorAll(".btn-show-password");

showPasswordButtons.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        e.preventDefault(); // if tag is link
        const inputPasswordTarget = this.dataset.inputPasswordTarget;
        const inputPassword = document.querySelector(inputPasswordTarget);
        if (inputPassword.getAttribute("type").toLowerCase() === "text") {
            inputPassword.setAttribute("type", "password");
        } else {
            inputPassword.setAttribute("type", "text");
        }
    });
});
