<?php
require_once 'includes/languages.php';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo __('about'); ?> - <?php echo __('system_name'); ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Emblem_of_Nepal.svg/1024px-Emblem_of_Nepal.svg.png">
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
        
        <div class="bg-white rounded-xl p-8 md:p-12 shadow-sm border border-gray-100">
            <h1 class="text-3xl md:text-4xl font-black text-[#111418] mb-6"><?php echo __('about_system_title'); ?></h1>
            
            <div class="prose max-w-none text-gray-600 space-y-6">
                <p class="text-lg leading-relaxed">
                    <?php echo __('about_pgms_intro'); ?>
                </p>

                <div class="my-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <img src="https://thehimalayantimes.com/uploads/imported_images/wp-content/uploads/2016/10/The-Office-of-the-Prime-Ministers-and-Council-of-Ministers.jpg" class="rounded-xl shadow-lg h-64 w-full object-cover" alt="<?php echo __('nepal_government'); ?>">
                    <div class="flex flex-col justify-center">
                        <h3 class="text-xl font-bold text-[#111418] mb-3"><?php echo __('our_mission_title'); ?></h3>
                        <p><?php echo __('our_mission_desc'); ?></p>
                        
                        <h3 class="text-xl font-bold text-[#111418] mt-6 mb-3"><?php echo __('our_vision_title'); ?></h3>
                        <p><?php echo __('our_vision_desc'); ?></p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-[#111418] mt-10"><?php echo __('how_it_works_title'); ?></h2>
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong><?php echo __('step_register_title'); ?>:</strong> <?php echo __('step_register_desc'); ?></li>
                    <li><strong><?php echo __('step_submit_title'); ?>:</strong> <?php echo __('step_submit_desc'); ?></li>
                    <li><strong><?php echo __('step_track_title'); ?>:</strong> <?php echo __('step_track_desc'); ?></li>
                    <li><strong><?php echo __('step_resolve_title'); ?>:</strong> <?php echo __('step_resolve_desc'); ?></li>
                </ul>

                <h2 class="text-2xl font-bold text-[#111418] mt-10"><?php echo __('contact_support_title'); ?></h2>
                <p>
                    <?php echo __('contact_support_desc'); ?>
                    <br>
                    <strong><?php echo __('toll_free'); ?>:</strong> 1111
                    <br>
                    <strong><?php echo __('email'); ?>:</strong> support@grievance.gov.np
                </p>
            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-[#dbe0e6] py-10">
        <div class="max-w-[1200px] mx-auto px-4 md:px-10 flex flex-col md:flex-row justify-between gap-10">
            <div class="flex flex-col gap-4 max-w-sm">
                <div class="flex items-center gap-3">
                    <div class="size-10 flex items-center justify-center rounded overflow-hidden">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Emblem_of_Nepal.svg/1024px-Emblem_of_Nepal.svg.png" alt="Nepal Emblem" class="h-full w-auto">
                    </div>
                    <span class="text-[#111418] font-bold text-lg"><?php echo __('nepal_government'); ?></span>
                </div>
                <p class="text-[#617589] text-sm">Official Portal for Public Grievance Management.</p>
                <p class="text-[#617589] text-sm">© 2024 Government of Nepal. All rights reserved.</p>
            </div>
            <div class="flex flex-wrap gap-10 md:gap-20">
                <div class="flex flex-col gap-3">
                    <h4 class="text-[#111418] text-sm font-bold uppercase tracking-wider">Quick Links</h4>
                    <a class="text-[#617589] text-sm hover:text-primary" href="index.php">Home</a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="about.php">About</a>
                </div>
                <div class="flex flex-col gap-3">
                    <h4 class="text-[#111418] text-sm font-bold uppercase tracking-wider">Contact</h4>
                    <p class="text-[#617589] text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">location_on</span> Kathmandu, Nepal
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
