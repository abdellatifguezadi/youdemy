<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="lg:hidden fixed top-[1.35rem] left-4 z-50 bg-violet-600 text-white p-2 rounded-lg">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-16 z-40 transition-transform duration-300 lg:translate-x-0 -translate-x-full">
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

    <!-- Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 lg:ml-64">
        <div class="p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Courses Management</h1>
            </div>

            <div class="bg-white rounded-xl shadow-lg">
                <div class="relative" style="height: 500px;">
                    <div style="position: absolute; inset: 0; overflow-x: auto;">
                        <table style="min-width: 800px;" class="w-full">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Taux d'engagement
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <?php 
                                            $engagementRate = $course->getEngagementRate();
                                            $colorClass = $engagementRate >= 70 ? 'text-green-600' :
                                                        ($engagementRate >= 40 ? 'text-yellow-600' : 'text-red-600');
                                            ?>
                                            <span class="<?= $colorClass ?> font-semibold">
                                                <?= $engagementRate ?>%
                                            </span>
                                            <span class="ml-2 text-gray-500 text-sm">
                                                approuvés
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="/admin/courses/delete/<?= $course->getId() ?>" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                                                <i class="fas fa-trash-alt"></i>
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
    </div>
</div>

<!-- JavaScript for sidebar toggle -->
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const mobileMenuButton = document.getElementById('mobile-menu-button');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
    }

    mobileMenuButton.addEventListener('click', toggleSidebar);
    sidebarOverlay.addEventListener('click', toggleSidebar);
</script>

<div class="z-20">
    <?php include '../app/views/partials/modals/footer.php'; ?>
</div> 
