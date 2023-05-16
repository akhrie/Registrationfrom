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
   
    $sql = "INSERT INTO registration (ID, Name, Gender, DOB, Course, Branch, RollNo, Email_Address, User_Name, AboutUs, Password, Photo) 
    VALUES('$ID', '$Name', '$Gender', '$DOB', '$Course', '$Branch', '$RollNo', '$Email_Address', '$User_Name', '$AboutUs', '$Password', '$image')";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Inserted Successfully")</script>';
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
