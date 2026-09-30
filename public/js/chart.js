const renderOrderChart = (dates, orderCounts, revenues) => {
    const ctx = document.getElementById('orderChart').getContext('2d');
    const orderChart = new Chart(ctx, {
        type: 'bar',  // You can also use 'bar' for a bar chart
        data: {
            labels: dates,  // Dates passed from the controller
            datasets: [{
                label: 'Orders',
                data: orderCounts,  // Order counts
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                yAxisID: 'y1',  // This dataset uses the first y-axis
            }, {
                label: 'Revenue (₱)',
                data: revenues,  // Revenue data
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                yAxisID: 'y2',  // This dataset uses the second y-axis
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                // First Y-axis for order counts
                y1: {
                    type: 'linear',
                    position: 'left',
                    beginAtZero: true,
                },
                // Second Y-axis for revenue
                y2: {
                    type: 'linear',
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false,  // Hide the grid for the second axis
                    }
                }
            }
        }
    });
};

document.querySelectorAll('.time-range-btn').forEach(button => {
    button.addEventListener('click', function() {
        const range = this.getAttribute('data-range');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        // Set the start and end date based on the selected range
        const today = new Date();
        let startDate, endDate;

        switch (range) {
            case 'last_7_days':
                startDate = new Date();
                startDate.setDate(today.getDate() - 7);
                endDate = today;
                break;
            case 'last_30_days':
                startDate = new Date();
                startDate.setDate(today.getDate() - 30);
                endDate = today;
                break;
            case 'this_month':
                startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                endDate = today;
                break;
            case 'last_month':
                startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                endDate = new Date(today.getFullYear(), today.getMonth(), 0);
                break;
            case 'ytd':
                startDate = new Date(today.getFullYear(), 0, 1);
                endDate = today;
                break;
            default:
                return;
        }

        // Format date in yyyy-mm-dd format and set the inputs
        const formatDate = date => {
            return date.toISOString().split('T')[0];
        };

        startDateInput.value = formatDate(startDate);
        endDateInput.value = formatDate(endDate);
    });
});

