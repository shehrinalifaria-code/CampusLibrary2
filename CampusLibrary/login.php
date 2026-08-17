<?php

session_start();

include "includes/db.php";


if(isset($_POST['login'])){


$email=$_POST['email'];

$password=$_POST['password'];



$sql="SELECT * FROM users 
WHERE email='$email'";

$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)>0){

    $row=mysqli_fetch_assoc($result);


    if(password_verify($password,$row['password'])){


        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['name']=$row['name'];
        $_SESSION['role']=$row['role'];


        header("Location: dashboard.php");
        exit();


    }

    else{

        echo "Wrong Password";

    }


}
else{

    echo "Email not found";

}


$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)>0){


$user=mysqli_fetch_assoc($result);



$_SESSION['user_id']=$user['user_id'];

$_SESSION['role']=$user['role'];

$_SESSION['name']=$user['name'];



header("Location: dashboard.php");

exit();


}

else{


$error="Invalid Email or Password";


}


}


?>


<!DOCTYPE html>
<html>

<head>

<title>Login - Campus Library</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body class="login-body">


<div class="login-card">


<h3>
📚 Campus Tools Sharing System
</h3>


<h2>
➜] login
</h2>



<?php

if(isset($error)){

echo "<p class='error'>$error</p>";

}

?>



<form method="POST">


<label>
Email
</label>


<input type="email" name="email" required>




<label>
Password
</label>


<input type="password" name="password" required>




<button name="login">
Login
</button>



<p>

Don't have an account?

<a href="register.php">
Register Here
</a>


</p>



</form>


</div>


</body>

</html>