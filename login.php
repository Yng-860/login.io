<?php
include "db.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql="SELECT * FROM students where email = '$email' and password = '$password'";
    $result = $db->query($sql);
    if($result->num_rows>0){

    header("Location: dashboard.php");
    exit(); 
} else {
    echo "login error: " . mysqli_error($db);
}
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
         * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        body { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
        }

        .box { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); 
            width: 100%; 
            max-width: 400px; 
        }

        h2 { 
            text-align: center; 
            margin-bottom: 24px; 
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            color: #666;
            font-size: 14px;
        }

        input { 
            width: 100%; 
            padding: 12px 16px; 
            border: 1px solid #ddd; 
            border-radius: 6px; 
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
            background-color: #f9f9f9;
        }

        input:focus {
            border-color: #764ba2;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(118, 75, 162, 0.15);
        }

        button { 
            width: 100%; 
            padding: 12px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);  
            color: white; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            font-size: 16px;
            font-weight: 600;
            transition: opacity 0.2s ease, transform 0.1s ease;
            margin-top: 10px;
        }

        button:hover {
            opacity: 0.9;
        }

        button:active {
            transform: scale(0.98);
        }

        /* Message Styles */
        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            font-weight: 500;
        }

        .alert.success {
            background-color: #e6fffa;
            color: #0b69a3;
            border: 1px solid #b2f5ea;
            color: #234e52;
        }

        .alert.error {
            background-color: #fff5f5;
            border: 1px solid #fed7d7;
            color: #9b2c2c;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login</h2>
        <form  method="Post">
            <input type="email" placeholder="E-mail" id="email" name="email"required>
            <input type="password" placeholder="Password" id="password" name="password" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
