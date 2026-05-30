document.addEventListener("click", (e) => {
  const favBtn = e.target.closest(".favorite-btn");
  if(!favBtn) return;
  e.preventDefault();
  e.stopPropagation();
  const id = Number(favBtn.dataset.id);
  let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  const icon = favBtn.querySelector("i");
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
});  