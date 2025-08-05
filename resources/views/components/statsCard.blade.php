@props(['title', 'value', 'change', 'icon', 'color'])

<div class="bg-white rounded-lg border border-gray-200 p-4 transition cursor-pointer shadow-lg">
    <div class="flex items-center justify-between p-2">
        <div>
            <p class="text-lg font-medium text-gray-500">{{ $title }}</p>
            @if($change)
                <span class="{{ $change['color'] }} text-sm">{{ $change['text'] }}</span>
            @endif
            <h3 class="text-2xl font-bold">{{ $value }}</h3>
        </div>
       
    </div>
</div>