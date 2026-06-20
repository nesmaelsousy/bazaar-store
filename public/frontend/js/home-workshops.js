// Workshops Section (Home/Workshops page)
document.addEventListener("DOMContentLoaded", () => {

let slider = document.getElementById("slider");
if(slider){
  let slides = document.querySelectorAll("#slider > div");
  let index = 0;
  let startX = 0;
    
  function updateSlider(){
       slider.style.transform = `translateX(-${index * 100}%)`;
   }
   // Next Button (Desktop)
   let nextBtn = document.getElementById("next");
   if(nextBtn){
       nextBtn.onclick = () => {
       index++;
       if (index >= slides.length){
          index = 0;
         }
       updateSlider();
       };
   }
   // Prev Button (Desktop)
   let prevBtn = document.getElementById("prev");
   if(prevBtn){
       prevBtn.onclick = () => {
       index--;
       if (index < 0){
          index = slides.length - 1;
         }
       updateSlider();
       };
   }
   // Swipe For Mobile
   slider.addEventListener("touchstart", (e) => {
       startX = e.touches[0].clientX;
    });
   slider.addEventListener("touchend", (e) => {
       let endX = e.changedTouches[0].clientX;
       let diff = startX - endX;
       
       if(diff > 70 && index < slides.length - 1){
           index++;
        }else if(diff < -70 && index > 0){
           index--;
        }
        updateSlider();
      });
}
// Contact Modal
const buttons = document.querySelectorAll(".openContact");
const modal = document.getElementById("contactModal");

if(modal){
  buttons.forEach(btn => {
     btn.addEventListener("click", () => {
     modal.classList.remove("hidden");
     modal.classList.add("flex");
    });
  });
  modal.addEventListener("click", (e) => {
     if(e.target === modal){
       modal.classList.add("hidden");
       modal.classList.remove("flex");
     }
   });
}  });
