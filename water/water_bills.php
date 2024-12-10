<?php
// Initialize error message variable
$error_message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $account_number = $_POST['account_number'] ?? '';
    $account_name = $_POST['account_name'] ?? '';
    $email_address = $_POST['email_address'] ?? '';
    $bill_protect = isset($_POST['bill_protect']) ? 'Yes' : 'No'; // Checkbox value

    // Basic form validation
    if (empty($account_number) || empty($account_name)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!preg_match('/^\d{9,12}$/', $account_number)) {
        $error_message = 'Account number must be between 9 and 12 digits.';
    } else {
        // Here, you can process the form data, e.g., save it to a database
        // For now, we just redirect to a confirmation page (or you could display success message)
        header('Location: confirmation.php');
        exit(); // Stop further execution after redirect
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pay Bills</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <i class="fas fa-arrow-left"></i>
        <h1 class="text-lg font-semibold">Pay Bills</h1>
        <div class="flex items-center space-x-2">
            <span>11:09</span>
            <i class="fas fa-signal"></i>
            <i class="fas fa-wifi"></i>
            <i class="fas fa-battery-half"></i>
        </div>
    </div>

    <div class="bg-white p-4">
        <div class="flex items-center space-x-4">
            <img alt="Company logo" class="w-12 h-12" height="50" src="https://storage.googleapis.com/a1aa/image/P8n073wScs5eFCeA4NKdFfYU08JbAUKLXW303IcxwgKIasynA.jpg" width="50"/>
            <div>
                <h2 class="text-lg font-semibold">8TH ARK MANAGEMENT CORPORATION</h2>
                <p class="text-gray-500">Posting Period: <span class="font-semibold">next business day</span></p>
            </div>
        </div>

        <?php if ($error_message): ?>
            <div class="text-red-500 mt-4">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <div class="flex justify-between items-center">
                <span class="text-lg font-semibold">PHP</span>
                <span class="text-4xl text-gray-300">0.00</span>
            </div>
            <p class="text-gray-500 mt-2">
                You will be charged a service fee of <span class="font-semibold">PHP 10.00</span>
            </p>
        </div>

        <form action="pay_bills.php" method="post">
            <div class="mt-4">
                <label class="block text-gray-700 font-semibold">9-12 Digit Account Number</label>
                <input class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Enter 9-12 Digit Account Number" type="text" name="account_number" value="<?php echo htmlspecialchars($account_number); ?>" required/>
            </div>
            <div class="mt-4">
                <label class="block text-gray-700 font-semibold">Account Name</label>
                <input class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Enter Account Name" type="text" name="account_name" value="<?php echo htmlspecialchars($account_name); ?>" required/>
            </div>
            <div class="mt-4">
                <label class="block text-gray-700 font-semibold">Email Address</label>
                <input class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Enter Email Address (optional)" type="email" name="email_address" value="<?php echo htmlspecialchars($email_address); ?>"/>
            </div>

            <div class="mt-4 bg-blue-50 p-4 rounded">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    <h3 class="text-blue-500 font-semibold">Protect your bills now, thank us later!</h3>
                </div>
                <p class="text-gray-700 mt-2">
                    Get 36 months of coverage, for less than 1% of your bill amount! 
                    <a class="text-blue-500 underline" href="#">Learn more about GInsure Bill Protect</a>
                </p>
                <div class="flex items-center mt-2">
                    <input class="mr-2" id="bill-protect" type="checkbox" name="bill_protect"/>
                    <label class="text-gray-700" for="bill-protect">
                        Yes! I agree to pay PHP 0.00, and get GInsure Bill Protect! 
                        <a class="text-blue-500 underline" href="#">View Group Policy</a>
                    </label>
                </div>
            </div>

            <p class="text-center text-gray-500 mt-4">Can accept with Due Date and Past Due payments.</p>

            <button class="w-full bg-blue-600 text-white py-3 rounded mt-4">NEXT</button>
        </form>
    </div>
</body>
</html>
