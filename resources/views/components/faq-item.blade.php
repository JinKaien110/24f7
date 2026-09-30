<div class="border border-gray-200 {{ $index > 1 ? 'border-t-0' : '' }}">
    <div class="p-4 cursor-pointer flex items-center"
        @click="activeTab === {{ $index }} ? activeTab = null : activeTab = {{ $index }}">
        <span
            class="text-2xl font-bold mr-2 transition-colors duration-300"
            :class="activeTab === {{ $index }} ? 'text-[#FF7700]' : 'text-black'"
            x-text="activeTab === {{ $index }} ? '−' : '+'"></span>
        <h3
            class="font-medium transition-colors duration-300"
            :class="activeTab === {{ $index }} ? 'text-[#FF7700]' : 'text-black'">
            {{ $question }}
        </h3>
    </div>

    <div x-show="activeTab === {{ $index }}"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 max-h-0 transform scale-y-75"
        x-transition:enter-end="opacity-100 max-h-screen transform scale-y-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 max-h-screen transform scale-y-100"
        x-transition:leave-end="opacity-0 max-h-0 transform scale-y-75"
        class="overflow-hidden p-4 pt-0 border-t border-gray-200 text-gray-700"
        x-cloak>
        {!! $answer !!}
    </div>
</div>
