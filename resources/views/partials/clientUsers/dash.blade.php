 <!-- Contenido -->
            <main id="adminApp" class="p-6">
                <!-- User Profile Panel -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Profile Picture -->
                        <div class="flex flex-col items-center">
                            <img src="http://127.0.0.1:8000/storage/images/favicon.png" alt="Profile" class="w-32 h-32 rounded-full border-4 border-mktPurple">
                            <button class="mt-4 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-md text-sm">
                                <i class="fas fa-camera mr-2"></i> Change Photo
                            </button>
                        </div>
                        
                        <!-- User Details -->
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Profile Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" value="German Padilla" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" value="germanr.padilla@gmail.com" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input type="tel" value="+1 555-1234" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                    <select class="w-full border border-gray-300 rounded-md px-3 py-2">
                                        <option selected>Admin</option>
                                        <option>Manager</option>
                                        <option>User</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="flex space-x-4 pt-4 border-t border-gray-200">
                                <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-md text-sm">
                                    <i class="fas fa-save mr-2"></i> Save Changes
                                </button>
                                <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-md text-sm">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>