<?php
session_start();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Contact Us - Public Grievance Management System</title>
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
                    <a class="text-primary text-sm font-bold transition-colors" href="contact.php">Contact</a>
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

    <main class="flex-grow w-full max-w-[1200px] mx-auto px-4 md:px-10 py-10">
        
        <div class="mb-10 text-center">
             <h1 class="text-3xl md:text-4xl font-black text-[#111418] mb-4">Contact Us</h1>
             <p class="text-gray-600 max-w-2xl mx-auto">Get in touch with the grievance management team for support, feedback, or general inquiries.</p>
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
                        <h3 class="text-lg font-bold text-[#111418]">Head Office</h3>
                        <p class="text-gray-600 mt-1">Office of the Prime Minister and Council of Ministers<br>Singha Durbar, Kathmandu, Nepal</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="size-12 rounded-lg bg-green-50 flex items-center justify-center text-green-600 shrink-0">
                        <span class="material-symbols-outlined text-2xl">call</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#111418]">Phone Support</h3>
                        <p class="text-gray-600 mt-1">
                            <span class="block"><strong>Toll Free:</strong> 1111 (Hello Sarkar)</span>
                            <span class="block"><strong>Phone:</strong> +977-1-4211000</span>
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="size-12 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 shrink-0">
                        <span class="material-symbols-outlined text-2xl">mail</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#111418]">Email Us</h3>
                        <p class="text-gray-600 mt-1">
                            <span class="block"><strong>General:</strong> info@opmcm.gov.np</span>
                            <span class="block"><strong>Support:</strong> support@grievance.gov.np</span>
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
                <h3 class="text-2xl font-bold text-[#111418] mb-6">Send a Message</h3>
                <form action="#" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Your Name</label>
                            <input type="text" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11" placeholder="Ram Bahadur">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11" placeholder="98XXXXXXXX">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                        <input type="email" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary h-11" placeholder="ram@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Message</label>
                        <textarea rows="4" class="block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="button" onclick="alert('Thank you! This is a demo form.')" class="w-full bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition-colors shadow-lg">
                        Send Message
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
                    <a class="text-[#617589] text-sm hover:text-primary" href="departments.php">Departments</a>
                    <a class="text-[#617589] text-sm hover:text-primary" href="contact.php">Contact</a>
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
