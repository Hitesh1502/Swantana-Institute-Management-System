<?php 
session_start(); 
 
// Database connection 
$host = 'localhost'; 
$db = 'swantana'; 
$user = 'root'; 
$pass = ''; 
 
$conn = new mysqli($host, $user, $pass, $db); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Sanitize and validate input data 
    $username = htmlspecialchars(trim($_POST['username'])); 
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = 'user'; // Default role 
 
// Check if email is valid 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error = "Invalid email format."; 
    } else { 
        // Check if user already exists 
        $check_sql = "SELECT id FROM users WHERE email = ?"; 
        $check_stmt = $conn->prepare($check_sql); 
        if ($check_stmt) { 
            $check_stmt->bind_param("s", $email); 
            $check_stmt->execute(); 
            $check_stmt->store_result(); 
             
            if ($check_stmt->num_rows > 0) { 
                $error = "This email is already registered. Please use a different email ."; 
            } else { 
          // Insert user into the database 
          $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)"; 
          $stmt = $conn->prepare($sql); 
          if ($stmt) { 
              $stmt->bind_param("ssss", $username, $email, $password, $role); 
 
              if ($stmt->execute()) { 
                  $success = "Registration successful! You can now login."; 
              } else { 
                  $error = "Registration failed. Please try again. Error: " . $stmt->error; 
              } 
              $stmt->close(); 
          } else { 
              $error = "Database error. Please try again."; 
          } 
      } 
      $check_stmt->close(); 
  } else { 
      $error = "Database error. Please try again."; 
  } 
} 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Register - Swantana Charitable Trust</title> 
    <link rel="stylesheet" href="style.css"> 
    <style> 
       body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #f4f4f9, #e0e0f5); 
            margin: 0; 
            padding: 0; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            color: #333; 
        } 
 
        /* Registration Container */ 
        .login-container { 
            background-color: #fff; 
            padding: 2.5rem; 
            border-radius: 12px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 
            width: 100%; 
            max-width: 400px; 
            margin: 20px; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        } 
 
        .login-container:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); 
        } 
 
        h2 { 
            text-align: center; 
            color: #004080; 
            margin-bottom: 2rem; 
            font-size: 2.2rem; 
            font-weight: 600; 
            letter-spacing: -0.5px; 
        } 
 
        /* Form Labels */ 
        label { 
            display: block; 
            margin-bottom: 0.75rem; 
            font-weight: 600; 
            color: #444; 
            font-size: 0.95rem; 
        } 
 
        /* Input Fields */ 
        input[type="text"], 
        input[type="email"], 
        input[type="password"] { 
            width: 100%; 
            padding: 0.85rem; 
            margin-bottom: 1.25rem; 
            border: 1px solid #ddd; 
            border-radius: 6px; 
            font-size: 1rem; 
            box-sizing: border-box; 
            transition: border-color 0.3s ease, box-shadow 0.3s ease; 
            background-color: #f9f9f9; 
        } 
 
      
        input[type="text"]:focus, 
        input[type="email"]:focus, 
        input[type="password"]:focus { 
            border-color: #007bff; 
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3); 
            outline: none; 
            background-color: #fff; 
        } 
 
        /* Submit Button */ 
        button { 
            width: 100%; 
            padding: 0.85rem; 
            background: linear-gradient(135deg, #004080, #002d5a); 
            color: #fff; 
            border: none; 
            border-radius: 6px; 
            font-size: 1rem; 
            font-weight: 600; 
            cursor: pointer; 
            transition: background 0.3s ease, transform 0.3s ease; 
        } 
 
        button:hover { 
            background: linear-gradient(135deg, #002d5a, #004080); 
            transform: translateY(-2px); 
        } 
 
        button:active { 
            transform: translateY(0); 
        } 
 
        /* Additional Links (e.g., Login Link) */ 
        .additional-links { 
            text-align: center; 
            margin-top: 1.5rem; 
        } 
 
        .additional-links a { 
            color: #007bff; 
            text-decoration: none; 
            font-weight: 500; 
            transition: color 0.3s ease; 
        } 
 
        .additional-links a:hover { 
            color: #0056b3; 
        } 
 
        /* Success and Error Messages */ 
        .success { 
            color: #28a745; 
            font-size: 0.95rem; 
            margin-bottom: 1.5rem; 
            text-align: center; 
            font-weight: 500; 
        } 
 
        .error { 
            color: #ff4d4d; 
            font-size: 0.95rem; 
            margin-bottom: 1.5rem; 
            text-align: center; 
            font-weight: 500; 
        } 
 
        /* Responsive Design */ 
        @media (max-width: 768px) { 
            .login-container { 
                padding: 1.5rem; 
            } 
 
            h2 { 
                font-size: 1.8rem; 
            } 
 
            input[type="text"], 
            input[type="password"] { 
                font-size: 0.95rem; 
                padding: 0.75rem; 
            } 
 
            button { 
                font-size: 0.95rem; 
                padding: 0.75rem; 
            } 
        } 
    </style> 
</head> 
<body> 
     
    <div class="login-container"> 
        <h2>Register for Swantana Charitable Trust</h2> 
        <?php if (isset($success)): ?> 
            <div class="success"><?php echo $success; ?></div> 
        <?php endif; ?> 
        <?php if (isset($error)): ?> 
            <div class="error"><?php echo $error; ?></div> 
        <?php endif; ?> 
        <form method="post" action=""> 
            <label for="username">Username:</label> 
            <input type="text" id="username" name="username" required> 
 
             
             <label for="email">Email:</label> 
             <input type="email" id="email" name="email" required> 
 
            <label for="password">Password:</label> 
            <input type="password" id="password" name="password" required> 
 
            <button type="submit">Register</button> 
        </form> 
        <p>Already have an account? <a href="login.php">Login here</a>.</p> 
    </div> 
</body> 
</html>