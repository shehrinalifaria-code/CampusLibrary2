<?php

include "includes/session.php";
include "includes/db.php";


$id = $_SESSION['user_id'];


// User Information

$sql="SELECT * FROM users WHERE user_id='$id'";

$result=mysqli_query($conn,$sql);

$user=mysqli_fetch_assoc($result);



// My Items Count

$item_query=mysqli_query($conn,

"SELECT * FROM items 
WHERE owner_id='$id'"

);

$item_count=mysqli_num_rows($item_query);




// My Borrow Requests Count

$request_query=mysqli_query($conn,

"SELECT * FROM borrow_requests
WHERE borrower_id='$id'"

);

$request_count=mysqli_num_rows($request_query);




// Approved Requests Count

$approved_query=mysqli_query($conn,

"SELECT * FROM borrow_requests
WHERE borrower_id='$id'
AND status='Approved'"

);

$approved_count=mysqli_num_rows($approved_query);


?>


<!DOCTYPE html>
<html>

<head>

<title>My Profile</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<div class="profile-card">


<div class="profile-icon">

👤

</div>



<h2>
My Profile
</h2>



<div class="profile-info">


<p>
<b>Name:</b>
<?php echo $user['name']; ?>
</p>



<p>
<b>Student ID:</b>
<?php echo $user['student_id']; ?>
</p>



<p>
<b>Department:</b>
<?php echo $user['department']; ?>
</p>



<p>
<b>Email:</b>
<?php echo $user['email']; ?>
</p>



<p>
<b>Phone:</b>
<?php echo $user['phone']; ?>
</p>



<p>
<b>Role:</b>
<?php echo $user['role']; ?>
</p>



</div>


</div>





<h2 class="activity-title">
Activities
</h2>




<div class="activity-cards">



<div class="activity-card">

<a href="my_items.php" class="activity-link">


<h3>
📦 My Items
</h3>


<h1>
<?php echo $item_count; ?>
</h1>


</a>

</div>




<div class="activity-card">

<a href="my_requests.php" class="activity-link">

<h3>
📩 My Requests
</h3>

<h1>
<?php echo $request_count; ?>
</h1>

</a>

</div>




<div class="activity-card">

<a href="my_requests.php" class="activity-link">

<h3>
✅ Approved
</h3>

<h1>
<?php echo $approved_count; ?>
</h1>

</a>

</div>



</div>



</body>

</html>