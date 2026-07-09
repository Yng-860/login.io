<?php
include "db.php";

// NOWOŚĆ: Logika usuwania bezpośrednio w tym samym pliku
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    // Zabezpieczenie przed SQL Injection
    $studentid = mysqli_real_escape_string($db, $_GET['id']);
    
    // Zapytanie usuwające
    $sql_delete = "DELETE FROM students WHERE student_id = '$studentid'";
    
    if (mysqli_query($db, $sql_delete)) {
        
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit();
    } else {
        echo "<script>alert('Błąd podczas usuwania: " . mysqli_error($db) . "');</script>";
    }
}


$sql = "SELECT * from students";
$res = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="students.css">
        <title>Document</title>
    </head>
    <body>
        <h2>Student list</h2>
        <table>
            <tr>
                <th>Full name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Actions</th> 
            </tr>
            <?php
            if($res->num_rows > 0){
                while ($row = $res->fetch_array()){
                    echo "<tr>";    
                    echo "<td>" . htmlspecialchars($row[1]) . "</td>"; // Full name
                    echo "<td>" . htmlspecialchars($row[2]) . "</td>"; // Student ID
                    echo "<td>" . htmlspecialchars($row[3]) . "</td>"; // Email
                    echo "<td>" . htmlspecialchars($row[4]) . "</td>"; // Phone
                    echo "<td>" . htmlspecialchars($row[7]) . "</td>"; // Department
                    echo "<td>" . htmlspecialchars($row[8]) . "</td>"; // Semester
                    
                    $student_id_url = urlencode($row[2]); // Pobieramy Student ID do linku
                    
                    // ZMIANA: Link usuwania kieruje na ten sam plik z parametrem action=delete
                    echo "<td>
                            <a href='update.php?id=$student_id_url'>Edit</a> | 
                            <a href='?action=delete&id=$student_id_url' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <br>
        <button><a href="update.php">Add new student</a></button>
</body>
</html>