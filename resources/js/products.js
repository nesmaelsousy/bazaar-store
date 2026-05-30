// Import 
import {
  getFilteredProducts,
  sortProducts,
  renderProducts
} from "./productUI.js";

const searchInput = document.getElementById("searchInput");
const sortSelect = document.getElementById("sortSelect");
const categoryFilter = document.getElementById("categoryFilter");
const minPriceInput = document.getElementById("minPrice");
const maxPriceInput = document.getElementById("maxPrice");
const container = document.getElementById("productsContainer");
const params = new URLSearchParams(window.location.search);
const countText = document.getElementById("countText");

// State
let state = {
  search: "",
  category: params.get("category") || "all",
  sort: "",
  minPrice: "",
  maxPrice: ""
};

// Update UI
function updateUI(){
  let result = getFilteredProducts(state);
  result = sortProducts(result, state.sort);
  renderProducts(container, result);
  if(countText){
    countText.textContent = `${result.length} Products`;
  }
}
// ========
// Events 
// ========
// Search Box 
searchInput.addEventListener("input", (e) => {
  state.search = e.target.value;
  updateUI();
});

// Sort Box
sortSelect.addEventListener("change", (e) => {
  state.sort = e.target.value;
  updateUI();
});

// Filter
categoryFilter.addEventListener("change", (e) => {
  state.category = e.target.value;
  updateUI();
});

// Min Price In Filter
minPriceInput.addEventListener("input", (e) => {
  state.minPrice = e.target.value;
  updateUI();
});

// Max Price In Filter
maxPriceInput.addEventListener("input", (e) => {
  state.maxPrice = e.target.value;
  updateUI();
});
updateUI();

// Favorite Button 
document.addEventListener("click", (e) => {
  const favBtn = e.target.closest(".favorite-btn");
  if(favBtn){
    e.stopImmediatePropagation();
    const id = Number(favBtn.dataset.id);
    const icon = favBtn.querySelector("i");
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    const index = favorites.indexOf(id);

    if(index === -1){
      favorites.push(id);
      icon.classList.remove("fa-regular", "text-[#875E43]");
      icon.classList.add("fa-solid", "text-red-500");
    }else{
      favorites.splice(index, 1);
      icon.classList.remove("fa-solid", "text-red-500");
      icon.classList.add("fa-regular", "text-[#875E43]");
    }
    localStorage.setItem("favorites", JSON.stringify(favorites));
    return;
  }
}); 