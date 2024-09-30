
<?php
include('config/db_connect.php');

 
 $search = '';

if(isset($_POST['delete'])){
  $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);
  $sql="DELETE FROM student WHERE id=$id_to_delete";

  if(mysqli_query($conn,$sql)){
    header('Location: index.php');
  }else{
    //error
    echo 'query error:'.mysqli_error($conn);       
 }

}

$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <h2 class="center">STUDENT MANAGEMENT</h2>
    <div class="row">
        <form method="GET" action="index.php" class="col s12">
            <div class="input-field col s10">
                <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>"required>
                <label for="search">Search Students</label>
            </div>
            <div class="input-field col s2">
                <button type="submit" class="btn">Search</button>
            </div>
            <div class="center-align" style="position:relative;bottom:130px;">
        <a href="add.php" class="btn green">Add New Student</a>
    </div>
        </form>
    </div>
    <table>
        <thead>
          <tr>
              <th>Name</th>
              <th>RollNo</th>
              <th>Department</th>
              <th>Hostel</th>
              <th>update</th>
              <th>delete</th>

          </tr>
        </thead>

        <tbody>
        <?php 
       if(isset($_GET['search'])){
        $filtervalues=$_GET['search'];
        $query="SELECT *FROM students WHERE CONCAT(Name,Roll_No,Department,Hostel) LIKE '%$filtervalues%' ";
        $query_run=mysqli_query($conn,$query);
        if(mysqli_num_rows($query_run)>0){
          foreach($query_run as $items){
            ?>
            <tr>
              <td><?=$items['id'];?></td>
              <td><?=$items['Name'];?></td>

              <td><?=$items['Roll_No'];?></td>
              <td><?=$items['Department'];?></td>
              <td><?=$items['Hostel'];?></td>
          </tr>





              <?php }
          }
        
        else{
          ?>
          <tr>
            <td >NO RECORDS FOUND</td>
        </tr>
        <?php
        }
        }
        
      ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        //real
         foreach($students as $student){ ?>
          <tr>
            <td><?php echo htmlspecialchars($student['Name']); ?></td>
            <td><?php echo htmlspecialchars($student['Roll_No']); ?></td>
            <td><?php echo htmlspecialchars($student['Department']); ?></td>
            <td><?php echo htmlspecialchars($student['Hostel']); ?></td>
            <td><a href="edit.php? updateid=<?php echo $student['id']; ?>" class="btn blue">Edit</a></td>
            
            <td><form action="index.php"method="post">
              <input type="hidden" name="id_to_delete" value="<?php echo $student['id']; ?>">
              <input type="submit" name="delete" value="Delete" class="btn red brand z-depth-0"></td>
            </form>
          </tr>
         <?php } ?> 
          
        </tbody>
      </table>
            
    
    


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>
