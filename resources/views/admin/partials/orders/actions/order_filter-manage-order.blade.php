<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="GET" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Transactions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Date From</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date To</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
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
                
                
                <div class="col-md-6">
                    <label class="form-label">User</label>
                    <select name="user_id" class="form-select">
                        <option value="">All</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('admin.orders.management') }}" class="btn btn-outline-secondary">Reset</a>
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>
</div>