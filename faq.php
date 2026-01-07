<?php
session_start();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FAQ & Guidelines - Public Grievance Management System</title>
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

    <header class="bg-white border-b border-[#f0f2f4] sticky top-0 z-30">
        <div class="px-4 md:px-10 py-3 flex items-center justify-between max-w-[1200px] mx-auto w-full">
            <a href="index.php" class="flex items-center gap-4 cursor-pointer">
                <div class="size-10 flex items-center justify-center rounded-lg bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">account_balance</span>
                </div>
                <div>
                    <h2 class="text-[#111418] text-lg font-bold leading-tight">Nepal Government</h2>
                    <p class="text-xs text-[#617589] font-medium">Public Grievance Management System</p>
                </div>
            </a>
            <div class="hidden lg:flex flex-1 justify-end gap-8 items-center">
                <div class="flex items-center gap-6">
                    <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="index.php">Home</a>
                    <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="about.php">About</a>
                    <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="departments.php">Departments</a>
                    <a class="text-[#111418] text-sm font-medium hover:text-primary transition-colors" href="contact.php">Contact</a>
                </div>
                <div class="flex gap-2">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="hidden md:flex items-center text-sm font-bold text-gray-700 mr-2">Namaste, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-secondary text-white text-sm font-bold hover:bg-blue-800 transition-colors shadow-sm gap-2" onclick="window.location.href='<?php echo $_SESSION['role'] === 'admin' ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>'">
                            <span class="material-symbols-outlined text-lg">dashboard</span> Dashboard
                        </button>
                        <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100 transition-colors border border-red-100" onclick="window.location.href='logout.php'">
                            Logout
                        </button>
                    <?php else: ?>
                        <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-primary text-white text-sm font-bold hover:bg-red-700 transition-colors shadow-sm" onclick="window.location.href='login.php'">
                            Login
                        </button>
                        <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-[#f0f2f4] text-[#111418] text-sm font-bold hover:bg-gray-200 transition-colors" onclick="window.location.href='register.php'">
                            Register
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-secondary text-white py-16 px-4">
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <h1 class="text-3xl md:text-4xl font-black">How can we help you?</h1>
            <p class="text-blue-100 text-lg">Find answers to common questions about filing grievances and tracking status.</p>
            
            <div class="relative mt-8 max-w-xl mx-auto">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">search</span>
                </div>
                <input type="text" id="faqSearch" onkeyup="filterFAQ()" class="block w-full pl-12 pr-4 py-4 rounded-full border-0 text-gray-900 shadow-lg ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6" placeholder="Search keywords like 'password', 'status', 'time'...">
            </div>
        </div>
    </div>

    <main class="flex-grow max-w-5xl mx-auto px-4 py-12 w-full grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">
            
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">info</span> General Information
                </h3>
                <div class="space-y-3" id="faq-container">
                    
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800">What is the Public Grievance Management System?</span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                This is an official digital platform by the Government of Nepal allowing citizens to lodge complaints regarding public services directly to the concerned departments. It ensures transparency and accountability.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800">Is this service free of cost?</span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                Yes, filing a grievance through this portal is completely free for all citizens.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800">Can I file a complaint anonymously?</span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                While we encourage users to provide contact details for better follow-up, you can submit anonymous complaints. However, you will not receive SMS updates for anonymous submissions.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pt-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">settings</span> Technical & Process
                </h3>
                <div class="space-y-3">
                    
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800">How long does it take to resolve a complaint?</span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                The resolution time depends on the nature of the grievance. Typically, departments are required to respond within 7 working days. Complex issues may take up to 15-30 days.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800">I forgot my password. How can I reset it?</span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                Go to the Login page and click on "Forgot Password". You will receive an OTP on your registered mobile number to create a new password.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                            <span class="font-bold text-gray-800">How do I track my status?</span>
                            <span class="material-symbols-outlined text-gray-400 rotate-icon">keyboard_arrow_down</span>
                        </button>
                        <div class="faq-answer bg-gray-50 px-6 border-t border-gray-100">
                            <p class="py-4 text-gray-600 text-sm leading-relaxed">
                                Use the "Check Status" box on the Homepage. Enter your Grievance ID (e.g., GRV-2024-XXXX) to see the real-time timeline of your application.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="space-y-8">
            
            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-primary">
                <h3 class="font-bold text-lg mb-4 text-[#111418]">Guidelines (निर्देशिका)</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="font-bold text-sm text-green-700 flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-base">check_circle</span> DO's
                        </p>
                        <ul class="text-sm text-gray-600 list-disc ml-6 space-y-1">
                            <li>Provide accurate location details.</li>
                            <li>Attach clear photos if applicable.</li>
                            <li>Keep your Grievance ID safe.</li>
                        </ul>
                    </div>
                    
                    <div>
                        <p class="font-bold text-sm text-red-700 flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-base">cancel</span> DON'Ts
                        </p>
                        <ul class="text-sm text-gray-600 list-disc ml-6 space-y-1">
                            <li>Do not use abusive language.</li>
                            <li>Do not file false complaints.</li>
                            <li>Do not share your password.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h3 class="font-bold text-lg mb-2 text-secondary">Still have questions?</h3>
                <p class="text-sm text-gray-600 mb-4">Our support team is available from 10 AM to 5 PM (Sun-Fri).</p>
                
                <div class="space-y-3">
                    <div class="flex items-center gap-3 bg-white p-3 rounded-lg border border-blue-100">
                        <span class="material-symbols-outlined text-secondary">call</span>
                        <div>
                            <p class="text-xs text-gray-500">Toll Free Number</p>
                            <p class="font-bold text-gray-800">1111</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-white p-3 rounded-lg border border-blue-100">
                        <span class="material-symbols-outlined text-secondary">mail</span>
                        <div>
                            <p class="text-xs text-gray-500">Email Support</p>
                            <p class="font-bold text-gray-800">support@moha.gov.np</p>
                        </div>
                    </div>
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
                    <span class="text-[#111418] font-bold text-lg">Nepal Government</span>
                </div>
                <p class="text-[#617589] text-sm">Official Portal for Public Grievance Management.</p>
                <p class="text-[#617589] text-sm">© 2024 Government of Nepal. All rights reserved.</p>
            </div>
            <div class="flex flex-wrap gap-10 md:gap-20">
                <div class="flex flex-col gap-3">
                    <h4 class="text-[#111418] text-sm font-bold uppercase tracking-wider">Quick Links</h4>
                    <a class="text-[#617589] text-sm hover:text-primary" href="index.php">Home</a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="about.php">About</a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="faq.php">FAQ</a>
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

    <script>
        // Toggle Accordion
        function toggleFAQ(button) {
            const answer = button.nextElementSibling;
            const isOpen = answer.classList.contains('open');

            // Close all others (optional - for accordion effect)
            document.querySelectorAll('.faq-answer').forEach(item => {
                item.classList.remove('open');
                item.style.maxHeight = null;
                item.style.opacity = 0;
            });
            document.querySelectorAll('.rotate-icon').forEach(icon => {
                icon.style.transform = 'rotate(0deg)';
            });

            // Toggle current
            if (!isOpen) {
                answer.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + "px";
                answer.style.opacity = 1;
                button.querySelector('.rotate-icon').style.transform = 'rotate(180deg)';
            }
        }

        // Search Filter
        function filterFAQ() {
            const input = document.getElementById('faqSearch');
            const filter = input.value.toLowerCase();
            const items = document.querySelectorAll('.faq-item');

            items.forEach(item => {
                const text = item.innerText.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>
