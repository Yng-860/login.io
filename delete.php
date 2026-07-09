<?php
include "db.php";

if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
    $studentid = $_POST['student_id'];
    
   
    $sql2 = "DELETE FROM students WHERE student_id = '$studentid'";
    
    $result = mysqli_query($db, $sql2);

   
    if ($result && mysqli_affected_rows($db) > 0) {
       
        echo "<script>alert('User was successfully deleted');</script>";
    } else {
        echo "<script>alert('User was not found or already deleted');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="students.css">
        <title>Document</title>
    </head>
    <body>
        <form method="post">
            <label for="student_id">Delete student by id:</label>
            <input type="text" name="student_id" id="student_id" required>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
