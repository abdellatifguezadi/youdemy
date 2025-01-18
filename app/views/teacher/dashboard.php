<?php include '../app/views/partials/modals/header.php'; ?>

<div class="flex min-h-screen bg-gray-100 pt-16">
    <div class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-violet-800 to-violet-600 text-white shadow-lg mt-16 z-10">
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

    <div class="flex-1 ml-64">
        <div class="max-w-7xl mx-auto p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Welcome Back, Teacher!</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-emerald-100 text-sm">Total Courses</p>
                            <p class="text-3xl font-bold mt-1">24</p>
                        </div>
                        <div class="p-2 bg-emerald-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 text-sm">Total Students</p>
                            <p class="text-3xl font-bold mt-1">1,245</p>
                        </div>
                        <div class="p-2 bg-blue-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-amber-100 text-sm">Pending Enrollments</p>
                            <p class="text-3xl font-bold mt-1">18</p>
                        </div>
                        <div class="p-2 bg-amber-400 bg-opacity-30 rounded-lg">
                            <i class="fas fa-user-clock text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                <i class="fas fa-user-graduate text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">New student enrolled in "Web Development"</p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="bg-green-100 rounded-full p-2 mr-4">
                                <i class="fas fa-comment text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">New review on "JavaScript Basics"</p>
                                <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="bg-violet-100 rounded-full p-2 mr-4">
                                <i class="fas fa-video text-violet-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">New course published "React Fundamentals"</p>
                                <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Popular Courses</h2>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <img src="https://via.placeholder.com/40" alt="Course" class="rounded-lg mr-4 h-10 w-10 object-cover">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Web Development Bootcamp</h3>
                                <p class="text-xs text-gray-500 mt-1">1,234 students</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <img src="https://via.placeholder.com/40" alt="Course" class="rounded-lg mr-4 h-10 w-10 object-cover">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">JavaScript Mastery</h3>
                                <p class="text-xs text-gray-500 mt-1">956 students</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <img src="https://via.placeholder.com/40" alt="Course" class="rounded-lg mr-4 h-10 w-10 object-cover">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">React for Beginners</h3>
                                <p class="text-xs text-gray-500 mt-1">784 students</p>
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
 