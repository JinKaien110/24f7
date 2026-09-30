console.log('user-orders.js loaded!');

window.openModal = function () {
    const modal = document.getElementById('checkoutModal');
    if (modal) modal.classList.remove('hidden');
};

window.closeModal = function () {
    const modal = document.getElementById('checkoutModal');
    if (modal) modal.classList.add('hidden');
};

window.calculateChange = function () {
    const amountPaid = parseFloat(document.getElementById('amount_paid')?.value || 0);
    const total = parseFloat(document.getElementById('modal-total')?.textContent.replace(/[^0-9.]/g, '') || 0);
    const change = amountPaid - total;
    document.getElementById('changeDisplay').textContent = change >= 0 ? change.toFixed(2) : '0.00';
};

window.validateCheckout = function () {
    const amountPaid = parseFloat(document.getElementById('amount_paid')?.value || 0);
    const total = parseFloat(document.getElementById('checkoutTotal')?.textContent.replace(/[^0-9.]/g, '') || 0);

    if (amountPaid < total) {
        alert('Insufficient amount paid.');
        return false;
    }

    return true;
};