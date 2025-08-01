@props(['type' => 'success', 'message' => ''])

<div
    x-data="{
        show: false,
        type: '{{ $type }}',
        message: '{{ $message }}'
    }"
    x-on:show-modal.window="
        message = $event.detail.message;
        type = $event.detail.type || 'success';
        show = true;
    "
    x-show="show"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
    style="display: none;"
>
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="show = false" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
        >
            <div>
                <div
                    class="flex items-center justify-center w-12 h-12 mx-auto rounded-full"
                    :class="{
                        'bg-green-100': type === 'success',
                        'bg-red-100': type === 'error',
                        'bg-blue-100': type === 'info',
                    }"
                >
                    <template x-if="type === 'success'">
                        <i class="fas fa-check text-2xl text-green-600"></i>
                    </template>
                    <template x-if="type === 'error'">
                        <i class="fas fa-times text-2xl text-red-600"></i>
                    </template>
                    <template x-if="type === 'info'">
                        <i class="fas fa-info text-2xl text-blue-600"></i>
                    </template>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title" x-text="type === 'success' ? '¡Éxito!' : (type === 'error' ? 'Error' : 'Aviso')"></h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" x-html="message"></p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <button
                    @click="show = false"
                    type="button"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                >
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>