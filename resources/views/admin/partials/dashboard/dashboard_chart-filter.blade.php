<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.index') }}" method="GET" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Order Analytics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body row g-3">
                <!-- Predefined Date Range -->
                

                <!-- Custom Date Range (Start & End Dates) -->
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request('start_date', \Carbon\Carbon::now()->subDays(30)->toDateString()) }}">
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request('end_date', \Carbon\Carbon::now()->toDateString()) }}">
                </div>

                <!-- Custom Time Range (Start & End Time) -->
                <div class="col-md-6">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="form-control"
                        value="{{ request('start_time', '') }}">
                </div>
                <div class="col-md-6">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="form-control"
                        value="{{ request('end_time', '') }}">
                </div>
                

                <div class="col-md-6">
                    <label for="time_range" class="form-label">Select Time Range</label>
                    <select name="time_range" id="time_range" class="form-select">
                        <option value="">Choose Date Range</option>
                        <option value="last_7_days" {{ request('time_range') == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="last_30_days" {{ request('time_range') == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
                        <option value="this_month" {{ request('time_range') == 'this_month' ? 'selected' : '' }}>This Month</option>
                        <option value="last_month" {{ request('time_range') == 'last_month' ? 'selected' : '' }}>Last Month</option>
                        <option value="ytd" {{ request('time_range') == 'ytd' ? 'selected' : '' }}>Year-to-Date (YTD)</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="user" class="form-label">Customer</label>
                    <select name="user_id" id="user" class="form-select">
                        <option value="">All Customers</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Order Status -->
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                
                        {{-- Regular Order Statuses --}}
                        @php
                            $statuses = ['pending', 'shipped', 'delivered', 'complete', 'cancelled', 'refunded'];
                        @endphp
                        @foreach ($statuses as $status)
                            <option value="status:{{ $status }}" {{ request('status') === "status:$status" ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                
                        {{-- Refund Statuses --}}
                        @php
                            $refundStatuses = ['requested', 'rejected',];
                        @endphp
                        @foreach ($refundStatuses as $refundStatus)
                            <option value="refund_status:{{ $refundStatus }}" {{ request('status') === "refund_status:$refundStatus" ? 'selected' : '' }}>
                                Refund: {{ ucfirst($refundStatus) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Payment Method -->
                <div class="col-md-6">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-select">
                        <option value="">All</option>
                        <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="gcash" {{ request('payment_method') == 'gcash' ? 'selected' : '' }}>GCash</option>
                        <option value="paymaya" {{ request('payment_method') == 'paymaya' ? 'selected' : '' }}>PayMaya</option>
                    </select>
                </div>

                 <!-- Revenue Range -->
                 <div class="col-md-6">
                    <label for="min_revenue" class="form-label">Min Revenue (₱)</label>
                    <input type="number" name="min_revenue" id="min_revenue" class="form-control" value="{{ request('min_revenue') }}">
                </div>
                <div class="col-md-6">
                    <label for="max_revenue" class="form-label">Max Revenue (₱)</label>
                    <input type="number" name="max_revenue" id="max_revenue" class="form-control" value="{{ request('max_revenue') }}">
                </div>
               
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
