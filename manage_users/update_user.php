<?php
$con = mysqli_connect("localhost", "root", "", "indenting", "3308");

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

$fname = $_GET['fname'];
$username = $_GET['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
  <title>Delete Data From Database in Php</title>
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
    <!-- Your button links here -->
    <button onclick="window.location.href='../home/index.html'">Home</button>
    <button onclick="window.location.href='new_user.html'">Create New User</button>
    <button onclick="window.location.href='index3.php'" id="user-btn">Update Users</button>
    <button onclick="window.location.href='index2.php'">Delete User</button>
    <button onclick="window.location.href='search_user.php'">Search User</button>
    <button onclick="window.location.href='../admin1.php'">Logout</button>
  </div>
    <br>
        <div class="container">
            <h4><b>Update User Details</b></h4><br>
                <form action="" method="POST">
                    <label for="fname">FULL NAME :</label>
                    <input type="text" id="fname" min="3" max="30" name="fname" size="30" value="<?php echo "$fname" ?>" required><br>
                    <label for="username">USER NAME :</label>
                    <input type="text" id="username" name="username" size="30" value="<?php echo "$username" ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required><br>
                    <center>
                    <div id="button">
                        <input type="submit" value="update" name="submit">
                    </div></center>
                </form>
        </div>
    </div>
    <script>
        // Get the current page URL
        var currentPage = window.location.href;

        // Check if the current page URL matches the "new_user.html" URL
        if (currentPage.includes("update_user.php")) {
            // Add the "active" class to the button
            document.getElementById("user-btn").classList.add("active");
        }
    </script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $newFname = $_POST['fname'];
    $newUsername = $_POST['username'];

    // Check if the values are different before attempting an update
    $query = "SELECT * FROM create_new_user WHERE username='$newUsername'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
    } else {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $currentFname = $row['fname'];

            if ($newFname !== $currentFname) {
                $query = "UPDATE create_new_user SET fname='$newFname',username='$newUsername' WHERE username='$newUsername'";
                $data = mysqli_query($con, $query);

                if ($data) {
                    echo "<script>alert('Record Updated Successfully')</script>";
                    echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_users/index3.php">';
                } else {
                    echo "Failed to Update Record: " . mysqli_error($con);
                }
            } else {
                echo "No changes detected in the data. Nothing to update.";
            }
        } else {
            echo "User with username '$newUsername' not found.";
        }
    }
}
?>
