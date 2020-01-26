<?php
if (isset($_POST['submit'])) {
    require "config/connection.php";
}
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $stdID = $_POST['studentID'];
    $deptID = $_POST['deptID'];

    if ($stmt = mysqli_prepare($conn, "INSERT INTO students (stdID, fname, lname, deptID) VALUES (?, ?, ?, ?)"));
    mysqli_stmt_bind_param($stmt, 'ssss', $stdID, $fname, $lname, $deptID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>

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
    <input type="text" name="deptID" id="deptID"><br>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to HOME</a>
</div>
<?php include "templates/footer.php";?>
