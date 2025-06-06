@props(['title', 'value', 'change', 'icon', 'color'])

<div class="stat-card bg-white rounded-lg border border-gray-200 p-6 transition cursor-pointer">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
            <h3 class="text-2xl font-bold">{{ $value }}</h3>
            <p class="text-sm {{ $change['color'] ?? 'text-green-500' }} mt-1">{{ $change['text'] }}</p>
        </div>
        <div class="w-12 h-12 rounded-full {{ $color['bg'] ?? 'bg-blue-100' }} flex items-center justify-center">
            <i class="fas {{ $icon }} {{ $color['text'] ?? 'text-blue-600' }} text-xl"></i>
        </div>
    </div>
</div>