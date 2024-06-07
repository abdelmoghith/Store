let bar = document.querySelector(".right i");
let menu = document.querySelector(".sidebar");
let exit = document.querySelector("#exit");

bar.onclick = function () {
  menu.style.display = "block";
};
exit.onclick = function () {
  menu.style.display = "none";
};

let input = document.querySelector(".form input:first-of-type");
function scrollToTop() {
  input.focus();
  const scrollDuration = 500;
  const scrollStep = -window.scrollY / (scrollDuration / 15);
  const scrollInterval = setInterval(() => {
    if (window.scrollY !== 0) {
      window.scrollBy(0, scrollStep);
    } else {
      clearInterval(scrollInterval);
    }
  }, 15);
}


document.getElementById("phoneNumber").addEventListener("input", function() {
  if (this.value.length > 10) {
      this.value = this.value.slice(0, 10);
  }
});

