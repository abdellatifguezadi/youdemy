<?php include 'modals/header.php'; ?>

<!-- Main Content -->
<main class="flex-grow mt-24">
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16 px-4">
        <div class="container mx-auto text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Welcome to YouDemy
            </h1>
            <p class="text-xl mb-8">
                Join our community of learners and teachers
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
                <a href="/register?role=student"
                    class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                    Become a Student
                </a>
                <a href="/register?role=teacher"
                    class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition">
                    Become a Teacher
                </a>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="/search" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex-1">
                        <input type="text"
                            name="keywords"
                            placeholder="Search courses..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="flex-1">
                        <select name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                            <option value="">All Categories</option>
                            <option value="programming">Programming</option>
                            <option value="design">Design</option>
                            <option value="business">Business</option>
                            <option value="languages">Languages</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Course Catalog</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition duration-300">
                <img src="https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=500&auto=format"
                    alt="PHP Introduction"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-sm text-blue-600 font-semibold">PROGRAMMING</span>
                    <h3 class="text-lg font-semibold mb-2">PHP Introduction</h3>
                    <p class="text-gray-600 text-sm mb-3">By John Doe</p>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">Backend</span>
                        <span class="px-2 py-1 bg-green-50 text-green-600 text-xs rounded-full">Database</span>
                        <span class="px-2 py-1 bg-purple-50 text-purple-600 text-xs rounded-full">Web Development</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-users mr-2"></i>150 students
                        </span>
                        <a href="/course/1" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition duration-300">
                <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500&auto=format"
                    alt="Advanced JavaScript"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-sm text-blue-600 font-semibold">WEB DEVELOPMENT</span>
                    <h3 class="text-lg font-semibold mb-2">Advanced JavaScript</h3>
                    <p class="text-gray-600 text-sm mb-3">By Jane Smith</p>
 
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-yellow-50 text-yellow-600 text-xs rounded-full">Frontend</span>
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">Web Development</span>
                        <span class="px-2 py-1 bg-purple-50 text-purple-600 text-xs rounded-full">Game Development</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-users mr-2"></i>120 students
                        </span>
                        <a href="/course/2" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition duration-300">
                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&auto=format"
                    alt="UI/UX Design"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-sm text-purple-600 font-semibold">DESIGN</span>
                    <h3 class="text-lg font-semibold mb-2">UI/UX Design</h3>
                    <p class="text-gray-600 text-sm mb-3">By Sarah Wilson</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-pink-50 text-pink-600 text-xs rounded-full">UI/UX Design</span>
                        <span class="px-2 py-1 bg-purple-50 text-purple-600 text-xs rounded-full">Graphic Design</span>
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">Frontend</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-users mr-2"></i>200 students
                        </span>
                        <a href="/course/3" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition duration-300">
                <img src="https://images.unsplash.com/photo-1533750516457-a7f992034fec?w=500&auto=format"
                    alt="Digital Marketing"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-sm text-yellow-600 font-semibold">MARKETING</span>
                    <h3 class="text-lg font-semibold mb-2">Digital Marketing</h3>
                    <p class="text-gray-600 text-sm mb-3">By Mike Johnson</p>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-orange-50 text-orange-600 text-xs rounded-full">Digital Marketing</span>
                        <span class="px-2 py-1 bg-yellow-50 text-yellow-600 text-xs rounded-full">SEO</span>
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full">Business Analytics</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-users mr-2"></i>180 students
                        </span>
                        <a href="/course/4" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-center gap-2 mt-8">
            <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition disabled:opacity-50">
                Previous
            </a>
            <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">1</a>
            <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">2</a>
            <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">3</a>
            <span class="px-4 py-2 border border-gray-300 rounded-md">...</span>
            <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">10</a>
            <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                Next
            </a>
        </div>
    </section>
</main>

<?php include 'modals/footer.php'; ?>