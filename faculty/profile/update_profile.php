<?php
if (isset($_POST['update'])) {
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

    // Retrieve data from the form
    $username = $_POST['user_id']; // Change this to 'user_id'
    $new_fname = $_POST['fname'];
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Update the user's profile in the database
    $sql = "UPDATE $table SET fname = '$new_fname', username = '$new_username', password = '$new_password' WHERE username = '$username'";

    if (mysqli_query($link, $sql)) {
        echo "<script>alert('Profile updated successfully!')</script>";
        ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/profile/edit_profile.php">
        <?php
    } else {
        echo "<script>alert('Error updating profile: ')</script>" . mysqli_error($link);
    }

    mysqli_close($link);
}
?>

