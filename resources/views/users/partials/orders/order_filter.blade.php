<form method="GET" action="{{ route('users.orders.index') }}" class="w-full lg:w-[260px] bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-[130px] h-fit" id="filterForm">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🧊 Filter Products</h2>
    <div class="space-y-6 text-sm text-gray-700">

        {{-- Brand --}}
        <div>
            <label class="block font-semibold mb-1">Brand</label>
            <select name="brand" class="w-full rounded-lg border-gray-300" onchange="this.form.submit()">
                <option value="">All Brands</option>
                <option value="Carrier" {{ request('brand') == 'Carrier' ? 'selected' : '' }}>Carrier</option>
                <option value="Daikin" {{ request('brand') == 'Daikin' ? 'selected' : '' }}>Daikin</option>
                <option value="Midea" {{ request('brand') == 'Midea' ? 'selected' : '' }}>Midea</option>
            </select>
        </div>

        {{-- Type --}}
        <div>
            <p class="font-semibold mb-2">Type</p>
            <div class="space-y-1">
                @foreach (['Window', 'Split'] as $type)
                    <label class="flex items-center gap-2">
                        <input type="radio" name="type" value="{{ $type }}" {{ request('type') == $type ? 'checked' : '' }} onchange="this.form.submit()">
                        {{ $type }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Horsepower --}}
        <div>
            <p class="font-semibold mb-2">Horsepower</p>
            <div class="space-y-1">
                @foreach ([0.5, 0.8, 1.0, 1.5, 2.0, 2.5, 3.0] as $hp)
                    <label class="flex items-center gap-2">
                        <input type="radio" name="hp" value="{{ $hp }}" {{ request('hp') == $hp ? 'checked' : '' }} onchange="this.form.submit()">
                        {{ $hp }} HP
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Price Range --}}
        <div>
            <p class="font-semibold mb-2">Price Range</p>
            <select name="price_range" class="w-full rounded-lg border-gray-300" onchange="this.form.submit()">
                <option value="">All Prices</option>
                <option value="0-10000" {{ request('price_range') == '0-10000' ? 'selected' : '' }}>₱0 - ₱10,000</option>
                <option value="10001-20000" {{ request('price_range') == '10001-20000' ? 'selected' : '' }}>₱10,001 - ₱20,000</option>
                <option value="20001-30000" {{ request('price_range') == '20001-30000' ? 'selected' : '' }}>₱20,001 - ₱30,000</option>
                <option value="30001-50000" {{ request('price_range') == '30001-50000' ? 'selected' : '' }}>₱30,001 - ₱50,000</option>
                <option value="50001-100000" {{ request('price_range') == '50001-100000' ? 'selected' : '' }}>₱50,001 - ₱100,000</option>
            </select>
        </div>

        {{-- Sort By --}}
        <div>
            <p class="font-semibold mb-2">Sort By</p>
            <select name="sort_by" class="w-full rounded-lg border-gray-300" onchange="this.form.submit()">
                <option value="">Default</option>
                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
            </select>
        </div>

        {{-- Clear Filters --}}
        <div>
            <a href="{{ route('users.orders.index') }}" class="block w-full mt-4 text-center bg-gray-300 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-400 transition">Clear Filters</a>
        </div>
    </div>
</form>
