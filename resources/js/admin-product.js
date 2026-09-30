console.log('admin-product.js is loaded')

document.addEventListener('DOMContentLoaded', function () {
    const productSelect = document.getElementById('product_id');
    const serialInput = document.getElementById('serial_number');

    productSelect.addEventListener('change', function () {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const prefix = selectedOption.getAttribute('data-prefix');
        
        // Prefill the serial input with the prefix and leave space for the admin to type
        serialInput.value = prefix ? prefix + '-' : '';
    });
});