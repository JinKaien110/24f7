console.log('cart.js loaded!');

document.addEventListener('DOMContentLoaded', function () {

    function showAlert(message, type = 'success') {
        const alertElement = document.getElementById('alert-message');
        const alertText = document.getElementById('alert-text');
        
        // Set the message and style based on type
        alertText.textContent = message;
        
        // Remove all previous types and hidden class, then add new classes
        alertElement.classList.remove('hidden', 'success', 'error', 'warning', 'info');
        alertElement.classList.add(type, 'show');

        // Automatically hide the alert after 3 seconds
        setTimeout(() => {
            alertElement.classList.remove('show');
            alertElement.classList.add('hidden');
        }, 3000);
    }

    // Close the alert when the close button is clicked
    document.getElementById('close-alert')?.addEventListener('click', () => {
        const alertElement = document.getElementById('alert-message');
        alertElement.classList.remove('show');
        alertElement.classList.add('hidden');
    });



    // Add to cart form submission handling
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Stop the browser from redirecting

            const formData = new FormData(form);
            const url = form.getAttribute('action');

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => {
                if (response.redirected) {
                    // Laravel redirected us to login
                    window.location.href = response.url; // go to login page
                    return;
                }
            
                return response.json(); // continue if not redirected
            })
            .then(data => {
                // Show the alert with success or failure message
                if (data.success) {
                    showAlert('Item has been added to cart! ', 'success');
                } else {
                    showAlert('Failed to add item.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while adding the item to the cart.', 'error');
            });
        });
    });
});


function updateQuantity(itemId, action) {
    const quantityElement = document.getElementById('quantity-' + itemId);
    const modalQuantityElement = document.getElementById('modalQuantity-' + itemId);
    const totalAmountElement = document.getElementById('total-amount-' + itemId);
    const currentQuantity = parseInt(quantityElement.textContent);

    // Determine new quantity based on action
    let newQuantity = currentQuantity;
    if (action === 'increase') {
        newQuantity++;
    } else if (action === 'decrease') {
        newQuantity--;
    }

    
    // Update the local UI first
    quantityElement.textContent = newQuantity;
    modalQuantityElement.textContent = newQuantity;
    
    // Calculate the new total amount
    const price = parseFloat(totalAmountElement.dataset.price);
    let newTotalAmount = newQuantity * price;

    // Format the new total amount with commas
    let formattedTotal = newTotalAmount.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });

    // Update the total amount displayed on the page
    totalAmountElement.textContent = formattedTotal;

   
    // Send AJAX request to update the quantity in the database
    fetch(`/users/cart/update-quantity/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: action
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            if (data.deleted) {
                // Remove the item's DOM element from the cart
                const itemRow = document.getElementById('cart-item-' + itemId);
                if (itemRow) itemRow.remove();
            } 
            // Update the totals on the page after the server responds
            document.getElementById('cart-subtotal').textContent = '' + data.subtotal;
            document.getElementById('cart-vat').textContent = '' + data.vat;
            document.getElementById('cart-total').textContent = '' + data.total;

            document.getElementById('modal-subtotal').textContent = '' + data.subtotal;
            document.getElementById('modal-vat').textContent = '' + data.vat;
            document.getElementById('modal-total').textContent = '' + data.total;
        } else {
            // Handle error case
            alert(data.message || 'Failed to update quantity');
        }
    })
    .catch(error => {
        console.error('Error updating quantity:', error);
        alert('An error occurred while updating the cart.');
    });
}


    // Function to fetch cart item count and update the badge
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
    
    // Function to fetch cart item count and update the badge
    function updateCartCount() {
        const cartCountUrl = "{{ route('users.cart.item-count') }}";
        console.log("Fetching from URL:", cartCountUrl);
        
        fetch("http://127.0.0.1:8000/users/cart/item-count")
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById("cart-count-badge");
            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove("hidden");
                } else {
                    badge.textContent = '0';
                    badge.classList.remove("hidden");
                }
            }
        })
        .catch((error) => {
            console.error("Error fetching cart count:", error);
        });
    
    }

    