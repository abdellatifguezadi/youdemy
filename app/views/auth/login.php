<?php include dirname(__DIR__) . '/partials/modals/header.php'; ?>

<div class="min-h-screen relative flex items-center justify-center pt-20 pb-6 px-4 sm:px-6 lg:px-8">

    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop" 
         alt="Education Background" 
         class="absolute top-0 left-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/60 to-purple-900/60"></div>

    <div class="max-w-md w-full bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-6 transform transition-all hover:scale-105 relative z-10">
        <div class="text-center mb-4">
            <i class="fas fa-graduation-cap text-4xl text-indigo-600 mb-2"></i>
            <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
            <p class="text-sm text-gray-600">Sign in to your account</p>
        </div>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4 animate-shake">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form class="mt-4 space-y-4" action="/login" method="POST">
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
                <button type="submit" 
                    class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm 
                    font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign in
                </button>
            </div>
        </form>

        <p class="mt-3 text-center text-sm text-gray-600">
            Not registered? 
            <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
                <i class="fas fa-user-plus mr-1"></i>Create an account
            </a>
        </p>
    </div>
</div>

<?php include dirname(__DIR__) . '/partials/modals/footer.php'; ?> 