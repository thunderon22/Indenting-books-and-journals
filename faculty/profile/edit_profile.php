
<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle the case when the user is not logged in
    header('Location: login.php');
    exit();
}

// Retrieve the logged-in username
$username = $_SESSION['username'];

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

// Retrieve user data from the database
$sql = "SELECT * FROM $table WHERE username = '$username'";
$result = mysqli_query($link, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="new_user.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        form
        {
        height:auto;
        width:auto;
        }
        label
            {
            display:inline-block;
            width:100%;
            margin-right:1px;
            text-align:left;
            padding: 10px 5px 5px 20px;
            font-weight:bold;
            }

            body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
        }

        #header {
        /* Header styles */
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
        /* Higher z-index for header */
        }

        #navigation {
        /* Navigation styles */
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 20px;
        background-color: #f7f7f7;
        color: white;
        width: auto;
        position: sticky;
        top: 0;
        z-index: 100;
        /* Lower z-index for navigation */
        }

        #section {
        background-color: #f7f7f7;
        padding: 10px;
        width: 100%;
        /* Adjust as needed */
        }

        #section form {
        max-width: 50%;
        }

        .container {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        width: 600px;
        margin: 0 auto;
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

        .btn-group1 {
        display: flex;
        justify-content: center;
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
        /*color: rgb(20, 20, 20);*/
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 12px;
        }

        input[type="submit"],
        input[type="reset"] {
        background-color: #003366;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
        width: 30%;
        }

        input[type="submit"]:hover {
        background-color: #002855;
        }

        .error-message {
        color: #ff0000;
        margin-top: 10px;
        }

        .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        }

        #user-btn.active {
        background-color: #6a819c;
        }

        .horizontal-line {
        border: none;
        height: 4px;
        /* Adjust the height as needed */
        background-color: #003366;
        /* Change the color as needed */
        }

    </style>
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
    <div id="navigation" align="center" class="btn-group1">
    <button onclick="window.location.href='../select_book.php'" >Select Books</button>
    <button onclick="window.location.href='../select_journal.php'">Select Journals</button>
    <button onclick="window.location.href='../suggest_books.html'">Suggest Books</button>
    <button onclick="window.location.href='../suggest_journals.html'">Suggest Journals</button>
    <button onclick="window.location.href='edit_profile.php'" id="user-btn">Edit Profile</button>
    <button onclick="window.location.href='/../indent/faculty.php'">Logout</button>
  </div>
<div class="container">
    <center>
    <form method="post" action="update_profile.php">

    <h4><b>Edit Profile</b></h4>

    <label for="fname">Fullname:</label><br>
        <input type="text" name="fname" value="<?php echo $row['fname']; ?>" required><br>

        <!-- <label for="username">Username:</label><br>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br> -->

        <label for="password">Password:</label><br>
        <input type="text" name="password" value="<?php echo $row['password']; ?>" required><br>

        <input type="hidden" name="user_id" value="<?php echo $username; ?>"><br>
        <!-- Pass the username as user_id for identification -->

        <center><input type="submit" name="update" value="Update Profile"></center>
    </form>
    </center>
</div>
</body>
<script>
    // Get the current page URL
    var currentPage = window.location.href;

    // Check if the current page URL matches the "new_user.html" URL
    if (currentPage.includes("edit_profile.php")) {
        // Add the "active" class to the button
        document.getElementById("user-btn").classList.add("active");
    }
</script>
</html>
<?php
} else {
    echo "User not found.";
}

mysqli_close($link);
?>
