let inventoryItems = []; // Temporary storage for frontend demo

function addAC() {
    let name = document.getElementById('acName').value;
    let type = document.getElementById('acType').value;
    let hp = document.getElementById('acHP').value;
    let price = document.getElementById('acPrice').value;

    if (!name || !hp || !price) {
        alert("Please fill in all fields!");
        return;
    }

    // Create new AC object
    let newAC = {
        name: name,
        type: type,
        hp: hp,
        price: parseFloat(price).toFixed(2)
    };

    inventoryItems.push(newAC); // Add to array
    updateInventoryTable(); // Update UI

    // Reset form fields
    document.getElementById('addACForm').reset();

    // Close Modal
    var modal = new bootstrap.Modal(document.getElementById('addACModal'));
    modal.hide();
}

function updateInventoryTable() {
    let tableBody = document.querySelector("tbody");
    tableBody.innerHTML = ""; // Clear existing rows

    inventoryItems.forEach((item, index) => {
        let row = `
            <tr>
                <td>${item.name}</td>
                <td>${item.type}</td>
                <td>${item.hp}</td>
                <td>$${item.price}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editItem(${index})">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteItem(${index})">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

function deleteItem(index) {
    inventoryItems.splice(index, 1);
    updateInventoryTable();
}