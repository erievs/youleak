var button = document.getElementById("appbar-guide-button");
var menu = document.getElementById("appbar-guide-menu");
var isMenuVisible = false;

button.addEventListener("click", function() {
  if (isMenuVisible) {
    menu.style.display = "none";
  } else {
    menu.style.display = "block";
  }
  isMenuVisible = !isMenuVisible;
});