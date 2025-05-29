const display = document.getElementById("username-display");
const form = document.getElementById("username-form");
const editBtn = document.getElementById("edit-username-btn");

editBtn.addEventListener("click", function () {
  display.style.display = "none";
  editBtn.style.display = "none";
  form.style.display = "inline";
  document.getElementById("username-input").focus();
});
