{{-- 🎁 Product Grid --}}
<main class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3 gap-10 w-full" id="products">
    @foreach ($products as $product)
    <div class="bg-white rounded-3xl overflow-hidden shadow-xl group hover:shadow-2xl transition-all border border-gray-200 flex flex-col h-full relative {{ $product->stock->quantity == 0 ? 'opacity-50 pointer-events-none' : '' }}">
        
      {{-- 📸 Image --}}
        <div class="relative h-60 overflow-hidden">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

            <span class="absolute top-3 left-3 bg-rose-500 text-white text-[11px] px-3 py-1 rounded-full uppercase font-semibold">New</span>

            @if ($product->stock && $product->stock->quantity == 0)
                {{-- Overlay signage --}}
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-10">
                    <span class="text-white text-lg font-bold tracking-wider uppercase">Out of Stock</span>
                </div>
            @endif
        </div>

        {{-- 📋 Info --}}
        <div class="p-5 flex flex-col h-full">
            
            {{-- Top Content: Title and Description --}}
            <div>
                <h3 class="text-base font-semibold text-gray-900 mb-1">
                    {{ $product->name }}
                </h3>
                <p class="text-sm text-gray-500">
                    {{ $product->description }}
                </p>
            </div>
            

            {{-- Bottom Content: Rating, Price, and Button --}}
            <div class="mt-auto">
                <div class="text-sm text-gray-700 space-y-1">
                    <p><span class="font-medium text-gray-800">Horsepower:</span> {{ $product->horsepower }}</p>
                    <p><span class="font-medium text-gray-800">Type:</span> {{ $product->type }}</p>
                </div>
                <div class="flex items-center gap-1 text-yellow-400 mt-4 text-sm">
                    <span>⭐ ⭐ ⭐ ⭐ ☆</span>
                    <span class="text-gray-400 text-xs">(128)</span>
                </div>

                <div class="mt-2 mb-4 text-lg font-bold text-blue-700">
                    ₱{{ number_format($product->price, 2) }}
                </div>

                @include('users.partials.orders.order_add-to-cart-button')
            </div>
        </div>
    </div>
    @endforeach
</main>
