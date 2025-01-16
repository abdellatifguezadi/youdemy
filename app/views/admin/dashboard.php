<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">
    <!-- Sidebar -->
    <div class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-16 z-10">
        <nav class="py-6">
            <a href="/admin/dashboard" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
                <i class="fas fa-home w-6"></i>
                <span class="ml-3">Overview</span>
            </a>
            <a href="/admin/pending-teachers" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-user-clock w-6"></i>
                <span class="ml-3">Pending Teachers</span>
            </a>
            <a href="/admin/courses" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-book w-6"></i>
                <span class="ml-3">Courses</span>
            </a>
            <a href="/admin/users" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-users w-6"></i>
                <span class="ml-3">Users</span>
            </a>
            <a href="/admin/categories" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-folder w-6"></i>
                <span class="ml-3">Categories</span>
            </a>
            <a href="/admin/tags" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-tags w-6"></i>
                <span class="ml-3">Tags</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-8 pb-16">
        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-blue-100 text-sm">Total Users</p>
                        <p class="text-3xl font-bold mt-1">2,450</p>
                    </div>
                    <div class="p-2 bg-blue-400 bg-opacity-30 rounded-lg">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Courses -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-emerald-100 text-sm">Total Courses</p>
                        <p class="text-3xl font-bold mt-1">150</p>
                    </div>
                    <div class="p-2 bg-emerald-400 bg-opacity-30 rounded-lg">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Active Teachers -->
            <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-violet-100 text-sm">Active Teachers</p>
                        <p class="text-3xl font-bold mt-1">45</p>
                    </div>
                    <div class="p-2 bg-violet-400 bg-opacity-30 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Teachers -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-amber-100 text-sm">Pending Teachers</p>
                        <p class="text-3xl font-bold mt-1">8</p>
                    </div>
                    <div class="p-2 bg-amber-400 bg-opacity-30 rounded-lg">
                        <i class="fas fa-user-clock text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column (2 cols wide) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Most Popular Course -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Most Popular Course</h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="https://via.placeholder.com/150" alt="Course thumbnail" 
                                 class="w-24 h-24 rounded-lg object-cover shadow-lg">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">Formation Complete JavaScript</h4>
                                <div class="flex items-center mt-2">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe" class="w-6 h-6 rounded-full mr-2">
                                    <span class="text-gray-600">John Doe</span>
                                </div>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-users mr-1"></i>1,234 étudiants
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Distribution -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Category Distribution</h3>
                    <div class="space-y-4">
                        <!-- Web Development -->
                        <div class="bg-gradient-to-r from-sky-100 to-blue-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-700 font-semibold">Web Development</span>
                                <span class="text-blue-600 font-bold">45%</span>
                            </div>
                            <div class="w-full bg-blue-100 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">68 cours</p>
                        </div>

                        <!-- Design -->
                        <div class="bg-gradient-to-r from-fuchsia-100 to-purple-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-700 font-semibold">Design</span>
                                <span class="text-purple-600 font-bold">30%</span>
                            </div>
                            <div class="w-full bg-purple-100 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: 30%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">45 cours</p>
                        </div>

                        <!-- Marketing -->
                        <div class="bg-gradient-to-r from-teal-100 to-emerald-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-700 font-semibold">Marketing</span>
                                <span class="text-emerald-600 font-bold">25%</span>
                            </div>
                            <div class="w-full bg-emerald-100 rounded-full h-2">
                                <div class="bg-emerald-600 h-2 rounded-full" style="width: 25%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">37 cours</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Top 3 Teachers -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Top 3 Teachers</h3>
                    <div class="space-y-6">
                        <!-- First Place -->
                        <div class="flex items-center space-x-4 bg-gradient-to-r from-amber-100 to-yellow-200 p-4 rounded-lg">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson" class="w-16 h-16 rounded-full">
                                <span class="absolute -top-2 -right-2 bg-yellow-500 text-white w-6 h-6 rounded-full flex items-center justify-center font-bold text-sm">1</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Sarah Johnson</h4>
                                <p class="text-sm text-gray-600">12 cours • 845 étudiants</p>
                            </div>
                        </div>

                        <!-- Second Place -->
                        <div class="flex items-center space-x-4 bg-gradient-to-r from-slate-100 to-gray-200 p-4 rounded-lg">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Mike+Smith" class="w-16 h-16 rounded-full">
                                <span class="absolute -top-2 -right-2 bg-gray-500 text-white w-6 h-6 rounded-full flex items-center justify-center font-bold text-sm">2</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Mike Smith</h4>
                                <p class="text-sm text-gray-600">8 cours • 562 étudiants</p>
                            </div>
                        </div>

                        <!-- Third Place -->
                        <div class="flex items-center space-x-4 bg-gradient-to-r from-orange-100 to-red-200 p-4 rounded-lg">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Emma+Davis" class="w-16 h-16 rounded-full">
                                <span class="absolute -top-2 -right-2 bg-orange-500 text-white w-6 h-6 rounded-full flex items-center justify-center font-bold text-sm">3</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Emma Davis</h4>
                                <p class="text-sm text-gray-600">6 cours • 428 étudiants</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-plus text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nouveau professeur inscrit</p>
                                <p class="text-sm font-medium text-gray-800">Ahmed Hassan</p>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 2h</span>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <i class="fas fa-graduation-cap text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nouveau cours publié</p>
                                <p class="text-sm font-medium text-gray-800">Introduction à Python</p>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 5h</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="z-20">
    <?php include '../app/views/partials/modals/footer.php'; ?>
</div> 