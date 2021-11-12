<?php
 //// Database connection, MySQL ////

// Variables
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "pizzaDB";

// Create database
$createDB = false;
if($createDB)
{
     // Connect
     $connection = new mysqli($serverName,$userName,$password);

     // Check connection
     if($connection->connect_error)
     {
          die("DataBase connection failed: " . $connection->connect_error);
     }
     else
     {
          //echo "DataBase connected";
     }

     // Create database
     $sql = "CREATE DATABASE pizzaDB";
     if($connection->query($sql) === true) // Try using query
     {

     }
     else // If some error occured
     {
          if(strpos($connection->error, "database exists") != false) // If databse already exists
          {

          }
          else // Different error occured
          {
               echo "Error creating new database " . $connection->error; 
          }
     }    
}

// Create tables
$createTables = false;
if($createTables)
{
     // Connect
     $connection = new mysqli($serverName,$userName,$password,$dbName);

     // Check connection
     if($connection->connect_error)
     {
          die("DataBase connection failed: " . $connection->connect_error);
     }
     else
     {
          //echo "DataBase connected";
     }

     // Create tables
     $sql = "CREATE TABLE User
     (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `username` varchar(40) NOT NULL,
          `pass` varchar(60) NOT NULL,
          `email` varchar(40) NOT NULL,
          PRIMARY KEY (id)
     )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
     ";
     if($connection->query($sql) === true) // Try using query
     {

     }
     else // If some error occured
     {
          if(strpos($connection->error, "already exists") != false) // If table already exists
          {

          }
          else // Different error occured
          {
               echo "Error creating new table " . $connection->error; 
          }
     }  
}

// Connect to database
$connection = new mysqli($serverName,$userName,$password,$dbName);

// Check connection
if($connection->connect_error)
{
     die("DataBase connection failed: " . $connection->connect_error);
}
else
{
     //echo "DataBase connected";
}
?>