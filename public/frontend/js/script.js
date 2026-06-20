// =======================
// Header / Navbar section 
// =======================
const menuBtn = document.getElementById("menu-btn");
const menuItems = document.getElementById("menu-items");
const menuIcon = document.getElementById("menu-icon");

if(menuBtn && menuItems && menuIcon){
 menuBtn.addEventListener("click", () => {
    menuItems.classList.toggle("hidden");
    if(menuItems.classList.contains("hidden")){
       menuIcon.classList.remove("fa-xmark");
       menuIcon.classList.add("fa-bars");
    }else{
       menuIcon.classList.remove("fa-bars");
       menuIcon.classList.add("fa-xmark");
    }
 }); 
}
// =======================================================
// Add To Cart Section (Home/Products/Cart/Checkout Page)
// ======================================================= 
// import { products } from "./data.js"; 
const product = products.find(p => p.id === id);
if(!product) return;

function addToCart(id, quantity = 1, selectedColor = null, selectedSize = null, engraving = ""){
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const product = products.find(p => p.id === id);
  if(!product) return;
  const color = selectedColor || product.colors?.[0] || "Default";
  const size = selectedSize || product.sizes?.[0] || "One Size";
  const existing = cart.find(item =>
    item.id === id &&
    item.color === color &&
    item.size === size &&
    item.engraving === engraving
  );

  if(existing){
    existing.quantity += quantity;
  }else{
    cart.push({
      id: id,
      name: product.name,
      price: product.price,
      quantity: quantity,
      color: color,
      size: size,
      engraving: engraving
    });
  }
  // localStorage.setItem("cart", JSON.stringify(cart));
  // if(window.updateCartCount){
  //   window.updateCartCount();
  // }
}
window.addToCart = addToCart;

// showToast 
function showToast(){
  const toast = document.getElementById("toast");
  if(!toast) return;
  toast.classList.remove("opacity-0");
  setTimeout(() => {
    toast.classList.add("opacity-0");
  }, 2000);
} 

// Click EventListener
document.addEventListener("click", (e) => {
  const btn = e.target.closest(".add-to-cart");
  if(btn && !btn.dataset.clicked){
    btn.dataset.clicked = "true";
    setTimeout(() => {
      delete btn.dataset.clicked;
    }, 300);

    e.preventDefault();
    e.stopPropagation();
    const id = Number(btn.dataset.id);
    const quantity = Number(document.getElementById("quantityInput")?.value) || 1;
    const selectedColor = document.getElementById("colorSelect")?.value;
    const selectedSize = document.getElementById("sizeSelect")?.value;
    const engraving = document.getElementById("engravingInput")?.value || ""; 

    if(window.addToCart){
      window.addToCart(id, quantity, selectedColor, selectedSize, engraving);
      showToast();
    }
    return;
  }
  if(e.target.closest(".favorite-btn")){
    return;
  }
  const card = e.target.closest(".product-card");
  if(card){
    const id = card.dataset.id;
    window.location.href = `product-details.html?id=${id}`;
  }
});

// Update Cart Count Function
// function updateCartCount(){
//   const cart = JSON.parse(localStorage.getItem("cart")) || [];
//   const count = cart.reduce((sum, item) => sum + item.quantity, 0);
//   const el = document.getElementById("cart-count");
//   if(el){
//     el.innerText = count;
//   }
// }
document.addEventListener("DOMContentLoaded", updateCartCount);
window.updateCartCount = updateCartCount;

// =========================
// General Email Validation 
// =========================
function validateEmail(email){
  return email.includes("@") && email.includes(".");
} 
window.validateEmail = validateEmail;
// ===============
// Footer Section
// ===============
const footerBtn = document.getElementById("subscribeBtn");
const emailInput = document.getElementById("emailInput");
const footerMessage = document.getElementById("message");

if(footerBtn && emailInput && footerMessage){
  footerBtn.addEventListener("click", () => {
    const email = emailInput.value.trim();

    if(email === ""){
      footerMessage.textContent = "Please Enter Your Email!";
      footerMessage.style.color = "red";
    }else if(!validateEmail(email)){
      footerMessage.textContent = "Invalid Email Format!";
      footerMessage.style.color = "orange";
    }else{
      footerMessage.textContent = "Subscription Successful";
      footerMessage.style.color = "lightgreen";
      emailInput.value = "";
    }
    footerMessage.classList.remove("hidden");
  });
} 