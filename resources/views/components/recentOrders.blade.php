<div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold">Recent Orders</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Orden</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-0001</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Carlos Perez</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">04 de Mayo 2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$1250.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completado</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="text-blue-600 hover:text-blue-900 text-2xl">...</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-500">Showing 1 to 3 of 15 entries</div>
        <div class="flex space-x-1">
            <button class="px-3 py-1 rounded border border-gray-300 text-sm">Previous</button>
            <button class="px-3 py-1 rounded bg-blue-600 text-white text-sm">1</button>
            <button class="px-3 py-1 rounded border border-gray-300 text-sm">2</button>
            <button class="px-3 py-1 rounded border border-gray-300 text-sm">Next</button>
        </div>
    </div>
</div>