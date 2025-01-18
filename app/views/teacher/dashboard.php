<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">
    <button id="mobile-menu-button" class="lg:hidden fixed top-[1.35rem] left-4 z-50 bg-violet-600 text-white p-2 rounded-lg">
        <i class="fas fa-bars"></i>
    </button>

    <div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-14 z-40 transition-transform duration-300 lg:translate-x-0 -translate-x-full">
        <nav class="py-6">
            <a href="/teacher/dashboard" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
                <i class="fas fa-home w-6"></i>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="/teacher/courses" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-book w-6"></i>
                <span class="ml-3">My Courses</span>
            </a>
            <a href="/teacher/students" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-users w-6"></i>
                <span class="ml-3">My Students</span>
            </a>
        </nav>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden"></div>

    <div class="flex-1 lg:ml-64">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 text-sm">Total Courses</p>
                            <p class="text-3xl font-bold mt-1"><?= $totalCourses ?></p>
                        </div>
                        <div class="p-2 bg-blue-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-emerald-100 text-sm">Total Students</p>
                            <p class="text-3xl font-bold mt-1"><?= $totalStudents ?></p>
                        </div>
                        <div class="p-2 bg-emerald-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-violet-100 text-sm">Pending Enrollments</p>
                            <p class="text-3xl font-bold mt-1"><?= $pendingEnrollments ?></p>
                        </div>
                        <div class="p-2 bg-violet-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-user-clock text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-amber-100 text-sm">Course Types</p>
                            <div class="flex gap-4 mt-1">
                                <div>
                                    <i class="fas fa-video text-amber-100"></i>
                                    <span class="text-xl font-bold"><?= $videoCourses ?></span>
                                </div>
                                <div>
                                    <i class="fas fa-file-alt text-amber-100"></i>
                                    <span class="text-xl font-bold"><?= $documentCourses ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 bg-amber-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-film text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Popular Courses</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($popularCourses as $course): ?>
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <img src="<?= htmlspecialchars($course->getPhotoUrl()) ?>" 
                                 alt="<?= htmlspecialchars($course->getTitle()) ?>" 
                                 class="w-16 h-16 rounded object-cover">
                            <div class="ml-4 flex-1">
                                <h3 class="font-medium text-gray-900 line-clamp-1"><?= htmlspecialchars($course->getTitle()) ?></h3>
                                <div class="flex items-center mt-1 text-sm text-gray-500">
                                    <i class="fas fa-users mr-2"></i>
                                    <span><?= $course->getStudentCount() ?> students</span>
                                </div>
                                <span class="inline-flex items-center mt-2 px-2 py-0.5 rounded text-xs font-medium
                                    <?= $course->getType() === 'Cours vidéo' ? 'bg-blue-100 text-blue-700' : 'bg-violet-100 text-violet-700' ?>">
                                    <i class="fas <?= $course->getType() === 'Cours vidéo' ? 'fa-video' : 'fa-file-alt' ?> mr-1"></i>
                                    <?= $course->getType() ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (empty($popularCourses)): ?>
                        <div class="col-span-full text-center py-4 text-gray-500">
                            No courses available yet
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Courses</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-gray-200">
                                <th class="pb-3 font-medium text-gray-600">Title</th>
                                <th class="pb-3 font-medium text-gray-600">Type</th>
                                <th class="pb-3 font-medium text-gray-600">Students</th>
                                <th class="pb-3 font-medium text-gray-600">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentCourses as $course): ?>
                            <tr class="border-b border-gray-100">
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <img src="<?= htmlspecialchars($course->getPhotoUrl()) ?>" 
                                             alt="<?= htmlspecialchars($course->getTitle()) ?>" 
                                             class="w-10 h-10 rounded object-cover mr-3">
                                        <span class="font-medium text-gray-900"><?= htmlspecialchars($course->getTitle()) ?></span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        <?= $course->getType() === 'Cours vidéo' ? 'bg-blue-100 text-blue-700' : 'bg-violet-100 text-violet-700' ?>">
                                        <i class="fas <?= $course->getType() === 'Cours vidéo' ? 'fa-video' : 'fa-file-alt' ?> mr-1"></i>
                                        <?= $course->getType() ?>
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="text-gray-700"><?= $course->getStudentCount() ?></span>
                                </td>
                                <td class="py-3">
                                    <span class="text-gray-500"><?= date('M d, Y', strtotime($course->getCreatedAt())) ?></span>
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

<?php include '../app/views/partials/modals/footer.php'; ?>