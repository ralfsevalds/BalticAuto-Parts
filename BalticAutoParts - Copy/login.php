<!DOCTYPE html>
<html>
<head>
    <title>Login and Signup Page</title>
    <style>
        body {
            background-color: #333;
            font-family: Arial, sans-serif;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        
        .container {
            width: 400px;
            padding: 40px;
            background-color: #222;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        
        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
        }
        
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f00;
            color: #fff;
            cursor: pointer;
        }
        
        .form-group input[type="submit"]:hover {
            background-color: #c00;
        }
        
        .switch-form {
            text-align: center;
            margin-top: 20px;
        }
        
        .switch-form a {
            color: #f00;
            text-decoration: none;
        }
        
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-button a {
            color: #f00;
            text-decoration: none;
        }
        
        .popup {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
            display: none;
        }
    </style>
    <script>
        function showPopup(id) {
            var popup = document.getElementById(id);
            popup.style.display = "block";
        }
        
        function hidePopup(id) {
            var popup = document.getElementById(id);
            popup.style.display = "none";
        }
        
        function validateForm() {
            var password = document.getElementById("password").value;
            var email = document.getElementById("email").value;
            
            if (password.length < 8) {
                showPopup("passwordPopup");
                return false;
            }
            
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showPopup("emailPopup");
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form onsubmit="return validateForm()">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Enter your email">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" id="password" placeholder="Enter your password">
</div>
<div class="form-group">
<input type="submit" value="Login">
</div>
</form>
<div class="switch-form">
Don't have an account? <a href="sing_up.php">Sign up</a>
</div>
<div class="back-button">
<a href="index.html">Back to Main Page</a>
</div>
</div>
<div id="passwordPopup" class="popup">
    <p>Password should be 8 or more characters.</p>
    <button onclick="hidePopup('passwordPopup')">OK</button>
</div>

<div id="emailPopup" class="popup">
    <p>Invalid email format.</p>
    <button onclick="hidePopup('emailPopup')">OK</button>
</div>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Create a connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "baltic";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to select the user with the provided email and password
    $stmt = $conn->prepare("INSERT INTO baltic(email, password,) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password,);
    $stmt->execute();
    $stmt->close();
    // Get the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User login successful
        echo "Login successful";
    } else {
        // Invalid login credentials
        echo "Invalid email or password";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>