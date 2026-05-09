<?php 
// Start the session 
session_start(); 
 
// Check if the user is already logged in 
if (isset($_SESSION['user_id'])) { 
    header("Location: swantana.php"); // Redirect to dashboard if already logged in 
    exit(); 
} 
 
// Database connection (replace with your database credentials) 
$host = 'localhost'; 
$db = 'swantana'; 
$user = 'root'; 
$pass = ''; 
 
$conn = new mysqli($host, $user, $pass, $db); 
 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
// Handle form submission 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Sanitize and validate input data 
    $username = htmlspecialchars(trim($_POST['username'])); 
    $password = $_POST['password']; 
 
    // Fetch user from the database 
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?"; 
    $stmt = $conn->prepare($sql); 
    if ($stmt) { 
        $stmt->bind_param("s", $username); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
 
        if ($result->num_rows == 1) { 
            $user = $result->fetch_assoc(); 
            if (password_verify($password, $user['password'])) { 
                // Login successful 
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['username'] = $user['username']; 
                $_SESSION['role'] = $user['role']; // Store user role in session 
 
                // Redirect based on role 
                if ($user['role'] == 'admin') { 
                    header("Location: admin.php"); // Redirect to admin page 
                } else { 
                    header("Location: swantana.php"); // Redirect to homepage 
                } 
                exit(); 
            } else { 
                $error = "Invalid username or password."; 
            } 
        } else { 
            $error = "Invalid username or password."; 
        } 
        $stmt->close(); 
    } else { 
        $error = "Database error. Please try again."; 
    } 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login - Swantana Charitable Trust</title> 
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
 
        /* Login Container */ 
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
 
        /* Additional Links (e.g., Forgot Password) */ 
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
 
        /* Error Messages */ 
        .error { 
            color: #ff4d4d; 
            font-size: 0.9rem; 
            margin-top: 5px; 
            display: block; 
            font-weight: 500; 
        } 
 
        .invalid { 
            border-color: #ff4d4d !important; 
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
        <h2>Login to Swantana Charitable Trust</h2> 
        <?php if (isset($error)): ?> 
            <div class="error"><?php echo $error; ?></div> 
        <?php endif; ?> 
        <form method="post" action=""> 
            <label for="username">Username:</label> 
            <input type="text" id="username" name="username" required> 
 
            <label for="password">Password:</label> 
            <input type="password" id="password" name="password" required> 
 
            <button type="submit">Login</button> 
        </form> 
        <p>Don't have an account? <a href="register.php">Register here</a>.</p> 
    </div> 
</body> 
</html> 
 
 
Profile.php: 
<?php 
session_start(); 
 
// Redirect if not logged in 
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
} 
 
// Database connection with error handling 
$host = 'localhost'; 
$db   = 'swantana'; 
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4'; 
 
$conn = new mysqli($host, $user, $pass, $db); 
 
// Check connection 
if ($conn->connect_error) { 
    error_log("Connection failed: " . $conn->connect_error); 
    die("We're experiencing technical difficulties. Please try again later."); 
} 
 
// Fetch user data with prepared statement 
$user = null; 
try { 
    $stmt = $conn->prepare("SELECT username, role, email, created_at FROM users 
WHERE id = ?"); 
    if (!$stmt) { 
        throw new Exception("Prepare failed: " . $conn->error); 
    } 
     
    $stmt->bind_param("i", $_SESSION['user_id']); 
    if (!$stmt->execute()) { 
        throw new Exception("Execute failed: " . $stmt->error); 
    } 
     
    $result = $stmt->get_result(); 
    $user = $result->fetch_assoc(); 
     
    if (!$user) { 
        session_destroy(); 
        header("Location: login.php"); 
        exit(); 
    } 
     
    $stmt->close(); 
} catch (Exception $e) { 
    error_log("Database error: " . $e->getMessage()); 
    die("We're experiencing technical difficulties. Please try again later."); 
} 
 
$conn->close(); 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Your Profile - Swantana</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font
awesome/6.0.0/css/all.min.css"> 
    <style> 
        :root { 
            --primary-color: #004080; 
            --secondary-color: #f8f9fa; 
            --accent-color: #ffcc00; 
        } 
         
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f4f9; 
            margin: 0; 
            padding: 0; 
            color: #333; 
        } 
         
        .profile-container { 
            max-width: 800px; 
            margin: 2rem auto; 
            padding: 2rem; 
            background: white; 
            border-radius: 10px; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
        } 
         
        .profile-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 2rem; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 1rem; 
        } 
         
        .profile-avatar { 
            width: 100px; 
            height: 100px; 
            border-radius: 50%; 
            background-color: var(--primary-color); 
            color: white; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 2.5rem; 
            font-weight: bold; 
        } 
         
        .profile-details { 
            margin-top: 2rem; 
        } 
         
        .detail-row { 
            display: flex; 
            margin-bottom: 1rem; 
            padding: 1rem; 
            background: var(--secondary-color); 
            border-radius: 5px; 
        } 
         
        .detail-label { 
            font-weight: 600; 
            min-width: 150px; 
            color: var(--primary-color); 
        } 
         
     
        .btn { 
            padding: 0.75rem 1.5rem; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: 600; 
            transition: all 0.3s ease; 
            text-decoration: none; 
            display: inline-flex; 
            align-items: center; 
            gap: 0.5rem; 
        } 
        
         
        .btn-home { 
            background: #004080; 
            color: white; 
        } 
         
        .btn-home:hover { 
            background: #003366; 
            transform: translateY(-2px); 
        } 
         
        .btn-logout { 
            background: #d9534f; 
            color: white; 
        } 
         
        .btn-logout:hover { 
            background: #c9302c; 
            transform: translateY(-2px); 
        } 
         
        .btn-primary { 
            background-color: var(--primary-color); 
            color: white; 
        } 
         
        .btn-primary:hover { 
            background-color: #002d5a; 
        } 
         
        .btn-danger { 
            background-color: #dc3545; 
            color: white; 
        } 
         
        .btn-danger:hover { 
            background-color: #bb2d3b; 
        } 
         
        .btn-secondary { 
            background-color: #6c757d; 
            color: white; 
        } 
         
        .btn-secondary:hover { 
            background-color: #5a6268; 
        } 
         
        @media (max-width: 768px) { 
            .profile-container { 
                margin: 1rem; 
                padding: 1rem; 
            } 
             
            .detail-row { 
                flex-direction: column; 
            } 
             
            .detail-label { 
                margin-bottom: 0.5rem; 
            } 
        } 
    </style> 
