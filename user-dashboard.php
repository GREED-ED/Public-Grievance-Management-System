<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in and is a citizen
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'citizen') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch Grievances
$sql = "SELECT * FROM grievances WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$grievances = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>User Dashboard - Public Grievance Management System</title>
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
                        "primary": "#DC143C",
                        "secondary": "#003893",
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
</head>
<body class="bg-background-light text-[#111418] min-h-screen flex flex-col">

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
                <span class="hidden md:flex items-center text-sm font-bold text-gray-700 mr-2">Namaste, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-secondary text-white text-sm font-bold hover:bg-blue-800 transition-colors shadow-sm gap-2" onclick="window.location.href='user-dashboard.php'">
                    <span class="material-symbols-outlined text-lg">dashboard</span> Dashboard
                </button>
                <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100 transition-colors border border-red-100" onclick="window.location.href='logout.php'">
                    Logout
                </button>
            </div>
        </div>
    </div>
</header>

<main class="flex-grow py-8 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#111418]">My Grievances</h2>
                <p class="text-gray-500 mt-1">Track the status of your submitted complaints (तपाइँको गुनासोहरु)</p>
            </div>
            <a href="form.php" class="bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 shadow-lg hover:shadow-xl">
                <span class="material-symbols-outlined">add</span>
                New Grievance
            </a>
        </div>

        <?php if (isset($_GET['submitted'])): ?>
            <div class="bg-green-50 border-l-4 border-green-500 p-4">
                <p class="text-green-700 font-bold">Success</p>
                <p class="text-green-600 text-sm">Your grievance has been submitted successfully! Reference ID: <strong><?php echo htmlspecialchars($_GET['ref']); ?></strong></p>
            </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-bold uppercase">Total Submitted</p>
                    <p class="text-3xl font-black text-[#111418] mt-1"><?php echo count($grievances); ?></p>
                </div>
                <div class="size-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">list_alt</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-bold uppercase">Pending</p>
                    <p class="text-3xl font-black text-orange-600 mt-1">
                        <?php echo count(array_filter($grievances, fn($g) => $g['status'] == 'Pending')); ?>
                    </p>
                </div>
                <div class="size-12 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">hourglass_top</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-bold uppercase">Resolved</p>
                    <p class="text-3xl font-black text-green-600 mt-1">
                        <?php echo count(array_filter($grievances, fn($g) => $g['status'] == 'Resolved')); ?>
                    </p>
                </div>
                <div class="size-12 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">check_circle</span>
                </div>
            </div>
        </div>

        <!-- Grievance List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-bold tracking-wider">
                            <th class="px-6 py-4">Ref ID</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Submission Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (count($grievances) > 0): ?>
                            <?php foreach ($grievances as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-bold text-[#111418]">
                                        <?php echo htmlspecialchars($row['reference_id']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-700">
                                        <?php echo htmlspecialchars($row['category']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php 
                                            $statusColor = match($row['status']) {
                                                'Pending' => 'bg-orange-100 text-orange-800',
                                                'In Progress' => 'bg-blue-100 text-blue-800',
                                                'Resolved' => 'bg-green-100 text-green-800',
                                                'Rejected' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold <?php echo $statusColor; ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($row['attachment']): ?>
                                            <a href="uploads/<?php echo htmlspecialchars($row['attachment']); ?>" target="_blank" class="text-secondary hover:text-blue-800 text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">attachment</span> View File
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs italic">No Attachment</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="material-symbols-outlined text-4xl text-gray-300">inbox</span>
                                        <p>No grievances submitted yet.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

</body>
</html>
