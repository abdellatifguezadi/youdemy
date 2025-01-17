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
            <a href="/admin/courses" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
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
    <div class="flex-1 ml-64">
        <div class="p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Courses Management</h1>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <div class="relative">
                            <input type="text" placeholder="Search courses..." 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">All Categories</option>
                            <option value="programming">Programming</option>
                            <option value="design">Design</option>
                            <option value="business">Business</option>
                            <option value="language">Language</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">All Types</option>
                            <option value="video">Video Course</option>
                            <option value="document">Document Course</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($courses as $course): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-lg object-cover" 
                                         src="<?= $course->getPhotoUrl() ?>" 
                                         alt="Course thumbnail">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $course->getTitle() ?></div>
                                        <div class="text-sm text-gray-500">Created on <?= date('M d, Y', strtotime($course->getCreatedAt())) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" 
                                         src="https://ui-avatars.com/api/?name=<?= urlencode($course->getName()) ?>" 
                                         alt="Teacher">
                                    <span class="ml-2 text-sm text-gray-900"><?= $course->getName() ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-violet-100 text-violet-800">
                                    <?= $course->getCategoryName() ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">
                                    <?php if($course->getType() === 'Cours vidéo'): ?>
                                        <i class="fas fa-video text-blue-500 mr-2"></i>Video
                                    <?php else: ?>
                                        <i class="fas fa-file-alt text-green-500 mr-2"></i>Document
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <i class="fas fa-users mr-2"></i><?= $course->getStudentCount() ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="/admin/courses/delete/<?= $course->getId() ?>" method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 bg-red-100 rounded-md hover:bg-red-200">
                                        <i class="fas fa-trash"></i>
                                        <span class="ml-1">Delete</span>
                                    </button>
                                </form>
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
