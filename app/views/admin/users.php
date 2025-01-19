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
            <a href="/admin/courses" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors">
                <i class="fas fa-book w-6"></i>
                <span class="ml-3">Courses</span>
            </a>
            <a href="/admin/users" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
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
                <h1 class="text-2xl font-bold text-gray-800">Users Management</h1>

            </div>

            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <div class="relative">
                            <input type="text" placeholder="Search users..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Pending</option>
                            <option value="2">Suspended</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg">
                <div class="relative" style="height: 500px;">
                    <div style="position: absolute; inset: 0; overflow-x: auto;">
                        <table style="min-width: 800px;" class="w-full">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($AllUsers as $user) : ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=random"
                                                    alt="<?= htmlspecialchars($user['name']) ?>">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= $user['name'] ?></div>
                                                    <div class="text-sm text-gray-500"><?= $user['email'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?php 
                                                    switch($user['role_name']) {
                                                        case 'teacher':
                                                            echo 'bg-violet-100 text-violet-800';
                                                            break;
                                                        case 'student':
                                                            echo 'bg-blue-100 text-blue-800';
                                                            break;
                                                        default:
                                                            echo 'bg-gray-100 text-gray-800';
                                                    }
                                                ?>">
                                                <?= htmlspecialchars($user['role_name']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?php 
                                                    if ((int)$user['is_active'] === 2) {
                                                        echo 'bg-yellow-100 text-red-800';
                                                    } elseif ((int)$user['is_active'] === 1) {
                                                        echo 'bg-green-100 text-green-800';
                                                    } else {
                                                        echo 'bg-orange-100 text-orange-800';
                                                    }
                                                ?>">
                                                <?php 
                                                    if ((int)$user['is_active'] === 2) {
                                                        echo 'Suspended';
                                                    } elseif ((int)$user['is_active'] === 1) {
                                                        echo 'Active';
                                                    } else {
                                                        echo 'Pending';
                                                    }
                                                ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                             <?= date('M d, Y', strtotime($user['created_at'])) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <?php if ((int)$user['is_active'] === 2): ?>
                                                <form action="/admin/users/activate/<?= $user['id'] ?>" method="POST" class="inline mr-2">
                                                    <button type="submit" class="px-3 py-1 bg-green-100 text-green-600 rounded-md hover:bg-green-200">
                                                        <i class="fas fa-check"></i>
                                                        <span class="ml-1">Activate</span>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form action="/admin/users/suspend/<?= $user['id'] ?>" method="POST" class="inline mr-2">
                                                    <button type="submit" class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-md hover:bg-yellow-200">
                                                        <i class="fas fa-ban"></i>
                                                        <span class="ml-1">Suspend</span>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <form action="/admin/users/delete/<?= $user['id'] ?>" method="POST" class="inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200">
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