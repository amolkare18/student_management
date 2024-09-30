<?php


include('config/db_connect.php');
$Name = $Roll_No = $Department = $Hostel = '';

$errors = array('Name' => '', 'Roll_No' => '', 'Department' => '', 'Hostel' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['Name'])) {
        $errors['Name'] = 'Name is required';
    } else {
        $Name = $_POST['Name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $Name)) {
            $errors['Name'] = 'Name must contain letters only';
        }
    }

    // Roll_No validation
    if (empty($_POST['Roll_No'])) {
        $errors['Roll_No'] = 'Roll no is required';
    } else {
        $Roll_No = $_POST['Roll_No'];
        // if (!ctype_alnum($Roll_No)) {
        //     $errors['Roll_No'] = 'Roll no only contains alphanumeric characters';
        // }
    }

    // Department validation
    if (empty($_POST['Department'])) {
        $errors['Department'] = 'Department is required';
    } else {
        $Department = $_POST['Department'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $Department)) {
            $errors['Department'] = 'Department must contain letters only';
        }
    }

    // Hostel validation
    if (empty($_POST['Hostel'])) {
        $errors['Hostel'] = 'Hostel is required';
    } else {
        $Hostel = $_POST['Hostel'];
        if (!ctype_alnum($Hostel)) {
            $errors['Hostel'] = 'Hostel must contain letters only';
        }
    }

    if (array_filter($errors)) {
        echo 'Errors in the form';
    } else {

        $Name=mysqli_real_escape_string($conn,$_POST['Name']);
        $Roll_No=mysqli_real_escape_string($conn,$_POST['Roll_No']);
        $Department=mysqli_real_escape_string($conn,$_POST['Department']);
        $Hostel=mysqli_real_escape_string($conn,$_POST['Hostel']);

        //create sql
        $sql="INSERT INTO student(Name,Roll_No,Department,Hostel) VALUES('$Name','$Roll_No','$Department','$Hostel')";
        //csave data 
        if(mysqli_query($conn,$sql)){
            header('Location: index.php');
        }else{
            //error
            echo 'query error:'.mysqli_error($conn);       
         }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <section class="container grey-text">
        <h4 class="center">ADD A STUDENT</h4>
        <form action="add.php" class="white" method="POST">
            <label for="">Name</label>
            <input type="text" name="Name" value="<?php echo htmlspecialchars($Name); ?>">
            <div class="red-text"><?php echo $errors['Name']; ?></div>
            <label for="">Roll_No</label>
            <input type="text" name="Roll_No" value="<?php echo htmlspecialchars($Roll_No); ?>">
            <div class="red-text"><?php echo $errors['Roll_No']; ?></div>
            <label for="">Department</label>
            <input type="text" name="Department" value="<?php echo htmlspecialchars($Department); ?>">
            <div class="red-text"><?php echo $errors['Department']; ?></div>
            <label for="">Hostel</label>
            <input type="text" name="Hostel" value="<?php echo htmlspecialchars($Hostel); ?>">
            <div class="red-text"><?php echo $errors['Hostel']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>
