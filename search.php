<?php
 include "db.php";
 
 
?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="students.css">
        <title>Document</title>
    </head>
    <body>
        <form method="post">
        <label for="student_id">Search student by id:</label>
       <input type="text" name="student_id" id="student_id">
       
        <button type="submit">Submit</button>
</form>
 
         <table>
            <tr>
                <th>Full name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Semester</th>
            </tr>
            <?php   
    if (isset($_POST['student_id'])) {
    $studentid = $_POST['student_id'];
    $sql2 = "SELECT * FROM students WHERE student_id = '$studentid'";
    $result = mysqli_query($db, $sql2);

    
    if ($result) {
        while($row = mysqli_fetch_array($result)){
             echo "<tr>";    
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "<td>$row[5]</td>";
                echo "<td>$row[6]</td>";
                echo "</tr>";
        }
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

        ?>
</table>
</body>