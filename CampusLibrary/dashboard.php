<?php

include "includes/session.php";
include "includes/db.php";


$user_id = $_SESSION['user_id'];



// Total Items

$total_items = mysqli_query($conn,
"SELECT * FROM items"
);

$total = mysqli_num_rows($total_items);




// My Items

$my_items = mysqli_query($conn,
"SELECT * FROM items
WHERE owner_id='$user_id'"
);

$my_total = mysqli_num_rows($my_items);




// Pending Requests

$pending = mysqli_query($conn,
"SELECT * FROM borrow_requests
WHERE owner_id='$user_id'
AND status='Pending'"
);

$pending_total = mysqli_num_rows($pending);




// Borrowed Items

// My Borrowed Items

$borrowed = mysqli_query($conn,

"SELECT * FROM borrow_requests

WHERE borrower_id='$user_id'

AND status='Approved'"

);


$borrowed_total = mysqli_num_rows($borrowed);


?>


<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<div class="welcome-box">

    <h1>
        👋Welcome <?php echo $_SESSION['name']; ?>
    </h1>

    <h3>
        Role: <?php echo $_SESSION['role']; ?>
    </h3>

</div>



<hr>



<h2>
🏠︎Dashboard Overview
</h2>




<div class="dashboard-cards">


<div class="card">

    <h3>Total Items</h3>

    <p>
        <?php echo $total; ?>
    </p>

</div>



<div class="card">

    <h3>My Items</h3>

    <p>
        <?php echo $my_total; ?>
    </p>

</div>



<div class="card">

    <h3>Pending Requests</h3>

    <p>
        <?php echo $pending_total; ?>
    </p>

</div>



<div class="card">

    <h3>Borrowed</h3>

    <p>
        <?php echo $borrowed_total; ?>
    </p>

</div>


</div>




<br><br>




<?php


if($_SESSION['role']=="Admin"){


?>


<a href="admin_dashboard.php">
Admin Panel
</a>



<?php


}

else{


?>

 
<div class="dashboard-buttons">


<a href="add_item.php" class="btn">
Add New Item
</a>


<a href="browse.php" class="btn">
Browse Items
</a>


<a href="manage_requests.php" class="btn">
Manage Requests
</a>


<a href="my_requests.php" class="btn">
My Borrow Requests
</a>

<a href="my_borrowed.php" class="btn">
My Borrowed Items
</a>
</div>



<?php


}


?>



</body>

</html>