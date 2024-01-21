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
    #create-user-button.active {
      background-color: #03213f;
    }
  </style>
  <title>Data From Database</title>
</head>

<body>
<div id="header">
        <div id="img_left">
            <img src="../img/uoh_logo_white.png" alt="University of Hyderabad">
        </div>
        <div id="title">
            <h1>School of Computer and Information Sciences</h1>
            <h2>Library Books / Journals Indenting System</h2>
        </div>
        <div id="img_right">
            <img src="../img/uoh_ioe_white.png" alt="University of Hyderabad">
        </div>
    </div>

    <div id="section" align="left" class="btn-group1">       
        <button onclick="window.location.href='select_book.php'">Select Books</button>
        <button onclick="window.location.href='select_journal.php'">Select Journals</button>
        <button onclick="window.location.href='suggest_books.html'">Suggest Books</button>
        <button onclick="window.location.href='suggest_journals.html'">Suggest Journals</button>
        <button onclick="window.location.href='edit_profile.html'">Edit Profile</button>
        <button onclick="window.location.href='../faculty.php'">Logout</button>
    </div>
  <!--<body class="bg-dark">-->
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="display-6 text-center">Suggested Journals</h2>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center">
              <tr class="bg-dark text-white">
                <td> Journal Name </td>
                <td> Journal Number </td>
                <td> Publisher </td>
                <td> Year of Publication </td>
                <td> Field </td>
                <!--<td> Edit </td>
                <td> Delete </td>-->
              </tr>
              <tr>
                <?php
                require_once 'config/db1.php';
                $query = "select * from suggested_journals";
                $data = mysqli_query($con, $query);
                $total = mysqli_num_rows($data);

                if ($total != 0) {
                  while ($result = mysqli_fetch_assoc($data)) {
                    echo "
                        <tr>
                        <td>" . $result['journalName'] . "</td>
                        <td>" . $result['journalNumber'] . "</td>
                        <td>" . $result['publisher'] . "</td>
                        <td>" . $result['year'] . "</td>
                        <td>" . $result['field'] . "</td>

                        
                        </tr>
                        ";
                  }
                } else {
                  echo "No records found";
                }
                ?>
            <!--137 line code <td><a href='delete2.php?journalNumber=$result[journalNumber]' onclick='return checkdelete()' class='btn btn-danger'>Delete</a></td>-->
            </table>
            <script>
              function checkdelete() {
                return confirm('Are you sure want to Delete this Record');
              }
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>