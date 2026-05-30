// Helpers
function validateEmail(email){
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validatePhone(phone){
  return /^[0-9]{7,15}$/.test(phone);
}

function getErrorElement(input){
  return input.closest("div").querySelector(".error") || input.closest("div").parentElement.querySelector(".error");
}

function showError(input, message){
  const error = getErrorElement(input);
  if(!error) return;
  error.textContent = message;
  error.style.color = "red";
  error.classList.remove("hidden");
}

function hideError(input){
  const error = getErrorElement(input);
  if(!error) return;
  error.classList.add("hidden");
}

const form = document.getElementById("checkoutForm");
const formContainer = document.getElementById("formContainer");
const deliveryBox = document.getElementById("deliveryBox");
const goToPaymentBtn = document.getElementById("goToPayment");
const phone = document.getElementById("phone");

// Phone Input 
phone.addEventListener("input", () => {
  phone.value = phone.value.replace(/\D/g, "");
});

// Order Summary
const cart = JSON.parse(localStorage.getItem("cart")) || [];
const orderItems = document.getElementById("orderItems");
const totalPrice = document.getElementById("totalPrice");
let total = 0;
let html = "";

cart.forEach(item => {
  const price = Number(item.price) || 0;
  const quantity = Number(item.quantity) || 1;
  total += price * quantity;
  html += `
    <div class="flex justify-between items-center mb-3">
      <div>
        <p class="text-sm font-medium">${item.name}</p>
        <p class="text-xs text-gray-500">Color: ${item.color || "Default"} | Size: ${item.size || "One Size"}</p>
        <p class="text-xs text-gray-500">Qty: ${quantity}</p>
      </div>
      <p class="text-sm font-medium">$${price * quantity}</p>
    </div>
  `;
});
orderItems.innerHTML = html;
totalPrice.textContent = total;

// Go To Payment Button
goToPaymentBtn?.addEventListener("click", () => {
  window.location.href = "payment.html";
});

// Submit Form
form.addEventListener("submit", function(e){
  e.preventDefault();
  let isValid = true;
  const name = document.getElementById("name");
  const email = document.getElementById("email");
  const countryCode = document.getElementById("countryCode");
  const country = document.getElementById("country");
  const city = document.getElementById("city");
  const district = document.getElementById("district");
  const street = document.getElementById("street");
  const building = document.getElementById("building");
  const floor = document.getElementById("floor");
  const requiredFields = [name, phone, email, country, city, district, street, building];

  // Required
  requiredFields.forEach(input => {
    if(input.value.trim() === ""){
      showError(input, "This Field Is Required");
      isValid = false;
    }else{
      hideError(input);
    }
  });

  // Phone
  if(phone.value.trim() !== "" && !validatePhone(phone.value)){
    showError(phone, "Phone Must Be 7–15 Digits");
    isValid = false;
  }

  // Email
  if(email.value.trim() !== "" && !validateEmail(email.value)){
    showError(email, "Invalid Email Format");
    isValid = false;
  }

  // Building Number
  if(building.value.trim() !== "" && !/^\d+$/.test(building.value)){
    showError(building, "Numbers Only");
    isValid = false;
  }

  // Floor
  if(floor.value && !/^\d+$/.test(floor.value)){
    showError(floor, "Numbers Only");
    isValid = false;
  }
  if(!isValid) return;

  // Delivery Dates
  const today = new Date();
  const minDate = new Date();
  const maxDate = new Date();
  minDate.setDate(today.getDate() + 4);
  maxDate.setDate(today.getDate() + 5);

  // UI Transition
  formContainer.style.transition = "all 0.3s ease";
  formContainer.style.opacity = "0";
  formContainer.style.transform = "translateY(-20px)";
  setTimeout(() => {
    formContainer.classList.add("hidden");
    deliveryBox.innerHTML = `
      <div class="animate-fadeSlide bg-white border border-[#f1e2d3] rounded-xl shadow-md overflow-hidden">
        <!-- Shipping -->
        <div class="p-4">
          <h3 class="font-semibold text-[#a05a1c] flex items-center gap-2 mb-3"><i class="fa-solid fa-location-dot"></i>Shipping Address</h3>
          <div class="text-[#5A3E2B] text-sm space-y-2">
             <p class="flex items-center gap-2"><i class="fa-regular fa-user"></i>${name.value}</p>
             <p class="flex items-center gap-2"><i class="fa-solid fa-map-location-dot"></i>${city.value}, ${district.value}, ${street.value}, Bldg ${building.value}</p>
             <p class="flex items-center gap-2"><i class="fa-solid fa-phone"></i>${countryCode.value} ${phone.value}</p>
          </div>
        </div>
        <div class="border-t border-[#f1e2d3]"></div>
        <!-- Delivery -->
        <div class="bg-[#fffaf5] p-4">
           <h3 class="font-semibold text-[#a05a1c] flex items-center gap-2 mb-3"><i class="fa-solid fa-truck"></i>Delivery Information</h3>
           <p class="flex items-center gap-2 text-sm text-[#5A3E2B] font-bold"><i class="fa-regular fa-calendar"></i>${minDate.toDateString()} - ${maxDate.toDateString()}</p>
           <p class="flex items-center gap-2 text-sm text-[#5A3E2B] mt-1"><i class="fa-solid fa-box"></i>Within 4 to 5 days</p>
        </div>
      </div>
    `;
    deliveryBox.classList.remove("hidden");
  }, 300);

  // Payment Button
  goToPaymentBtn.classList.remove("hidden");
  goToPaymentBtn.scrollIntoView({behavior: "smooth"});
}); 