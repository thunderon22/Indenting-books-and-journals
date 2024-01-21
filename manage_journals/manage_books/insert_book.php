<?php
   $book_name = $_POST['book_name'];
   $author = $_POST['author'];
   $edition = $_POST['edition'];
   $isbn = $_POST['isbn'];
   $publisher = $_POST['publisher'];
   $year = $_POST['year'];
   $cost = $_POST['cost'];
   $field = $_POST['field'];
   

   //database connection
   $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');
   //prepare inserting the queries into the table
   $stmt = $conn->prepare("insert into add_new_books(book_name, author, edition, isbn, publisher, year, cost, field) values(?,?,?,?,?,?,?,?)");
   if(!$stmt){
        die('Connection Failed : '.$conn->error);
   }
    
    //bind the ? with proper datatype
    $stmt->bind_param("sssssiis",$book_name, $author, $edition, $isbn, $publisher, $year, $cost, $field);
    if($stmt->execute()){
        echo "<script>alert('Added new books successful')</script>";
    ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_books/update_books.php">
    <?php
    }else{
        echo "Error inserting record: " . $stmt->error;
    }
    $stmt->close();   //closing
    $conn->close();   //closing connection
   
?>
<!--</div>
</body>
</html>-->
