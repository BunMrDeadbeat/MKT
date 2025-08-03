@if (session('success') || session('error') || session('info') || $errors->any())
    @php
        $type = session('success') ? 'success' : (session('error') ? 'error' : 'info');
        if ($errors->any()) {
            $type = 'error';
        }

        $bgColor = [
            'success' => 'bg-green-500/50',
            'error' => 'bg-red-500/50',
            'info' => 'bg-blue-500/50',
        ][$type];

        $message = $errors->any() 
            ? '<ul>@foreach ($errors->all() as $error)<li>' . $error . '</li>@endforeach</ul>' 
            : (session('success') ?? session('error') ?? session('info'));
    @endphp

    <div id="session-alert" class="{{ $bgColor }} text-white p-4 text-center relative" role="alert">
        <span>{!! $message !!}</span>
        <button onclick="document.getElementById('session-alert').style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </button>
    </div>
@endif