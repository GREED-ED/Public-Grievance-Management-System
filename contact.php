<?php
require_once 'includes/languages.php';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo __('contact_page_title'); ?> - <?php echo __('system_name'); ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#DC143C",
              "secondary": "#003893",
              "background-light": "#f6f7f8",
              "background-dark": "#101922",
            },
            fontFamily: {
              "display": ["Public Sans", "Noto Sans", "sans-serif"]
            },
          },
        },
      }
    </script>
</head>
<body class="bg-background-light text-[#111418] font-display overflow-x-hidden flex flex-col min-h-screen">
    
    <?php include 'includes/navbar.php'; ?>

    <main class="flex-grow w-full max-w-[1200px] mx-auto px-4 md:px-10 py-10">
        
        <div class="mb-10 text-center">
             <h1 class="text-3xl md:text-4xl font-black text-[#111418] mb-4"><?php echo __('contact_page_title'); ?></h1>
             <p class="text-gray-600 max-w-2xl mx-auto"><?php echo __('contact_intro'); ?></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            
            <!-- Contact Info -->
            <div class="space-y-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="size-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                        <span class="material-symbols-outlined text-2xl">location_on</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#111418]"><?php echo __('head_office'); ?></h3>
                        <p class="text-gray-600 mt-1"><?php echo __('head_office_address'); ?></p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="size-12 rounded-lg bg-green-50 flex items-center justify-center text-green-600 shrink-0">
                        <span class="material-symbols-outlined text-2xl">call</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#111418]"><?php echo __('phone_support'); ?></h3>
                        <p class="text-gray-600 mt-1">
                            <span class="block"><?php echo __('phone_support_tolfree'); ?></span>
                            <span class="block"><?php echo __('phone_support_number'); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="size-12 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 shrink-0">
                        <span class="material-symbols-outlined text-2xl">mail</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#111418]"><?php echo __('email_us'); ?></h3>
                        <p class="text-gray-600 mt-1">
                            <span class="block"><?php echo __('email_general'); ?></span>
                            <span class="block"><?php echo __('email_support'); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Google Map Embed -->
                <div class="bg-gray-100 rounded-xl h-64 w-full overflow-hidden shadow-sm border border-gray-200">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.463339071536!2d85.3197669106096!3d27.697843825633596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a744473369%3A0x707324319472e394!2sSingha%20Durbar%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1715000000000!5m2!1sen!2snp" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                <h3 class="text-2xl font-bold text-[#111418] mb-6"><?php echo __('send_message'); ?></h3>
                <form action="#" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('your_name'); ?></label>
                            <input type="text" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11" placeholder="Ram Bahadur">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('phone_number'); ?></label>
                            <input type="tel" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11" placeholder="98XXXXXXXX">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('email_address'); ?></label>
                        <input type="email" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11" placeholder="ram@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1"><?php echo __('message'); ?></label>
                        <textarea rows="4" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" placeholder="<?php echo __('message_placeholder'); ?>"></textarea>
                    </div>
                    <button type="button" onclick="alert('<?php echo __('alert_demo'); ?>')" class="w-full bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition-colors shadow-lg">
                        <?php echo __('send_btn'); ?>
                    </button>
                </form>
            </div>

        </div>

    </main>

    <footer class="bg-white border-t border-[#dbe0e6] py-10">
        <div class="max-w-[1200px] mx-auto px-4 md:px-10 flex flex-col md:flex-row justify-between gap-10">
            <div class="flex flex-col gap-4 max-w-sm">
                <div class="flex items-center gap-3">
                    <div class="size-8 flex items-center justify-center rounded bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">account_balance</span>
                    </div>
                    <span class="text-[#111418] font-bold text-lg"><?php echo __('nepal_government'); ?></span>
                </div>
                <p class="text-[#617589] text-sm"><?php echo __('official_portal'); ?></p>
                <p class="text-[#617589] text-sm">© 2024 <?php echo __('rights_reserved'); ?></p>
            </div>
            <div class="flex flex-wrap gap-10 md:gap-20">
                <div class="flex flex-col gap-3">
                    <h4 class="text-[#111418] text-sm font-bold uppercase tracking-wider"><?php echo __('quick_links'); ?></h4>
                    <a class="text-[#617589] text-sm hover:text-primary" href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('home'); ?></a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="about.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('about'); ?></a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="departments.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('departments'); ?></a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="contact.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo __('contact'); ?></a>
                </div>
                <div class="flex flex-col gap-3">
                    <h4 class="text-[#111418] text-sm font-bold uppercase tracking-wider"><?php echo __('contact_us'); ?></h4>
                    <p class="text-[#617589] text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">location_on</span> Kathmandu, Nepal
                    </p>
                    <p class="text-[#617589] text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">call</span> +977-1-4200000
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
