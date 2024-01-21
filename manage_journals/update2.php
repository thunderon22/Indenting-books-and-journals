<?php
$con = mysqli_connect("localhost", "root", "", "indenting", "3308");

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

$journalNumber = isset($_GET['journalNumber']) ? $_GET['journalNumber'] : '';

if (!empty($journalNumber)) { // Changed $JournalNumber to $journalNumber
    // Retrieve journal details based on journalNumber
    $query = "SELECT * FROM journals WHERE journalNumber='$journalNumber'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Journal with Journal Number '$journalNumber' not found."); // Changed $JournalNumber to $journalNumber
    }

    $journalName = $row['journalName'];
    $publisher = $row['publisher'];
    $year = $row['year'];
    $field = $row['field'];
} else {
    // Handle the case where journalNumber is not provided in the URL
    echo "Journal number is missing in the URL.";
    // You can decide what action to take or display a message as needed.
}
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

  <div id="navigation" class="btn-group1">
    <!-- Your button links here -->
    <button onclick="window.location.href='../home/index.html'">Home</button>
    <button onclick="window.location.href='adding_journals.html'">Add New Journals</button>
    <button onclick="window.location.href='update_journals.php'" id="user-btn">Update Journals</button>
    <button onclick="window.location.href='delete_journals.php'">Delete Journals</button>
    <button onclick="window.location.href='search_journals.php'">Search Journals</button>
    <button onclick="window.location.href='../admin1.php'">Logout</button>
  </div>
    <div class="container">
    <h4><b>Update Journal Details</b></h4><br>
                <form action="" method="POST">
                    <label for="journalName">JOURNAL NAME :</label>
                    <input type="text" id="journalName" name="journalName" size="50" placeholder="enter the book name" value="<?php echo $journalName; ?>" required><br>
                    <label for="journalNumber">JOURNAL NUMBER :</label>
                    <input type="text" id="journalNumber" name="journalNumber" size="100" placeholder="author of book" value="<?php echo $journalNumber; ?>" required><br>
                    <label for="publisher">PUBLISHER :</label>
                    <input type="text" id="publisher" name="publisher" size="50" placeholder="publisher name" value="<?php echo $publisher; ?>" required><br>
                    <label for="year">YEAR OF PUBLICATION :</label>
                    <input type="number" id="year" name="year" pattern="\d{4}" placeholder="enter year of publication" value="<?php echo $year; ?>" required><br>
                    <label for="field">FIELD OF JOURNAL:</label>
                    <input type="text" id="field" name="field" size="30" placeholder="enter the field of book" value="<?php echo $field; ?>" required><br>
                    <center>
                    <div id="button">
                        <input type="submit" value="Update" name="submit">
                    </div></center>
                </form>
            </center>
        </div>
        <script>
        // Get the current page URL
        var currentPage = window.location.href;

        // Check if the current page URL matches the "new_user.html" URL
        if (currentPage.includes("update2.php")) {
            // Add the "active" class to the button
            document.getElementById("user-btn").classList.add("active");
        }
    </script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $newJournalName = $_POST['journalName'];
    $newPublisher = $_POST['publisher'];
    $newYear = $_POST['year'];
    $newField = $_POST['field'];

    // Check if the values are different before attempting an update
    if ($newJournalName !== $journalName || $newPublisher !== $publisher || $newYear !== $year || $newField !== $field) {
        $query = "UPDATE journals SET journalName='$newJournalName', publisher='$newPublisher', year='$newYear', field='$newField' WHERE journalNumber='$journalNumber'";
        $data = mysqli_query($con, $query);

        if ($data) {
            echo "<script>alert('Record Updated Successfully')</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_journals/update_journals.php">
            <?php
        } else {
            echo "Failed to Update Record: " . mysqli_error($con);
        }
    } else {
        echo "No changes detected in the data. Nothing to update.";
    }
}
?>