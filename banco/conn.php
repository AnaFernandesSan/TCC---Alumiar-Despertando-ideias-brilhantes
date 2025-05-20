<?php
      $servername = "alumiar-server.mysql.database.azure.com";
      $username = "trkeaptuil";
      $password = "alumiarIFSP2024";
      $dbname = "saberler_db";
      $port = "3306";

      /*$servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "saberler_db";
      $port = "3306";*/   
  
  
  function connect()
  {
      global $servername, $username, $password, $dbname, $port;
      $conn = mysqli_connect($servername, $username, $password, $dbname, $port);
      return $conn;
  }

  
?>