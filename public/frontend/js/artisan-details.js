document.addEventListener("DOMContentLoaded", () => {

import { products } from "./data.js";
import { artisans } from "./artisan.js";

const container = document.getElementById("artisanContainer");
const params = new URLSearchParams(window.location.search);
const artisanId = Number(params.get("id"));
const artisan = artisans.find(a => a.id === artisanId);

if(!artisan){
  container.innerHTML = `
    <div class="text-center py-20">
      <h2 class="text-2xl text-[#835837] font-bold">Artisan Not Found</h2>
    </div>
  `;
}else{
  renderArtisan(artisan);
}

function renderArtisan(artisan){
  const artisanProducts = products.filter(p => p.artisanId === artisan.id);
  container.innerHTML = `
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
         <div class="flex flex-col md:flex-row items-center gap-6">
             <img src="${artisan.image}" class="w-32 h-32 object-cover rounded-full border-4 border-[#F7EEE9]">
             <div class="text-center md:text-left">
                 <h1 class="text-2xl font-bold text-[#835837] mb-2">${artisan.name}</h1>
                 <p class="text-[#9B6B4A] mb-2"><i class="fa-solid fa-location-dot mr-1"></i>${artisan.location}</p>
                 <div class="flex items-center justify-center md:justify-start gap-1 mb-2">
                     ${renderStars(artisan.rating)}
                     <span class="text-[#835837] font-semibold ml-1">${artisan.rating}</span>
                 </div>
                 <p class="text-sm text-[#9B6B4A] mb-3">${artisan.bio}</p>
                 <div class="text-sm text-[#835837] font-semibold">
                     ${artisanProducts.length} Products
                 </div>
             </div>
         </div>
     </div>

    <div class="mb-10">
      <h2 class="text-xl font-bold text-[#835837] mb-4">Products</h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        ${artisanProducts.map(product => `
          <a href="product-details.html?id=${product.id}" class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">
             <img src="${product.image}" class="w-full h-32 object-cover rounded-lg mb-2">
             <p class="text-sm text-[#835837] font-semibold truncate">${product.name}</p>
             <p class="text-sm text-[#a05a1c] font-bold">$${product.price}</p>
          </a>
        `).join("")}
      </div>
    </div>

    <div>
      <h2 class="text-xl font-bold text-[#835837] mb-4">Customer Reviews</h2>
       ${artisanProducts.some(p => p.reviews?.length)
        ?
        artisanProducts.flatMap(p => p.reviews || []).slice(0,5).map(r => `
          <div class="bg-white rounded-xl shadow p-4 mb-3">
             <div class="flex justify-between mb-2">
                 <h3 class="text-[#835837] font-semibold">${r.user}</h3>
                  <span class="text-sm text-[#9B6B4A]">${r.Date}</span>
             </div>
             <div class="flex mb-2">${renderStars(r.rating)}</div>
             <p class="text-[#9B6B4A] text-sm">${r.comment}</p>
          </div>
        `).join("")
        :
        `<p class="text-[#9B6B4A]">No Reviews Yet</p>`
      }
    </div>
  `;
}

// Artisan Rating
function renderStars(rating){
  return Array.from({length:5}, (_,i)=>`
    <i class="fa-star ${
      i < Math.floor(rating)
      ? "fa-solid text-yellow-400"
      : "fa-regular text-gray-300"
    }"></i>
  `).join("");
} 
});