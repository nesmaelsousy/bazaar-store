import { artisans } from "./artisan.js";
import { products } from "./data.js"; 

const container = document.getElementById("artisansContainer");
function renderArtisans() {
  container.innerHTML = artisans.map(a => {
    const productsCount = products.filter(p => p.artisanId === a.id).length;
    return `
      <div onclick="goToArtisan(${a.id})" class="bg-[#EAD8CC] rounded-2xl shadow-md border border-[#e5d3c5] p-4 text-center transition duration-300 cursor-pointer hover:shadow-xl hover:-translate-y-1 hover:scale-[1.02]">
         <img src="${a.image}" class="w-24 h-24 mx-auto rounded-full border-4 border-white mb-4 object-cover">
         <div class="bg-white p-4 rounded-xl shadow-sm">
             <h3 class="text-[#835837] font-bold mb-1">${a.name}</h3>
             <p class="flex justify-center items-center gap-1 text-sm text-[#835837] mb-2"><i class="fa-solid fa-location-dot text-[#c8a98d]"></i>${a.location}</p>
             <p class="text-xs text-[#9A7F73] mb-5">${a.bio}</p>
             <div class="flex justify-between text-sm text-[#835837] font-medium">
                 <span class="flex items-center gap-1">
                     <i class="fa-solid fa-star text-yellow-500"></i>${a.rating}
                 </span>
                 <span>${productsCount} Products</span>
             </div>
         </div>
      </div>
    `;
  }).join("");
}

window.goToArtisan = function(id){
  window.location.href = `artisan-details.html?id=${id}`;
};
renderArtisans(); 