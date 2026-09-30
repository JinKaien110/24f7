<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-20 py-3 rounded-md text-white hover:bg-[#0D47A1] bg-[#3c88f8] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
