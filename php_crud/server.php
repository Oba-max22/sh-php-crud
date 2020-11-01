<?php 
   include('connect_db.php');//Connect to database

    
    //Initialize variables
    $name = "";
    $age = "";
    $username = "";
    $address = "";
    $image = "";
    $id = 0;
    $update = false;



    //For Inserting records
    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $username = $_POST['username'];
        $address = $_POST['address'];

        if(isset($_FILES['file'])){
            //specifying the supported file extension
            $validextensions = array("jpg", "jpeg", "JPG", "png", "PNG");
            //explode file name from dot(.)
            $ext = explode('.',basename($_FILES['file']['name']));
            $file_extension = end($ext);
        
            //generate Name for the image
            $image = "image_".rand(100000, 900000).".".$file_extension; 
            $target_path = $image;
            $filesize = 5000000;

            if(($_FILES['file']['size'] < $filesize) && in_array($file_extension, $validextensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], "images/".$image)) {
                    $query = "INSERT INTO crudtable (name, age, username, address, image) VALUES ('$name', '$age', '$username', '$address', '$image')";
                    mysqli_query($db, $query);
                    header('location: index.php'); 
                }
            }
        }   
        
    }

    //For updating records
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        
        if(isset($_FILES['file'])){
            //specifying the supported file extension
            $validextensions = array("jpg", "jpeg", "JPG", "png", "PNG");
            //explode file name from dot(.)
            $ext = explode('.', basename($_FILES['file']['name']));
            $file_extension = end($ext);
        
            //generate Name for the video
            $image = "image_".rand(100000, 900000).".".$file_extension; 
            $target_path = $image;
            $filesize = 5000000;

            if(($_FILES['file']['size'] < $filesize) && in_array($file_extension, $validextensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], "images/".$image)) {
                    mysqli_query($db, "UPDATE crudtable SET name='$name', age = '$age', username = '$username', address= '$address', image= '$image ' WHERE id=$id");
                    header('location: index.php');
                }
            }
        }   
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