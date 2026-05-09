<?php 
session_start(); 
$host = 'localhost'; 
$db = 'swantana'; 
$user = 'root'; 
$pass = ''; 
 
$conn = new mysqli($host, $user, $pass, $db); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
// Redirect to login if not logged in 
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
} 
 
// Redirect to homepage if not an admin 
if ($_SESSION['role'] != 'admin') { 
    header("Location: swantana.php"); 
    exit(); 
} 
 
// Fetch users with search and pagination 
$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; 
$limit = 10; 
$offset = ($page - 1) * $limit; 
 
$sql = "SELECT id, username, role FROM users WHERE username LIKE ? LIMIT ? 
OFFSET ?"; 
$stmt = $conn->prepare($sql); 
$search_term = "%$search%"; 
$stmt->bind_param("sii", $search_term, $limit, $offset); 
$stmt->execute(); 
$result = $stmt->get_result(); 
 
// Fetch total number of users for pagination 
$total_sql = "SELECT COUNT(*) AS total FROM users WHERE username LIKE ?"; 
$total_stmt = $conn->prepare($total_sql); 
$total_stmt->bind_param("s", $search_term); 
$total_stmt->execute(); 
$total_result = $total_stmt->get_result(); 
$total_row = $total_result->fetch_assoc(); 
$total_users = $total_row['total']; 
$total_pages = ceil($total_users / $limit); 
 
// Fetch applications with search and pagination 
$app_search = isset($_GET['app_search']) ? $_GET['app_search'] : ''; 
$app_page = isset($_GET['app_page']) ? intval($_GET['app_page']) : 1; 
$app_limit = 10; 
$app_offset = ($app_page - 1) * $app_limit; 
 
$app_sql = "SELECT * FROM applications WHERE  
            name LIKE ? OR 
            aadhar_number LIKE ? OR 
            contact_no LIKE ? OR 
            email LIKE ? 
            ORDER BY id DESC  
            LIMIT ? OFFSET ?"; 
$app_stmt = $conn->prepare($app_sql); 
$app_search_term = "%$app_search%"; 
$app_stmt->bind_param("ssssii", $app_search_term, $app_search_term, 
$app_search_term, $app_search_term, $app_limit, $app_offset); 
$app_stmt->execute(); 
$app_result = $app_stmt->get_result(); 
 
$app_total_sql = "SELECT COUNT(*) AS total FROM applications WHERE  
                 name LIKE ? OR 
                 aadhar_number LIKE ? OR 
                 contact_no LIKE ? OR 
                 email LIKE ?"; 
$app_total_stmt = $conn->prepare($app_total_sql); 
$app_total_stmt->bind_param("ssss", $app_search_term, $app_search_term, 
$app_search_term, $app_search_term); 
$app_total_stmt->execute(); 
$app_total_result = $app_total_stmt->get_result(); 
$app_total_row = $app_total_result->fetch_assoc(); 
$total_applications = $app_total_row['total']; 
$total_app_pages = ceil($total_applications / $app_limit); 
 
// Fetch contacts data 
$contact_sql = "SELECT * FROM contacts ORDER BY created_at DESC"; 
$contact_result = $conn->query($contact_sql); 
 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Admin Dashboard - Swantana Charitable Trust</title> 
    <link rel="stylesheet" href="style.css"> 
    <style> 
        body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    background: linear-gradient(135deg, #f4f4f9, #e0e0f5); 
    left-margin: 100px; 
    padding: 21px; 
    color: #333; 
    align: center; 
} 
 
/* Navigation */ 
nav { 
    background: #004080; 
    padding: 1rem; 
    text-align: center; 
} 
 
nav a { 
    color: #fff; 
    text-decoration: none; 
    margin: 0 1rem; 
    font-weight: 500; 
    font-size: 1rem; 
    transition: color 0.3s ease; 
} 
 
nav a:hover { 
    color: #ffcc00; 
} 
 
/* Admin Dashboard Container */ 
.admin-container { 
    max-width: 900px;  /* Same as Contacts List */ 
    margin: 0 auto; 
    background: #fff;  
    padding: 20px; 
    border-radius: 10px; 
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
} 
 
/* Headings */ 
h2, h3 { 
    color: #004080; 
    font-weight: 600; 
} 
 
h2 { 
    margin-bottom: 1.5rem; 
    font-size: 2rem; 
} 
 