</head> 
<body> 
    <?php include 'header.php'; ?> 
     
    
    <div class="profile-container"> 
    <a href="swantana.php" class="btn btn-home"> 
                <i class="fas fa-home"></i> Home 
            </a> 
             
            <!-- Logout Button --> 
            <a href="logout.php" class="btn btn-logout"> 
                <i class="fas fa-sign-out-alt"></i> Logout 
            </a> 
        <div class="profile-header"> 
            <h2><i class="fas fa-user-circle"></i> Your Profile</h2> 
            <div class="profile-avatar"> 
                <?php echo strtoupper(substr($user['username'], 0, 1)); ?> 
            </div> 
        </div> 
         
        <div class="profile-details"> 
            <div class="detail-row"> 
                <span class="detail-label"><i class="fas fa-user"></i> Username:</span> 
                <span><?php echo htmlspecialchars($user['username']); ?></span> 
            </div> 
             
            <div class="detail-row"> 
                <span class="detail-label"><i class="fas fa-shield-alt"></i> Account Type:</span> 
                <span><?php echo htmlspecialchars(ucfirst($user['role'])); ?></span> 
            </div> 
             
            <div class="detail-row"> 
                <span class="detail-label"><i class="fas fa-envelope"></i> Email:</span> 
                <span><?php echo htmlspecialchars($user['email']); ?></span> 
            </div> 
             
            <div class="detail-row"> 
                <span class="detail-label"><i class="fas fa-calendar-alt"></i> Member 
Since:</span> 
                <span><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span> 
            </div> 
        </div> 
         
         
    </div> 
 
    <?php include 'footer.php'; ?> 
</body> 
</html> 
 
 
Logout.php: 
<?php 
// Start the session 
session_start(); 
 
// Unset all session variables 
$_SESSION = array(); 
 
// Destroy the session 
session_destroy(); 
 
// Redirect to the login page 
header("Location: swantana.php"); 
exit(); 
?> 
 
Home_button.php: 
<button class="home-btn" onclick="window.location.href='swantana.php'"> 
  <i class="fas fa-home"></i> Home 
</button> 
 
Auth.php: 
<?php 
session_start(); 
include 'swantana.php'; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
 
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE 
username = ?"); 
    $stmt->bind_param("s", $username); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
 
    if ($row = $result->fetch_assoc()) { 
        if (password_verify($password, $row['password'])) { 
            $_SESSION['user_id'] = $row['id']; 
            $_SESSION['username'] = $row['username']; 
            $_SESSION['role'] = $row['role']; 
 
            // Redirect based on role 
            header("Location: " . ($_SESSION['role'] == 'admin' ? "admin.php" : "index.php")); 
            exit(); 
        } 
    } 
    echo "Invalid login credentials."; 
} 
?> 
 
Header.php: 
 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Swantana</title> 
    <meta charset="UTF-8"> 
    <!-- All your meta tags --> 
    <link rel="stylesheet" href="style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
</head> 
<body> 
    <header> 
        Swantana Charitable Trust 
    </header> 
       
    <nav> 
        <!-- The dynamic nav we created earlier --> 
    </nav> 
     
    <?php if(isset($_SESSION['user_id'])): ?> 
        <div class="user-greeting"> 
            Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>! 
        </div> 
    <?php endif; ?> 
Footer.php: 
    <footer> 
        &copy; 2025 Swantana Charitable Trust. All rights reserved. 
    </footer> 
    <script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body> 
</html>