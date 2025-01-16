<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">
    <!-- Sidebar -->
    <div class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-16 z-10">
        <nav class="py-6">
            <a href="/admin/dashboard" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
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
            <a href="/admin/categories" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
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
    <div class="flex-1 ml-64">
        <div class="p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Categories Management</h1>
                <div class="flex gap-4">
                    <button class="px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Category
                    </button>
                </div>
            </div>

            <!-- Search -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="relative">
                    <input type="text" placeholder="Search categories..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Courses</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($category as $category) : ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-violet-100 rounded-lg">
                                            <i class="fas fa-code text-violet-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"> <?= htmlspecialchars($category['name']) ?> </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500"> <?= htmlspecialchars($category['description']) ?> </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-violet-100 text-violet-800">
                                        <?= $category['course_count'] ?> Courses
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-violet-600 hover:text-violet-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="z-20">
    <?php include '../app/views/partials/modals/footer.php'; ?>
</div>