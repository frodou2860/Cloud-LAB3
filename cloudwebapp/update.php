<?php
require "config/connection.php";

if(isset($_GET['stdID'])){
    $id = $_GET['stdID'];
    $sql = "SELECT * FROM students WHERE stdID = '$id' ";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    
}else {
    $sql = "SELECT * FROM students";
}
if (isset($_POST['submit'])) {
    

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $stdID = $_POST['stdID'];
    $deptID = $_POST['deptID'];

    $update = mysqli_query($conn,"UPDATE students SET fname='$fname', lname='$lname',deptID='$deptID' WHERE stdID = '$stdID' ");

    if(!isset($sql)){
        die ("Error $sql" .mysqli_connect_error());
    }else{
        header("location: index.php");  
    }
}
?>

<script>
    function confirmSubmit() { 
        var ans = confirm("Do you want to submit");
    if (ans==true){
        document.location = "index.php"
    }
}
</script>

<?php include "templates/header.php";?>
<h2>Update a Data</h2>

<form method="post">
    <label for="studentID">Student ID</label>
    <input type="text" name="stdID" id="stdID" value="<?php echo $row["stdID"];?>"><br>

    <label for="firstname">First Name</label>
    <input type="text" name="fname" id="fname" value="<?php echo $row["fname"];?>"><br>
    <label for="lastname">Last Name</label>
    <input type="text" name="lname" id="lname" value="<?php echo $row["lname"];?>"><br>
    
    <label for="deptID">Department ID</label>

    <select name="deptID" id="deptID"  value="<?php echo $row["deptID"];?>">
        <option value=""><-- Please Select --></option>

        <?php 
             
            $res1 = mysqli_query($conn,'SELECT  * FROM department');
          while($row1 = mysqli_fetch_array($res1)) {
              echo "<option value='".$row1['deptID']."'>".$row1['deptName']."</option>";
          } 
              mysqli_close($conn);?>
    </select><br>

    <button type="submit" name="submit" id="submit" onclick='confirmSubmit()'><strong>Submit</strong></button>
</form>

<a href="index.php">Back to HOME</a>
</div>
<?php include "templates/footer.php";?>
