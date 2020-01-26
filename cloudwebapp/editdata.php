<?php
require "config/connection.php";
require "templates/header.php"; 



if(isset($_GET['searchid']) ){
    $stdID = $_GET['searchid'];
    $sql = "SELECT stdID, fname, lname, deptName FROM students,department 
    WHERE students.deptID = department.deptID AND stdID LIKE '%$stdID%' ";
    $res = mysqli_query($conn, $sql);
}
?>
<script>
    function confirmDelete(ID) { 
        var ans = confirm("Delete this" + ID + " ?");
    if (ans==true){
        document.location = "delete.php?stdID=" + ID;
    }
}
</script>
<h2>Edit students</h2>

<form method="GET">
<input type="text" placeholder="Input Student ID" id="serachid" name="searchid">
<button type="submit" ><strong>Search</strong></button>
</form>

<table>
    <thead>
        <tr>
            <th>StudentID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        
        <?php 
        while($row = mysqli_fetch_assoc($res)) {?>
        <tr>
            <td><?php echo $row['stdID']; ?> </td>
            <td><?php echo $row['fname']; ?> </td>
            <td><?php echo $row['lname']; ?> </td>
            <td><?php echo $row['deptName']; ?> </td>
           
            <td><a href='#' onclick='confirmDelete("<?php echo $row['stdID']; ?>")'> Delete </a></td>
            <td><?php echo "<a href='update.php?stdID=" . $row['stdID']. "'> Update </a>" ;?></td>

        </tr>
        <?php } 
        mysqli_close($conn);?>
    </tbody>
</table>
<a href="index.php">Back to HOME</a>
</div>
<?php require "templates/footer.php"; ?>