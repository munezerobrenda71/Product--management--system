const form = document.getElementById("productForm");
const message = document.getElementById("message");

form.addEventListener("submit", function (event) {

    const price = Number(document.getElementById("price").value);
    const quantity = Number(document.getElementById("quantity").value);

    if (price <= 0) {
        event.preventDefault();
        message.textContent = "Price must be greater than zero.";
        return;
    }

    if (quantity < 0) {
        event.preventDefault();
        message.textContent = "Quantity cannot be negative.";
        return;
    }

    // Ask the user before submitting
    const answer = confirm("Do you want to save this product?");

    if (!answer) {
        event.preventDefault();
        message.textContent = "Product was not saved.";
        return;
    }

    message.textContent = "Saving product...";
});