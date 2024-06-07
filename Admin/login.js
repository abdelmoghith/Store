let eye = document.querySelector(".eye ");
let password = document.querySelector(
  ".password-container input[type='password']"
);

eye.onclick = function () {
    if (password.type == "password") {
        eye.style.backgroundImage = "url(hide.png)";
        password.type = "text";
    } else if (password.type == "text") {
        eye.style.backgroundImage = "url(eye.png)";
      password.type = "password";
    }
  };
  