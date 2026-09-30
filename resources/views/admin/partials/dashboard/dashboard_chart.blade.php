<div class="mb-6">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h5 class="card-title">Order Analytics</h5>
                <div class="mb-3 text-end">
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Reset</a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="bi bi-funnel"></i> Filter Orders
                    </button>
                </div>

            <!-- Chart Container -->
            <canvas id="orderChart"></canvas>

            <!-- Include the Chart.js file from public/js only once -->
            <script src="{{ asset('js/chart.js') }}"></script>

            <!-- Call Chart.js Script -->
            <script>
                // Ensure the correct data is passed
                const chartData = @json($chartData); 
                renderOrderChart(chartData.dates, chartData.orderCounts, chartData.revenues);
            </script>
        </div>
    </div>
</div>
