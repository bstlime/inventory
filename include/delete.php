<?php 

include 'DBConn.php';


 $id = $_GET['id'];
 $sql = "DELETE FROM `supplies` WHERE `id` = $id;";
 $query = mysqli_query($conn, $sql);
 
 header('Location: ../menu.php');