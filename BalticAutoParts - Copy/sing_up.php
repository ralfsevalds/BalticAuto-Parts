<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
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

    // Prepare and execute the SQL statement to insert user data into the table
    $stmt = $conn->prepare("INSERT INTO singup (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        // User registration successful
        echo "Registration successful";
    } else {
        // Failed to register user
        echo "Registration failed";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
<html>
<head>
  <title>Signup Page</title>
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
    <h1>Signup</h1>
    <form action="singin.php" method="post" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" placeholder="Enter your name" name="Name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" placeholder="Enter your email" Name="Email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password" Name="Password">
      </div>
      <div class="form-group">
        <input type="submit" value="Signup">
      </div>
    </form>
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
</body>
</html>
