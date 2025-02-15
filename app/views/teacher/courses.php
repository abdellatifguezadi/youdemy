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
            <a href="/teacher/courses" class="flex items-center px-6 py-3 hover:bg-white/10 transition-colors bg-white/10">
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
            <?php if (isset($_SESSION['message'])): ?>
                <div class="mb-4 p-4 rounded-lg <?= $_SESSION['message']['type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                    <?= $_SESSION['message']['text'] ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">My Courses</h1>
                <button onclick="toggleAddCourseModal()" class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="fas fa-plus"></i>
                    <span>Add New Course</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($courses as $course) : ?>
                    <div class="bg-white rounded-xl shadow-lg">
                        <div class="relative">
                            <img src="<?= htmlspecialchars($course->getPhotoUrl()) ?>" 
                                 alt="<?= htmlspecialchars($course->getTitle()) ?>" 
                                 class="w-full h-48 object-cover rounded-t-xl">

                            <div class="absolute top-2 right-2 flex gap-2">
                                <button onclick="openEditModal(<?= htmlspecialchars(json_encode([
                                    'id' => $course->getId(),
                                    'title' => $course->getTitle(),
                                    'description' => $course->getDescription(),
                                    'photo_url' => $course->getPhotoUrl(),
                                    'category_id' => $course->getCategoryId(),
                                    'type' => $course->getType() === 'Cours vidéo' ? 'video' : 'document',
                                    'content' => $course->getContent(),
                                    'tags' => array_map(function($tag) { return $tag['id']; }, $course->getTags())
                                ])) ?>)" class="bg-violet-600 hover:bg-violet-700 text-white p-2 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/teacher/courses/delete/<?= $course->getId() ?>" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                <?= htmlspecialchars($course->getTitle()) ?>
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                                <?= htmlspecialchars($course->getDescription()) ?>
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-1 px-3 py-1 <?= $course->getType() === 'Cours vidéo' ? 'bg-blue-50 text-blue-700' : 'bg-violet-50 text-violet-700' ?> rounded-full text-sm">
                                    <i class="fas <?= $course->getType() === 'Cours vidéo' ? 'fa-video' : 'fa-file-alt' ?>"></i>
                                    <span><?= $course->getType() ?></span>
                                </span>

                                <div class="flex items-center gap-2 text-gray-500">
                                    <i class="fas fa-users"></i>
                                    <span class="text-sm"><?= $course->getStudentCount() ?> students</span>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                    <i class="fas fa-folder mr-1"></i>
                                    <?= htmlspecialchars($course->getCategoryName()) ?>
                                </span>
                            </div>

                            <?php if (!empty($course->getTags())) : ?>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <?php foreach ($course->getTags() as $tag) : ?>
                                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">
                                            <?= htmlspecialchars($tag['name']) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($courses)) : ?>
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">You haven't created any courses yet.</p>
                        <button onclick="toggleAddCourseModal()" 
                                class="mt-4 bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-colors">
                            <i class="fas fa-plus"></i>
                            <span>Create Your First Course</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="addCourseModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="toggleAddCourseModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl bg-white rounded-xl shadow-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Add New Course</h3>
                <button onclick="toggleAddCourseModal()" type="button" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="/teacher/courses" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                        <input type="text" name="title" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter course title">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Type</label>
                        <select name="type" id="courseType" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            onchange="toggleContentField()">
                            <option value="">Select Type</option>
                            <option value="video">Video Course</option>
                            <option value="document">Document Course</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Image URL</label>
                        <input type="url" name="photo_url" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter image URL">
                    </div>
                </div>

                <div id="courseContentField" class="hidden">
                    <div id="videoField" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                        <input type="url" name="video"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter video URL">
                    </div>

                    <div id="documentField" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Document URL</label>
                        <input type="url" name="document"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter document URL">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" required rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                        placeholder="Enter course description"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-3 border border-gray-300 rounded-lg max-h-[200px] overflow-y-auto">
                        <?php foreach ($tags as $tag): ?>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" 
                                       class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                                <span class="text-sm text-gray-700"><?= htmlspecialchars($tag['name']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleAddCourseModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                        Add Course
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editCourseModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="toggleEditModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl bg-white rounded-xl shadow-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Edit Course</h3>
                <button onclick="toggleEditModal()" type="button" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="/teacher/courses/update" method="POST" class="space-y-6">
                <input type="hidden" name="course_id" id="edit_course_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                        <input type="text" name="title" id="edit_title" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter course title">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category_id" id="edit_category_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Type</label>
                        <select name="type" id="edit_type" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            onchange="toggleEditContentField()">
                            <option value="">Select Type</option>
                            <option value="video">Video Course</option>
                            <option value="document">Document Course</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Course Image URL</label>
                        <input type="url" name="photo_url" id="edit_photo_url" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter image URL">
                    </div>
                </div>

                <div id="editCourseContentField">
                    <div id="editVideoField" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                        <input type="url" name="video" id="edit_video"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter video URL">
                    </div>

                    <div id="editDocumentField" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Document URL</label>
                        <input type="url" name="document" id="edit_document"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter document URL">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="edit_description" required rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                        placeholder="Enter course description"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-3 border border-gray-300 rounded-lg max-h-[200px] overflow-y-auto">
                        <?php foreach ($tags as $tag): ?>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" 
                                       class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500 edit-tag-checkbox">
                                <span class="text-sm text-gray-700"><?= htmlspecialchars($tag['name']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleEditModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                        Update Course
                    </button>
                </div>
            </form>
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

    function toggleAddCourseModal() {
        const modal = document.getElementById('addCourseModal');
        modal.classList.toggle('hidden');
    }

    function toggleContentField() {
        const courseType = document.getElementById('courseType').value;
        const contentField = document.getElementById('courseContentField');
        const videoField = document.getElementById('videoField');
        const documentField = document.getElementById('documentField');
        const videoInput = videoField.querySelector('input');
        const documentInput = documentField.querySelector('input');

        contentField.classList.remove('hidden');
        videoField.classList.add('hidden');
        documentField.classList.add('hidden');
        videoInput.removeAttribute('required');
        documentInput.removeAttribute('required');

        if (courseType === 'video') {
            videoField.classList.remove('hidden');
            videoInput.setAttribute('required', 'required');
        } else if (courseType === 'document') {
            documentField.classList.remove('hidden');
            documentInput.setAttribute('required', 'required');
        }
    }

    function toggleEditModal() {
        const modal = document.getElementById('editCourseModal');
        modal.classList.toggle('hidden');
    }

    function toggleEditContentField() {
        const courseType = document.getElementById('edit_type').value;
        const videoField = document.getElementById('editVideoField');
        const documentField = document.getElementById('editDocumentField');
        const videoInput = videoField.querySelector('input');
        const documentInput = documentField.querySelector('input');

        videoField.classList.add('hidden');
        documentField.classList.add('hidden');
        videoInput.removeAttribute('required');
        documentInput.removeAttribute('required');

        if (courseType === 'video') {
            videoField.classList.remove('hidden');
            videoInput.setAttribute('required', 'required');
        } else if (courseType === 'document') {
            documentField.classList.remove('hidden');
            documentInput.setAttribute('required', 'required');
        }
    }

    function openEditModal(course) {
        document.getElementById('edit_course_id').value = course.id;
        document.getElementById('edit_title').value = course.title;
        document.getElementById('edit_description').value = course.description;
        document.getElementById('edit_photo_url').value = course.photo_url;
        document.getElementById('edit_category_id').value = course.category_id;
        document.getElementById('edit_type').value = course.type;
        
        if (course.type === 'video') {
            document.getElementById('edit_video').value = course.content;
        } else {
            document.getElementById('edit_document').value = course.content;
        }
        
        // Reset all checkboxes
        document.querySelectorAll('.edit-tag-checkbox').forEach(checkbox => {
            checkbox.checked = course.tags.includes(parseInt(checkbox.value));
        });
        
        toggleEditContentField();
        toggleEditModal();
    }
</script>

<?php include '../app/views/partials/modals/footer.php'; ?>