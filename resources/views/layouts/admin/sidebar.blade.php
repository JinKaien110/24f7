<a href="/" class="d-flex align-items-center mb-4 text-white text-decoration-none">
    <img src="{{ asset('storage/24f7/logo.jpg') }}" alt="Company Logo" class="img-fluid rounded shadow" style="max-width: 140px;">
</a>

<ul class="nav nav-pills flex-column gap-2 mb-auto">
    <li>
        <a href="{{ route('admin.index') }}"
           class="nav-link d-flex align-items-center {{ request()->is('admin') ? 'bg-primary text-white' : 'text-white hover:bg-secondary' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('inventory') }}"
           class="nav-link d-flex align-items-center {{ request()->is('inventory') ? 'bg-primary text-white' : 'text-white hover:bg-secondary' }}">
            <i class="bi bi-box-seam me-2"></i> Inventory
        </a>
    </li>
    <li>
        <a href="{{ route('system_users.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('system_users.index') ? 'bg-primary text-white' : 'text-white hover:bg-secondary' }}">
            <i class="bi bi-people me-2"></i> System Users
        </a>
    </li>
    <li>
        <a href="{{ route('products') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('products') ? 'bg-primary text-white' : 'text-white hover:bg-secondary' }}">
            <i class="bi bi-menu-button me-2"></i> Products
        </a>
    </li>
    <li x-data="{ open: {{ request()->routeIs('admin.orders.*') ? 'true' : 'false' }} }">
        <button
            type="button"
            @click="open = !open"
            class="nav-link w-100 d-flex align-items-center justify-between {{ request()->routeIs('admin.orders.*') ? 'bg-primary text-white' : 'text-white hover:bg-secondary' }}">
            <span><i class="bi bi-cart2 me-2"></i> Orders</span>
            <i :class="open ? 'bi bi-chevron-up' : 'bi bi-chevron-down'"></i>
        </button>

        <div x-show="open" x-transition.duration.300ms class="ps-4 mt-2" x-cloak>
            <a href="{{ route('admin.orders.index') }}"
               class="nav-link small text-white ps-3 d-block hover:text-primary text-decoration-none">
                All Orders
            </a>
            <a href="{{ route('admin.orders.management') }}"
               class="nav-link small text-white ps-3 d-block hover:text-primary text-decoration-none">
                Manage Orders
            </a>
        </div>
    </li>
    <li>
        <a href="{{ route('transactions.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('transactions.index') ? 'bg-primary text-white' : 'text-white hover:bg-secondary' }}">
            <i class="bi bi-bank me-2"></i> Transactions
        </a>
    </li>
</ul>

<hr class="border-secondary">

<ul class="nav flex-column mt-3">
    <li>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="#" class="nav-link text-danger d-flex align-items-center"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </form>
    </li>
</ul>
