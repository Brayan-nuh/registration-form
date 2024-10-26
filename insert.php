<?php
$userName=$_POST['userName'];
$passWord=$_POST['passWord'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phonecode=$_POST['phonecode'];
$phone=$_POST['phone'];



    $conn=new mysqli('localhost','root','','test');
    if($conn->connect_error){
        die('Connection failed:'.$conn->connect_error);
    } 
    if (empty($userName) || empty($passWord) || empty($gender) || empty($email) || empty($phonecode) || empty($phone)) {
        die("All fields are required.Received values:".
        "userName = $userName, passWord = $passWord, gender = $gender, email = $email, phonecode = $phonecode, phone = $phone");
    }
    $sql="INSERT INTO registration(userName,passWord,gender,email,phonecode,phone)
    VALUES(?,?,?,?,?,?)";
    $stmt=$conn->prepare("$sql");

    if ($stmt === false) {
        die("Error in prepare statement: " . $conn->error);
    }
    $stmt->bind_param("ssssii",$userName,$passWord,$gender,$email,$phonecode,$phone);

    if ($stmt->execute()) {
        echo "Record inserted successfully";
    }else{
        echo"Error inserting record: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();

?>