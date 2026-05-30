import { products } from "./data.js"; 

// let cart = JSON.parse(localStorage.getItem("cart")) || [];
let cart = window.serverCart || [];
const container = document.getElementById("cart-container");
const empty = document.getElementById("empty-cart");
const message = document.getElementById("cart-message");
const totalBox = document.getElementById("total");
const checkoutBox = document.getElementById("checkout-box");

// Add To Cart
// export function addToCart(id, selectedColor, selectedSize, engravingText = null){
//   const product = products.find(p => p.id === id);
//   if(!product) return;
//   const color = selectedColor || product.colors?.[0] || "Mixed Colors";
//   const size = selectedSize || product.sizes?.[0] || "One Size";
//   const existingItem = cart.find(item =>
//     item.id === id &&
//     item.color === color &&
//     item.size === size &&
//     item.engraving === engravingText
//   );

//   if(existingItem){
//     existingItem.quantity++;
//   }else{
//     cart.push({
//       cartItemId: Date.now() + Math.random(),
//       id,
//       color,
//       size,
//       quantity: 1,
//       engraving: engravingText
//     });
//   }
//   save();
// }

// Render Cart
// function renderCart(){
//   if(cart.length === 0){
//     empty.classList.remove("hidden");
//     container.innerHTML = "";
//     message.classList.add("hidden");
//     totalBox.innerText = "";
//     checkoutBox.classList.add("hidden");
//     return;
//   }
//   empty.classList.add("hidden");
//   message.classList.remove("hidden");
//   checkoutBox.classList.remove("hidden");
//   container.innerHTML = cart.map((item, index) => {
//     const product = products.find(p => p.id === item.id);
//     if (!product) return "";

//     return `
//      <div class="bg-[#FFFDF9] rounded-2xl shadow-xl border border-[#eee] overflow-hidden">
//        <div class="bg-white overflow-hidden aspect-[1/1]">
//           <img src="${product.image}" class="w-full h-full object-cover hover:scale-105 transition">
//        </div>
//        <div class="p-4 space-y-2">
//            <p class="font-bold text-[#5A3E2B] text-sm">${product.name}</p>
//            <div class="flex items-center gap-2">
//              <span class="text-sm text-[#6B4F3A] font-semibold">Color:</span>
//              ${
//              (!product.colors || product.colors.length <= 1)
//              ?
//              `<span class="text-[#6B4F3A] text-sm">${item.color || "Mixed Colors"}</span>`
//              :
//              `<select onchange="changeColor(${index}, this.value)" class="w-[100px] px-2 py-1 text-sm border border-[#e5d3c5] rounded-lg bg-white text-[#6B4F3A] outline-none focus:ring-1 focus:ring-[#7A6A5A]">
//                ${product.colors.map(c => `<option value="${c}" ${item.color === c ? "selected" : ""}>${c}</option>`).join("")}
//              </select>`
//              }
//            </div>
//            <div class="flex items-center gap-2">
//              <span class="text-sm text-[#6B4F3A] font-semibold">Size:</span>
//              ${
//              (!product.sizes || product.sizes.length <= 1 || product.sizes[0] === "One Size")
//              ?
//              `<span class="text-[#6B4F3A] text-sm">${item.size || "One Size"}</span>`
//              :
//              `<select onchange="changeSize(${index}, this.value)" class="w-[100px] px-2 py-1 text-sm border border-[#e5d3c5] rounded-lg bg-white text-[#6B4F3A] outline-none focus:ring-1 focus:ring-[#7A6A5A]">
//                ${product.sizes.map(size => `<option value="${size}" ${item.size === size ? "selected" : ""}>${size}</option>`).join("")}
//              </select>`
//              }
//            </div>
//            ${item.engraving ? `<p class="text-sm text-[#7A4E2D] bg-[#f3d6c3] px-2 py-1 rounded-md inline-block">Engraving: ${item.engraving}</p>` : ""}
//            <p class="text-md text-[#c26a2d] font-bold">Price: ${product.price}$</p>
//            <div class="flex items-center justify-between"> 
//              <div class="flex items-center gap-2 bg-[#f1e4db] text-[#7A6A5A] px-2 py-1 rounded-lg">
//                <button onclick="decrease(${index})" class="w-6 h-6 bg-white rounded">-</button>
//                <span>${item.quantity}</span>
//                <button onclick="increase(${index})" class="w-6 h-6 bg-white rounded">+</button>
//              </div>
//              <button onclick="removeItem(${index})" class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
//            </div>
//          </div>
//        </div>`;
//       }).join("");
//   calculateTotal();
// }

// Update Functions
function increase(index){
  cart[index].quantity++;
  save();
}

function decrease(index){
  if(cart[index].quantity > 1){
    cart[index].quantity--;
  }
  save();
}

function changeColor(index, color){
  cart[index].color = color;
  mergeDuplicateItems();
  save();
}

function changeSize(index, size){
  cart[index].size = size;
  mergeDuplicateItems();
  save();
}

function mergeDuplicateItems(){
  const mergedCart = [];
  cart.forEach(item => {
    const existing = mergedCart.find(i =>
      i.id === item.id &&
      i.color === item.color &&
      i.size === item.size &&
      i.engraving === item.engraving
    );

    if(existing){
      existing.quantity += item.quantity;
    }else{
      mergedCart.push(item);
    }
  });
  cart = mergedCart;
}

function removeItem(index){
  cart.splice(index, 1);
  save();
}

// Save and Total Functions
function save(){
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
  window.updateCartCount?.();
}

function calculateTotal(){
  const total = cart.reduce((sum, item) => {
    const product = products.find(p => p.id === item.id);
    return sum + (product.price * item.quantity);
  }, 0);
  totalBox.innerText = "Total: " + total + "$";
  localStorage.setItem("total", total);
} 

window.increase = increase;
window.decrease = decrease;
window.removeItem = removeItem;
window.changeColor = changeColor;
window.changeSize = changeSize;
renderCart(); 