<?php
include "db.php";

$studentid = "";
$fullname = "";
$email = "";
$phone = "";
$department = "";
$semester = "";
$address = "";
$message = "";


if (isset($_GET['id'])) {
  
    $studentid = mysqli_real_escape_string($db, $_GET['id']);
    
    $sql2 = "SELECT * FROM students WHERE student_id = '$studentid'";
    $result = mysqli_query($db, $sql2);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $department = $row['department'];
        $semester = $row['semester'];
        $address = $row['address'];
    } else {
        $message = "Student profile not found!";
        $studentid = ""; 
    }
}


if (isset($_POST['search_student'])) {
    $studentid = mysqli_real_escape_string($db, $_POST['student_id']);
    
    $sql2 = "SELECT * FROM students WHERE student_id = '$studentid'";
    $result = mysqli_query($db, $sql2);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $department = $row['department'];
        $semester = $row['semester'];
        $address = $row['address'];
    } else {
        $message = "Student profile not found!";
        $studentid = ""; 
    }
}


if (isset($_POST['update_student'])) {
    $studentid = mysqli_real_escape_string($db, $_POST['student_id']);
    $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $department = mysqli_real_escape_string($db, $_POST['department']);
    $semester = mysqli_real_escape_string($db, $_POST['semester']);
    $address = mysqli_real_escape_string($db, $_POST['address']);

    $sql1 = "UPDATE `students` SET 
            `fullname`='$fullname',
            `email`='$email',
            `phone`='$phone',
            `department`='$department',
            `semester`='$semester',
            `address`='$address' 
            WHERE `student_id`='$studentid'";

    if (mysqli_query($db, $sql1)) {
        
        header("Location: dashboard.php");
        exit(); 
    } else {
        $message = "Update error: " . mysqli_error($db);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; }
        .box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); width: 100%; max-width: 500px; }
        h2 { text-align: center; margin-bottom: 24px; color: #333; font-size: 28px; font-weight: 600; }
        h3 { color: #764ba2; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 15px; margin-top: 5px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 6px; color: #555; font-size: 14px; font-weight: 500; }
        input, textarea, select { width: 100%; padding: 12px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 15px; transition: all 0.3s ease; outline: none; background-color: #f9f9f9; }
        textarea { resize: vertical; }
        input:focus, textarea:focus, select:focus { border-color: #764ba2; background-color: #fff; box-shadow: 0 0 0 3px rgba(118, 75, 162, 0.15); }
        .btn { width: 100%; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: 600; transition: opacity 0.2s ease, transform 0.1s ease; margin-top: 5px; }
        .btn:hover { opacity: 0.9; }
        .btn:active { transform: scale(0.98); }
        .btn:disabled { background: #cbd5e1; color: #94a3b8; cursor: not-allowed; opacity: 1; }
        .btn-secondary { display: block; text-align: center; text-decoration: none; background: #e2e8f0; color: #4a5568; font-size: 15px; font-weight: 600; padding: 12px; border-radius: 6px; transition: background 0.2s ease; }
        .btn-secondary:hover { background: #cbd5e1; }
        .divider { height: 1px; background-color: #e2e8f0; margin: 25px 0; }
        .error-msg { color: #ff0000; text-align: center; font-weight: bold; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="box">
        <h2>Update Student</h2>

        <?php if($message != "") { echo "<div class='error-msg'>$message</div>"; } ?>

        <h3>1. Search Student</h3>
        <form action="update.php" method="POST">
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" placeholder="Enter ID (e.g., STU12345)" value="<?php echo htmlspecialchars($studentid); ?>" required>
            </div>
            <button type="submit" name="search_student" class="btn">Find Profile</button>
        </form>

        <div class="divider"></div>

        <h3>2. Edit Information</h3>
        <form action="update.php" method="POST">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($studentid); ?>">

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="John Doe" value="<?php echo htmlspecialchars($fullname); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="johndoe@example.com" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+1 234 567 890" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" name="department" required>
                    <option value="" disabled <?php if($department == "") echo "selected"; ?>>Select department</option>
                    <option value="123" <?php if($department == "123") echo "selected"; ?>>123</option>
                    <option value="456" <?php if($department == "456") echo "selected"; ?>>456</option>
                    <option value="789" <?php if($department == "789") echo "selected"; ?>>789</option>
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <select id="semester" name="semester" required>
                    <option value="" disabled <?php if($semester == "") echo "selected"; ?>>Select Semester</option>
                    <option value="one" <?php if($semester == "one") echo "selected"; ?>>one</option>
                    <option value="two" <?php if($semester == "two") echo "selected"; ?>>two</option>
                    <option value="three" <?php if($semester == "three") echo "selected"; ?>>three</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Residential Address</label>
                <textarea id="address" name="address" rows="3" placeholder="Enter full address details..." required><?php echo htmlspecialchars($address); ?></textarea>
            </div>

            <button type="submit" name="update_student" class="btn" <?php if($studentid == "") echo "disabled"; ?>>Save Modifications</button>
        </form>

        <div class="divider"></div>
        
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

</body>
</html>
