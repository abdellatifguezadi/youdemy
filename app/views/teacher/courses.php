<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">

    <div class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-16 z-10">
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

    <div class="flex-1 ml-64">
        <div class="p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">My Courses</h1>
                <button class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
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
</div>

<div class="z-20">
    <?php include '../app/views/partials/modals/footer.php'; ?>
</div> 
