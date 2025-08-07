{{-- @php $activeNav = 'users' @endphp --}}
@extends('layouts.adminPageLayout')

@section('content')

    @include('partials.users')
    <div id="editUserModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-2xl font-bold text-gray-800">Editar Usuario</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <div class="mt-5">
                <form id="editUserForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-semibold mb-4 text-gray-700">Datos Personales</h4>
                            <input type="hidden" id="editUserId" name="user_id">

                            <div class="mb-4">
                                <label for="editName" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                <input type="text" id="editName" name="name" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="editEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="editEmail" name="email" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <p class="text-xs text-gray-500 mt-1">Al cambiar el email, se verificará automáticamente.</p>
                            </div>
                            
                            <div class="mb-4">
                                <label for="editTelefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                                <input type="tel" id="editTelefono" name="telefono" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <p class="text-xs text-gray-500 mt-1">Sí el codigo de país no es +1, incluya un 1 despues de éste.</p>
                            </div>

                            <div class="mb-4">
                                <label for="editPassword" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña (Opcional)</label>
                                <input type="password" id="editPassword" name="password" placeholder="Dejar en blanco para no cambiar" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Estado del Email</label>
                                <div id="emailVerificationStatus" class="p-2 flex items-center space-x-4">
                                    </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-4 text-gray-700">Carrito de Compras</h4>
                            <div id="userCartDetails" class="border rounded-md p-4 h-80 overflow-y-auto bg-gray-50">
                                </div>
                        </div>
                        <div class="md:col-span-2 mt-6">
                            <h4 class="text-lg font-semibold mb-4 text-gray-700">Sesiones Activas</h4>
                            <div id="userSessions" class="border rounded-md max-h-60 overflow-y-auto bg-gray-50">
                                </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-6 border-t mt-6 space-x-4">
                        <button type="button" onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('/js/GlobalAlert.js') }}"></script>
<script>
    const modal = document.getElementById('editUserModal');
    const form = document.getElementById('editUserForm');
    const userIdField = document.getElementById('editUserId');

    function closeModal() {
        modal.classList.add('hidden');
    }

    async function openUserDetailsModal(userId) {
        try {
            const response = await fetch(`/admin/usuarios/${userId}/details`);
            if (!response.ok) throw new Error('Error al cargar los datos del usuario.');
            
            const user = await response.json();

            userIdField.value = user.id;
            form.action = `/admin/usuarios/${user.id}/update-admin`;
            document.getElementById('editName').value = user.name;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editTelefono').value = user.telefono || '';
            document.getElementById('editPassword').value = ''; 

            const verificationStatusDiv = document.getElementById('emailVerificationStatus');
            if (user.email_verified_at) {
                verificationStatusDiv.innerHTML = `
                    <span class="text-green-600 font-semibold flex items-center"><i class="fas fa-check-circle mr-2"></i> Verificado</span>
                    <button type="button" onclick="handleVerificationAction(${user.id}, 'unverify')" class="text-sm bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Cancelar Verificación</button>
                `;
            } else {
                verificationStatusDiv.innerHTML = `
                    <span class="text-red-600 font-semibold flex items-center"><i class="fas fa-times-circle mr-2"></i> No Verificado</span>
                    <button type="button" onclick="handleVerificationAction(${user.id}, 'verify')" class="text-sm bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Verificar Ahora</button>
                `;
            }

            const cartDetailsDiv = document.getElementById('userCartDetails');
            if (user.cart && user.cart.productos.length > 0) {
                let cartHtml = '<ul class="divide-y divide-gray-200">';
                user.cart.productos.forEach(item => {
                    cartHtml += `
                        <li class="py-3">
                            <p class="font-semibold text-gray-800">${item.producto.name}</p>
                            <p class="text-sm text-gray-600">Cantidad: ${item.quantity}</p>
                            <p class="text-sm text-gray-600">Precio Unitario: $${parseFloat(item.unit_price).toFixed(2)}</p>
                        </li>
                    `;
                });
                cartHtml += '</ul>';
                cartDetailsDiv.innerHTML = cartHtml;
            } else {
                cartDetailsDiv.innerHTML = '<p class="text-center text-gray-500">El usuario no tiene un carrito activo o está vacío.</p>';
            }
            const sessionsDiv = document.getElementById('userSessions');
            if (user.sessions && user.sessions.length > 0) {
                let sessionsHtml = `
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">IP</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Dispositivo / Navegador</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Última Actividad</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">`;

                user.sessions.forEach(session => {
                    const lastActivityDate = new Date(session.last_activity * 1000);
                    const formattedDate = lastActivityDate.toLocaleString('es-MX', {
                        dateStyle: 'medium',
                        timeStyle: 'short'
                    });

                    sessionsHtml += `
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800 font-mono">${session.ip_address || 'N/A'}</td>
                            <td class="px-4 py-3 text-sm text-gray-600 truncate max-w-xs" title="${session.user_agent || ''}">
                                ${session.user_agent || 'N/A'}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">${formattedDate}</td>
                        </tr>
                    `;
                });

                sessionsHtml += `</tbody></table></div>`;
                sessionsDiv.innerHTML = sessionsHtml;
            } else {
                sessionsDiv.innerHTML = '<p class="text-center text-gray-500 p-4">No se encontraron sesiones activas para este usuario.</p>';
            }
            
            modal.classList.remove('hidden');

        } catch (error) {
            console.error('Error:', error);
            showAlert('No se pudieron cargar los detalles del usuario.');
        }
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const actionUrl = form.action;

        try {
            const response = await fetch(actionUrl, {
                method: 'POST', 
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            });

            const result = await response.json();

            if (!response.ok) {
                let errorMsg = 'Ocurrió un error.';
                if (result.errors) {
                    errorMsg = Object.values(result.errors).flat().join('\n');
                }
                throw new Error(errorMsg);
            }
            
            alert(result.success);
            closeModal();
            location.reload();

        } catch (error) {
            console.error('Error al actualizar:', error);
            showAlert(`Error: ${error.message}`);
        }
    });

    async function handleVerificationAction(userId, action) {
        try {
            const response = await fetch(`/admin/usuarios/${userId}/update-admin`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'PUT',
                    name: document.getElementById('editName').value,
                    email: document.getElementById('editEmail').value,
                    email_action: action
                })
            });

            const result = await response.json();
            if (!response.ok) throw new Error('Falló la acción.');

            alert(result.success);
            openUserDetailsModal(userId);

        } catch (error) {
            showAlert('No se pudo completar la acción.');
        }
    }

</script>
<script>
function confirmUserDeletion(userId, userName) {
    const confirmation = confirm(`¿Estás seguro de que quieres eliminar al usuario "${userName}"?\n\n¡Esta acción no se puede deshacer!`);

    if (confirmation) {
        deleteUser(userId);
    }
}

async function deleteUser(userId) {
    try {
        const response = await fetch(`/admin/usuarios/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'Ocurrió un error al eliminar el usuario.');
        }
        
        alert(result.message);
        location.reload();

    } catch (error) {
        console.error('Error al eliminar el usuario:', error);
        showAlert(`Error: ${error.message}`);
    }
}
</script>
@endsection