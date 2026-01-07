<?php
require_once 'includes/languages.php';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo __('departments_page_title'); ?> - <?php echo __('system_name'); ?></title>
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
             <h1 class="text-3xl md:text-4xl font-black text-[#111418] mb-4"><?php echo __('departments_page_title'); ?></h1>
             <p class="text-gray-600 max-w-2xl mx-auto"><?php echo __('departments_intro'); ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Dept 1 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600">
                         <span class="material-symbols-outlined text-2xl">add_road</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors"><?php echo __('dept_roads'); ?></h3>
                <p class="text-gray-500 text-sm mb-4"><?php echo __('dept_roads_desc'); ?></p>
                <div class="text-xs text-gray-400 font-mono bg-gray-50 p-2 rounded">
                    Phone: 01-5529075<br>
                    Email: info@dor.gov.np
                </div>
            </div>

            <!-- Dept 2 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                         <span class="material-symbols-outlined text-2xl">water_drop</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors"><?php echo __('dept_water'); ?></h3>
                <p class="text-gray-500 text-sm mb-4"><?php echo __('dept_water_desc'); ?></p>
                 <div class="text-xs text-gray-400 font-mono bg-gray-50 p-2 rounded">
                    Phone: 01-4413744<br>
                    Email: info@dwssm.gov.np
                </div>
            </div>

            <!-- Dept 3 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-yellow-50 flex items-center justify-center text-yellow-600">
                         <span class="material-symbols-outlined text-2xl">bolt</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors"><?php echo __('dept_electricity'); ?></h3>
                <p class="text-gray-500 text-sm mb-4"><?php echo __('dept_electricity_desc'); ?></p>
                 <div class="text-xs text-gray-400 font-mono bg-gray-50 p-2 rounded">
                    Phone: 1151 (Hotline)<br>
                    Email: info@nea.org.np
                </div>
            </div>

            <!-- Dept 4 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                         <span class="material-symbols-outlined text-2xl">recycling</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors"><?php echo __('dept_waste'); ?></h3>
                <p class="text-gray-500 text-sm mb-4"><?php echo __('dept_waste_desc'); ?></p>
                 <div class="text-xs text-gray-400 font-mono bg-gray-50 p-2 rounded">
                    Phone: 01-4231610<br>
                    Email: env@kathmandu.gov.np
                </div>
            </div>

             <!-- Dept 5 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                         <span class="material-symbols-outlined text-2xl">gavel</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors"><?php echo __('dept_ciaa'); ?></h3>
                <p class="text-gray-500 text-sm mb-4"><?php echo __('dept_ciaa_desc'); ?></p>
                 <div class="text-xs text-gray-400 font-mono bg-gray-50 p-2 rounded">
                    Phone: 107 (Hotline)<br>
                    Email: ciaa@ciaa.gov.np
                </div>
            </div>
            
             <!-- Dept 6 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                         <span class="material-symbols-outlined text-2xl">support_agent</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors"><?php echo __('dept_hello_sarkar'); ?></h3>
                <p class="text-gray-500 text-sm mb-4"><?php echo __('dept_hello_sarkar_desc'); ?></p>
                 <div class="text-xs text-gray-400 font-mono bg-gray-50 p-2 rounded">
                    Phone: 1111<br>
                    Email: 1111@opmcm.gov.np
                </div>
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
