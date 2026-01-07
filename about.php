<?php
session_start();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>About Us - Public Grievance Management System</title>
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
                    <a class="text-primary text-sm font-bold transition-colors" href="about.php">About</a>
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

    <main class="flex-grow w-full max-w-[1200px] mx-auto px-4 md:px-10 py-10">
        
        <div class="bg-white rounded-xl p-8 md:p-12 shadow-sm border border-gray-100">
            <h1 class="text-3xl md:text-4xl font-black text-[#111418] mb-6">About the System</h1>
            
            <div class="prose max-w-none text-gray-600 space-y-6">
                <p class="text-lg leading-relaxed">
                    The <strong>Public Grievance Management System (PGMS)</strong> is an initiative by the Government of Nepal to bridge the gap between valid concerns of citizens and the government departments. We believe that transparency and accountability are the pillars of a strong democracy.
                </p>

                <div class="my-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <img src="https://thehimalayantimes.com/uploads/imported_images/wp-content/uploads/2016/10/The-Office-of-the-Prime-Ministers-and-Council-of-Ministers.jpg" class="rounded-xl shadow-lg h-64 w-full object-cover" alt="Nepal Government">
                    <div class="flex flex-col justify-center">
                        <h3 class="text-xl font-bold text-[#111418] mb-3">Our Mission</h3>
                        <p>To provide a seamless, transparent, and efficient digital platform for citizens to voice their grievances and for the government to resolve them in a timely manner.</p>
                        
                        <h3 class="text-xl font-bold text-[#111418] mt-6 mb-3">Our Vision</h3>
                        <p>A responsive governance system where every citizen's voice is heard and valued.</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-[#111418] mt-10">How It Works</h2>
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Register:</strong> Citizens create an account using their mobile number.</li>
                    <li><strong>Submit:</strong> Log in and fill out the simple grievance form with location details and attachments.</li>
                    <li><strong>Track:</strong> Get a unique Reference ID to track the status of your complaint in real-time.</li>
                    <li><strong>Resolve:</strong> Relevant government officers review and resolve the issue, providing updates directly on your dashboard.</li>
                </ul>

                <h2 class="text-2xl font-bold text-[#111418] mt-10">Contact Support</h2>
                <p>
                    If you face any issues using this portal, our support team is available 24/7.
                    <br>
                    <strong>Toll Free:</strong> 1111
                    <br>
                    <strong>Email:</strong> support@grievance.gov.np
                </p>
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
