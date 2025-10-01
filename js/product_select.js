// product_select.js
document.addEventListener("DOMContentLoaded", () => {
  // Read URL parameter
  const urlParams = new URLSearchParams(window.location.search);
  const selectedProduct = urlParams.get("product");

  if (selectedProduct) {
    // Clear previous selections
    document.querySelectorAll('.gallery input[type="checkbox"]').forEach(cb => {
      cb.checked = false;
      cb.parentElement.classList.remove("highlight");
    });

    // Map parameter to the right input value
    const productMap = {
      "small-oil": "Herbal hair oil[small]",
      "large-oil": "Herbal hair oil[large]",
      "daily-powder": "daily harbal powder",
      "weekly-powder": "Weekly herbal product"
    };

    const targetValue = productMap[selectedProduct];

    // Find the matching checkbox
    const targetCheckbox = document.querySelector(`.gallery input[value="${targetValue}"]`);
    if (targetCheckbox) {
      targetCheckbox.checked = true;
      targetCheckbox.parentElement.classList.add("highlight"); // add CSS highlight
    }
  }
});