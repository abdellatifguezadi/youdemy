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
            <a href="/admin/categories" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-folder w-6"></i>
                <span class="ml-3">Categories</span>
            </a>
            <a href="/admin/tags" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
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
                <h1 class="text-2xl font-bold text-gray-800">Tags Management</h1>
                <div class="flex gap-4">
                    <button onclick="document.getElementById('bulkInsertModal').classList.remove('hidden')" class="px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600 transition-colors">
                        <i class="fas fa-upload mr-2"></i>Bulk Insert
                    </button>
                </div>
            </div>


            <div id="bulkInsertModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <div class="flex justify-between items-center pb-3">
                            <h3 class="text-lg font-medium text-gray-900">Bulk Insert Tags</h3>
                            <button onclick="document.getElementById('bulkInsertModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="mt-2 px-7 py-3">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Enter Multiple Tags (comma-separated)
                                </label>
                                <textarea 
                                    placeholder="Example: JavaScript, React, Node.js, Python, UI Design"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-violet-500 h-24"
                                ></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end gap-4 px-7 py-3">
                            <button onclick="document.getElementById('bulkInsertModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600 transition-colors">
                                Insert Tags
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search tags..." 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <div>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">Sort by usage</option>
                            <option value="most_used">Most Used</option>
                            <option value="least_used">Least Used</option>
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tags Grid -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($tags as $tag): ?>
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-3 py-1 bg-violet-100 text-violet-800 rounded-full text-sm font-medium">
                                <?= htmlspecialchars($tag['name']) ?>
                            </span>
                            <div class="flex items-center space-x-2">
                                <button class="text-violet-600 hover:text-violet-900">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="mr-4"><i class="fas fa-book mr-1"></i><?= $tag['course_count'] ?> courses</span>
                            <span><i class="fas fa-clock mr-1"></i>Added in <?= date('M d, Y', strtotime($tag['created_at'])) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="z-20">
    <?php include '../app/views/partials/modals/footer.php'; ?>
</div> 