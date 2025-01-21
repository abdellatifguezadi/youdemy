<?php include 'modals/header.php'; ?>


<main class="flex-grow mt-24">
    <?php if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] === 'student' || $_SESSION['user']['role_name'] === 'admin'): ?>
    <section class="relative h-[400px] overflow-hidden">

        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop" 
             alt="Education Background" 
             class="absolute top-0 left-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/40 to-purple-800/30"></div>

        <div class="container mx-auto text-center text-white relative z-10 h-full flex flex-col justify-center px-4">
            <?php if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] === 'admin'): ?>
            <h1 class="text-3xl md:text-4xl font-bold mb-3 animate-fade-in">
                Welcome to YouDemy
            </h1>
            <p class="text-lg md:text-xl mb-6 animate-fade-in-delay">
                Join our community of learners and teachers
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto animate-fade-in-delay-2">
                <div class="flex flex-col gap-3">
                    <a href="/register?role=student"
                        class="bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                        Become a Student
                    </a>
                </div>
                <div class="flex flex-col gap-3">
                    <a href="/register?role=teacher"
                        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition transform hover:scale-105">
                        Become a Teacher
                    </a>
                </div>
            </div>
            <?php elseif ($_SESSION['user']['role_name'] === 'student'): ?>
            <h1 class="text-3xl md:text-4xl font-bold mb-3 animate-fade-in">
                Welcome back, <?= htmlspecialchars($_SESSION['user']['name']) ?>!
            </h1>
            <p class="text-lg md:text-xl mb-6 animate-fade-in-delay">
                Continue your learning journey
            </p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="flex-1 md:col-span-2">
                        <input type="text"
                            name="keywords"
                            placeholder="Search courses..."
                            value="<?= htmlspecialchars($currentKeywords ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="flex-1">
                        <select name="category"
                            onchange="window.location.href='?category='+this.value+'<?= isset($_GET['tag']) ? '&tag='.$_GET['tag'] : '' ?><?= isset($_GET['keywords']) ? '&keywords='.$_GET['keywords'] : '' ?>'"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($currentCategory == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex-1">
                        <select name="tag"
                            onchange="window.location.href='?tag='+this.value+'<?= isset($_GET['category']) ? '&category='.$_GET['category'] : '' ?><?= isset($_GET['keywords']) ? '&keywords='.$_GET['keywords'] : '' ?>'"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                            <option value="">All Tags</option>
                            <?php foreach ($tags as $tag): ?>
                            <option value="<?= $tag['id'] ?>" <?= ($currentTag == $tag['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tag['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="md:col-span-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-md hover:from-indigo-700 hover:to-purple-700 transition">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Course Catalog</h2>
            <?php if ($totalCourses > 0): ?>
                <p class="text-gray-600 mt-2">Found <?= $totalCourses ?> course<?= $totalCourses > 1 ? 's' : '' ?></p>
            <?php endif; ?>
        </div>

        <?php if (empty($courses)): ?>
            <div class="text-center py-8">
                <div class="text-gray-500 mb-4">
                    <i class="fas fa-search fa-3x"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No courses found</h3>
                <p class="text-gray-600">Try adjusting your search criteria or browse all courses</p>
                <a href="/" class="inline-block mt-4 px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-md hover:from-indigo-700 hover:to-purple-700 transition">
                    View All Courses
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($courses as $course): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition duration-300">
                    <img src="<?= htmlspecialchars($course->getPhotoUrl() ?: 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=500&auto=format') ?>"
                         alt="<?= htmlspecialchars($course->getTitle()) ?>"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="text-sm text-indigo-600 font-semibold">
                            <?= strtoupper($course->getCategoryName()) ?>
                        </span>
                        <h3 class="text-lg font-semibold mb-2">
                            <?= htmlspecialchars($course->getTitle()) ?>
                        </h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            <?= htmlspecialchars($course->getDescription()) ?>
                        </p>
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
                                <span class="text-sm" title="<?= $course->getType() ?>">
                                    <?php if ($course->getType() === 'Cours vidéo'): ?>
                                        <i class="fas fa-video text-blue-500"></i>
                                    <?php else: ?>
                                        <i class="fas fa-file-pdf text-red-500"></i>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <?php if (!isset($_SESSION['user'])): ?>
                                <a href="/login" 
                                   class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-md hover:from-indigo-700 hover:to-purple-700 transition">
                                    Se connecter
                                </a>
                            <?php elseif ($_SESSION['user']['role_name'] === 'student'): ?>
                                <?php 
                                    $enrollment = $studentModel->getEnrollmentStatus($course->getId(), $_SESSION['user']['id']);
                                    if ($enrollment === null): 
                                ?>
                                    <form action="/course/enroll/<?= $course->getId() ?>" method="POST" class="inline">
                                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-md hover:from-indigo-700 hover:to-purple-700 transition">
                                            S'inscrire
                                        </button>
                                    </form>
                                <?php elseif ($enrollment === 'approved'): ?>
                                    <div class="flex gap-2">
                                        <a href="/course/<?= $course->getId() ?>" 
                                           class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-md hover:from-green-600 hover:to-green-700 transition">
                                            Voir le cours
                                        </a>
                                    </div>
                                <?php elseif ($enrollment === 'pending'): ?>
                                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-md">
                                        <i class="fas fa-clock mr-1"></i> En attente
                                    </span>
                                <?php elseif ($enrollment === 'rejected'): ?>
                                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-md">
                                        <i class="fas fa-times-circle mr-1"></i> Refusé
                                    </span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-lock mr-1"></i> Réservé aux étudiants
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
            <!-- Pagination -->
            <div class="flex justify-center gap-2 mt-8">
                <?php 

                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                $url = '?';
                if (isset($_GET['keywords'])) $url .= 'keywords=' . $_GET['keywords'] . '&';
                if (isset($_GET['category'])) $url .= 'category=' . $_GET['category'] . '&';
                if (isset($_GET['tag'])) $url .= 'tag=' . $_GET['tag'] . '&';
                ?>

                <?php if ($page > 1): ?>
                <a href="<?= $url ?>page=<?= $page - 1 ?>" 
                   class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    Previous
                </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="<?= $url ?>page=<?= $i ?>" 
                   class="px-4 py-2 <?= $i == $page ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white' : 'bg-white border border-gray-300' ?> rounded-md hover:<?= $i == $page ? 'from-indigo-700 hover:to-purple-700' : 'bg-gray-50' ?> transition">
                    <?= $i ?>
                </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                <a href="<?= $url ?>page=<?= $page + 1 ?>" 
                   class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    Next
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</main>

<?php include 'modals/footer.php'; ?>