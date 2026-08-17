<?php

include "includes/db.php";
//without register user cannot login
//that's why not include session.php
//below by using POST hiding url
if(isset($_POST['register'])){


$name=$_POST['name'];
$student_id=$_POST['student_id'];
$department=$_POST['department'];
$email=$_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);$role=$_POST['role'];
$phone=$_POST['phone'];



// Check email already exists

$check="SELECT * FROM users WHERE email='$email'";

$result=mysqli_query($conn,$check);



if(mysqli_num_rows($result)>0){


echo "<script>

alert('Email already exists');

</script>";


}

else{


$sql="INSERT INTO users

(name,student_id,department,email,password,role,phone)

VALUES

('$name',
'$student_id',
'$department',
'$email',
'$password',
'$role',
'$phone')";



if(mysqli_query($conn,$sql)){


echo "<script>

alert('Registration Successful');

window.location.href='login.php';

</script>";


exit();


}

else{


echo "Error: ".mysqli_error($conn);


}


}


}


?>


<!DOCTYPE html>

<html>


<head>

<title>Register - Campus Library</title>

<link rel="stylesheet" href="css/style.css">

</head>



<body class="login-body">



<div class="register-card">



<h2>
           📚 Campus Tools Sharing System
</h2>



<h2>
Create Account
</h2>




<form method="POST">



<label>
Name
</label>


<input type="text" name="name" required>




<label>
Student ID
</label>


<input type="text" name="student_id" required>




<label>
Department
</label>


<input type="text" name="department">




<label>
Email
</label>


<input type="email" name="email" required>




<label>
Password
</label>


<input type="password" name="password" required>




<label>
Role
</label>


<select name="role">


<option value="Student">
Student
</option>


<option value="Staff">
Staff
</option>


</select>




<label>
Phone
</label>


<input type="text" name="phone">




<button type="submit" name="register">

Register

</button>



<p>

Already have an account?

<a href="login.php">
Login Here
</a>


</p>



</form>


</div>



</body>


</html>