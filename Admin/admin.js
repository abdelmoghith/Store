let btn = document.querySelector(".just");
let list = document.querySelector(".list");
let icon = document.querySelector(".fa-chevron-down");

btn.onclick = function () {
  if (list.classList.contains("show")) {
    list.classList.remove("show");
    btn.style.backgroundColor = "";
    setTimeout(() => {
      list.style.display = "none";
    }, 500);
    icon.style.rotate = "0deg";
  } else {
    btn.style.backgroundColor = "#eeeeeed5";
    list.style.display = "block";
    icon.style.rotate = "180deg";
    setTimeout(() => {
      list.classList.add("show");
    }, 10);
  }
};

let links = document.querySelectorAll("#view");
let okButton = document.querySelector("#Okey");
let view = document.querySelector(".About");
let confirmation = document.querySelector(".confirmation");
let cancel = document.querySelector("#Cancel");

let exitButton = document.querySelector(".About-product > div:first-child p");
let exitConfirmation = document.querySelector(
  ".confirmation > div:first-child p"
);
let menu = document.querySelector(".About-product");
let buyButton = document.querySelector(".flex h3:last-of-type");
let Delete = document.querySelectorAll("td > i");
let page = document.querySelector(".left , .contain");
let page2 = document.querySelector(".contain");

function showMenu() {
  menu.style.opacity = "1";
  menu.style.display = "inline";
  blurBackground();
}

function hideMenu() {
  menu.style.display = "none";
  removeBlur();
}

function showView() {
  view.style.opacity = "1";
  view.style.display = "inline";
  blurBackground();
}
function showConfirmation() {
  confirmation.style.opacity = "1";
  confirmation.style.display = "inline";
  blurBackground();
}

function hideConfirmation() {
  confirmation.style.display = "none";
  removeBlur();
}
function hideView() {
  view.style.display = "none";
  removeBlur();
}

function blurBackground() {
  page.style.opacity = "0.2";
  page.style.filter = "blur(2px)";
  page2.style.opacity = "0.2";
  page2.style.filter = "blur(2px)";
}

function removeBlur() {
  page.style.opacity = "1";
  page.style.filter = "none";
  page2.style.opacity = "1";
  page2.style.filter = "none";
}

Delete.forEach((Button) => {
  Button.addEventListener("click", showConfirmation);
});

if (buyButton) {
  buyButton.addEventListener("click", showMenu);
}

if (exitButton) {
  exitButton.addEventListener("click", hideMenu);
}
cancel.addEventListener("click", hideConfirmation);
exitConfirmation.addEventListener("click", hideConfirmation);

links.forEach((link) => {
  link.addEventListener("click", showView);
});

if (okButton) {
  okButton.addEventListener("click", hideView);
}
