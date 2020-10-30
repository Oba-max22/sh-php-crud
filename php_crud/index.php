<?php 

    include('server.php'); 

    // fetch the record to be updated
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $rec = mysqli_query($db, "SELECT * FROM crudtable WHERE id=$id");
        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $age = $record['age'];
        $username = $record['username'];
        $address = $record['address'];
        $id = $record['id'];

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>How to create, update, delete database records: PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php $results = mysqli_query($db, "SELECT * FROM crudtable"); ?>    

    <table>
        <thead>
           <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Username</th>
                <th>Address</th>
                <th colspan='2'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id'] ?>" class="edit_btn">Edit</a>
                </td>
                <td>
                    <a href="index.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <form method="post" action="server.php">

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="input-group">
            <label>Name</label>
            <input type="text" name= "name" value="<?php echo $name; ?>">
        </div>  
        <div class="input-group">
            <label>Age</label>
            <input type="text" name= "age" value="<?php echo $age; ?>">
        </div>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name= "username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Address</label>
            <input type="text" name= "address" value="<?php echo $address; ?>">
        </div>
        <div class="input-group">
            <?php if($update == true): ?>
                <button type="submit" name="update" style="background: #556B2F;" >Update</button>
            <?php else: ?>
                <button type="submit" name="save">Save</button>
            <?php endif ?>
        </div>
    </form>
    
</body>
</html>