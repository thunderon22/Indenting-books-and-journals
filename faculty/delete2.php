<?php    
//include("config/db1.php");
//error_reporting(0);
require_once 'config/db1.php';
$journalNumber = $_GET['journalNumber'];
$query = "DELETE FROM suggested_journals WHERE JOURNALNUMBER='$journalNumber'";
$data = mysqli_query($con, $query);
if($data)
{
  echo "<script>alert('Record Deleted from Database')</script>";
  ?>
  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/delete.php">
  <?php
}   
else
{
  echo "<script>alert('Failed to Delete data from Database')</script>";
}
?>