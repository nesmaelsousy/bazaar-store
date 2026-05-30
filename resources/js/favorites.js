import { products } from "./data.js";

const container = document.getElementById("favoritesContainer");
const header = document.getElementById("favoritesHeader");
function renderFavorites(){
  const favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  const favoriteProducts = products.filter(product => favorites.includes(product.id));

  if(favoriteProducts.length > 0){
    header.classList.add("hidden");
  }else{
    header.classList.remove("hidden");
  }

  container.innerHTML = "";
  favoriteProducts.forEach(product => {
    container.innerHTML += `
      <div class="flex justify-between items-center bg-white rounded-xl shadow-md transition duration-300 px-3 py-2 hover:shadow-lg hover:-translate-y-1">
         <a href="product-details.html?id=${product.id}" class="flex flex-1 items-center gap-3">
             <img src="${product.image}" class="w-24 h-24 object-cover rounded-lg">
             <div>
                 <h3 class="text-xl text-[#835837] font-bold mb-1">${product.name}</h3>
                 <p class="text-[#9B6B4A] font-semibold">$${product.price}</p>
             </div>
          </a>
          <button class="remove-favorite text-xl text-[#835837] hover:text-red-500 transition" data-id="${product.id}">
             <i class="fa-solid fa-trash"></i>
          </button>
      </div>
    `;
  });
}
renderFavorites();

document.addEventListener("click", (e) => {
  const removeBtn = e.target.closest(".remove-favorite");
  if(!removeBtn) return;
  const id = Number(removeBtn.dataset.id);
  let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  favorites = favorites.filter(itemId => itemId !== id);
  localStorage.setItem("favorites", JSON.stringify(favorites));
  renderFavorites();
}); 