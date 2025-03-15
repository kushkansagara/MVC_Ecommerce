function incrementQuantity(id) {
  const inputElement = document.getElementById("quantity-" + id);
  const currentValue = parseInt(inputElement.value);
  const newValue = currentValue + 1;
  inputElement.value = newValue;
  updateQuantity(id, newValue);
}

// Function to decrement quantity
function decrementQuantity(id) {
  const inputElement = document.getElementById("quantity-" + id);
  const currentValue = parseInt(inputElement.value);
  if (currentValue > 1) {
    const newValue = currentValue - 1;
    inputElement.value = newValue;
    updateQuantity(id, newValue);
  }
}

// Function to update quantity
function updateQuantity(id, quantity) {
  // Send AJAX request to update quantity
  // This is just a placeholder - you'll need to implement the actual AJAX request
  console.log("Update quantity: Product ID " + id + ", Quantity: " + quantity);

  // Reload the page or update the UI
  // For better UX, consider updating the UI directly instead of reloading
  window.location.reload();
}

// Function to remove item
function removeItem(id) {
  // Send AJAX request to remove item
  // This is just a placeholder - you'll need to implement the actual AJAX request
  console.log("Remove item: Product ID " + id);

  // Reload the page or update the UI
  window.location.reload();
}
document.addEventListener("DOMContentLoaded", function () {
  const toggleShippingBtn = document.getElementById("toggleShipping");
  const shippingSection = document.getElementById("shippingSection");
  let useCustomShipping = false;

  toggleShippingBtn.addEventListener("click", function () {
    useCustomShipping = !useCustomShipping;
    if (useCustomShipping) {
      shippingSection.classList.remove("hidden");
      toggleShippingBtn.textContent = "Use Billing Address";
    } else {
      shippingSection.classList.add("hidden");
      toggleShippingBtn.textContent = "Change Shipping Address";
    }
  });

  document
    .getElementById("addressForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      // Collect form data
      const formData = {
        firstName: document.getElementById("firstName").value,
        lastName: document.getElementById("lastName").value,
        email: document.getElementById("email").value,
        phoneNumber: document.getElementById("phoneNumber").value,
        billingAddress: {
          street: document.getElementById("billingStreet").value,
          city: document.getElementById("billingCity").value,
          region: document.getElementById("billingRegion").value,
          zipCode: document.getElementById("billingZipCode").value,
          country: document.getElementById("billingCountry").value,
        },
      };

      if (useCustomShipping) {
        formData.shippingAddress = {
          street: document.getElementById("shippingStreet").value,
          city: document.getElementById("shippingCity").value,
          region: document.getElementById("shippingRegion").value,
          zipCode: document.getElementById("shippingZipCode").value,
          country: document.getElementById("shippingCountry").value,
        };
      } else {
        formData.shippingAddress = formData.billingAddress;
      }

      console.log("Form Data:", formData);
      // Here you would typically send this data to your server
      alert("Form submitted successfully!");
    });
});
document.addEventListener("DOMContentLoaded", function () {
  const sameAsBillingCheckbox = document.getElementById("sameAsBilling");
  const billingStreet = document.getElementById("billingStreet");
  const billingCity = document.getElementById("billingCity");
  const billingZipCode = document.getElementById("billingZipCode");
  const billingCountry = document.getElementById("billingCountry");
  const billingRegion = document.getElementById("billingRegion");

  const shippingStreet = document.getElementById("shippingStreet");
  const shippingCity = document.getElementById("shippingCity");
  const shippingZipCode = document.getElementById("shippingZipCode");
  const shippingCountry = document.getElementById("shippingCountry");
  const shippingRegion = document.getElementById("shippingRegion");

  sameAsBillingCheckbox.addEventListener("change", function () {
    if (this.checked) {
      shippingStreet.value = billingStreet.value;
      shippingCity.value = billingCity.value;
      shippingZipCode.value = billingZipCode.value;
      shippingCountry.value = billingCountry.value;
      shippingRegion.value = billingRegion.value;
    } else {
      shippingStreet.value = "";
      shippingCity.value = "";
      shippingZipCode.value = "";
      shippingCountry.value = "Select Country";
      shippingRegion.value = "Select State";
    }
  });
});
