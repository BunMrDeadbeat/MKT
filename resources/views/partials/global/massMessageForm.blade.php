@php
$user = (auth()->check() && auth()->user()->hasVerifiedEmail()) ? auth()->user() : null;
@endphp
<div class="service-card rounded-xl p-8">
    <h3 class="text-2xl font-bold text-white mb-6">Envíanos un mensaje</h3>
    <form>
        <div class="mb-4">
            <label for="name" class="block text-white font-medium mb-2">Nombre completo</label>
            <input type="text" id="name" name="name"
               value="{{ $user ? $user->name : '' }}" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3  placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-white font-medium mb-2">Correo electrónico</label>
            <input type="email" id="email" name="email"
               value="{{ $user ? $user->email : '' }}" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3  placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-white font-medium mb-2">Teléfono</label>
            <input type="tel" id="phone" name="phone"
                value="" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3  placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
        </div>
        <div class="mb-4">
            <label for="service" class="block text-white font-medium mb-2">Servicio de interés</label>
            <select id="service" name="service"
                class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3  placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                <option value="">Selecciona un servicio</option>
                <option value="Sublimación y grabado láser">Sublimación y grabado láser</option>
                <option value="Uniformes bordados">Uniformes bordados</option>
                <option value="Diseño web">Diseño web</option>
                <option value="Manejo de redes sociales">Manejo de redes sociales</option>
                <option value="Impresión publicitaria">Impresión publicitaria</option>
                <option value="Cursos de capacitación">Cursos de capacitación</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-white font-medium mb-2">Mensaje</label>
            <textarea id="message" rows="4" name="message"
                class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3  placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300"></textarea>
        </div>
        <button formaction="{{ route('mass-message.send') }}" type="submit"
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-4 rounded-lg transition duration-300">
            Enviar mensaje<i class="fas fa-paper-plane ml-2"></i>
        </button>
    </form>
</div>