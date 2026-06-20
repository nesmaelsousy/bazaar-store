const form = document.getElementById("contactForm");
const message = document.getElementById("formMessage");

if(form && message){
  form.addEventListener("submit", function(e){
    e.preventDefault();
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const textarea = document.getElementById("messageInput");
    message.classList.remove("hidden");

    if(name.value.trim() === "" || email.value.trim() === "" || textarea.value.trim() === ""){
      message.textContent = "Please fill all fields!";
      message.style.color = "red";
      return;
    }
    if(!validateEmail(email.value.trim())){
      message.textContent = "Invalid email format!";
      message.style.color = "orange";
      return;
    }
    message.textContent = "Your message has been sent successfully!";
    message.style.color = "green";
    form.reset();
  });
} 