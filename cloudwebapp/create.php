<?php
require "config/connection.php";
$res1 = mysqli_query($conn,'SELECT  * FROM department');
if (isset($_POST['submit'])) {
    

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $stdID = $_POST['studentID'];
    $deptID = $_POST['deptID'];

    $sql= "INSERT INTO students (stdID, fname, lname, deptID) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $stdID, $fname, $lname, $deptID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

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
<h2>Add a student</h2>

<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname"><br>
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname"><br>
    <label for="studentID">Student ID</label>
    <input type="text" name="studentID" id="studentID"><br>
    <label for="deptID">Department ID</label>

    <select name="deptID" id="deptID" >
        <option value=""><-- Please Select --></option>

        <?php 
             
          while($row = mysqli_fetch_array($res1)) {
              echo "<option value='".$row['deptID']."'>".$row['deptName']."</option>";
          } 
              mysqli_close($conn);?>
    </select><br>

    <button type="submit" name="submit" id="submit" onclick='confirmSubmit()'><strong>Submit</strong></button>
</form>

<a href="index.php">Back to HOME</a>
</div>
<?php include "templates/footer.php";?>
