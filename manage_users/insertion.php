<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $success = true; // Track if all insertions are successful

    // Process the uploaded CSV file
    if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == 0) {
        $file = $_FILES["csvfile"]["tmp_name"];
        
        // Read CSV file
        if (($handle = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $fname = $data[0];
                $username = $data[1];
                $password = $data[2];
                
                // Insert data into the "create_new_user" table
                $sql = "INSERT INTO create_new_user (fname, username, password) VALUES ('$fname', '$username', '$password')";
                
                if ($conn->query($sql) != true) {
                    $success = false; // Set to false on the first error
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                    break; // Exit the loop on error
                }
            }
            fclose($handle);
        }

        if ($success) {
            echo "<script>alert('Data added to database successfully')</script>" . "<br>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_users/index3.php">
            <?php
        } else {
            echo "<script>alert('Error: Unable to add all users')</script>";
        }
    }
    
    $conn->close();
}
?>
