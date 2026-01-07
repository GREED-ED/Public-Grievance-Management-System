<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $municipality = $_POST['municipality'];
    
    // File Upload Logic
    $attachment = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_name = time() . '_' . basename($_FILES['attachment']['name']);
        $target_file = $upload_dir . $file_name;
        
        // Simple check for image/pdf
        $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'pdf'])) {
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
                $attachment = $file_name;
            } else {
                $error = "Failed to upload file.";
            }
        } else {
            $error = "Only JPG, PNG, and PDF files are allowed.";
        }
    }

    if (empty($error)) {
        // Generate Reference ID
        $reference_id = 'GRV-' . date('Y') . '-' . rand(1000, 9999);
        
        $sql = "INSERT INTO grievances (user_id, category, description, location_province, location_district, location_municipality, attachment, reference_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        try {
            $stmt->execute([$user_id, $category, $description, $province, $district, $municipality, $attachment, $reference_id]);
            // Redirect to dashboard with success
            header("Location: user-dashboard.php?submitted=1&ref=" . $reference_id);
            exit();
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Submit Grievance - Nepal Government</title>
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
                        "primary": "#DC143C", /* Nepal Crimson (Red) */
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
                <button class="flex items-center justify-center rounded-lg h-9 px-4 bg-secondary text-white text-sm font-bold hover:bg-blue-800 transition-colors shadow-sm gap-2" onclick="window.location.href='<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? 'admin-dashboard.php' : 'user-dashboard.php'; ?>'">
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
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="user-dashboard.php" class="inline-flex items-center gap-1 text-sm font-medium text-gray-500 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Back to Dashboard
            </a>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <p class="text-red-700 font-bold">Error</p>
                <p class="text-red-600 text-sm"><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-surface rounded-xl shadow-lg border-t-4 border-primary overflow-hidden">
            
            <div class="px-6 py-6 border-b border-gray-100 bg-gray-50">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-black text-[#111418] flex items-center gap-2">
                            Submit a Grievance
                        </h2>
                        <p class="text-lg text-primary font-medium mt-1">(गुनासो दर्ता फारम)</p>
                    </div>
                    <div class="hidden sm:flex size-12 items-center justify-center rounded-full bg-blue-50 text-secondary">
                        <span class="material-symbols-outlined text-3xl">edit_document</span>
                    </div>
                </div>
                <p class="mt-2 text-gray-600 text-sm">Please fill out the form below. Fields marked with <span class="text-red-500">*</span> are mandatory.</p>
            </div>

            <form action="form.php" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
                
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-2 border-b border-gray-200">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h3 class="text-lg font-bold text-[#111418]">
                            Reporting User <span class="text-sm font-normal text-gray-500 ml-1">(विवरण)</span>
                        </h3>
                    </div>
                    <div>
                         <p class="text-gray-700">Logged in as: <span class="font-bold"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></p>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-2 mb-6 pb-2 border-b border-gray-200">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <h3 class="text-lg font-bold text-[#111418]">
                            Location Details <span class="text-sm font-normal text-gray-500 ml-1">(स्थान विवरण)</span>
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block mb-1.5">
                                <span class="block text-sm font-bold text-gray-800">Province</span>
                                <select name="province" class="w-full h-11 px-3 rounded-lg border-gray-300 focus:border-secondary focus:ring-secondary shadow-sm text-sm bg-white">
                                    <option>Bagmati Province</option>
                                    <option>Gandaki Province</option>
                                    <option>Lumbini Province</option>
                                    <option>Koshi Province</option>
                                </select>
                                <span class="text-xs text-gray-400 mt-1">प्रदेश</span>
                            </label>
                        </div>
                        <div>
                            <label class="block mb-1.5">
                                <span class="block text-sm font-bold text-gray-800">District</span>
                                <select name="district" class="w-full h-11 px-3 rounded-lg border-gray-300 focus:border-secondary focus:ring-secondary shadow-sm text-sm bg-white">
                                    <option>Kathmandu</option>
                                    <option>Lalitpur</option>
                                    <option>Bhaktapur</option>
                                    <option>Kaski</option>
                                </select>
                                <span class="text-xs text-gray-400 mt-1">जिल्ला</span>
                            </label>
                        </div>
                        <div>
                            <label class="block mb-1.5">
                                <span class="block text-sm font-bold text-gray-800">Municipality</span>
                                <select name="municipality" class="w-full h-11 px-3 rounded-lg border-gray-300 focus:border-secondary focus:ring-secondary shadow-sm text-sm bg-white">
                                    <option>Kathmandu Metro</option>
                                    <option>Lalitpur Metro</option>
                                    <option>Kirtipur</option>
                                </select>
                                <span class="text-xs text-gray-400 mt-1">नगरपालिका / गाउँपालिका</span>
                            </label>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-2 mb-6 pb-2 border-b border-gray-200">
                        <span class="material-symbols-outlined text-primary">report_problem</span>
                        <h3 class="text-lg font-bold text-[#111418]">
                            Complaint Details <span class="text-sm font-normal text-gray-500 ml-1">(गुनासो विवरण)</span>
                        </h3>
                    </div>

                    <div class="space-y-6">
                        <div class="max-w-md">
                            <label class="block mb-1.5">
                                <span class="block text-sm font-bold text-gray-800">Category <span class="text-red-500">*</span></span>
                                <select name="category" class="w-full h-11 px-3 rounded-lg border-gray-300 focus:border-secondary focus:ring-secondary shadow-sm text-sm bg-white">
                                    <option>Road Maintenance (सडक मर्मत)</option>
                                    <option>Water Supply (खानेपानी)</option>
                                    <option>Electricity (बिद्युत)</option>
                                    <option>Waste Management (फोहोर व्यवस्थापन)</option>
                                    <option>Corruption / Bribe (भ्रष्टाचार)</option>
                                </select>
                                <span class="text-xs text-gray-400 mt-1">गुनासोको प्रकृति</span>
                            </label>
                        </div>

                        <div>
                            <label class="block mb-1.5">
                                <span class="block text-sm font-bold text-gray-800">Description <span class="text-red-500">*</span></span>
                                <textarea name="description" required class="w-full p-4 rounded-lg border-gray-300 focus:border-secondary focus:ring-secondary shadow-sm text-sm resize-y min-h-[150px]" placeholder="Please describe your grievance in detail so we can help you better..."></textarea>
                                <span class="text-xs text-gray-400 mt-1">गुनासोको विस्तृत विवरण</span>
                            </label>
                        </div>

                        <div>
                            <span class="block text-sm font-bold text-gray-800 mb-1">Attachments (Photo/PDF)</span>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 hover:border-primary transition-all cursor-pointer group">
                                <div class="space-y-2 text-center">
                                    <span class="material-symbols-outlined text-4xl text-gray-400 group-hover:text-primary transition-colors">cloud_upload</span>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label class="relative cursor-pointer rounded-md font-bold text-secondary hover:text-blue-700 focus-within:outline-none" for="file-upload">
                                            <span>Upload a file</span>
                                            <input class="sr-only" id="file-upload" name="attachment" type="file"/>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="pt-6 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <a href="user-dashboard.php" class="w-full sm:w-auto px-6 py-3 border border-gray-300 shadow-sm text-sm font-bold rounded-lg text-gray-700 bg-white hover:bg-gray-50 text-center transition-colors">
                        Cancel (रद्द गर्नुहोस्)
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3 border border-transparent text-sm font-bold rounded-lg text-white bg-primary hover:bg-red-700 shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">send</span>
                        Submit Grievance
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>
