<?php 
include 'con_connect.php'; 
$success = ""; 
$error = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $subject = $_POST['subject']; 
    $message = $_POST['message']; 
 
    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', 
'$email', '$subject', '$message')"; 
 
    if ($conn->query($sql) === TRUE) { 
        $success = "Message sent successfully!"; 
        echo "<script>alert('$success');</script>"; 
    } else { 
        $error = "Error: " . $sql . "<br>" . $conn->error; 
    } 
    $conn->close(); 
} 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Contact Us</title> 
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
 
        /* Contact Container */ 
        .contact-container { 
            background-color: #fff; 
            padding: 2.5rem; 
            border-radius: 12px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 
            width: 100%; 
            max-width: 500px; 
            margin: 20px; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        } 
 
        .contact-container:hover { 
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
        textarea { 
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
        textarea:focus { 
            border-color: #007bff; 
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3); 
            outline: none; 
            background-color: #fff; 
        } 
 
        textarea { 
            resize: vertical; 
            height: 150px; 
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
            .contact-container { 
                padding: 1.5rem; 
            } 
 
            h2 { 
                font-size: 1.8rem; 
            } 
 
            input[type="text"], 
            input[type="email"], 
            textarea { 
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
    <div class="contact-container"> 
        <h2>Contact Us</h2> 
        <p align='center'>Email: swantanact@gmail.com</p> 
        <p align='center'>Phone: +91 9381185059</p> 
        <?php if (!empty($error)): ?> 
            <div class="error"><?php echo $error; ?></div> 
        <?php endif; ?> 
 
        <form action="contact.php" method="POST"> 
            <label for="name">Name:</label> 
            <input type="text" id="name" name="name" required> 
 
            <label for="email">Email:</label> 
            <input type="email" id="email" name="email" required> 
 
            <label for="subject">Subject:</label> 
            <input type="text" id="subject" name="subject" required> 
 
            <label for="message">Message:</label> 
            <textarea id="message" name="message" required></textarea> 
 
            <button type="submit">Send</button> 
        </form> 
    </div> 
 
</body> 
</html> 
 
Con_connect.php: 
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "swantana"; 
 
$conn = new mysqli($servername, $username, $password, $dbname); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
?> 