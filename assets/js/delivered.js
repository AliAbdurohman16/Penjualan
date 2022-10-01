const buttonYes = document.querySelector("#radioTrue");
const buttonNo = document.querySelector("#radioFalse");
const address = document.querySelector("#alamat");
const alone = document.querySelector("#bawa-sendiri");

buttonYes.addEventListener("click", function () {
  if (buttonYes.checked == true) {
    address.style.display = "block";
    alone.style.display = "none";
  }
});

buttonNo.addEventListener("click", function () {
  if (buttonNo.checked == true) {
    address.style.display = "none";
    alone.style.display = "block";
  }
});
