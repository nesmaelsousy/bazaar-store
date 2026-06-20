document.addEventListener("DOMContentLoaded", () => {

import { products } from "./data.js";
import { artisans } from "./artisan.js";

const container = document.getElementById("productDetailsContainer");
const params = new URLSearchParams(window.location.search);
const productId = Number(params.get("id"));
const product = products.find(p => p.id === productId);

if(!product){
  container.innerHTML = `
    <div class="text-center py-20">
       <h2 class="text-2xl text-[#835837] font-bold">Product Not Found</h2>
    </div>
  `;
}else{
  renderProductDetails(product);
}

function renderProductDetails(product){
  const artisan = artisans.find(a => a.id === product.artisanId);
  container.innerHTML = `
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-16">
       <div>
         <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
           <img src="${product.image}" id="mainImage" class="w-full h-[380px] object-cover transition duration-500 cursor-zoom-in">
         </div>
         <div class="flex gap-3 mt-2 hidden md:block">
           <img src="${product.image}" class="size-24 object-cover rounded-lg cursor-pointer hover:opacity-80">
         </div>
       </div>
       <div class="bg-white rounded-2xl shadow-2xl p-6">
         <h1 class="text-2xl text-[#835837] font-bold mb-3">${product.name}</h1>
         <div class="flex items-center gap-1 mb-4">
           ${Array.from({ length: 5 }, (_, i) => `
            <i class="fa-star ${
              i < Math.floor(product.rating)
                ? "fa-solid text-yellow-400"
                : "fa-regular text-gray-300"
            }"></i>
           `).join("")}
           <span class="text-md text-[#835837] font-semibold">${product.rating}</span>
         </div>
         <p class="text-[#9B6B4A] leading-relaxed mb-4">${product.description}</p>
         <p class="text-xl text-[#835837] font-bold mb-4">$${product.price}</p>
         <div class="bg-[#F4E7DD] rounded-xl p-4 mb-6">
           <h3 class="text-lg text-[#835837] font-bold mb-4">Customization Options</h3>
           <div class="mb-4">
             <label class="block text-md text-[#9B6B4A] font-semibold mb-1">Color :</label>
             <select id="colorSelect" class="w-full p-2 bg-white text-[#6B4F3A] text-sm border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#9B6B4A]">
               ${product.colors.map(color => `
                <option>${color}</option>
               `).join("")}
             </select>
           </div>
           <div class="mb-4">
             <label class="block text-md text-[#9B6B4A] font-semibold mb-1">Size :</label>
             <select id="sizeSelect" class="w-full p-2 bg-white text-[#6B4F3A] text-sm border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#9B6B4A]">
               ${product.sizes.map(size => `
                <option>${size}</option>
               `).join("")}
             </select>
           </div>
           ${product.hasEngraving ? `
            <div>
               <label class="block text-md text-[#9B6B4A] font-semibold mb-1">Engraving :</label>
               <input id="engravingInput" type="text" placeholder="Enter Text For Engraving" class="w-full p-2 bg-white text-[#6B4F3A] text-sm border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#9B6B4A]">
            </div>
           ` : ""}
         </div>
         <div class="mb-6">
           <label class="block text-md text-[#9B6B4A] font-bold mb-2">Quantity :</label>
           <input id="quantityInput" type="number" value="1" min="1" class="w-24 p-2 text-[#6B4F3A] border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#9B6B4A] appearance-auto">
         </div>
         <div class="flex items-center gap-3">
           <button class="add-to-cart flex-1 bg-[#875E43] text-white font-semibold py-2 rounded-lg shadow-md transition hover:bg-[#9B6B4A]" data-id="${product.id}">
             <i class="fa-solid fa-cart-shopping mr-1"></i>
             Add To Cart
           </button>
           <button id="favoriteBtn" class="flex justify-center items-center bg-white w-12 h-10 border border-[#875E43] rounded-lg transition duration-300">
             <i class="fa-regular fa-heart text-[#875E43]"></i>
           </button>
         </div>
         <div class="flex items-center gap-1 text-sm text-[#9B6B4A] mt-3">
           <i class="fa-solid fa-location-dot"></i>
           Made In ${artisan?.location || "Unknown"}
         </div>
       </div>
     </div>

     <div class="bg-white rounded-2xl shadow-xl mb-10 p-4">
       <h2 class="text-xl text-[#835837] font-bold mb-3">About The Artisan</h2>
       <div class="flex flex-col md:flex-row items-start md:items-center gap-3">
         <img src="${artisan?.image}" class="size-24 object-cover rounded-full border-4 border-[#F7EEE9]">
         <div>
           <h3 class="text-lg text-[#9B6B4A] font-bold">${artisan?.name}</h3>
           <div class="flex gap-4 text-sm text-[#9B6B4A] mt-1">
             <span><i class="fa-solid fa-location-dot"></i> ${artisan?.location}</span>
             <span>⭐ ${artisan?.rating}</span>
           </div>
           <p class="text-sm text-[#9B6B4A] mt-2">${artisan?.bio}</p>
         </div>
       </div>
     </div>

     <div class="bg-white rounded-2xl shadow-xl p-4">
       <h2 class="text-xl text-[#835837] font-bold mb-4">Customer Reviews</h2>
       ${product.reviews.length > 0 ? product.reviews.map(review => `
         <div class="border-b py-1 last:border-none">
           <div class="flex justify-between mb-2">
             <h3 class="text-[#9B6B4A] font-semibold">${review.user}</h3>
             <span class="text-sm text-[#9B6B4A]">${review.Date}</span>
           </div>
           <div class="flex items-center gap-1 my-2">
             ${Array.from({ length: 5 }, (_, i) => `
             <i class="fa-star ${
               i < Math.floor(review.rating)
                ? "fa-solid text-yellow-400"
                : "fa-regular text-gray-300"
             }"></i>
             `).join("")}
           </div>
           <p class="text-[#9B6B4A]">${review.comment}</p>
         </div>
       `).join("") : `
        <p class="text-[#9B6B4A]">No Reviews Yet</p>
      `}
    </div>
  `;

  // Image Zoom
  const mainImage = document.getElementById("mainImage");
  if(mainImage){
    mainImage.addEventListener("mousemove", (e) => {
      const rect = mainImage.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;
      mainImage.style.transformOrigin = `${x}% ${y}%`;
      mainImage.style.transform = "scale(1.8)";
    });
    mainImage.addEventListener("mouseleave", () => {
      mainImage.style.transform = "scale(1)";
    });
  }

  // Favorite Button
  const favoriteBtn = document.getElementById("favoriteBtn");
  if(favoriteBtn){
    const icon = favoriteBtn.querySelector("i");
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    function updateFavoriteUI(isFavorite){
      if(isFavorite){
        favoriteBtn.classList.add("bg-[#875E43]", "border-[#875E43]");
        favoriteBtn.classList.remove("bg-white", "border-[#875E43]");
        icon.classList.remove("fa-regular", "text-[#875E43]");
        icon.classList.add("fa-solid", "text-white");
      }else{
        favoriteBtn.classList.remove("bg-[#875E43]", "border-[#875E43]");
        favoriteBtn.classList.add("bg-white", "border-[#875E43]");
        icon.classList.remove("fa-solid", "text-white");
        icon.classList.add("fa-regular", "text-[#875E43]");
      }
    }
    updateFavoriteUI(favorites.includes(product.id));
    favoriteBtn.addEventListener("click", () => {
      let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
      const index = favorites.indexOf(product.id);
      if(index === -1){
        favorites.push(product.id);
        showToast("Added To Favorites","check");
      }else{
        favorites.splice(index, 1);
        showToast("Removed From Favorites","xmark");
      }
      localStorage.setItem("favorites", JSON.stringify(favorites));
      updateFavoriteUI(favorites.includes(product.id));
    });
  }
}

// Favorite Toast Message
function showToast(message, icon){
  let toast = document.getElementById("favoriteToast");
  if(!toast){
    toast = document.createElement("div");
    toast.id = "favoriteToast";
    toast.className = `
      fixed bottom-5 right-5
      bg-[#E6B693] text-white text-lg
      font-semibold px-4 py-2
      rounded-lg shadow-lg opacity-0
      transition-all duration-300
      flex items-center z-50
    `;
    document.body.appendChild(toast);
  }

 let iconHTML = "";
 if(message.includes("Removed")){
  iconHTML = `<i class="fa-solid fa-xmark text-red-500 text-xl ml-1"></i>`;
 }else{
  iconHTML = `<i class="fa-solid fa-check text-green-500 text-xl ml-1"></i>`;
 }

  toast.innerHTML =`<span>${message}</span>${iconHTML}`;
  toast.classList.remove("opacity-0");
  clearTimeout(toast.hideTimeout);
  toast.hideTimeout = setTimeout(() => {
    toast.classList.add("opacity-0");
  }, 2000);
} });