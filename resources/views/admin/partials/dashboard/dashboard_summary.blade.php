<div class="mb-6">
    <div class="row">
        <!-- Total Products Card -->
        <div class="col-md-2 col-sm-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Products</h6>
                    <h4 class="card-text">{{ $totalProducts }}</h4>
                </div>
            </div>
        </div>

        <!-- Products Needing Reorder Card -->
        <div class="col-md-2 col-sm-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="card-title text-muted">Products Needing Reorder</h6>
                    <h4 class="card-text text-danger">{{ $productsNeedingReorder }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Sales Today Card -->
        <div class="col-md-2 col-sm-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Sales Today</h6>
                    <h4 class="card-text text-success">₱{{ number_format($totalSalesToday, 2) }}</h4>
                </div>
            </div>
        </div>

          <!-- Total Sales Revenue Today Card -->
          <div class="col-md-2 col-sm-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Revenue Today</h6>
                    <h4 class="card-text text-success">₱{{ number_format($totalRevenueToday, 2) }}</h4>
                </div>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="col-md-2 col-sm-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="card-title text-muted">Pending Orders</h6>
                    <h4 class="card-text text-warning">{{ $pendingOrders }}</h4>
                </div>
            </div>
        </div>

                  <!-- Total of users -->
                  <div class="col-md-2 col-sm-6 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total of Users</h6>
                            <h4 class="card-text text-success">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
    </div>
</div>
