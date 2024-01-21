<?php
// Include your database configuration here
require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approved_books'])) {
    // Retrieve the selected books data sent from the front-end
    $selectedBooks = json_decode($_POST['approved_books'], true);

    if (is_array($selectedBooks) && !empty($selectedBooks)) {
        $insertedCount = 0;

        // Loop through the selected books and insert them into the 'approved_books' table
        foreach ($selectedBooks as $book) {
            $bookName = mysqli_real_escape_string($con, $book['book_name']);
            $author = mysqli_real_escape_string($con, $book['author']);
            $edition = mysqli_real_escape_string($con, $book['edition']);
            $isbn = mysqli_real_escape_string($con, $book['isbn']);
            $publisher = mysqli_real_escape_string($con, $book['publisher']);
            $year = mysqli_real_escape_string($con, $book['year']);
            $cost = mysqli_real_escape_string($con, $book['cost']);
            $field = mysqli_real_escape_string($con, $book['field']);

            // Insert the book data into the 'approved_books' table
            $insertQuery = "INSERT INTO approved_books (book_name, author, edition, isbn, publisher, year, cost, field) 
                            VALUES ('$bookName', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field')";

            $result = mysqli_query($con, $insertQuery);

            if ($result) {
                $insertedCount++;
            } else {
                // Handle insertion errors
                echo "Error inserting book: " . mysqli_error($con);
            }
        }

        // Check if any books were successfully inserted
            if ($insertedCount > 0) {
                echo "Successfully approved $insertedCount book(s).";
                // header("Location: http://localhost/indent/approve/approved_books_list.php");
                // exit(); // Ensure that no further code is executed after redirection
            } else {
                echo "No books were suggested.";
            }
        } else {
            echo "Invalid request. Please submit the form data.";
        }
    }

// Close the database connection
mysqli_close($con);
?>
