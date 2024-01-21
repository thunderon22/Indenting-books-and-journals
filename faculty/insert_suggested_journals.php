<?php
   $journalName = $_POST['journalName'];
   $journalNumber = $_POST['journalNumber'];
   $publisher = $_POST['publisher'];
   $year = $_POST['year'];
   $field = $_POST['field'];
   

   //database connection
   $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');
   //prepare inserting the queries into the table
   $stmt = $conn->prepare("insert into suggested_journals(journalName, journalNumber, publisher, year, field) values(?,?,?,?,?)");
   if(!$stmt){
        die('Connection Failed : '.$conn->error);
   }
    
    //bind the ? with proper datatype
    $stmt->bind_param("sisis",$journalName, $journalNumber, $publisher, $year, $field);
    if($stmt->execute()){
        echo "<script>alert('Added new journals successful')</script>";
    ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/delete.php">
    <?php
    }else{
        echo "Error inserting record: " . $stmt->error;
    }
    $stmt->close();   //closing
    $conn->close();   //closing connection
   
?>

