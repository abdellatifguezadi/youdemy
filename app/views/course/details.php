<?php include '../app/views/partials/modals/header.php'; ?>

<main class="mt-24">
    <div class="container mx-auto px-4 py-8">

        <div class="mb-6">
            <a href="/" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>

        <?php if (isset($course) && $course): ?>
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="h-64 relative">
                        <img src="<?= htmlspecialchars($course->getPhotoUrl()) ?>" 
                             alt="<?= htmlspecialchars($course->getTitle()) ?>" 
                             class="w-full h-full object-cover rounded-lg">
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            <?= htmlspecialchars($course->getTitle()) ?>
                        </h1>
                        <div class="flex items-center text-gray-600 mb-6">
                            <span class="mr-4">
                                <i class="fas fa-user mr-2"></i>
                                <?= htmlspecialchars($course->getName()) ?>
                            </span>
                            <span class="mr-4">
                                <i class="fas fa-folder mr-2"></i>
                                <?= htmlspecialchars($course->getCategoryName()) ?>
                            </span>
                            <span>
                                <i class="fas fa-calendar mr-2"></i>
                                <?= date('d/m/Y', strtotime($course->getCreatedAt())) ?>
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-8">
                            <?php foreach ($course->getTags() as $tag): ?>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                    <?= htmlspecialchars($tag['name']) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <div class="prose max-w-none mb-8">
                            <p class="text-gray-600 leading-relaxed">
                                <?= nl2br(htmlspecialchars($course->getDescription())) ?>
                            </p>
                        </div>

                        <div class="text-center md:text-left">
                            <?php if (!isset($_SESSION['user'])): ?>
                                <a href="/login" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Se connecter pour s'inscrire
                                </a>
                            <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['role_name'] === 'student'): ?>
                                <?php if ($enrollment === null || $enrollment === false): ?>
                                    <form action="/course/enroll/<?= $course->getId() ?>" method="POST" class="inline">
                                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            <i class="fas fa-graduation-cap mr-2"></i>
                                            S'inscrire au cours
                                        </button>
                                    </form>
                                <?php elseif (isset($enrollment['status']) && $enrollment['status'] === 'approved'): ?>
                                    <button disabled class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg cursor-not-allowed">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Déjà inscrit
                                    </button>
                                <?php elseif (isset($enrollment['status']) && $enrollment['status'] === 'pending'): ?>
                                    <button disabled class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white rounded-lg cursor-not-allowed">
                                        <i class="fas fa-clock mr-2"></i>
                                        Inscription en attente
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($course->getType() === 'Cours vidéo'): ?>
                <div class="mt-8">
                    <div class="bg-gray-100 rounded-lg p-4 max-w-3xl mx-auto">
                        <div class="aspect-w-16 aspect-h-9">
                            <video 
                                class="w-full rounded"
                                controls
                                controlsList="nodownload"
                                poster="<?= htmlspecialchars($course->getPhotoUrl()) ?>"
                            >
                                <source src="<?= htmlspecialchars($course->getContent()) ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($course->getType() === 'document'): ?>
                <div class="mt-8 bg-gray-100 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold text-gray-900">Support de cours</h3>
                            <p class="text-sm text-gray-600">Document PDF</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="h-[800px] w-full">
                            <iframe
                                src="https://docs.google.com/viewer?url=<?= urlencode($course->getContent()) ?>&embedded=true"
                                class="w-full h-full border-0"
                                frameborder="0"
                            ></iframe>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-search text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Cours non trouvé</h2>
                <p class="text-gray-600">Le cours que vous recherchez n'existe pas ou a été supprimé.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include '../app/views/partials/modals/footer.php'; ?>