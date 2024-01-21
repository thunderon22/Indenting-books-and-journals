<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }

    h1,
    h2 {
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
  </style>
  <title>Select Book</title>
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
    <button onclick="window.location.href='select_book.php'" id="user-btn">Select Books</button>
    <button onclick="window.location.href='select_journal.php'">Select Journals</button>
    <button onclick="window.location.href='suggest_books.html'">Suggest Books</button>
    <button onclick="window.location.href='suggest_journals.html'">Suggest Journals</button>
    <button onclick="window.location.href='../faculty/profile/edit_profile.php'">Edit Profile</button>
    <button onclick="window.location.href='../faculty.php'">Logout</button>
  </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="display-6 text-center">Select and Suggest Books</h2>
          </div>
          <div class="card-body">
            <form action="process_suggested_books.php" method="post">
              <table class="table table-bordered text-center" id="bookTable">
                <tr class="bg-dark text-white heading-row">
                  <td> Book Name </td>
                  <td> Author </td>
                  <td> Edition </td>
                  <td> ISBN Number </td>
                  <td>
                    <select id="publisherFilter">
                      <option value="">All publishers</option>
                      <?php
                      require_once 'config/db1.php';
                      $query = "SELECT DISTINCT publisher FROM add_new_books";
                      $publisherData = mysqli_query($con, $query);
                      while ($publisher = mysqli_fetch_assoc($publisherData)) {
                        echo "<option value='" . htmlspecialchars($publisher['publisher']) . "'>" . htmlspecialchars($publisher['publisher']) . "</option>";
                      }
                      ?>
                    </select>
                    <button type="button" onclick="filterTable1(); return false;">Filter</button>
                  </td>
                
                  <td>
                    <select id="yearSortDirection">
                      <option value="asc">Ascending</option>
                      <option value="desc">Descending</option>
                    </select>
                    <!-- Add the "return false;" to prevent form submission -->
                    <button type="button" onclick="sortTable(); return false;">Sort</button>

                  </td>
                  <td> Cost </td>
                  <td>
                    <select id="fieldFilter">
                      <option value="">All Fields</option>
                      <?php
                      require_once 'config/db1.php';
                      $query = "SELECT DISTINCT field FROM add_new_books";
                      $fieldData = mysqli_query($con, $query);
                      while ($field = mysqli_fetch_assoc($fieldData)) {
                        echo "<option value='" . htmlspecialchars($field['field']) . "'>" . htmlspecialchars($field['field']) . "</option>";
                      }
                      ?>
                    </select>
                    <button type="button" onclick="filterTable(); return false;">Filter</button>
                  </td>
                  <td> Suggest </td>
                </tr>
                <?php
                $query = "select * from add_new_books";
                $data = mysqli_query($con, $query);
                $total = mysqli_num_rows($data);

                if ($total != 0) {
                  while ($result = mysqli_fetch_assoc($data)) {
                    echo "
                                        <tr>
                                        <td>" . $result['book_name'] . "</td>
                                        <td>" . $result['author'] . "</td>
                                        <td>" . $result['edition'] . "</td>
                                        <td>" . $result['isbn'] . "</td>
                                        <td>" . $result['publisher'] . "</td>
                                        <td>" . $result['year'] . "</td>
                                        <td>" . $result['cost'] . "</td>
                                        <td>" . $result['field'] . "</td>
                                        <td>
                                            <input type='checkbox' class='suggested-book-checkbox' data-book='" . htmlentities(json_encode($result)) . "'>
                                        </td>
                                        </tr>
                                        ";
                  }
                } else {
                  echo "No records found";
                }
                ?>
              </table>
              <!--<button type="submit" class="btn btn-success">Suggest Selected Books</button>-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="text-center mt-3">
    <button id="suggestButton" class="btn btn-success" type="button">Suggest Selected Books</button>

  </div>

  <script>
    function sortTable() {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById('bookTable');
      switching = true;
      while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length - 1; i++) {
          shouldSwitch = false;
          x = rows[i].getElementsByTagName('td')[5]; // 5 is the index of the Year column
          y = rows[i + 1].getElementsByTagName('td')[5]; // 5 is the index of the Year column
          var direction = document.getElementById('yearSortDirection').value;
          if ((direction === 'asc' && parseInt(x.textContent) > parseInt(y.textContent)) ||
            (direction === 'desc' && parseInt(x.textContent) < parseInt(y.textContent))) {
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }

    function filterTable() {
      var selectedField = document.getElementById('fieldFilter').value.toLowerCase();
      $('#bookTable tr').each(function() {
        if (!$(this).hasClass('heading-row')) { // Exclude heading row
          var fieldCell = $(this).find('td:eq(7)').text().toLowerCase(); // 7 is the index of the Field column
          if (selectedField === '' || fieldCell === selectedField) {
            $(this).show();
          } else {
            $(this).hide();
          }
        }
      });
    }

    function filterTable1() {
      var selectedpublisher = document.getElementById('publisherFilter').value.toLowerCase();
      $('#bookTable tr').each(function() {
        if (!$(this).hasClass('heading-row')) { // Exclude heading row
          var publisherCell = $(this).find('td:eq(4)').text().toLowerCase(); // 4 is the index of the Field column
          if (selectedpublisher === '' || publisherCell === selectedpublisher) {
            $(this).show();
          } else {
            $(this).hide();
          }
        }
      });
    }

    $(document).ready(function() {
      // Handle the click event of the "Suggest Selected Books" button
      $("#suggestButton").on("click", function() {
        var selectedBooks = [];
        $(".suggested-book-checkbox:checked").each(function() {
          var bookData = $(this).data("book");
          selectedBooks.push(bookData);
        });

        // Check if at least one book is selected
        if (selectedBooks.length === 0) {
          alert("No books selected for suggestion.");
          return; // Prevent form submission
        }

        // Send the selected books to the server for processing
        $.ajax({
          type: "POST",
          url: "process_suggested_books.php", // Updated the URL here
          data: {
            suggested_books: JSON.stringify(selectedBooks) // Convert to JSON string
          },
          success: function(response) {
            // Handle the response from the server, e.g., display a success message
            alert(response);
            // You can redirect to another page or perform other actions as needed.
          },
          error: function(xhr, status, error) {
            // Handle errors here
            alert("Error: " + xhr.responseText);
          }
        });
      });
    });
  </script>
  <script>
    // Get the current page URL
    var currentPage = window.location.href;

    // Check if the current page URL matches the "new_user.html" URL
    if (currentPage.includes("select_book.php")) {
        // Add the "active" class to the button
        document.getElementById("user-btn").classList.add("active");
    }
  </script>
</body>

</html>