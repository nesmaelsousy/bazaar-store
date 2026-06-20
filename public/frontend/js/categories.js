document.addEventListener("DOMContentLoaded", () => {
const searchInput = document.getElementById("searchInput");
const countElement = document.getElementById("countText");

if(searchInput){
  const categories = document.querySelectorAll(".category");
  
  function updateCount(){
    const visible = Array.from(categories).filter(
      el => !el.classList.contains("hidden")
    ).length;
    countElement.textContent = `${visible} Categories`;
  }

  searchInput.addEventListener("input", function(){
    const value = this.value.toLowerCase();
    categories.forEach(el => {
      const name = (el.dataset.name || "").toLowerCase();
      el.classList.toggle("hidden", !name.includes(value));
    });
    updateCount();
  });
  updateCount();
} });