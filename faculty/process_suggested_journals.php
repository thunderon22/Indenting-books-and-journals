<?php
/*require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['suggested_journals'])) {
        $suggestedJournals = $_POST['suggested_journals'];

        foreach ($suggested_journals as $journalData) {
            // Decode the JSON data to get book details
            $JournalDetails = json_decode(urldecode($journalData), true);

            // Extract journal details
            $journalName = $journalDetails['journal_name'];
            $journalNumber = $journalDetails['journalNumber'];
            $publisher = $journalDetails['publisher'];
            $year = $journalDetails['year'];
            $field = $journalDetails['field'];

            // Insert the book into the suggested_books table (Modify this query based on your table structure)
            $insertQuery = "INSERT INTO suggested_journals (journal_name, journalNumber, publisher, year, field) VALUES (?, ?, ?, ?, ?)";

            // Prepare and execute the query (Use prepared statements for security)
            $stmt = mysqli_prepare($con, $insertQuery);
            mysqli_stmt_bind_param($stmt, 'sssss', $journalName, $journalNumber, $publisher, $year, $field);
            $result = mysqli_stmt_execute($stmt);

            // Check if the insertion was successful
            if ($result) {
                // Book inserted successfully, you can perform additional actions if needed.
            } else {
                // Error occurred while inserting the book.
                // Handle the error as per your application's requirements.
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        }

        // Redirect back to the select_book.php page after processing
        header("Location: select_journal.php");
        exit();
    } else {
        // No books were selected for suggestion
        echo "No journals selected for suggestion.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
*/

require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggested_journals'])) {
    $suggestedJournals = json_decode($_POST['suggested_journals'], true);

    if (is_array($suggestedJournals) && !empty($suggestedJournals)) {
        $insertedCount = 0;

        foreach ($suggestedJournals as $journalData) {
            $journalName = mysqli_real_escape_string($con, $journalData['journalName']);
            $journalNumber = mysqli_real_escape_string($con, $journalData['journalNumber']);
            $publisher = mysqli_real_escape_string($con, $journalData['publisher']);
            $year = mysqli_real_escape_string($con, $journalData['year']);
            $field = mysqli_real_escape_string($con, $journalData['field']);

            $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, field) 
                            VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$field')";

            $result = mysqli_query($con, $insertQuery);

            if ($result) {
                $insertedCount++;
            } else {
                // Handle insertion errors
                echo "Error inserting journal: " . mysqli_error($con);
            }
        }

        if ($insertedCount > 0) {
            echo "Successfully suggested $insertedCount journal(s).";
            // Redirect to select_journal.php after a brief delay (0 seconds)
            //echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/select_journal.php">';
        } else {
            echo "No journals were suggested.";
        }
    } else {
        echo "No valid journals selected for suggestion.";
    }
} else {
    echo "Invalid request. Please submit the form data.";
}

mysqli_close($con);
?>
