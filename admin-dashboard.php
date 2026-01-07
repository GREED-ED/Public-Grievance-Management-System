<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in and is ADMIN
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // If citizen, redirect to user dashboard
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'citizen') {
        header("Location: user-dashboard.php");
        exit();
    }
    header("Location: login.php");
    exit();
}

$success_msg = '';
$error_msg = '';

// Handle Status Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $g_id = $_POST['grievance_id'];
    $new_status = $_POST['status'];
    
    $sql = "UPDATE grievances SET status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$new_status, $g_id])) {
        $success_msg = "Status updated successfully.";
    } else {
        $error_msg = "Failed to update status.";
    }
}

// Fetch All Grievances with User Info
$sql = "SELECT g.*, u.full_name, u.mobile FROM grievances g JOIN users u ON g.user_id = u.id ORDER BY g.created_at DESC";
$stmt = $pdo->query($sql);
$grievances = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard - Public Grievance Management System</title>
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
                <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-secondary text-white text-sm font-bold hover:bg-blue-800 transition-colors shadow-sm gap-2" onclick="window.location.href='admin-dashboard.php'">
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
    <div class="max-w-[1440px] mx-auto space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#111418]">Grievance Overview</h2>
                <p class="text-gray-500 mt-1">Manage all citizen complaints</p>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 flex flex-col">
                    <span class="text-xs text-gray-500 font-bold uppercase">Total</span>
                    <span class="text-xl font-black text-[#111418]"><?php echo count($grievances); ?></span>
                </div>
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-orange-200 flex flex-col">
                    <span class="text-xs text-orange-600 font-bold uppercase">Pending</span>
                    <span class="text-xl font-black text-orange-600"><?php echo count(array_filter($grievances, fn($g) => $g['status'] == 'Pending')); ?></span>
                </div>
            </div>
        </div>

        <?php if ($success_msg): ?>
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded shadow-sm">
                <p class="text-green-800 font-bold"><?php echo $success_msg; ?></p>
            </div>
        <?php endif; ?>

        <!-- Grievance Table -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Ref ID</th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Citizen</th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Details</th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Location</th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Attachment</th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (count($grievances) > 0): ?>
                            <?php foreach ($grievances as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-800 text-sm"><?php echo htmlspecialchars($row['reference_id']); ?></span>
                                        <div class="text-xs text-gray-500 mt-1"><?php echo date('d M Y', strtotime($row['created_at'])); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-sm text-gray-900"><?php echo htmlspecialchars($row['full_name']); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row['mobile']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <div class="inline-block px-2 py-0.5 rounded text-xs font-bold bg-blue-50 text-blue-700 mb-1">
                                            <?php echo htmlspecialchars($row['category']); ?>
                                        </div>
                                        <p class="text-sm text-gray-600 line-clamp-2" title="<?php echo htmlspecialchars($row['description']); ?>">
                                            <?php echo htmlspecialchars($row['description']); ?>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <?php echo htmlspecialchars($row['location_district']); ?><br>
                                        <span class="text-xs text-gray-400"><?php echo htmlspecialchars($row['location_municipality']); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($row['attachment']): ?>
                                            <a href="uploads/<?php echo htmlspecialchars($row['attachment']); ?>" target="_blank" class="text-secondary hover:underline text-xs font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">attach_file</span> View
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-300 text-xs">-</span>
                                        <?php endif; ?>
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
                                        <form method="POST" class="flex items-center gap-2">
                                            <input type="hidden" name="grievance_id" value="<?php echo $row['id']; ?>">
                                            <select name="status" class="text-xs rounded border-gray-300 py-1 pl-2 pr-6 focus:ring-primary focus:border-primary">
                                                <option value="Pending" <?php echo $row['status']=='Pending'?'selected':''; ?>>Pending</option>
                                                <option value="In Progress" <?php echo $row['status']=='In Progress'?'selected':''; ?>>In Progress</option>
                                                <option value="Resolved" <?php echo $row['status']=='Resolved'?'selected':''; ?>>Resolved</option>
                                                <option value="Rejected" <?php echo $row['status']=='Rejected'?'selected':''; ?>>Rejected</option>
                                            </select>
                                            <button type="submit" name="update_status" class="p-1 rounded bg-gray-200 hover:bg-primary hover:text-white transition-colors text-gray-600" title="Save Status">
                                                <span class="material-symbols-outlined text-base block">save</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    No records found.
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
