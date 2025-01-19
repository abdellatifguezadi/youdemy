<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">

    <button id="mobile-menu-button" class="lg:hidden fixed top-[1.35rem] left-4 z-50 bg-violet-600 text-white p-2 rounded-lg">
        <i class="fas fa-bars"></i>
    </button>

    <div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-14 z-40 transition-transform duration-300 lg:translate-x-0 -translate-x-full">
        <nav class="py-6">
            <a href="/teacher/dashboard" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-home w-6"></i>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="/teacher/courses" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-book w-6"></i>
                <span class="ml-3">My Courses</span>
            </a>
            <a href="/teacher/students" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
                <i class="fas fa-users w-6"></i>
                <span class="ml-3">My Students</span>
            </a>
        </nav>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden"></div>

    <div class="flex-1 lg:ml-64">
        <div class="p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">My Students</h1>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="mb-4 p-4 rounded-lg <?= $_SESSION['message']['type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                    <?= $_SESSION['message']['text'] ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <?php if (empty($courseStudents)): ?>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">You don't have any enrolled students yet.</p>
                </div>
            <?php else: ?>
                <?php foreach ($courseStudents as $course): ?>
                    <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                        <div class="bg-violet-600 text-white px-6 py-4">
                            <h2 class="text-lg font-semibold">
                                <i class="fas fa-book mr-2"></i>
                                <?= htmlspecialchars($course['title']) ?>
                                <span class="text-sm ml-2">(<?= count($course['students']) ?> students)</span>
                            </h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollment Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($course['students'] as $student): ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <img class="h-8 w-8 rounded-full" 
                                                         src="https://ui-avatars.com/api/?name=<?= urlencode($student['name']) ?>&background=6D28D9&color=fff" 
                                                         alt="<?= htmlspecialchars($student['name']) ?>">
                                                    <span class="ml-3 text-sm font-medium text-gray-900">
                                                        <?= htmlspecialchars($student['name']) ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?= htmlspecialchars($student['email']) ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <?= date('M d, Y', strtotime($student['enrollment_date'])) ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="/teacher/students/update-status/<?= $student['id'] ?>" method="POST" class="inline">
                                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                                    <select name="status" onchange="this.form.submit()" 
                                                            class="appearance-none bg-none cursor-pointer px-2 py-1 text-xs font-semibold rounded-full border-0 focus:ring-2 focus:ring-violet-500 [&::-ms-expand]:hidden
                                                            <?php
                                                            switch($student['status']) {
                                                                case 'approved':
                                                                    echo 'bg-green-100 text-green-800';
                                                                    break;
                                                                case 'pending':
                                                                    echo 'bg-yellow-100 text-yellow-800';
                                                                    break;
                                                                case 'rejected':
                                                                    echo 'bg-red-100 text-red-800';
                                                                    break;
                                                            }
                                                            ?>">
                                                        <option value="pending" <?= $student['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="approved" <?= $student['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                                        <option value="rejected" <?= $student['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="/teacher/students/delete/<?= $student['id'] ?>" method="POST" 
                                                      class="inline" 
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant de ce cours ?');">
                                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-800 transition-colors">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
