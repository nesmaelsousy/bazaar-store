// Import
import { products } from "./data.js";

// ==========
// Filter
// ==========
export function getFilteredProducts({
  search = "",
  category = "all",
  minPrice = "",
  maxPrice = ""
}){
  return products.filter(p => {
    const matchSearch = p.name
      .toLowerCase()
      .includes(search.toLowerCase());

    const matchCategory =
      category === "all" ||
      p.category.toLowerCase() === category.toLowerCase();

    const matchMin = minPrice === "" || p.price >= Number(minPrice);
    const matchMax = maxPrice === "" || p.price <= Number(maxPrice);
    return matchSearch && matchCategory && matchMin && matchMax;
  });
}
// ======
// Sort
// ====== 
export function sortProducts(list, type){
  const sorted = [...list];

  if(type === "low-high"){
    return sorted.sort((a, b) => a.price - b.price);
  }
  if(type === "high-low"){
    return sorted.sort((a, b) => b.price - a.price);
  }
  if(type === "newest"){
    return sorted.reverse(); 
  }
  return sorted;
}
// ================
// Render Products
// ================ 
export function renderProducts(container, products){
  container.innerHTML = "";
  if(products.length === 0){ 
    container.innerHTML = `
      <div class="col-span-full text-center py-10">
         <p class="text-[#835837] text-lg font-semibold">No Products Found</p>
      </div>
    `;
    return;
  }  

  // Render List 
 products.forEach(product => {
  const favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  const isFavorite = favorites.includes(product.id);
  container.innerHTML += `
     <div class="product-card relative bg-white p-2 rounded-lg shadow-md hover:shadow-lg transition" data-id="${product.id}">
       <button type="button" class="favorite-btn absolute top-3 right-3 z-10 w-9 h-9 bg-white rounded-full flex justify-center items-center transition duration-200 hover:scale-105" data-id="${product.id}">
         <i class="fa-heart ${isFavorite ? "fa-solid text-red-500" : "fa-regular text-[#875E43]"}"></i>
       </button>
       <a href="product-details.html?id=${product.id}" class="block">
         <img src="${product.image}" class="w-full h-44 object-cover rounded-lg">
       </a>
       <div class="flex justify-between items-center mt-3">
         <p class="text-[#835837] font-semibold">$${product.price}</p>
         <button type="button" class="add-to-cart text-xl text-[#875E43] hover:text-[#E6B693]" data-id="${product.id}">
           <i class="fa-solid fa-cart-plus"></i>
         </button>
       </div>
     </div>
   `;
});
}  
