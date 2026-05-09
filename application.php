<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="style.css"> 
    <title>Application Form</title> 
    <header> 
         
    </header> 
    <style> 
        /* General Styles */ 
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
 
        /* Form Container */ 
        .form-container { 
            background-color: #fff; 
            padding: 2.5rem; 
            border-radius: 12px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 
            width: 100%; 
            max-width: 600px; 
            margin: 20px; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        } 
 
        .form-container:hover { 
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
        input[type="date"], 
        input[type="email"], 
        select, 
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
        input[type="date"]:focus, 
        input[type="email"]:focus, 
        select:focus, 
        textarea:focus { 
            border-color: #007bff; 
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3); 
            outline: none; 
            background-color: #fff; 
        } 
 
        textarea { 
            resize: vertical; 
            height: 120px; 
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
 
        /* Form Groups */ 
        .form-group { 
            margin-bottom: 1.75rem; 
        } 
 
        .form-group:last-child { 
            margin-bottom: 0; 
        } 
 
        /* Responsive Design */ 
        @media (max-width: 768px) { 
            .form-container { 
                padding: 1.5rem; 
            } 
 
            h2 { 
                font-size: 1.8rem; 
            } 
 
            input[type="text"], 
            input[type="date"], 
            input[type="email"], 
            select, 
            textarea { 
                font-size: 0.95rem; 
                padding: 0.75rem; 
            } 
 
            button { 
                font-size: 0.95rem; 
                padding: 0.75rem; 
            } 
        } 
 
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
 
        /* Additional Modern Touches */ 
        select { 
            appearance: none; 
            background-position: right 0.75rem center; 
            background-size: 0.65rem auto; 
        } 
 
        /* Hover effect for select */ 
        select:hover { 
            border-color: #007bff; 
        } 
         
    </style> 
</head> 
<body> 
    <div class="form-container"> 
        <h2>Application Form</h2> 
        <form id="application-form" action="submit.php" method="post" onsubmit="return 
validateForm(event)"> 
            <!-- Form Fields --> 
            <div class="form-group"> 
                <label for="name">Name:</label> 
                <input type="text" id="name" name="name" required> 
                <span id="nameError" class="error"></span> 
            </div> 
            <div class="form-group"> 
                <label for="father_name">Father's Name:</label> 
                <input type="text" id="father_name" name="father_name" required> 
                <span id="fatherNameError" class="error"></span> 
            </div> 
            <div class="form-group"> 
                <label for="father_occupation">Father's Occupation:</label> 
                <input type="text" id="father_occupation" name="father_occupation"> 
            </div> 
            <div class="form-group"> 
                <label for="father_income">Father's Income:</label> 
                <input type="text" id="father_income" name="father_income"> 
            </div> 
            <div class="form-group"> 
                <label for="mother_name">Mother's Name:</label> 
                <input type="text" id="mother_name" name="mother_name"> 
            </div> 
            <div class="form-group"> 
                <label for="mother_occupation">Mother's Occupation:</label> 
                <input type="text" id="mother_occupation" name="mother_occupation"> 
            </div> 
            <div class="form-group"> 
                <label for="mother_income">Mother's Income:</label> 
                <input type="text" id="mother_income" name="mother_income"> 
            </div> 
            <div class="form-group"> 
                <label for="gender">Gender:</label> 
                <select id="gender" name="gender"> 
                    <option value="Male">Male</option> 
                    <option value="Female">Female</option> 
                    <option value="Other">Other</option> 
                </select> 
            </div> 
            <div class="form-group"> 
                <label for="dob">Date of Birth:</label> 
                <input type="date" id="dob" name="dob" required> 
                <span id="dobError" class="error"></span> 
            </div> 
            <div class="form-group"> 
                <label for="marital_status">Marital Status:</label> 
                <select id="marital_status" name="marital_status"> 
                    <option value="Single">Single</option> 
                    <option value="Married">Married</option> 
                    <option value="Divorced">Divorced</option> 
                </select> 
            </div> 
            <div class="form-group"> 
                <label for="caste_category">Caste Category:</label> 
                <select id="caste_category" name="caste_category"> 
                    <option value="General">General</option> 
                    <option value="SC">SC</option> 
                    <option value="ST">ST</option> 
                    <option value="OBC">OBC</option> 
                    <option value="Minority">Minority</option> 
                </select> 
            </div> 
            <div class="form-group"> 
                <label for="aadhar_number">Aadhar Number:</label> 
                <input type="text" id="aadhar_number" name="aadhar_number" required> 
                <span id="aadharError" class="error"></span> 
            </div> 
            <div class="form-group"> 
                <label for="address">Address:</label> 
                <textarea id="address" name="address"></textarea> 
            </div> 
            <div class="form-group"> 
                <label for="district">District:</label> 
                <input type="text" id="district" name="district"> 
            </div> 
            <div class="form-group"> 
                <label for="state">State:</label> 
                <input type="text" id="state" name="state"> 
            </div> 
            <div class="form-group"> 
                <label for="landmark">Landmark:</label> 
                <input type="text" id="landmark" name="landmark"> 
            </div> 
            <div class="form-group"> 
                <label for="contact_no">Contact No:</label> 
                <input type="text" id="contact_no" name="contact_no" required> 
                <span id="contactError" class="error"></span> 
            </div> 
            <div class="form-group"> 
                <label for="alternate_no">Alternate No:</label> 
                <input type="text" id="alternate_no" name="alternate_no"> 
            </div> 
            <div class="form-group"> 
                <label for="pincode">Pincode:</label> 
                <input type="text" id="pincode" name="pincode"> 
            </div> 
            <div class="form-group"> 
                <label for="email">Email:</label> 
                <input type="email" id="email" name="email" required> 
                <span id="emailError" class="error"></span> 
            </div> 
            <div class="form-group"> 
                <label for="education_level">Education Level:</label> 
                <select id="education_level" name="education_level"> 
                    <option value="SSC">SSC</option> 
                    <option value="Intermediate">Intermediate</option> 
                    <option value="Graduation">Graduation</option> 
                    <option value="PG">PG</option> 
                    <option value="Diploma">Diploma</option> 
                    <option value="Engineering">Engineering</option> 
                </select> 
            </div> 
            <div class="form-group"> 
                <label for="other_education">Other Education:</label> 
                <input type="text" id="other_education" name="other_education"> 
            </div> 
            <div class="form-group"> 
                <label for="govt_document">Government Document:</label> 
                <input type="text" id="govt_document" name="govt_document"> 
            </div> 
            <div class="form-group"> 
                <label for="bank_account_no">Bank Account No:</label> 
                <input type="text" id="bank_account_no" name="bank_account_no"> 
            </div> 
            <div class="form-group"> 
                <label for="bank_name">Bank Name:</label> 
                <input type="text" id="bank_name" name="bank_name"> 
            </div> 
            <div class="form-group"> 
                <label for="ifsc_code">IFSC Code:</label> 
                <input type="text" id="ifsc_code" name="ifsc_code"> 
            </div> 
            <button type="submit">Submit</button> 
        </form> 
    </div> 
    <script> 
        function validateForm(event) { 
            event.preventDefault(); // Prevent form submission 
 
            // Reset errors and invalid styles 
            document.querySelectorAll('.error').forEach(error => error.textContent = ''); 
            document.querySelectorAll('.invalid').forEach(input => 
input.classList.remove('invalid')); 
 
            let isValid = true; 
 
            // Validate Name 
            const name = document.getElementById('name').value.trim(); 
            if (name === '') { 
                document.getElementById('nameError').textContent = 'Name is required.'; 
                document.getElementById('name').classList.add('invalid'); 
                isValid = false; 
            } 
 
            // Validate Father's Name 
            const fatherName = document.getElementById('father_name').value.trim(); 
            if (fatherName === '') { 
                document.getElementById('fatherNameError').textContent = "Father's name is 
required."; 
                document.getElementById('father_name').classList.add('invalid'); 
                isValid = false; 
            } 
 
            // Validate Email 
            const email = document.getElementById('email').value.trim(); 
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
            if (!emailPattern.test(email)) { 
                document.getElementById('emailError').textContent = 'Invalid email address.'; 
                document.getElementById('email').classList.add('invalid'); 
                isValid = false; 
            } 
 
            // Validate Contact Number 
            const contactNo = document.getElementById('contact_no').value.trim(); 
            const contactPattern = /^\d{10}$/; 
            if (!contactPattern.test(contactNo)) { 
                document.getElementById('contactError').textContent = 'Contact number must be 
10 digits.'; 
                document.getElementById('contact_no').classList.add('invalid'); 
                isValid = false; 
            } 
 
            // Validate Date of Birth 
            const dob = document.getElementById('dob').value; 
            if (!dob) { 
                document.getElementById('dobError').textContent = 'Date of Birth is required.'; 
                document.getElementById('dob').classList.add('invalid'); 
                isValid = false; 
            } 
 
            // Validate Aadhar Number 
            const aadharNumber = document.getElementById('aadhar_number').value.trim(); 
            const aadharPattern = /^\d{12}$/; 
            if (!aadharPattern.test(aadharNumber)) { 
                document.getElementById('aadharError').textContent = 'Aadhar number must be 
12 digits.'; 
                document.getElementById('aadhar_number').classList.add('invalid'); 
                isValid = false; 
            } 
 
            // If all validations pass, submit the form 
            if (isValid) { 
                event.target.submit(); 
            } 
        } 
    </script> 
</body> 
</html> 

Submit.php: 
 
<?php 
// Database connection details 
$servername = "localhost"; // Replace with your server name 
$username = "root"; // Replace with your database username 
$password = ""; // Replace with your database password 
$dbname = "swantana"; // Replace with your database name 
 
// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname); 
 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
// Collect form data 
$name = $_POST['name']; 
$father_name = $_POST['father_name']; 
$father_occupation = $_POST['father_occupation']; 
$father_income = $_POST['father_income']; 
$mother_name = $_POST['mother_name']; 
$mother_occupation = $_POST['mother_occupation']; 
$mother_income = $_POST['mother_income']; 
$gender = $_POST['gender']; 
$dob = $_POST['dob']; 
$marital_status = $_POST['marital_status']; 
$caste_category = $_POST['caste_category']; 
$aadhar_number = $_POST['aadhar_number']; 
$address = $_POST['address']; 
$district = $_POST['district']; 
$state = $_POST['state']; 
$landmark = $_POST['landmark']; 
$contact_no = $_POST['contact_no']; 
$alternate_no = $_POST['alternate_no']; 
$pincode = $_POST['pincode']; 
$email = $_POST['email']; 
$education_level = $_POST['education_level']; 
$other_education = $_POST['other_education']; 
$govt_document = $_POST['govt_document']; 
$bank_account_no = $_POST['bank_account_no']; 
$bank_name = $_POST['bank_name']; 
$ifsc_code = $_POST['ifsc_code']; 
 
// SQL query to insert data into the database 
$sql = "INSERT INTO applications ( 
    name, father_name, father_occupation, father_income, mother_name, 
mother_occupation, mother_income, 
    gender, dob, marital_status, caste_category, aadhar_number, address, district, state, 
landmark, 
    contact_no, alternate_no, pincode, email, education_level, other_education, 
govt_document, 
    bank_account_no, bank_name, ifsc_code 
) VALUES ( 
    '$name', '$father_name', '$father_occupation', '$father_income', '$mother_name', 
'$mother_occupation', '$mother_income', 
    '$gender', '$dob', '$marital_status', '$caste_category', '$aadhar_number', '$address', 
'$district', '$state', '$landmark', 
    '$contact_no', '$alternate_no', '$pincode', '$email', '$education_level', '$other_education', 
'$govt_document', 
    '$bank_account_no', '$bank_name', '$ifsc_code' 
)"; 
 
// Execute the query 
if ($conn->query($sql) === TRUE) { 
        echo '<script> 
            alert("Application submitted successfully!"); 
        window.location.href = "swantana.php"; 
        </script>'; 
 
} else { 
    echo "Error: " . $sql . "<br>" . $conn->error; 
} 
 
// Close the connection 
$conn->close(); 
?>