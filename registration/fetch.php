<?php
include 'dbconnect.php';

if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = "DELETE FROM registration WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $rid);
    $stmt->execute();
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'fetch.php'</script>";
}

$sql = "SELECT ID, Name, Gender, DOB, Course, Branch, RollNo, Email_Address, User_Name, AboutUs,Password,Photo FROM registration";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1px'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Course</th>
            <th>Branch</th>
            <th>RollNo</th>
            <th>Email_Address</th>
            <th>User_Name</th>
            <th>AboutUs</th>
            <th>Password</th>
            <th>Image</th>
            <th>Action</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["ID"]."</td>
            <td>".$row["Name"]."</td>
            <td>".$row["Gender"]."</td>
            <td>".$row["DOB"]."</td>
            <td>".$row["Course"]."</td>
            <td>".$row["Branch"]."</td>
            <td>".$row["RollNo"]."</td>
            <td>".$row["Email_Address"]."</td>
            <td>".$row["User_Name"]."</td>
            <td>".$row["AboutUs"]."</td>
            <td>".$row["Password"]."</td>
            <td>".$row["Photo"]."</td>
            <td>
                <a href=\"edit.php?id=".$row['ID']."\">Edit</a> |
                <a href=\"fetch.php?delid=".$row['ID']."\" onclick=\"return confirm('Do you really want to delete?');\">Delete</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
