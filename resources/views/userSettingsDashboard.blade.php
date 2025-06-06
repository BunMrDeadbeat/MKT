<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        purple: {
                            500: '#8a3ab9',
                            600: '#6a2c8a',
                            700: '#4b1d6a'
                        },
                        green: {
                            400: '#4cd964',
                            500: '#34c759',
                            600: '#2a9e47'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar-collapsed {
            width: 80px;
        }
        .sidebar-collapsed .menu-text {
            display: none;
        }
        .sidebar-collapsed .menu-icon {
            margin-right: 0;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(74, 222, 128, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-purple-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <button id="sidebarToggle" class="text-white focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <h1 class="text-xl font-bold">Mi Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="text-white focus:outline-none relative">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="animate-pulse absolute top-0 right-0 w-2 h-2 bg-green-400 rounded-full"></span>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Foto de perfil" class="w-8 h-8 rounded-full border-2 border-white">
                    <span class="hidden md:inline">Claudia Pérez</span>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-purple-700 text-white h-screen fixed md:relative w-64 z-10">
            <div class="p-4 flex items-center space-x-2 border-b border-purple-600">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Foto de perfil" class="w-10 h-10 rounded-full border-2 border-white">
                <div>
                    <p class="font-semibold">Claudia Pérez</p>
                    <p class="text-xs text-purple-200">Usuario Premium</p>
                </div>
            </div>
            <nav class="mt-6">
                <div class="px-4">
                    <p class="text-xs uppercase text-purple-300 font-semibold mb-2">Mi Cuenta</p>
                </div>
                <ul>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-white hover:bg-purple-600 rounded px-3 py-2 transition" onclick="showSection('profile')">
                            <i class="fas fa-user-circle menu-icon mr-3"></i>
                            <span class="menu-text">Perfil</span>
                        </a>
                    </li>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-white hover:bg-purple-600 rounded px-3 py-2 transition" onclick="showSection('orders')">
                            <i class="fas fa-shopping-bag menu-icon mr-3"></i>
                            <span class="menu-text">Mis Órdenes</span>
                        </a>
                    </li>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-white hover:bg-purple-600 rounded px-3 py-2 transition" onclick="showSection('payments')">
                            <i class="fas fa-credit-card menu-icon mr-3"></i>
                            <span class="menu-text">Métodos de Pago</span>
                        </a>
                    </li>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-white hover:bg-purple-600 rounded px-3 py-2 transition" onclick="showSection('requests')">
                            <i class="fas fa-comments menu-icon mr-3"></i>
                            <span class="menu-text">Solicitudes</span>
                        </a>
                    </li>
                </ul>
                <div class="px-4 mt-6">
                    <p class="text-xs uppercase text-purple-300 font-semibold mb-2">Configuración</p>
                </div>
                <ul>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-white hover:bg-purple-600 rounded px-3 py-2 transition" onclick="showSection('security')">
                            <i class="fas fa-shield-alt menu-icon mr-3"></i>
                            <span class="menu-text">Seguridad</span>
                        </a>
                    </li>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-white hover:bg-purple-600 rounded px-3 py-2 transition" onclick="showSection('settings')">
                            <i class="fas fa-cog menu-icon mr-3"></i>
                            <span class="menu-text">Configuración</span>
                        </a>
                    </li>
                    <li class="px-4 py-2">
                        <a href="#" class="flex items-center text-red-300 hover:bg-purple-600 rounded px-3 py-2 transition" onclick="confirmAccountDeletion()">
                            <i class="fas fa-user-times menu-icon mr-3"></i>
                            <span class="menu-text">Cerrar Cuenta</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="main-content flex-1 ml-0 md:ml-64 p-6 transition-all duration-300">
            <!-- Profile Section -->
            <section id="profile" class="section-content">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-purple-700">Mi Perfil</h2>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition" onclick="enableEdit()">
                            <i class="fas fa-edit mr-2"></i>Editar
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col items-center">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Foto de perfil" class="w-32 h-32 rounded-full border-4 border-green-400 mb-4">
                            <button id="changePhotoBtn" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition hidden">
                                <i class="fas fa-camera mr-2"></i>Cambiar Foto
                            </button>
                        </div>
                        
                        <div>
                            <form id="profileForm">
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2" for="name">Nombre Completo</label>
                                    <input type="text" id="name" name="name" value="Claudia Pérez" 
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" disabled>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2" for="email">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" value="claudia.perez@example.com" 
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" disabled>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2" for="phone">Teléfono</label>
                                    <input type="tel" id="phone" name="phone" value="+1 234 567 890" 
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" disabled>
                                </div>
                                <div class="flex justify-end space-x-3 hidden" id="formButtons">
                                    <button type="button" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md transition" onclick="cancelEdit()">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                        <i class="fas fa-save mr-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Orders Section -->
            <section id="orders" class="section-content hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-purple-700 mb-6">Mis Órdenes</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-purple-600 text-white">
                                <tr>
                                    <th class="py-3 px-4 text-left">ID Orden</th>
                                    <th class="py-3 px-4 text-left">Fecha</th>
                                    <th class="py-3 px-4 text-left">Productos</th>
                                    <th class="py-3 px-4 text-left">Total</th>
                                    <th class="py-3 px-4 text-left">Estado</th>
                                    <th class="py-3 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="py-4 px-4">#ORD-2023-1001</td>
                                    <td class="py-4 px-4">15/06/2023</td>
                                    <td class="py-4 px-4">3 productos</td>
                                    <td class="py-4 px-4">$125.99</td>
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Enviado</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-purple-600 hover:text-purple-800">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-4 px-4">#ORD-2023-0928</td>
                                    <td class="py-4 px-4">28/05/2023</td>
                                    <td class="py-4 px-4">1 producto</td>
                                    <td class="py-4 px-4">$45.50</td>
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-medium">Completado</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-purple-600 hover:text-purple-800">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-4 px-4">#ORD-2023-0876</td>
                                    <td class="py-4 px-4">10/04/2023</td>
                                    <td class="py-4 px-4">5 productos</td>
                                    <td class="py-4 px-4">$210.75</td>
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pendiente</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-purple-600 hover:text-purple-800">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center bg-purple-50 p-4 rounded-md">
                        <div>
                            <h3 class="font-semibold text-purple-700">¿Necesitas ayuda con una orden?</h3>
                            <p class="text-sm text-gray-600">Contacta a nuestro equipo de soporte</p>
                        </div>
                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition">
                            <i class="fas fa-headset mr-2"></i>Soporte
                        </button>
                    </div>
                </div>
            </section>

            <!-- Payments Section -->
            <section id="payments" class="section-content hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-purple-700">Métodos de Pago</h2>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition" onclick="showAddCardForm()">
                            <i class="fas fa-plus mr-2"></i>Añadir Método
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="border rounded-lg p-4 flex justify-between items-center bg-purple-50">
                            <div class="flex items-center space-x-4">
                                <i class="fab fa-cc-visa text-4xl text-purple-700"></i>
                                <div>
                                    <p class="font-semibold">Visa terminada en 4242</p>
                                    <p class="text-sm text-gray-600">Expira 05/2025</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-purple-600 hover:text-purple-800">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg p-4 flex justify-between items-center bg-purple-50">
                            <div class="flex items-center space-x-4">
                                <i class="fab fa-cc-mastercard text-4xl text-red-500"></i>
                                <div>
                                    <p class="font-semibold">Mastercard terminada en 5555</p>
                                    <p class="text-sm text-gray-600">Expira 11/2024</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-purple-600 hover:text-purple-800">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="addCardForm" class="mt-6 hidden">
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-purple-700 mb-4">Agregar Nueva Tarjeta</h3>
                            <form>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2" for="cardNumber">Número de Tarjeta</label>
                                        <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" 
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2" for="cardName">Nombre en la Tarjeta</label>
                                        <input type="text" id="cardName" placeholder="Nombre como aparece en la tarjeta" 
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2" for="expiry">Fecha de Expiración</label>
                                        <input type="text" id="expiry" placeholder="MM/AA" 
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2" for="cvv">CVV</label>
                                        <input type="text" id="cvv" placeholder="123" 
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div class="flex items-end">
                                        <div class="flex space-x-2">
                                            <i class="fab fa-cc-visa text-3xl text-purple-700"></i>
                                            <i class="fab fa-cc-mastercard text-3xl text-red-500"></i>
                                            <i class="fab fa-cc-amex text-3xl text-blue-500"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3">
                                    <button type="button" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md transition" onclick="hideAddCardForm()">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                        <i class="fas fa-save mr-2"></i>Guardar Tarjeta
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Requests Section -->
            <section id="requests" class="section-content hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-purple-700 mb-6">Mis Solicitudes</h2>
                    
                    <div class="space-y-6">
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-semibold text-lg">Solicitud de Cotización</h3>
                                    <p class="text-sm text-gray-600">Fecha: 20/06/2023 - ID: #COT-230620</p>
                                </div>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pendiente</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700 mb-2"><span class="font-semibold">Productos:</span> 3 productos seleccionados</p>
                                <p class="text-gray-700"><span class="font-semibold">Mensaje:</span> Hola, necesito una cotización para estos productos con envío incluido a mi dirección. Gracias.</p>
                            </div>
                            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-comment-dots mr-2"></i>Ver Conversación
                            </button>
                        </div>
                        
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-semibold text-lg">Contacto con Soporte</h3>
                                    <p class="text-sm text-gray-600">Fecha: 12/06/2023 - ID: #SUP-230612</p>
                                </div>
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Resuelto</span>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700 mb-2"><span class="font-semibold">Asunto:</span> Problema con mi pedido #ORD-2023-1001</p>
                                <p class="text-gray-700"><span class="font-semibold">Mensaje:</span> Hola, mi pedido muestra que fue enviado pero aún no ha llegado. ¿Podrían verificar el estado? Gracias.</p>
                            </div>
                            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-comment-dots mr-2"></i>Ver Conversación
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-purple-50 p-4 rounded-md">
                        <h3 class="font-semibold text-purple-700 mb-2">Crear Nueva Solicitud</h3>
                        <p class="text-sm text-gray-600 mb-4">Selecciona el tipo de solicitud que deseas realizar</p>
                        <div class="flex flex-wrap gap-4">
                            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>Solicitar Cotización
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-question-circle mr-2"></i>Contactar Soporte
                            </button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-info-circle mr-2"></i>Información de Producto
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Security Section -->
            <section id="security" class="section-content hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-purple-700 mb-6">Seguridad</h2>
                    
                    <div class="space-y-6">
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold text-lg">Cambiar Contraseña</h3>
                                <i class="fas fa-lock text-purple-600"></i>
                            </div>
                            <form>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2" for="currentPassword">Contraseña Actual</label>
                                    <input type="password" id="currentPassword" 
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2" for="newPassword">Nueva Contraseña</label>
                                    <input type="password" id="newPassword" 
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <p class="text-xs text-gray-500 mt-1">La contraseña debe tener al menos 8 caracteres</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2" for="confirmPassword">Confirmar Nueva Contraseña</label>
                                    <input type="password" id="confirmPassword" 
                                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                        <i class="fas fa-save mr-2"></i>Cambiar Contraseña
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="border rounded-lg p-6 bg-red-50">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold text-lg text-red-700">Cerrar Sesión en Todos los Dispositivos</h3>
                                <i class="fas fa-sign-out-alt text-red-500"></i>
                            </div>
                            <p class="text-gray-700 mb-4">Esto cerrará tu sesión en todos los dispositivos donde hayas iniciado sesión, excepto en este.</p>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Cerrar en Todos los Dispositivos
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Settings Section -->
            <section id="settings" class="section-content hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-purple-700 mb-6">Configuración</h2>
                    
                    <div class="space-y-6">
                        <div class="border rounded-lg p-6">
                            <h3 class="font-semibold text-lg mb-4">Preferencias de Notificación</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">Correos Promocionales</p>
                                        <p class="text-sm text-gray-600">Recibe ofertas y promociones especiales</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">Notificaciones de Estado de Pedidos</p>
                                        <p class="text-sm text-gray-600">Recibe actualizaciones sobre tus pedidos</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">Notificaciones por SMS</p>
                                        <p class="text-sm text-gray-600">Recibe notificaciones importantes por mensaje de texto</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg p-6">
                            <h3 class="font-semibold text-lg mb-4">Preferencias de Privacidad</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">Perfil Público</p>
                                        <p class="text-sm text-gray-600">Permite que otros usuarios vean tu perfil</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">Compartir datos para análisis</p>
                                        <p class="text-sm text-gray-600">Ayúdanos a mejorar nuestros servicios</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                <i class="fas fa-save mr-2"></i>Guardar Configuración
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-purple-700 text-white mt-10 py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold">Mi Dashboard</h3>
                    <p class="text-xs text-purple-200">© 2023 Todos los derechos reservados</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-green-400 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-green-400 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-green-400 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-green-400 transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-purple-600 text-center md:text-left">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <a href="#" class="text-sm hover:text-green-400 transition mx-2">Términos y Condiciones</a>
                        <a href="#" class="text-sm hover:text-green-400 transition mx-2">Política de Privacidad</a>
                        <a href="#" class="text-sm hover:text-green-400 transition mx-2">Centro de Ayuda</a>
                    </div>
                    <div>
                        <p class="text-sm">
                            <i class="fas fa-headset mr-2"></i>
                            Soporte al Cliente: <a href="mailto:soporte@midashboard.com" class="hover:text-green-400 transition">soporte@midashboard.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Account Deletion Modal -->
    <div id="deletionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-red-600">Cerrar tu cuenta</h3>
                <button onclick="hideDeletionModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-gray-700 mb-4">¿Estás seguro que deseas cerrar tu cuenta? Esta acción no se puede deshacer.</p>
                <p class="text-sm text-gray-500">Todos tus datos personales serán eliminados permanentemente de nuestros sistemas.</p>
            </div>
            <div class="flex justify-end space-x-4">
                <button onclick="hideDeletionModal()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md transition">
                    Cancelar
                </button>
                <button onclick="deleteAccount()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                    <i class="fas fa-user-times mr-2"></i>Cerrar Cuenta
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mostrar sección seleccionada
        function showSection(sectionId) {
            // Ocultar todas las secciones
            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Mostrar la sección seleccionada
            document.getElementById(sectionId).classList.remove('hidden');
        }

        // Alternar menú lateral
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('sidebar-collapsed');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                mainContent.classList.add('md:ml-0');
                mainContent.classList.add('ml-0');
            } else {
                mainContent.classList.remove('md:ml-0');
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('md:ml-64');
            }
        });

        // Habilitar edición de perfil
        function enableEdit() {
            document.getElementById('name').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('phone').disabled = false;
            document.getElementById('changePhotoBtn').classList.remove('hidden');
            document.getElementById('formButtons').classList.remove('hidden');
        }

        // Cancelar edición de perfil
        function cancelEdit() {
            document.getElementById('name').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('phone').disabled = true;
            document.getElementById('changePhotoBtn').classList.add('hidden');
            document.getElementById('formButtons').classList.add('hidden');
            
            // Restaurar valores originales (simulado)
            document.getElementById('name').value = "Claudia Pérez";
            document.getElementById('email').value = "claudia.perez@example.com";
            document.getElementById('phone').value = "+1 234 567 890";
        }

        // Enviar formulario de perfil
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Los cambios se han guardado correctamente');
            cancelEdit();
        });

        // Mostrar/ocultar formulario de tarjeta
        function showAddCardForm() {
            document.getElementById('addCardForm').classList.remove('hidden');
        }

        function hideAddCardForm() {
            document.getElementById('addCardForm').classList.add('hidden');
        }

        // Mostrar modal de eliminación de cuenta
        function confirmAccountDeletion() {
            document.getElementById('deletionModal').classList.remove('hidden');
        }

        function hideDeletionModal() {
            document.getElementById('deletionModal').classList.add('hidden');
        }

        // Eliminar cuenta (simulado)
        function deleteAccount() {
            alert('Tu cuenta ha sido eliminada. Serás redirigido a la página principal.');
            hideDeletionModal();
            // En una aplicación real, aquí iría la llamada a la API para eliminar la cuenta
        }

        // Mostrar la sección de perfil por defecto al cargar
        document.addEventListener('DOMContentLoaded', function() {
            showSection('profile');
            
            // Para pantallas pequeñas, iniciar con el menú cerrado
            if (window.innerWidth < 768) {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.add('ml-0');
            }
        });
    </script>
</body>
</html>