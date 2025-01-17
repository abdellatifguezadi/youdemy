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

            <?php if (isset($_SESSION['message'])): ?>
                <div class="<?= $_SESSION['message_type'] === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700' ?> px-4 py-3 rounded relative mb-4 border" role="alert">
                    <span class="block sm:inline"><?= $_SESSION['message'] ?></span>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                    ?>
                </div>
            <?php endif; ?>

            <div id="bulkInsertModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Bulk Insert Tags</h3>
                        <form action="/admin/tags/bulk-insert" method="POST">
                            <div class="mb-4">
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Enter tags (comma separated)</label>
                                <textarea name="tags" id="tags" rows="4" class="shadow-sm focus:ring-violet-500 focus:border-violet-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="tag1, tag2, tag3"></textarea>
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="document.getElementById('bulkInsertModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600 transition-colors">Insert Tags</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Tag Modal -->
            <div id="updateTagModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Update Tag</h3>
                        <form action="/admin/tags/update" method="POST">
                            <input type="hidden" name="tag_id" id="update_tag_id">
                            <div class="mb-4">
                                <label for="update_tag_name" class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
                                <input type="text" name="name" id="update_tag_name" class="shadow-sm focus:ring-violet-500 focus:border-violet-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="document.getElementById('updateTagModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600 transition-colors">Update Tag</button>
                            </div>
                        </form>
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
                                    <button onclick="openUpdateModal(<?= $tag['id'] ?>, '<?= htmlspecialchars($tag['name']) ?>')" class="text-violet-600 hover:text-violet-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/admin/tags/delete/<?= $tag['id'] ?>" method="POST" class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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

<script>
function openUpdateModal(id, name) {
    document.getElementById('update_tag_id').value = id;
    document.getElementById('update_tag_name').value = name;
    document.getElementById('updateTagModal').classList.remove('hidden');
}
</script>

<div class="z-20">
    <?php include '../app/views/partials/modals/footer.php'; ?>
</div>