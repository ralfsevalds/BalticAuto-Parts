<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link rel="profile.css" href="profile.css">
</head>
<body>
  <div class="profile">
    <div class="profile-header">
      <h1>My Profile</h1>
    </div>
    <div class="profile-info">
      <img src="<?php echo $profile['profile_picture']; ?>" alt="Profile Picture">
      <h2><?php echo $profile['name']; ?></h2>
      <p>Email: <?php echo $profile['email']; ?></p>
      <p>Location: <?php echo $profile['location']; ?></p>
      <p>Interests: <?php echo $profile['interests']; ?></p>
    </div>
  </div>
</body>
</html>

<?php
// Assuming you have already established a database connection

// Fetch profile information from the database
$query = "SELECT * FROM profiles WHERE user_id = 1"; // Assuming you have a 'profiles' table and a 'user_id' column
$result = mysqli_query($conn, $query);
$profile = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>