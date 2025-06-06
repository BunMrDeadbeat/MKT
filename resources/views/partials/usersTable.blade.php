<div class="bg-white rounded-lg border border-gray-200 overflow-hidden"> 
    <div class="p-6 border-b border-gray-200 flex items-center justify-between"> 
        <h2 class="text-lg font-semibold">Lista de usuarios</h2> 
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> 
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500"> 
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th> 
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th> 
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200"> 
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap"> 
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500" value="{{ $user->id }}"> 
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4"> 
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div> 
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td> 
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->roles->first() && $user->roles->first()->name == 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $user->roles->first() ? $user->roles->first()->name : 'No Role' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"> 
                            <div class="flex space-x-2">
                                <button class="text-yellow-600 hover:text-yellow-900 action-btn"> 
                                    <i class="fas fa-edit"></i> 
                                </button>
                                <button class="text-red-600 hover:text-red-900 action-btn"> 
                                    <i class="fas fa-trash-alt"></i> 
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"> 
        <div class="text-sm text-gray-500">
            @if ($users->total() > 0)
                Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} usuarios
            @else
                Mostrando 0 a 0 de 0 usuarios
            @endif
        </div> 
        <div class="flex space-x-1"> 
            {{ $users->links() }} {{-- Renders pagination links automatically --}}
        </div>
    </div>
</div>