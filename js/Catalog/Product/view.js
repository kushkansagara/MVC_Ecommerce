function incrementQuantity() {
  const quantityInput = document.getElementById("quantity");
  quantityInput.value = parseInt(quantityInput.value) + 1;
}

function decrementQuantity() {
  const quantityInput = document.getElementById("quantity");
  if (parseInt(quantityInput.value) > 1) {
    quantityInput.value = parseInt(quantityInput.value) - 1;
  }
}

function changeImage(thumbnail, imageSrc) {
  // Update main image
  document.getElementById("main-image").src = imageSrc;

  // Update active thumbnail
  const thumbnails = document.getElementsByClassName("thumbnail");
  for (let i = 0; i < thumbnails.length; i++) {
    thumbnails[i].classList.remove("active");
  }
  thumbnail.classList.add("active");
}

function openTab(evt, tabName) {
  // Hide all tab content
  const tabContents = document.getElementsByClassName(
    "single-product-tab-content"
  );
  for (let i = 0; i < tabContents.length; i++) {
    tabContents[i].classList.remove("active");
  }

  // Remove active class from all tab buttons
  const tabButtons = document.getElementsByClassName(
    "single-product-tab-button"
  );
  for (let i = 0; i < tabButtons.length; i++) {
    tabButtons[i].classList.remove("active");
  }

  // Show the specific tab content
  document.getElementById(tabName).classList.add("active");

  // Add active class to the button that opened the tab
  evt.currentTarget.classList.add("active");
}
