<?php
require "config/connection.php";
$res = mysqli_query($conn, 'SELECT stdID, fname, lname, deptName FROM students, department WHERE students.deptID = department.deptID ');

if(isset($_GET['txtKeyword']) ){
    $stdID = $_GET['txtKeyword'];
    $sql = "SELECT stdID, fname, lname, deptName FROM students,department 
    WHERE students.deptID = department.deptID AND stdID LIKE '%$stdID%' ";
    $res = mysqli_query($conn, $sql);
}
?>

<?php require "templates/header.php"; ?>

<h2>Show all the students</h2>

<form name="frmSearch" method="GET" >
    <table width="599">
        <tr>
            <th>Keyword
            <input name="txtKeyword" type="text" id="txtKeyword">
            <input type="submit" value="Search"></th>
        </tr>
    </table>
</form>

<table>
    <thead>
        <tr>
            <th>StudentID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($res)) {?>
        <tr>
            <td><?php echo $row['stdID']; ?> </td>
            <td><?php echo $row['fname']; ?> </td>
            <td><?php echo $row['lname']; ?> </td>
            <td><?php echo $row['deptName']; ?> </td>
        </tr>
        <?php } 
        mysqli_close($conn);?>
    </tbdody>
</table>
<a href="index.php">Back to HOME</a>
</div>
<?php require "templates/footer.php"; ?>