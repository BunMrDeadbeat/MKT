<div x-show="showDeleteModal === {{ $service->id }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60" style="display: none;">
    <div @click.away="showDeleteModal = null" class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 text-center p-6">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mt-4">¿Estás seguro?</h3>
        <p class="text-gray-600 mt-2">
            Quieres eliminar el servicio <strong class="font-medium">"{{ $service->name }}"</strong>.
            Esta acción es irreversible.
        </p>
        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <div class="flex justify-center space-x-4">
                <button @click="showDeleteModal = null" type="button" class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Cancelar
                </button>
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Sí, Eliminar
                </button>
            </div>
        </form>
    </div>
</div>
