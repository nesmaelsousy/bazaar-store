const form = document.getElementById("paymentForm");
const paymentBox = document.getElementById("paymentBox");
const successBox = document.getElementById("successBox");
const cardNumber = document.getElementById("cardNumber");
const cvv = document.getElementById("cvv");
const expDate = document.getElementById("expDate");
const nameOnCard = document.getElementById("nameOnCard");
const totalPrice = document.getElementById("totalPrice");
const orderId = document.getElementById("orderId");

// Card Format
cardNumber.addEventListener("input", (e) => {
let value = e.target.value.replace(/\D/g, "");
value = value.replace(/(.{4})/g, "$1 ").trim();
e.target.value = value;
});

// CVV/CVC Numbers
cvv.addEventListener("input", (e) => {
e.target.value = e.target.value.replace(/\D/g, "").slice(0, 4);
});

// Exp Date Format 
expDate.addEventListener("input", (e) => {
let value = e.target.value.replace(/\D/g, "");

if(value.length >= 3){
value = value.slice(0, 2) + "/" + value.slice(2, 4);
}
e.target.value = value.slice(0, 5);
});

// Validation
function showError(input, msg){
let error = input.nextElementSibling;
error.textContent = msg;
error.classList.remove("hidden");
}

function hideError(input){
let error = input.nextElementSibling;
error.classList.add("hidden");
}

// Submit
form.addEventListener("submit", (e) => {
e.preventDefault();
let valid = true;

// Card Number
if(cardNumber.value.replace(/\s/g,"").length < 16){
showError(cardNumber, "Invalid Card Number");
valid = false;
}else hideError(cardNumber);

// Exp Date
if(!/^\d{2}\/\d{2}$/.test(expDate.value)){
showError(expDate, "Invalid Format MM/YY");
valid = false;
}else hideError(expDate);

// CVV/CVC
if(cvv.value.length < 3){
showError(cvv, "Invalid CVV/CVC");
valid = false;
}else hideError(cvv);

// Name On Card
if(nameOnCard.value.trim() === ""){
showError(nameOnCard, "Required");
valid = false;
}else hideError(nameOnCard);

if(!valid) return;
paymentBox.classList.add("hidden");
successBox.classList.remove("hidden");
orderId.textContent = Math.floor(Math.random() * 1000000);
totalPrice.textContent = localStorage.getItem("total") || 0;
});  