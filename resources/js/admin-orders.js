console.log("admin-orders.js loaded!");

let cart = [];

const productSelect = document.getElementById("productSelect");
const addToCartBtn = document.getElementById("addToCartBtn");
const cartItemsContainer = document.getElementById("cartItems");
const subtotalField = document.getElementById("subtotal");
const vatField = document.getElementById("vat_amount");
const totalAmountField = document.getElementById("total_amount");
const amountPaidField = document.getElementById("amountPaid");
const changeField = document.getElementById("change");
const hiddenInputsContainer = document.getElementById("cartHiddenInputs");

// Add to cart
addToCartBtn.addEventListener("click", () => {
    const selectedOption = productSelect.options[productSelect.selectedIndex];
    if (!selectedOption || !selectedOption.value) return;

    const productId = selectedOption.value;
    const productName = selectedOption.dataset.name;
    const price = parseFloat(selectedOption.dataset.price);
    const quantity = parseInt(document.getElementById("productQty").value) || 1;

    // Check for existing product
    const existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.quantity += quantity;
    } else {
        cart.push({ id: productId, name: productName, price, quantity });
    }

    updateCartDisplay();
});

// Update cart UI and totals
function updateCartDisplay() {
    cartItemsContainer.innerHTML = "";
    hiddenInputsContainer.innerHTML = "";

    cart.forEach((item, index) => {
        const itemDiv = document.createElement("div");
        itemDiv.classList.add("d-flex", "justify-content-between", "align-items-center", "mb-2");

        itemDiv.innerHTML = `
            <div>${item.name} (x${item.quantity})</div>
            <div>₱${(item.price * item.quantity).toFixed(2)}</div>
            <button type="button" class="btn btn-sm btn-danger remove-btn rounded-circle" data-index="${index}"><i class='bi bi-x-circle'></i></button>
        `;

        cartItemsContainer.appendChild(itemDiv);

        // Hidden fields for each product
        const productInput = document.createElement("input");
        productInput.type = "hidden";
        productInput.name = "product_id[]";
        productInput.value = item.id;
        hiddenInputsContainer.appendChild(productInput);

        const quantityInput = document.createElement("input");
        quantityInput.type = "hidden";
        quantityInput.name = "quantity[]";
        quantityInput.value = item.quantity;
        hiddenInputsContainer.appendChild(quantityInput);
    });

    calculateTotals();
}

// Totals calculation
function calculateTotals() {
    const subtotal = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    const vat_amount = subtotal * 0.12;
    const total_amount = subtotal + vat_amount;

    subtotalField.textContent = `₱${subtotal.toFixed(2)}`;
    vatField.textContent = `₱${vat_amount.toFixed(2)}`;
    totalAmountField.textContent = `₱${total_amount.toFixed(2)}`;

    const amountPaid = parseFloat(amountPaidField.value);
    if (!isNaN(amountPaid)) {
        changeField.value = (amountPaid - total_amount).toFixed(2);
    } else {
        changeField.value = "";
    }
}

// Recalculate on amountPaid input
amountPaidField.addEventListener("input", calculateTotals);

// Remove item from cart
cartItemsContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("remove-btn")) {
        const index = e.target.dataset.index;
        cart.splice(index, 1);
        updateCartDisplay();
    }
});