h3 { 
    margin-bottom: 1rem; 
    font-size: 1.5rem; 
} 
 
/* Search Bar */ 
.search-bar { 
    margin-bottom: 1.5rem; 
    display: flex; 
    align-items: center; 
    gap: 0.5rem; 
} 
 
.search-bar input { 
    flex: 1; 
    padding: 0.5rem; 
    border: 1px solid #ddd; 
    border-radius: 6px; 
    font-size: 1rem; 
} 
 
.search-bar button { 
    padding: 0.5rem 1rem; 
    background: #004080; 
    color: #fff; 
    border: none; 
    border-radius: 6px; 
    cursor: pointer; 
    font-size: 1rem; 
    transition: background 0.3s ease; 
} 
 
.search-bar button:hover { 
    background: #002d5b; 
} 
 
/* Tables */ 
table { 
    width: 900px; 
    border-collapse: collapse; 
    margin-top: 10px; 
    background: #ffffff; /* Ensures same background */ 
    border-radius: 8px; 
    overflow: hidden; 
     
} 
 
table th, table td { 
    padding: 12px 15px; 
    text-align: left; 
    border-bottom: 1px solid #ddd; 
} 
 
table th { 
    background-color: #f5f5f5; /* Light gray to match Contacts List */ 
    color: #333; 
    font-weight: bold; 
    text-transform: uppercase; 
} 
 
table tr:hover { 
    background: #f9f9f9; 
} 
 
.search-bar { 
    display: flex; 
    justify-content: space-between; 
    margin-bottom: 15px; 
} 
 
.search-bar input { 
    width: 80%; 
    padding: 8px; 
    border: 1px solid #ccc; 
    border-radius: 5px; 
} 
 
.search-bar button { 
    padding: 8px 15px; 
    background: #004080; 
    color: white; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
} 
 
.search-bar button:hover { 
    background: #003366; 
} 
 
/* Pagination */ 
.pagination { 
    display: flex; 
    justify-content: center; 
    margin-top: 15px; 
} 
 
.pagination a { 
    color: #004080; 
    text-decoration: none; 
    padding: 0.5rem 1rem; 
    margin: 0 0.25rem; 
    border: 1px solid #ddd; 
    border-radius: 6px; 
    transition: background 0.3s ease; 
} 
 
.pagination a:hover { 
    background: #f4f4f9; 
} 
 
.pagination .active { 
    background: #004080; 
    color: #fff; 
} 
 
/* Footer */ 
footer { 
    background-color: #004080; 
    color: #ffffff; 
    text-align: center; 
    padding: 15px; 
    position: relative; 
    bottom: 0; 
    width: 100%; 
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); 
} 
 
footer p { 
    margin: 5px 0; 
    font-size: 0.9rem; 
} 
 
/* Status Badges */ 
.status-badge { 
    padding: 0.25rem 0.5rem; 
    border-radius: 12px; 
    font-size: 0.8rem; 
    font-weight: 600; 
} 
 
.status-pending { 
    background-color: #fff3cd; 
    color: #856404; 
} 
 
.status-approved { 
    background-color: #d4edda; 
    color: #155724; 
} 
 
.status-rejected { 
    background-color: #f8d7da; 
    color: #721c24; 
} 
 
/* No Results Message */ 
.no-results { 
    padding: 20px; 
    text-align: center; 
    color: #666; 
} 
 
/* Mobile Responsiveness */ 
@media (max-width: 768px) { 
    .admin-container { 
        padding: 1rem; 
    } 
 
    .search-bar { 
        flex-direction: column; 
        align-items: stretch; 
    } 
 
    .search-bar input { 
        width: 100%; 
    } 
 
    table th, table td { 
        padding: 0.5rem; 
    } 
 
    nav a { 
        display: block; 
        padding: 0.5rem; 
    } 
} 
 
    </style> 
