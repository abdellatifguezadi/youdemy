<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouDemy - Online Learning Platform</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom Styles -->
    <style type="text/tailwindcss">
        @layer utilities {
            .animate-fade-in {
                animation: fadeIn 0.5s ease-in;
            }
            .animate-fade-in-delay {
                animation: fadeIn 0.5s ease-in 0.2s;
            }
            .animate-fade-in-delay-2 {
                animation: fadeIn 0.5s ease-in 0.4s;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-shake {
                animation: shake 0.5s ease-in-out;
            }
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        }
    </style>
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
                    <?php 
                    // Vérifier si nous sommes sur une page d'authentification
                    $currentPage = $_SERVER['REQUEST_URI'];
                    $isAuthPage = strpos($currentPage, 'login') !== false || strpos($currentPage, 'register') !== false;
                    
                    if ($isAuthPage): ?>
                        <a href="/" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-md hover:from-indigo-700 hover:to-purple-700 transition">
                            <i class="fas fa-home mr-2"></i>Homepage
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
