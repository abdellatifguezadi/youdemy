<?php require_once __DIR__ . '/../partials/modals/header.php'; ?>

<div class="bg-gray-50 min-h-screen pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Enrollments</h1>
            <p class="mt-2 text-sm text-gray-600">View and manage your course enrollments</p>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="mb-4 p-4 rounded-md <?= $_SESSION['message_type'] === 'error' ? 'bg-red-50 text-red-700' : 'bg-green-50 text-green-700' ?>">
                <?= $_SESSION['message'] ?>
            </div>
            <?php 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>

        <?php if (empty($enrollments)): ?>
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-graduation-cap text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No Enrollments Yet</h3>
                <p class="mt-2 text-sm text-gray-500">Browse our courses and start learning today!</p>
                <a href="/" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-violet-600 hover:bg-violet-700">
                    Browse Courses
                </a>
            </div>
        <?php else: ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($enrollments as $enrollment): ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative h-48">
                            <img src="<?= htmlspecialchars($enrollment['photo_url']) ?>" 
                                 alt="<?= htmlspecialchars($enrollment['title']) ?>" 
                                 class="w-full h-full object-cover">
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    <?php
                                    switch($enrollment['status']) {
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
                                    <?= ucfirst($enrollment['status']) ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <?= htmlspecialchars($enrollment['title']) ?>
                            </h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                <?= htmlspecialchars($enrollment['description']) ?>
                            </p>

                            <div class="flex items-center mb-4">
                                <i class="fas fa-chalkboard-teacher text-violet-600 mr-2"></i>
                                <span class="text-sm text-gray-600">
                                    <?= htmlspecialchars($enrollment['teacher_name']) ?>
                                </span>
                            </div>

                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>Enrolled on <?= date('M d, Y', strtotime($enrollment['enrollment_date'])) ?></span>
                            </div>

                            <?php if ($enrollment['status'] === 'approved'): ?>
                                <a href="/course/<?= $enrollment['course_id'] ?>" 
                                   class="mt-4 block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-violet-600 hover:bg-violet-700">
                                    Continue Learning
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/modals/footer.php'; ?> 