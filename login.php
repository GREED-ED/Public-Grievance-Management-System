<?php
session_start();
require_once 'db_connect.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];

    if (empty($mobile) || empty($password)) {
        $error = "Please enter both mobile/email and password.";
    } else {
        // Allow login by Email OR Mobile
        $sql = "SELECT * FROM users WHERE mobile = ? OR email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mobile, $mobile]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Password correct
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin-dashboard.php");
            } else {
                header("Location: user-dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid credential provider.";
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Public Grievance Management System</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#DC143C", /* Nepal Crimson */
                        "secondary": "#003893", /* Nepal Blue */
                        "background-light": "#f6f7f8",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "Noto Sans", "sans-serif"]
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-white font-display text-[#111418]">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
        
        <div class="flex flex-col justify-center items-center p-6 sm:p-12 lg:p-24 bg-white relative">
            
            <a href="index.html" class="absolute top-6 left-6 flex items-center gap-2 text-gray-500 hover:text-primary transition-colors text-sm font-bold">
                <span class="material-symbols-outlined text-lg">arrow_back</span> Back to Home
            </a>

            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <div class="mx-auto size-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-4">
                        <span class="material-symbols-outlined text-3xl">account_balance</span>
                    </div>
                    <h2 class="text-3xl font-black text-[#111418]">Welcome Back</h2>
                    <p class="text-gray-500 mt-2">Sign in to track your grievances<br><span class="text-sm">(तपाइँको खातामा लगइन गर्नुहोस्)</span></p>
                </div>

                <?php if (isset($_GET['registered'])): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4">
                        <p class="text-green-700 font-bold">Success</p>
                        <p class="text-green-600 text-sm">Account created successfully! Please login.</p>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4">
                        <p class="text-red-700 font-bold">Error</p>
                        <p class="text-red-600 text-sm"><?php echo htmlspecialchars($error); ?></p>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST" class="mt-8 space-y-6">
                    
                    <div>
                        <label for="mobile" class="block text-sm font-bold text-gray-700 mb-1">Mobile Number or Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400">person</span>
                            </div>
                            <input id="mobile" name="mobile" type="text" required class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary sm:text-sm h-12" placeholder="98XXXXXXXX">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400">lock</span>
                            </div>
                            <input id="password" name="password" type="password" required class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary sm:text-sm h-12" placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword()">
                                <span id="eyeIcon" class="material-symbols-outlined text-gray-400 hover:text-gray-600">visibility</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700 font-medium">Remember me</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-bold text-secondary hover:text-primary hover:underline">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-primary hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all shadow-lg hover:shadow-xl">
                        Sign in (लगइन)
                    </button>
                    


                </form>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Don't have an account? 
                    <a href="register.php" class="font-bold text-primary hover:text-red-700">Register New Account</a>
                </p>
            </div>
        </div>

        <div class="hidden lg:block relative bg-gray-900">
            <img class="absolute inset-0 h-full w-full object-cover opacity-60 mix-blend-overlay" 
                 src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?q=80&w=2671&auto=format&fit=crop" 
                 alt="Nepal Government Building">
            
            <div class="absolute inset-0 bg-gradient-to-br from-secondary/90 to-primary/80 mix-blend-multiply"></div>
            
            <div class="relative z-10 flex flex-col justify-center h-full px-12 text-white">
                <div class="border-l-4 border-white pl-6 mb-6">
                    <h2 class="text-4xl font-black mb-4">Nepal Government</h2>
                    <p class="text-xl font-medium opacity-90">Public Grievance Management System</p>
                </div>
                <p class="text-lg opacity-80 max-w-lg leading-relaxed">
                    "Dedicated to serving citizens with transparency, accountability, and speed. Your voice matters to us."
                </p>
                
                <div class="mt-12 flex gap-8">
                    <div>
                        <p class="text-3xl font-bold">15k+</p>
                        <p class="text-sm opacity-70">Grievances Solved</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold">24/7</p>
                        <p class="text-sm opacity-70">Support System</p>
                    </div>
                </div>
            </div>
            
            <div class="absolute bottom-8 left-12 text-xs text-white/50">
                © 2024 Government of Nepal. All rights reserved.
            </div>
        </div>
        
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerText = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerText = 'visibility';
            }
        }
    </script>
</body>
</html>