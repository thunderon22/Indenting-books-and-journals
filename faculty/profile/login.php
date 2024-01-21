<?php
// Start the session
session_start();

// Check if the user is already logged in, redirect to home if yes
if (isset($_SESSION['username'])) {
    header('Location: ../indent/faculty/select_book.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database configuration
    $host = "localhost";
    $port = 3308;
    $user = "root";
    $password = "";
    $db = "indenting";
    $table = "create_new_user";

    // Connect to MySQL
    $link = mysqli_connect($host, $user, $password, $db, $port);
    if (!$link) {
        die("Could not connect: " . mysqli_connect_error());
    }

    // Retrieve the entered username and password
    $fname = $_POST['fname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate email format for username
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid username format. Please enter a valid email address.";
    } else {
        // Fetch user record from the database
        $query = "SELECT * FROM $table WHERE username = '$username'";
        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the entered password against the stored password
            if ($password === $user['password']) {
                // Store the username in a session variable
                $_SESSION['username'] = $username;

                // Redirect to the home page or any other desired page
                header('Location: ../indent/faculty/select_book.php');
                exit();
            }
        }

        // Invalid credentials
        $error = "Invalid credentials. Please try again.";
    }

    // Close the database connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Add any additional styles or links here -->

<style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }

    h1,
    h2, h4 {
      text-align: center;
    }

    #header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
      background-color: #003366;
      color: white;
      width: auto;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    #navigation {
        /* Navigation styles */
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background-color: #f7f7f7;
        color: white;
        width: auto;
        position: sticky;
        top: 0;
        z-index: 100;
        /* Lower z-index for navigation */
        }

    #img_left,
    #img_right {
      flex: 0 0 auto;
    }

    #img_left img,
    #img_right img {
      max-width: 100%;
      height: auto;
    }

    #title {
      flex: 1 1 auto;
      text-align: center;
      margin: 0;
    }

    #section {
      text-align: center;
      padding: 20px 0;
    }

    .btn-group1 {
      display: flex;
      justify-content: center;
      border-radius: 4px;
    }

    .btn-group1 button {
      background-color: #003366;
      color: #fff;
      border: none;
      padding: 10px 20px;
      margin: 0 10px;
      cursor: pointer;
      font-size: 16px;
      border-radius: 4px;
    }

    .btn-group1 button:hover {
      background-color: #6a819c;
    }

    #user-btn.active {
        background-color: #6a819c;
        }
    .container {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    /* Adding bold font to labels for emphasis */
}

input[type="text"],
input[type="number"],
input[type="password"] {
    /* ... (other styles) ... */
    width: 95%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 12px;
}

input[type="submit"] {
    background-color: #003366;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
    width: 50%;
}

input[type="submit"],
input[type="reset"]:hover {
    background-color: #002855;
}

.error-message {
    color: #ff0000;
    margin-top: 10px;
}
</style>
  <title>Update User Details</title>
</head>

<body>
<header>
    <div id="header">
      <div id="img_left">
        <img src="../img/uoh_logo_white.png" alt="University of Hyderabad">
      </div>
      <div id="title">
            <h1><b>School of Computer and Information Sciences</b></h1>
            <h2><b>Library Books / Journals Indenting System</b></h2>            
        </div>
      <div id="img_right">
        <img src="../img/uoh_ioe_white.png" alt="University of Hyderabad">
      </div>
    </div>
  </header>
  <div id="section" class="btn-group1">
        <button onclick="window.location.href='admin1.php'" >Admin Login</button>
        <button onclick="window.location.href='faculty.php'" id="admin-login-btn">Faculty Login</button>
    </div>

    <div id="navigation">
        <div class="container">
            <h2><b>Edit Profile</b></h2>
            <?php if (isset($error)) : ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" action="">
              
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Enter your email as username" required>

                <label for="password">Password:</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <!-- You can include the eye icon and togglePasswordVisibility() here -->
                </div>
                <br><br>

                <center><input type="submit" name="login" value="Login"></center>
            </form>
        </div>
    </div>


    <!-- Add any additional scripts or content here -->
</body>

</html>
