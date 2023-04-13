const inputPhone = document.querySelectorAll(".input-phone");

// Regex
inputPhone.forEach((inputPhone) => {
  inputPhone.addEventListener("keypress", (e) => {
    const onlyNumbers = /[0-9]/;
    const key = String.fromCharCode(e.keyCode);

    // Allow only numbers
    if (!onlyNumbers.test(key)) {
      e.preventDefault();
      return;
    }
  });
});
