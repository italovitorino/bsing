const formBusiness = document.querySelector(".formBusiness");
const inputCep = document.querySelector(".inputCep");
const inputAddress = document.querySelector(".inputAddress");
const inputNumber = document.querySelector(".inputNumber");
const inputDistrict = document.querySelector(".inputDistrict");
const inputCity = document.querySelector(".inputCity");
const inputBusinessState = document.querySelector(".inputBusinessState");

// Validate CEP input
inputCep.addEventListener("keypress", (e) => {
  const onlyNumbers = /[0-9]/;
  const key = String.fromCharCode(e.keyCode);

  // Allow only numbers
  if (!onlyNumbers.test(key)) {
    e.preventDefault();
    return;
  }
});

// Get adress event
inputCep.addEventListener("keyup", (e) => {
  const inputValue = e.target.value;

  // Check if we have the correct length
  if (inputValue.length === 8) {
    getAddress(inputValue);
  }
});

// Get customer address from API
const getAddress = async (cep) => {
  const apiUrl = `https://viacep.com.br/ws/${cep}/json/`;
  const response = await fetch(apiUrl);
  const data = await response.json();

  // Show error and reset form
  if (data.erro) {
    formBusiness.reset();
    alert("CEP não encontrado");
    return;
  }

  inputAddress.value = data.logradouro;
  inputDistrict.value = data.bairro;
  inputCity.value = data.localidade;
  inputBusinessState.value = data.uf;
};
