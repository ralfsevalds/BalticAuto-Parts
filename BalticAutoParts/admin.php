<!DOCTYPE html>
<html>
<head>
  <title>Admin Page</title>
  <style>
    body {
      background-color: black;
      color: red;
      font-family: Arial, sans-serif;
    }
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    h1 {
      margin-bottom: 30px;
    }
    table {
      width: 80%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: red;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #333333;
    }
    .button-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .button-container button {
      margin: 0 10px;
      background-color: red;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Page</h1>

    <h2>User List</h2>
    <table>
      <tr>
        <th> ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
        </tr>
      <?php
      session_start();

      // Check if the user is logged in
      if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
        // Assuming you have a database connection established
        $host = 'localhost'; 
        $dbname = 'baltic'; 
        $username = 'root'; 
        $password = ''; 
        try {
          // Create a new PDO instance
          $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

          // Set PDO error mode to exception
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // Perform database query to retrieve users
          $stmt = $pdo->query("SELECT * FROM singup");

          // Loop through the user records and display them in the table
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>";
            echo "<button onclick=\"deleteUser('{$row['id']}')\">Delete</button>";
            echo "<button onclick=\"editUser('{$row['id']}')\">Edit</button>";
            echo "</td>";
            echo "</tr>";
          }
        } catch(PDOException $e) {
          echo "Database connection failed: " . $e->getMessage();
        }
      } else {
        // Redirect to the login page if the user is not logged in
        header("Location: index.html");
        exit();
      }
      ?>
    </table>

    <div class="button-container">
      <button onclick="addUser()">Add User</button>
    </div>
  </div>

  <script>
    function deleteUser(Id) {
      // Implement the logic to delete the user with the provided userId
      // ...

      // Example AJAX call to delete_user.php
      // Replace "your-delete-user-api-endpoint" with your actual API endpoint
      // Replace "userId" with the actual variable holding the user ID
      // Make sure to handle success and error cases in the AJAX call
      fetch("your-delete-user-api-endpoint", {
        method: "POST",
        body: JSON.stringify({ userId: userId }),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => response.json())
        .then((data) => {
          // Handle success case
        })
        .catch((error) => {
          // Handle error case
        });
    }

    function editUser(userId) {
      // Implement the logic to edit the user with the provided userId
      // ...

      // Example redirect to edit_user.php with the user ID as a query parameter
      // Replace "your-edit-user-page" with your actual edit user page
      // Replace "userId" with the actual variable holding the user ID
      window.location.href = "your-edit-user-page?userId=" + userId;
    }

    function addUser() {
      // Implement the logic to add a new user
      // ...

      // Example redirect to add_user.php
      // Replace "your-add-user-page" with your actual add user page
      window.location.href = "your-add-user-page";
    }
  </script>
</body>
</html>