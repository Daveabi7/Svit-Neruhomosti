/* Анімація для елементів */
function onEntry(entry) {
  entry.forEach(change => {
      if (change.isIntersecting) {
          change.target.classList.add('element-show');
      }
  });
}



const observerOptions = { threshold: 0.5 };
const observer = new IntersectionObserver(onEntry, observerOptions);
const elements = document.querySelectorAll('.element-text-animation, .element-photo-animation');

elements.forEach(el => observer.observe(el));

document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const sendMessageButton = document.getElementById("sendMessage");
  sendMessageButton.disabled = true;

  fetch("submit_form.php", {
      method: "POST",
      body: formData
  })
      .then(response => response.json())
      .then(data => {
          alert(data.message);
      })
      .catch(error => {
          console.error("Помилка:", error);
          alert("Сталася помилка, спробуйте пізніше.");
      })
      .finally(() => {
          sendMessageButton.disabled = false;
      });
});