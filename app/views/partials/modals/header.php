<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouDemy - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen">
    <header class="fixed w-full bg-white shadow-md z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-gray-800">
                    <a href="/" class="flex items-center">
                        <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">You</span>Demy
                    </a>
                </div>

                <div class="flex gap-4">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="flex items-center text-gray-700 bg-gray-100 px-3 py-2 rounded-md">
                            <i class="fas fa-user-circle mr-2 text-indigo-600"></i>
                            <span class="font-medium"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                        </span>
                        <a href="/logout" class="flex items-center gap-2 px-3 py-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="/register" class="px-4 py-2 border border-indigo-500 text-indigo-500 rounded-md hover:bg-indigo-50 transition">
                            <i class="fas fa-user-plus mr-2"></i>Sign Up
                        </a>
                        <a href="/login" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-md hover:from-indigo-700 hover:to-purple-700 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
