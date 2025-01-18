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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">My Courses</h1>
                <button onclick="toggleAddCourseModal()" class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="fas fa-plus"></i>
                    <span>Add New Course</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="bg-white rounded-xl shadow-lg">
                    <div class="relative">
                        <img src="https://via.placeholder.com/600x340" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-xl">
                        <span class="absolute top-2 left-2 px-3 py-1 text-sm text-emerald-700 bg-emerald-100 rounded-full">Published</span>
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button class="bg-violet-600 hover:bg-violet-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Web Development Bootcamp</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">Complete web development course from zero to hero. Learn HTML, CSS, JavaScript, and more.</p>

                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1 px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm">
                                <i class="fas fa-video"></i>
                                <span>Video Course</span>
                            </span>
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="fas fa-users"></i>
                                <span class="text-sm">1,234 students</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg">
                    <div class="relative">
                        <img src="https://via.placeholder.com/600x340" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-xl">
                        <span class="absolute top-2 left-2 px-3 py-1 text-sm text-amber-700 bg-amber-100 rounded-full">Draft</span>
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button class="bg-violet-600 hover:bg-violet-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">JavaScript Mastery</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">Master JavaScript with modern ES6+ features, async programming, and practical projects.</p>

                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1 px-3 py-1 bg-violet-50 text-violet-700 rounded-full text-sm">
                                <i class="fas fa-file-alt"></i>
                                <span>Document Course</span>
                            </span>
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="fas fa-users"></i>
                                <span class="text-sm">956 students</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg">
                    <div class="relative">
                        <img src="https://via.placeholder.com/600x340" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-xl">
                        <span class="absolute top-2 left-2 px-3 py-1 text-sm text-emerald-700 bg-emerald-100 rounded-full">Published</span>
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button class="bg-violet-600 hover:bg-violet-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">React for Beginners</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">Start your journey with React.js. Learn components, hooks, and build real applications.</p>

                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1 px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm">
                                <i class="fas fa-video"></i>
                                <span>Video Course</span>
                            </span>
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="fas fa-users"></i>
                                <span class="text-sm">784 students</span>
                            </div>
                        </div>
                    </div>
                </div>
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

            <form class="space-y-6">
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
                            <option value="1">Web Development</option>
                            <option value="2">Mobile Development</option>
                            <option value="3">Data Science</option>
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
                            placeholder="Enter image URL (e.g., https://example.com/image.jpg)">
                    </div>
                </div>

                <div id="courseContentField" class="hidden">
                    <div id="videoField" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                        <input type="url" name="video_url"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter video URL (e.g., YouTube, Vimeo)">
                    </div>

                    <div id="documentField" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Document URL</label>
                        <input type="url" name="document_url"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                            placeholder="Enter document URL (e.g., PDF, DOC)">
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
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="php" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">PHP</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="javascript" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">JavaScript</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="html" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">HTML</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="css" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">CSS</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="react" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">React</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="vue" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">Vue.js</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="angular" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">Angular</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="nodejs" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">Node.js</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="python" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">Python</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="java" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">Java</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="csharp" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">C#</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="ruby" class="w-4 h-4 text-violet-600 rounded focus:ring-violet-500">
                            <span class="text-sm text-gray-700">Ruby</span>
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Select all applicable tags for your course</p>
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
        const courseContentField = document.getElementById('courseContentField');
        const videoField = document.getElementById('videoField');
        const documentField = document.getElementById('documentField');

        courseContentField.classList.add('hidden');
        videoField.classList.add('hidden');
        documentField.classList.add('hidden');

        if (courseType === 'video') {
            courseContentField.classList.remove('hidden');
            videoField.classList.remove('hidden');
            videoField.querySelector('input').required = true;
            documentField.querySelector('input').required = false;
        } else if (courseType === 'document') {
            courseContentField.classList.remove('hidden');
            documentField.classList.remove('hidden');
            documentField.querySelector('input').required = true;
            videoField.querySelector('input').required = false;
        }
    }
</script>

<?php include '../app/views/partials/modals/footer.php'; ?>