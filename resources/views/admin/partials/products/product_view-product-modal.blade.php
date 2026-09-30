<!-- Modal -->
<div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="modal-header p-4 border-b">
                <h5 class="modal-title text-xl font-semibold" id="productModalLabel{{ $product->id }}">
                    Serial Numbers for {{ $product->name }}
                </h5>
                <button type="button" class="btn-close text-gray-400 hover:text-gray-600" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4 max-h-[60vh] overflow-y-auto">
                <table class="table-auto w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Serial Number</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($serialNumbers as $serial)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-sm">{{ $serial->serial_number }}</td>
                                <td class="px-4 py-2 text-sm">{{ ucfirst($serial->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-2 text-center text-sm text-gray-500">No serial numbers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer p-4 border-t">
                <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
