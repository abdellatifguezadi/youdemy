<?php include 'modals/header.php'; ?>

<!-- Main Content -->
<main class="flex-grow mt-24">
    <section class="relative h-[400px] overflow-hidden">
        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop" 
             alt="Education Background" 
             class="absolute top-0 left-0 w-full h-full object-cover">
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/40 to-blue-800/30"></div>
        
        <!-- Content -->
        <div class="container mx-auto text-center text-white relative z-10 h-full flex flex-col justify-center px-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-3 animate-fade-in">
                Welcome to YouDemy
            </h1>
            <p class="text-lg md:text-xl mb-6 animate-fade-in-delay">
                Join our community of learners and teachers
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto animate-fade-in-delay-2">
                <a href="/register?role=student"
                    class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                    Become a Student
                </a>
                <a href="/register?role=teacher"
                    class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition transform hover:scale-105">
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
            <?php foreach ($courses as $course): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition duration-300">
                <img src="<?= htmlspecialchars($course->getPhotoUrl() ?: 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=500&auto=format') ?>"
                     alt="<?= htmlspecialchars($course->getTitle()) ?>"
                     class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-sm text-blue-600 font-semibold">
                        <?= strtoupper($course->getCategoryName()) ?>
                    </span>
                    <h3 class="text-lg font-semibold mb-2">
                        <?= htmlspecialchars($course->getTitle()) ?>
                    </h3>
                    <p class="text-gray-600 text-sm mb-3">
                        <span class="mr-4">
                            <i class="fas fa-user mr-2"></i>
                            <?= htmlspecialchars($course->getName()) ?>
                        </span>
                    </p>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <?php foreach ($course->getTags() as $tag): ?>
                        <span class="px-2 py-1 bg-purple-50 text-purple-600 text-xs rounded-full">
                            <?= htmlspecialchars($tag['name']) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-users mr-2"></i><?= $course->getStudentCount() ?> students
                            </span>
                            <span class="<?= $course->getIconColor() ?> text-sm" title="<?= $course->getType() ?>">
                                <i class="fas <?= $course->getIcon() ?>"></i>
                            </span>
                        </div>
                        <a href="/course/<?= $course->getId() ?>" 
                           class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center gap-2 mt-8">
            <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>" 
               class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                Previous
            </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= min($totalPages, 3); $i++): ?>
            <a href="?page=<?= $i ?>" 
               class="px-4 py-2 <?= $i === $currentPage ? 'bg-blue-500 text-white' : 'bg-white border border-gray-300' ?> rounded-md hover:bg-<?= $i === $currentPage ? 'blue-600' : 'gray-50' ?> transition">
                <?= $i ?>
            </a>
            <?php endfor; ?>

            <?php if ($totalPages > 3): ?>
            <span class="px-4 py-2 border border-gray-300 rounded-md">...</span>
            <a href="?page=<?= $totalPages ?>" 
               class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                <?= $totalPages ?>
            </a>
            <?php endif; ?>

            <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>" 
               class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                Next
            </a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'modals/footer.php'; ?>