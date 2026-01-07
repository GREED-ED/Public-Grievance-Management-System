<?php
// Determine current URL protocol
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
// Get current URL
$current_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// Parse URL to manipulate query params
$parsed_url = parse_url($current_url);
$query_params = [];
if (isset($parsed_url['query'])) {
    parse_str($parsed_url['query'], $query_params);
}

// Function to generate language link
function getLangLink($lang_code) {
    global $protocol, $parsed_url, $query_params;
    $new_params = $query_params;
    $new_params['lang'] = $lang_code;
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $parsed_url['path'] . '?' . http_build_query($new_params);
}
?>

<header class="bg-white border-b border-[#f0f2f4] sticky top-0 z-30">
    <div class="px-4 md:px-10 py-3 flex items-center justify-between max-w-[1200px] mx-auto w-full">
        <a href="index.php?lang=<?php echo $_SESSION['lang']; ?>" class="flex items-center gap-4 cursor-pointer">
            <div class="size-12 flex items-center justify-center rounded-lg overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Emblem_of_Nepal.svg/1024px-Emblem_of_Nepal.svg.png" alt="Nepal Emblem" class="h-full w-auto">
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <h2 class="text-[#111418] text-lg font-bold leading-tight"><?php echo __('nepal_government'); ?></h2>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9b/Flag_of_Nepal.svg" alt="Nepal Flag" class="h-4 w-auto shadow-sm">
                </div>
                <p class="text-xs text-[#617589] font-medium"><?php echo __('system_name'); ?></p>
            </div>
        </a>
        <div class="hidden lg:flex flex-1 justify-end gap-8 items-center">
            <div class="flex items-center gap-6">
                <!-- Language Toggle -->
                <div class="flex items-center gap-2 text-sm font-bold border-r border-gray-200 pr-4 mr-2">
                    <a href="<?php echo getLangLink('en'); ?>" class="<?php echo $_SESSION['lang'] == 'en' ? 'text-primary' : 'text-gray-500 hover:text-gray-700'; ?>">EN</a>
                    <span class="text-gray-300">|</span>
                    <a href="<?php echo getLangLink('np'); ?>" class="<?php echo $_SESSION['lang'] == 'np' ? 'text-primary' : 'text-gray-500 hover:text-gray-700'; ?>">नेपा</a>
                </div>

                <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('home'); ?></a>
                <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="about.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('about'); ?></a>
                <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="departments.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('departments'); ?></a>
                <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="contact.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('contact'); ?></a>
            </div>
            <div class="flex gap-2">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="hidden md:flex items-center text-sm font-bold text-gray-700 mr-2"><?php echo __('namaste'); ?>, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-secondary text-white text-sm font-bold hover:bg-blue-800 transition-colors shadow-sm gap-2" onclick="window.location.href='<?php echo $_SESSION['role'] === 'admin' ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>?lang=<?php echo $_SESSION['lang']; ?>'">
                        <span class="material-symbols-outlined text-lg">dashboard</span> <?php echo __('dashboard'); ?>
                    </button>
                    <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100 transition-colors border border-red-100" onclick="window.location.href='logout.php?lang=<?php echo $_SESSION['lang']; ?>'">
                        <?php echo __('logout'); ?>
                    </button>
                <?php else: ?>
                    <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold hover:bg-red-700 transition-colors shadow-sm" onclick="window.location.href='login.php?lang=<?php echo $_SESSION['lang']; ?>'">
                        <?php echo __('login'); ?>
                    </button>
                    <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-[#f0f2f4] text-[#111418] text-sm font-bold hover:bg-gray-200 transition-colors" onclick="window.location.href='register.php?lang=<?php echo $_SESSION['lang']; ?>'">
                        <?php echo __('register'); ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <button class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded" onclick="toggleMenu()">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>
