<?php include dirname(__DIR__) . '/partials/modals/header.php'; ?>

<div class="min-h-screen bg-gradient-to-r from-indigo-600 to-purple-700 flex items-center justify-center pt-20 pb-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-6 transform transition-all hover:scale-105">
        <!-- Icon et Titre -->
        <div class="text-center mb-4">
            <i class="fas fa-user-graduate text-4xl text-indigo-600 mb-2"></i>
            <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
            <p class="text-sm text-gray-600">Join our learning platform</p>
        </div>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative mb-3 text-sm">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form class="mt-4 space-y-4" action="/register" method="POST">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input id="name" name="name" type="text" required 
                        class="appearance-none block w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="John Doe">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none block w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="you@example.com">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none block w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="••••••••">
                </div>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">I want to</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user-tag text-gray-400"></i>
                    </div>
                    <select id="role" name="role" required 
                        class="appearance-none block w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="student" <?= ($role === 'student') ? 'selected' : '' ?>>Learn as Student</option>
                        <option value="teacher" <?= ($role === 'teacher') ? 'selected' : '' ?>>Teach as Instructor</option>
                    </select>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm 
                    font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </button>
            </div>
        </form>

        <p class="mt-3 text-center text-sm text-gray-600">
            Already have an account? 
            <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
                <i class="fas fa-sign-in-alt mr-1"></i>Sign in
            </a>
        </p>
    </div>
</div>

<?php include dirname(__DIR__) . '/partials/modals/footer.php'; ?> 