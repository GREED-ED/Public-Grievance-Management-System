<?php
require_once 'includes/languages.php';
require_once 'db_connect.php';

// Check if user is logged in and is ADMIN
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // If citizen, redirect to user dashboard
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'citizen') {
        header("Location: user-dashboard.php?lang=" . $_SESSION['lang']);
        exit();
    }
    header("Location: login.php?lang=" . $_SESSION['lang']);
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
<html class="light" lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo __('admin_dashboard'); ?> - <?php echo __('system_name'); ?></title>
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

<?php include 'includes/navbar.php'; ?>

<main class="flex-grow py-8 px-4 sm:px-6">
    <div class="max-w-[1440px] mx-auto space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#111418]"><?php echo __('grievance_overview'); ?></h2>
                <p class="text-gray-500 mt-1"><?php echo __('manage_complaints_desc'); ?></p>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 flex flex-col">
                    <span class="text-xs text-gray-500 font-bold uppercase"><?php echo __('total'); ?></span>
                    <span class="text-xl font-black text-[#111418]"><?php echo count($grievances); ?></span>
                </div>
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-orange-200 flex flex-col">
                    <span class="text-xs text-orange-600 font-bold uppercase"><?php echo __('pending'); ?></span>
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
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('ref_id'); ?></th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('citizen'); ?></th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('details'); ?></th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('location'); ?></th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('attachment'); ?></th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('status'); ?></th>
                            <th class="px-6 py-4 text-xs uppercase text-gray-600 font-bold tracking-wider"><?php echo __('action'); ?></th>
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
                                            $statusKey = match($row['status']) {
                                                'Pending' => 'status_pending',
                                                'In Progress' => 'status_in_progress',
                                                'Resolved' => 'status_resolved',
                                                'Rejected' => 'status_rejected',
                                                default => 'status_pending'
                                            };
                                            $statusColor = match($row['status']) {
                                                'Pending' => 'bg-orange-100 text-orange-800',
                                                'In Progress' => 'bg-blue-100 text-blue-800',
                                                'Resolved' => 'bg-green-100 text-green-800',
                                                'Rejected' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold <?php echo $statusColor; ?>">
                                            <?php echo __( $statusKey ); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="POST" class="flex items-center gap-2">
                                            <input type="hidden" name="grievance_id" value="<?php echo $row['id']; ?>">
                                            <select name="status" class="text-xs rounded border-gray-300 py-1 pl-2 pr-6 focus:ring-primary focus:border-primary">
                                                <option value="Pending" <?php echo $row['status']=='Pending'?'selected':''; ?>><?php echo __('status_pending'); ?></option>
                                                <option value="In Progress" <?php echo $row['status']=='In Progress'?'selected':''; ?>><?php echo __('status_in_progress'); ?></option>
                                                <option value="Resolved" <?php echo $row['status']=='Resolved'?'selected':''; ?>><?php echo __('status_resolved'); ?></option>
                                                <option value="Rejected" <?php echo $row['status']=='Rejected'?'selected':''; ?>><?php echo __('status_rejected'); ?></option>
                                            </select>
                                            <button type="submit" name="update_status" class="p-1 rounded bg-gray-200 hover:bg-primary hover:text-white transition-colors text-gray-600" title="<?php echo __('save_status'); ?>">
                                                <span class="material-symbols-outlined text-base block">save</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <?php echo __('no_records_found'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
    </div>
</footer>

</body>
</html>
