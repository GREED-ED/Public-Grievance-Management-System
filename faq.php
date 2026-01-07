<?php
require_once 'includes/languages.php';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo __('faq_page_title'); ?> - <?php echo __('system_name'); ?></title>
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
                        "surface": "#ffffff",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "Noto Sans", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style>
        /* Smooth transition for accordion */
        .faq-answer {
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
        .faq-answer.open {
            max-height: 500px; /* Arbitrary large height */
            opacity: 1;
        }
        .rotate-icon {
            transition: transform 0.3s ease;
        }
        .open .rotate-icon {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-background-light font-display text-[#111418] min-h-screen flex flex-col">

    <?php include 'includes/navbar.php'; ?>

    <div class="bg-secondary text-white py-16 px-4">
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <h1 class="text-3xl md:text-4xl font-black"><?php echo __('how_can_we_help'); ?></h1>
            <p class="text-blue-100 text-lg"><?php echo __('faq_intro_sub'); ?></p>
            
            <div class="relative mt-8 max-w-xl mx-auto">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">search</span>
                </div>
                <input type="text" id="faqSearch" onkeyup="filterFAQ()" class="block w-full pl-12 pr-4 py-4 rounded-full border-0 text-gray-900 shadow-lg ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6" placeholder="<?php echo __('search_placeholder'); ?>">
            </div>
        </div>
    </div>

    <main class="flex-grow max-w-5xl mx-auto px-4 py-12 w-full grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">
            
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">info</span> <?php echo __('general_info'); ?>
                </h3>
                <div class="space-y-3" id="faq-container">
                    
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800"><?php echo __('faq_q1'); ?></span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                <?php echo __('faq_a1'); ?>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800"><?php echo __('faq_q2'); ?></span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                <?php echo __('faq_a2'); ?>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800"><?php echo __('faq_q3'); ?></span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                <?php echo __('faq_a3'); ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pt-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">settings</span> <?php echo __('technical_process'); ?>
                </h3>
                <div class="space-y-3">
                    
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800"><?php echo __('faq_q4'); ?></span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                <?php echo __('faq_a4'); ?>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800"><?php echo __('faq_q5'); ?></span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                <?php echo __('faq_a5'); ?>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800"><?php echo __('faq_q6'); ?></span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                <?php echo __('faq_a6'); ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="space-y-8">
            
            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-primary">
                <h3 class="font-bold text-lg mb-4 text-[#111418]"><?php echo __('guidelines'); ?></h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="font-bold text-sm text-green-700 flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-base">check_circle</span> <?php echo __('dos'); ?>
                        </p>
                        <ul class="text-sm text-gray-600 list-disc ml-6 space-y-1">
                            <li><?php echo __('guideline_do_1'); ?></li>
                            <li><?php echo __('guideline_do_2'); ?></li>
                            <li><?php echo __('guideline_do_3'); ?></li>
                        </ul>
                    </div>
                    
                    <div>
                        <p class="font-bold text-sm text-red-700 flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-base">cancel</span> <?php echo __('donts'); ?>
                        </p>
                        <ul class="text-sm text-gray-600 list-disc ml-6 space-y-1">
                            <li><?php echo __('guideline_dont_1'); ?></li>
                            <li><?php echo __('guideline_dont_2'); ?></li>
                            <li><?php echo __('guideline_dont_3'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h3 class="font-bold text-lg mb-2 text-secondary"><?php echo __('still_questions'); ?></h3>
                <p class="text-sm text-gray-600 mb-4"><?php echo __('support_team_hours'); ?></p>
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
    
    <script>
        function toggleFAQ(button) {
            const answer = button.nextElementSibling;
            
            // Toggle the current answer
            if (answer.classList.contains('open')) {
                answer.classList.remove('open');
                button.classList.remove('open');
            } else {
                answer.classList.add('open');
                button.classList.add('open');
            }
        }

        function filterFAQ() {
            let input = document.getElementById('faqSearch');
            let filter = input.value.toUpperCase();
            let container = document.getElementById('faq-container');
            let faqItems = document.querySelectorAll('.faq-item');

            for (let i = 0; i < faqItems.length; i++) {
                let button = faqItems[i].getElementsByTagName("button")[0];
                let txtValue = button.textContent || button.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    faqItems[i].style.display = "";
                } else {
                    faqItems[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
