<!DOCTYPE html>

<head>
  <title>Search Books</title>
  <link rel="stylesheet" href="../style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../manage_books/css/bootstrap.min.css">
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

        .submenu {
            display: none;
            flex-direction: column;
            position: relative;
            background-color: #003366;
        }

        .submenu button {
            width: 100%;
        }
        #suggestions {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            width: 35%;
        }

        .suggestion {
            padding: 5px;
            cursor: pointer;
        }

        .suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <header>
        <div id="header" class="btn-group1">
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
    <button onclick="window.location.href='../manage_books/adding_books.html'">Add New Books</button>
    <button onclick="window.location.href='update_books.php'" >Update Books</button>
    <button onclick="window.location.href='delete_books.php'">Delete Book</button>
    <button onclick="window.location.href='search_books.php'" id="user-btn">Search Book</button>
    <button onclick="window.location.href='../admin1.php'">Logout</button>
  </div>
  <br>
  <div class="container">
    <h2><b>Search the Books</b> </h2>
    <center>
    <form method="POST" action="">
        <label for="isbn"><b> ISBN Number : </b></label>
        <input type="text" name="search" id="search" placeholder="Enter the Book ISBN Number" size="30" required>
        <div id="suggestions"></div><br><br><br><br>
        <input type="submit" value="search">
    </form>
    </center>


    <?php

// $host = "localhost";
// $port = 3308;
// $user = "root";
// $password = "";
// $db = "indenting";
// $table = "users";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Retrieve form data
  $id = $_POST['search'];

  //Connect to the database
  $conn = new mysqli("127.0.0.1:3308", "root", "", "indenting");

  //Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

      //Retrieve data from the database by using id
      $sql = "SELECT * FROM add_new_books WHERE isbn = '$id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        //output data of each row
        while ($row = mysqli_fetch_assoc($result))   //to fetch a single row from the result set returned by MySQL database query
        {
          //echo "<div style='background-color: lightgreen; padding: 10px; border: solid lightcoral;'>";
          echo " <p style='font-weight: bold; font-size:38px; padding:50px' > 
            Book Name : " . $row["book_name"] . "<br>";
          echo "Author  : " . $row["author"] . "<br>";
          echo "Edition  : " . $row["edition"] . "<br>";
          echo "ISBN  : " . $row["isbn"] . "<br>";
          echo "Publisher  : " . $row["publisher"] . "<br>";
          echo "Year  : " . $row["year"] . "<br>";
          echo "Cost  : " . $row["cost"] . "<br>";
          echo "Field  : " . $row["field"] . "<br>";          
          echo "</p>";
          echo "</div>";
        }
      } else {
        echo "No books found with the given ISBN Number";
      }

      mysqli_close($conn);
    }

    ?>

  </div>
  <script>
   var searchInput = document.getElementById('search');
    var suggestionsContainer = document.getElementById('suggestions');

    searchInput.addEventListener('keyup', function () {
      var searchValue = searchInput.value;
      suggestionsContainer.innerHTML = '';

      if (searchValue.trim() !== '') {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var suggestions = JSON.parse(xhr.responseText);

            suggestions.forEach(function (suggestion) {
              var suggestionDiv = document.createElement('div');
              suggestionDiv.className = 'suggestion';
              suggestionDiv.textContent = suggestion;
              suggestionDiv.addEventListener('click', function () {
                searchInput.value = suggestion;
                suggestionsContainer.innerHTML = '';
              });
              suggestionsContainer.appendChild(suggestionDiv);
            });
          }
        };

        xhr.open('GET', 'get_books_suggestions.php?search=' + searchValue, true);
        xhr.send();
      }
    });
    </script>
  <script>
              // Get the current page URL
              var currentPage = window.location.href;

              // Check if the current page URL matches the "new_user.html" URL
              if (currentPage.includes("search_books.php")) {
                  // Add the "active" class to the button
                  document.getElementById("user-btn").classList.add("active");
              }
          </script>
</body>

</html>