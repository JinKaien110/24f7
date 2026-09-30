        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover text-white">
                <thead class="bg-transparent">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Reorder Level</th>
                        <th>Action Needed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                    @php
                        $quantity = $stock->quantity;
                        $reorderLevel = $stock->reorder_level;
                        $color = 'text-success'; // default
                        $actionNeeded = 'No';
                
                        if ($reorderLevel > 0) {
                            // Red threshold is 50% of the reorder level, Green threshold is 150% of the reorder level
                            $redThreshold = $reorderLevel * 1.0;
                            $greenThreshold = $reorderLevel * 1.5;
                
                            // Condition for red (low stock, needs action)
                            if ($quantity <= $redThreshold) {
                                $color = 'text-danger';
                                $actionNeeded = 'Yes';
                            }
                            // Condition for yellow (stock between red and green thresholds)
                            elseif ($quantity > $redThreshold && $quantity <= $greenThreshold) {
                                $color = 'text-warning';
                                $actionNeeded = 'Maybe';
                            }
                            // Condition for green (stock is healthy)
                            else {
                                $color = 'text-success';
                                $actionNeeded = 'No';
                            }
                        } else {
                            // If there is no reorder level, mark it as 'No Reorder Level'
                            $color = 'text-muted';
                            $actionNeeded = 'No Reorder Level';
                        }
                    @endphp

                    <tr class="hover:bg-gradient-to-r from-gray-700 to-black transition-all duration-300 ease-in-out">
                        <td>{{ $stock->product->name }}</td>
                        <td class="{{ $color }}"><strong>{{ $stock->quantity }}</strong></td>
                        <td>{{ $stock->reorder_level }}</td>
                        <td>
                            @if ($actionNeeded === 'Yes')
                                <span class="badge bg-danger">Reorder Now</span>
                            @elseif ($actionNeeded === 'Maybe')
                                <span class="badge bg-warning">Slightly Sufficient</span>
                            @elseif ($actionNeeded === 'No Reorder Level')
                                <span class="badge bg-secondary">N/A</span>
                            @else
                                <span class="badge bg-success">Sufficient</span>
                            @endif
                        </td>
                        <td>
                            <!-- Edit Modal Trigger -->
                            <button class="btn btn-warning btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal-{{ $stock->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Stock">
                                <i class="bi bi-pencil"></i>
                            </button>
                            
                            <!-- <button class="btn btn-sm btn-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $stock->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Stock">
                                <i class="bi bi-trash"></i>
                            </button> -->
                        </td>
                    </tr>

                    <!-- Modals -->
                    @include('admin.partials.inventory.inventory_edit-modal', ['stock' => $stock])
                    {{-- @include('admin.partials.inventory.inventory_delete-modal', ['stock' => $stock]) --}}

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