</head> 
<body> 
    <header> 
         
    </header> 
    <nav> 
            <a href="swantana.php">Home</a> 
            <a href="admin.php">Admin Dashboard</a> 
            <a href="logout.php">Logout</a> 
        </nav> 
 
    <div class="admin-container"> 
        <h2>Admin Dashboard</h2> 
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p> 
         <!-- Contacts Section --> 
         <h3>Contact Messages</h3> 
        <table> 
            <tr> 
                <th>ID</th> 
                <th>Name</th> 
                <th>Email</th> 
                <th>Subject</th> 
                <th>Message</th> 
                <th>Date</th> 
            </tr> 
            <?php 
            if ($contact_result->num_rows > 0) { 
                while ($row = $contact_result->fetch_assoc()) { 
                    echo "<tr> 
                            <td>" . htmlspecialchars($row['id']) . "</td> 
                            <td>" . htmlspecialchars($row['name']) . "</td> 
                            <td>" . htmlspecialchars($row['email']) . "</td> 
                            <td>" . htmlspecialchars($row['subject']) . "</td> 
                            <td>" . htmlspecialchars($row['message']) . "</td> 
                            <td>" . htmlspecialchars($row['created_at']) . "</td> 
                          </tr>"; 
                } 
            } else { 
                echo "<tr><td colspan='6'>No contact messages found.</td></tr>"; 
            } 
            ?> 
        </table> 
     
 
        <!-- User List --> 
        <h3>User List</h3> 
<div class="search-bar"> 
    <form method="GET" action=""> 
        <input type="text" name="search" placeholder="Search by username" value="<?php 
echo htmlspecialchars($search); ?>"> 
        <button type="submit">Search</button> 
    </form> 
</div> 
<div class="table-container"> 
<table> 
    <tr> 
        <th>ID</th> 
        <th>Username</th> 
        <th>Role</th> 
    </tr> 
    <?php 
    if ($result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) { 
            echo "<tr> 
                    <td>" . htmlspecialchars($row['id']) . "</td> 
                    <td>" . htmlspecialchars($row['username']) . "</td> 
                    <td>" . htmlspecialchars($row['role']) . "</td> 
                  </tr>"; 
        } 
    } else { 
        echo "<tr><td colspan='3' class='no-results'>No users found.</td></tr>"; 
    } 
    ?> 
</table> 
</div> 
 
<div class="pagination"> 
    <?php 
    for ($i = 1; $i <= $total_pages; $i++) { 
        echo "<a href='admin.php?search=" . urlencode($search) . "&page=$i' " . ($i == $page 
? "class='active'" : "") . ">$i</a>"; 
    } 
    ?> 
</div> 
 
        <!-- Applications Section --> 
        <h3>Applications</h3> 
<div class="search-bar"> 
    <form method="GET" action=""> 
        <input type="hidden" name="page" value="<?php echo $page; ?>"> 
        <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); 
?>"> 
        <input type="text" name="app_search" placeholder="Search applications" 
value="<?php echo htmlspecialchars($app_search); ?>"> 
        <button type="submit">Search</button> 
    </form> 
</div> 
<div class="table-container"> 
<table> 
    <tr> 
        <th>ID</th> 
        <th>Name</th> 
        <th>Contact</th> 
        <th>Aadhaar</th> 
        <th>Education</th> 
        <th>Family Income</th> 
    </tr> 
    <?php 
    if ($app_result->num_rows > 0) { 
        while ($app_row = $app_result->fetch_assoc()) { 
            $total_income = intval($app_row['father_income']) + 
intval($app_row['mother_income']); 
             
            echo "<tr> 
                    <td>" . htmlspecialchars($app_row['id']) . "</td> 
                    <td>" . htmlspecialchars($app_row['name']) . "</td> 
                    <td>" . htmlspecialchars($app_row['contact_no']) . "<br>" .  
                        htmlspecialchars($app_row['email']) . "</td> 
                    <td>" . htmlspecialchars($app_row['aadhar_number']) . "</td> 
                    <td>" . htmlspecialchars($app_row['education_level']) .  
                        ($app_row['other_education'] ? "<br>(" . 
htmlspecialchars($app_row['other_education']) . ")" : "") . "</td> 
                    <td>₹" . number_format($total_income) . "/month</td> 
                  </tr>"; 
        } 
    } else { 
        echo "<tr><td colspan='6' class='no-results'>No applications found.</td></tr>"; 
    } 
    ?> 
</table> 
</div> 
 
<div class="pagination"> 
    <?php 
    for ($i = 1; $i <= $total_app_pages; $i++) { 
        echo "<a href='admin.php?search=" . urlencode($search) . "&page=$page" . 
             "&app_search=" . urlencode($app_search) . "&app_page=$i' " .  
             ($i == $app_page ? "class='active'" : "") . ">$i</a>"; 
    } 
    ?> 
</div> 
</div> 
 
   </body> 
</html>