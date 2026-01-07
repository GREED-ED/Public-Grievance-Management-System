<?php
require_once 'includes/languages.php';
require_once 'db_connect.php';

$error_msg = '';
$success_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $nid = trim($_POST['nid']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms = isset($_POST['terms']);

    if (!$terms) {
        $error_msg = "You must agree to the Terms of Service.";
    } elseif ($password !== $confirm_password) {
        $error_msg = "Passwords do not match.";
    } else {
        // Check if mobile already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE mobile = ?");
        $stmt->execute([$mobile]);
        
        if ($stmt->rowCount() > 0) {
            $error_msg = "Mobile number already registered.";
        } else {
            // Insert User
            $full_name = $first_name . ' ' . $last_name;
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (full_name, email, mobile, password, nid_number, role) VALUES (?, ?, ?, ?, ?, 'citizen')";
            $stmt = $pdo->prepare($sql);
            
            try {
                if ($stmt->execute([$full_name, $email, $mobile, $hashed_password, $nid])) {
                    header("Location: login.php?registered=1&lang=" . $_SESSION['lang']);
                    exit();
                } else {
                    $error_msg = "Something went wrong. Please try again.";
                }
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo __('register_title'); ?> - <?php echo __('system_name'); ?></title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Emblem_of_Nepal.svg/1024px-Emblem_of_Nepal.svg.png">
    
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
        
        <div class="flex flex-col justify-center items-center p-6 sm:p-8 lg:p-12 bg-white relative overflow-y-auto">
            
            <a href="index.php?lang=<?php echo $_SESSION['lang']; ?>" class="absolute top-6 left-6 flex items-center gap-2 text-gray-500 hover:text-primary transition-colors text-sm font-bold">
                <span class="material-symbols-outlined text-lg">arrow_back</span> <?php echo __('back'); ?>
            </a>

            <div class="w-full max-w-lg space-y-6 mt-10 lg:mt-0">
                <div class="text-center mb-8">
                    <div class="mx-auto size-16 flex items-center justify-center mb-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Emblem_of_Nepal.svg/1024px-Emblem_of_Nepal.svg.png" alt="Nepal Emblem" class="h-full w-auto">
                    </div>
                    <h2 class="text-3xl font-black text-[#111418]"><?php echo __('create_account'); ?></h2>
                    <p class="text-gray-500 mt-2"><?php echo __('join_platform'); ?></p>
                </div>

                <?php if($error_msg): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                        <p class="text-red-700 font-bold">Error</p>
                        <p class="text-red-600 text-sm"><?php echo htmlspecialchars($error_msg); ?></p>
                    </div>
                <?php endif; ?>

                <form action="register.php?lang=<?php echo $_SESSION['lang']; ?>" method="POST" class="space-y-5">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('first_name'); ?> <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" required class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11 sm:text-sm" placeholder="Ram">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('last_name'); ?> <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" required class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11 sm:text-sm" placeholder="Bahadur">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('mobile_number'); ?> <span class="text-red-500">*</span></label>
                        <div class="flex rounded-lg shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm font-bold">+977</span>
                            <input type="tel" name="mobile" required class="flex-1 min-w-0 block w-full px-3 py-2 rounded-r-lg border-gray-300 focus:ring-primary focus:border-primary sm:text-sm h-11" placeholder="98XXXXXXXX">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('email_address'); ?></label>
                        <input type="email" name="email" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11 sm:text-sm" placeholder="example@email.com">
                    </div>

                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <label class="block text-sm font-bold text-secondary mb-1 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">badge</span> <?php echo __('citizenship_nid'); ?>
                        </label>
                        <input type="text" name="nid" required class="block w-full rounded-md border-gray-300 focus:ring-secondary focus:border-secondary h-11 sm:text-sm bg-white" placeholder="XX-XX-XX-XXXXX">
                        <p class="text-xs text-gray-500 mt-1"><?php echo __('nid_help'); ?></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('password'); ?> <span class="text-red-500">*</span></label>
                            <input name="password" type="password" required class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11 sm:text-sm" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('confirm_password'); ?> <span class="text-red-500">*</span></label>
                            <input name="confirm_password" type="password" required class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11 sm:text-sm" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700"><?php echo __('agree_terms'); ?></label>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-secondary hover:bg-blue-800 transition-all shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                        <?php echo __('create_account_btn'); ?>
                    </button>
                </form>

                <p class="mt-4 text-center text-sm text-gray-600">
                    <?php echo __('already_have_account'); ?> 
                    <a href="login.php?lang=<?php echo $_SESSION['lang']; ?>" class="font-bold text-primary hover:text-red-700"><?php echo __('sign_in_here'); ?></a>
                </p>
            </div>
        </div>

        <div class="hidden lg:block relative bg-gray-900">
            <img class="absolute inset-0 h-full w-full object-cover opacity-60 mix-blend-overlay" 
                 src="https://images.unsplash.com/photo-1572508589584-94d778209083?q=80&w=2574&auto=format&fit=crop" 
                 alt="Kathmandu City Landscape">
            
            <div class="absolute inset-0 bg-gradient-to-tl from-secondary/90 to-primary/80 mix-blend-multiply"></div>
            
            <div class="relative z-10 flex flex-col justify-center h-full px-12 text-white">
                <div class="border-l-4 border-white pl-6 mb-6">
                    <h2 class="text-4xl font-black mb-4"><?php echo __('empowering_citizens'); ?></h2>
                    <p class="text-xl font-medium opacity-90"><?php echo __('building_future'); ?></p>
                </div>
                
                <ul class="space-y-6 mt-8">
                    <li class="flex items-center gap-4">
                        <span class="size-10 rounded-full bg-white/20 flex items-center justify-center material-symbols-outlined">rocket_launch</span>
                        <div>
                            <p class="font-bold text-lg"><?php echo __('fast_processing'); ?></p>
                            <p class="text-sm opacity-70"><?php echo __('fast_processing_desc'); ?></p>
                        </div>
                    </li>
                    <li class="flex items-center gap-4">
                        <span class="size-10 rounded-full bg-white/20 flex items-center justify-center material-symbols-outlined">lock</span>
                        <div>
                            <p class="font-bold text-lg"><?php echo __('secure_private'); ?></p>
                            <p class="text-sm opacity-70"><?php echo __('secure_private_desc'); ?></p>
                        </div>
                    </li>
                    <li class="flex items-center gap-4">
                        <span class="size-10 rounded-full bg-white/20 flex items-center justify-center material-symbols-outlined">notifications</span>
                        <div>
                            <p class="font-bold text-lg"><?php echo __('real_time_updates'); ?></p>
                            <p class="text-sm opacity-70"><?php echo __('real_time_updates_desc'); ?></p>
                        </div>
                    </li>
                </ul>
            </div>
             <div class="absolute bottom-8 left-12 text-xs text-white/50">
                © 2024 <?php echo __('rights_reserved'); ?>
            </div>
        </div>
        
    </div>

</body>
</html>
