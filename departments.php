<?php
session_start();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Departments - Public Grievance Management System</title>
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
                    <a class="text-primary text-sm font-bold transition-colors" href="departments.php">Departments</a>
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
        
        <div class="mb-10 text-center">
             <h1 class="text-3xl md:text-4xl font-black text-[#111418] mb-4">Government Departments</h1>
             <p class="text-gray-600 max-w-2xl mx-auto">Find contact information and key responsibilities of various government departments handling public grievances.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Dept 1 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600">
                         <span class="material-symbols-outlined text-2xl">add_road</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors">Department of Roads</h3>
                <p class="text-gray-500 text-sm mb-4">Responsible for construction, maintenance, and expansion of strategic road networks.</p>
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
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors">Water Supply Department</h3>
                <p class="text-gray-500 text-sm mb-4">Planning and implementation of water supply and sanitation projects nationwide.</p>
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
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors">Nepal Electricity Authority</h3>
                <p class="text-gray-500 text-sm mb-4">Generation, transmission, and distribution of adequate, reliable, and affordable power.</p>
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
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors">Waste Management Division</h3>
                <p class="text-gray-500 text-sm mb-4">Overseeing municipal waste collection, processing, and environmental safety.</p>
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
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors">CIAA</h3>
                <p class="text-gray-500 text-sm mb-4">Commission for the Investigation of Abuse of Authority. Handling corruption cases.</p>
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
                <h3 class="text-lg font-bold text-[#111418] mb-2 group-hover:text-primary transition-colors">Hello Sarkar</h3>
                <p class="text-gray-500 text-sm mb-4">A direct channel to the Prime Minister's Office for immediate grievance hearing.</p>
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
