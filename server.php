<?php 
   include('connect_db.php');//Connect to database

    session_start();
    //Initialize variables
    $name = "";
    $age = "";
    $username = "";
    $address = "";
    $id = 0;
    $update = false;

    
    
    //For Inserting records
    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $username = $_POST['username'];
        $address = $_POST['address'];

        $query = "INSERT INTO crudtable (name, age, username, address) VALUES ('$name', '$age', '$username', '$address')";
        mysqli_query($db, $query);
        header('location: index.php'); //redirect to index page after inserting
    }

    //For updating records
    if (isset($_POST['update'])) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        

        mysqli_query($db, "UPDATE crudtable SET name='$name', age = '$age', username = '$username', address= '$address' WHERE id=$id");
        header('location: index.php');
    }

    //For deleting
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM crudtable WHERE id=$id");
        header('location: index.php');
    }

    //retrieve records
    $results = mysqli_query($db, "SELECT * FROM crudtable");
    
?>