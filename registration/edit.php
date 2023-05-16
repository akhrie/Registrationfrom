<?php
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    $ID = $_POST['id'];
    $Name = $_POST['name'];
    $Gender = $_POST['gender'];
    $DOB = $_POST['dob'];
    $Course = $_POST['course'];
    $Branch = $_POST['branch'];
    $RollNo = $_POST['rollno'];
    $Email_Address = $_POST['email'];
    $User_Name = $_POST['username'];
    $AboutUs = $_POST['aboutus'];
    $Password = $_POST['password'];

    $image = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Move the uploaded file to a desired directory
    $uploadDirectory = "image/"; // Specify the directory where you want to store the uploaded files
    $targetPath = $uploadDirectory . $image;
    move_uploaded_file($tmpName, $targetPath);

    // Display the image path
    $imagePath = $uploadDirectory . $image;
  

    $sql = "UPDATE registration SET ID='$ID', Name='$Name', Gender='$Gender', DOB='$DOB', Course='$Course', Branch='$Branch', RollNo='$RollNo', Email_Address='$Email_Address', User_Name='$User_Name', AboutUs='$AboutUs', Password='$Password', Photo='$image' WHERE ID='$ID'";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Updated Successfully")</script>';
        echo "<script>window.location.href = 'fetch.php'</script>"; 
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
        echo "<script>window.location.href = 'fetch.php'</script>"; 
        mysqli_close($conn);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="script.js"></script>
</head>

<body>
<h2 ALIGN="CENTER">Registration form</h2>
<form action="insert.php" method="post" name="name" enctype="multipart/form-data" onsubmit="return (validate());">
    <table border="0" align="center">
        <tbody>
            <?php
      

            // Fetch the data from the database
            $ID = $_GET['id'];
            $sql = "SELECT * FROM registration  WHERE ID = '$ID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <tr>
                <td><label for="id">Id:</label></td>
                <td><input id="id" maxlength="50" size="50" name="id" type="text" value="<?php echo $row['ID']; ?>"></td>
            </tr>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input id="name" maxlength="50" size="50" name="name" type="text" value="<?php echo $row['Name']; ?>"></td>
            </tr>
            <tr>
                <td><label for="Gender">Gender:</label></td>
                <td>
                    <select name="gender" id="Gender" maxlength="50">
                        <option value="Male" <?php if($row['Gender'] == 'Male') echo 'selected'; ?>>MALE</option>
                        <option value="Female" <?php if($row['Gender'] == 'Female') echo 'selected'; ?>>FEMALE</option>
                    </select>
                </td>
            </tr>
          
            <tr>
                <td><label for="DOB">DOB:</label></td>
                <td><input id="DOB" maxlength="50" size="50" name="dob" type="Date"/></td>
            </tr>

            <tr>
                <td><label for="course">Choose Course:</label></td>
                <td>
                    <select id="course" name="course">
                        <option value="BCA">BCA</option>
                        <option value="MCA">MCA</option>
                        <option value="O LEVEL">O LEVEL</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="branch">Branch:</label></td>
                <td><input id="branch" maxlength="50" size="50" name="branch" type="text" value="<?php echo $row['Branch']; ?>"></td>
            </tr>

            <tr>
                <td><label for="rollno">Rollno:</label></td>
                <td><input id="rollno" maxlength="50" size="50" name="rollno" type="text" value="<?php echo $row['RollNo']; ?>"></td>
            </tr>

           
<tr>
<td><label for="email">Email_Address:</label></td>
<td><input id="email" maxlength="50" size="50" name="email" type="text" value="<?php echo $row['Email_Address']; ?>"</td>
</tr>

<tr>
<td><label for="username">User_Name:</label></td>
<td><input id="username"maxlength="50" size="50" name="username" type="text" value="<?php echo $row['User_Name']; ?>"</td>
</tr>
<tr>
    <td><label for="aboutus">About Us:</label></td>
    <td>
        <textarea name="aboutus" maxlength="50" style="width: 500px;" align="center"></textarea>
    </td>
</tr>
<tr>
<td><label for="password">Password:</label></td>
<td><input id="password" maxlength="50" size="50" name="password"  type="text" value="<?php echo $row['Password']; ?>"</td>
</tr>

<tr>
<td><label for="username">Upload Photo:</label></td>
<td><input id=""maxlength="50" size="50" name="image" type="file" value="<?php echo $row['Photo']; ?>"/></td>
</tr>

<tr>
<td align="right"><input name="submit" type="Submit"value="Update"/></td>
</tr>

</tbody>
</table>
</form>
</html>


