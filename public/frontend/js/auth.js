document.addEventListener("DOMContentLoaded", () => {

const loginTab = document.getElementById("loginTab");
const signupTab = document.getElementById("signupTab");
const loginForm = document.getElementById("loginForm");
const signupForm = document.getElementById("signupForm");
const forgotForm = document.getElementById("forgotForm");
const goToForgot = document.getElementById("goToForgot");
const backToLogin = document.getElementById("backToLogin");

// Tabs Switch 
if(loginTab && signupTab && loginForm && signupForm && forgotForm){
  loginTab.addEventListener("click", () => {
    loginForm.classList.remove("hidden");
    signupForm.classList.add("hidden");
    forgotForm.classList.add("hidden");
    loginTab.classList.add("bg-white", "text-[#835837]", "font-medium");
    signupTab.classList.remove("bg-white", "text-[#835837]", "font-medium");
    signupTab.classList.add("text-[#9A7F73]");
  });

  signupTab.addEventListener("click", () => {
    signupForm.classList.remove("hidden");
    loginForm.classList.add("hidden");
    forgotForm.classList.add("hidden");
    signupTab.classList.add("bg-white", "text-[#835837]", "font-medium");
    loginTab.classList.remove("bg-white", "text-[#835837]", "font-medium");
    loginTab.classList.add("text-[#9A7F73]");
  });
}

// Forgot Password
if(goToForgot && loginForm && signupForm && forgotForm){
  goToForgot.addEventListener("click", () => {
    loginForm.classList.add("hidden");
    signupForm.classList.add("hidden");
    forgotForm.classList.remove("hidden");
  });
}
if(backToLogin && forgotForm && loginForm){
  backToLogin.addEventListener("click", () => {
    forgotForm.classList.add("hidden");
    loginForm.classList.remove("hidden");
  });
}

// Show Message
function showMessage(form, text, color){
  const message = form.querySelector(".statusMessage");
  if (!message) return;
  message.textContent = text;
  message.style.color = color;
  message.classList.remove("hidden");
}

// Login
// if(loginForm){
//   loginForm.addEventListener("submit", (e) => {
//     e.preventDefault();
//     showMessage(loginForm, "Login Successful.", "green");
//     loginForm.reset();
//   });
// }

// Signup
// if(signupForm){
//   signupForm.addEventListener("submit", (e) => {
//     e.preventDefault();
//     showMessage(signupForm, "Account Created Successfully.", "green");
//   });
// }

// Password Match
// const newPassword = document.getElementById("newPassword");
// const confirmPassword = document.getElementById("confirmPassword");
// const forgotError = forgotForm ? forgotForm.querySelector(".statusMessage") : null;

// function checkPasswordsMatch(){
//   if(!newPassword || !confirmPassword || !forgotError) return;
//   if(confirmPassword.value === "") return;
//   if(newPassword.value !== confirmPassword.value){
//     forgotError.textContent = "Passwords Do Not Match!";
//     forgotError.style.color = "red";
//   }else{
//     forgotError.textContent = "Passwords Match.";
//     forgotError.style.color = "green";
//   }
//    forgotError.classList.remove("hidden");
// }

// if(newPassword) newPassword.addEventListener("input", checkPasswordsMatch);
// if(confirmPassword) confirmPassword.addEventListener("input", checkPasswordsMatch);

// if(forgotForm && newPassword && confirmPassword){
//   forgotForm.addEventListener("submit", (e) => {
//     e.preventDefault();
//     if(newPassword.value !== confirmPassword.value){
//       showMessage(forgotForm, "Passwords Do Not Match!", "red");
//       return;
//     }
//     showMessage(forgotForm, "Password Reset Successful", "green");
//   });
// }

// // Email Fields Validation
// const emailFields = document.querySelectorAll(".email-field");
// emailFields.forEach(input => {
//   const errorMsg = input.nextElementSibling;
//   if (!errorMsg) return;
//   input.addEventListener("input", () => {
//     const value = input.value.trim();
//     if(value === ""){
//       errorMsg.textContent = "Email Is Required!";
//       errorMsg.style.color = "red";
//     }else if(!validateEmail(value)){
//       errorMsg.textContent = "Invalid Email Format!";
//       errorMsg.style.color = "orange";
//     }else{
//       errorMsg.textContent = "Valid Email.";
//       errorMsg.style.color = "green";
//     }
//     errorMsg.classList.remove("hidden");
//   });
// });

// // Password Validation
// const passwordInputs = document.querySelectorAll(".password-field");
// passwordInputs.forEach(input => {
//   const error = input.parentElement.querySelector(".error-msg");
//   if (!error) return;
//   input.addEventListener("input", () => {
//     const value = input.value;
//     if(value.length === 0){
//       error.classList.add("hidden");
//     }else if(value.length < 6){
//       error.textContent = "Password Must Be At Least 6 Characters.";
//       error.style.color = "red";
//       error.classList.remove("hidden");
//     }else if(!/[A-Z]/.test(value)){
//       error.textContent = "Must contain 1 capital letter.";
//       error.style.color = "orange";
//       error.classList.remove("hidden");
//     }else if(!/[0-9]/.test(value)){
//       error.textContent = "Must contain a number.";
//       error.style.color = "orange";
//       error.classList.remove("hidden");
//     }else{
//       error.textContent = "Strong Password.";
//       error.style.color = "green";
//       error.classList.remove("hidden");
//     }
//   });
// });

// Show/Hide Password
const passwordFields = document.querySelectorAll(".password-field");
passwordFields.forEach(input => {
  const toggle = input.parentElement.querySelector(".togglePassword");
  if (!toggle) return;
  input.type = "password";
  toggle.classList.add("hidden");
  toggle.classList.remove("fa-eye");
  toggle.classList.add("fa-eye-slash");
  input.addEventListener("input", () => {
    if(input.value.length > 0){
      toggle.classList.remove("hidden");
    }else{
      toggle.classList.add("hidden");
      input.type = "password";
      toggle.classList.replace("fa-eye", "fa-eye-slash");
    }
  });

  toggle.addEventListener("click", () => {
    if(input.type === "password"){
      input.type = "text";
      toggle.classList.replace("fa-eye-slash", "fa-eye");
    }else{
      input.type = "password";
      toggle.classList.replace("fa-eye", "fa-eye-slash");
    }
  });
});
});