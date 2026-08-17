<?php

include "includes/session.php";
include "includes/db.php";
include "includes/navbar.php";


$user_id=$_SESSION['user_id'];

//my borrowed item 
$sql="SELECT borrow_requests.*, 
             items.item_name, 
             items.image, 
             items.category,
             items.condition_status

FROM borrow_requests

JOIN items

ON borrow_requests.item_id=items.item_id

WHERE borrow_requests.borrower_id='$user_id'

AND borrow_requests.status='Approved'";


$result=mysqli_query($conn,$sql);


?>


<!DOCTYPE html>
<html>

<head>

<title>My Borrowed Items</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<div class="page-container">


<h2 class="page-title">
📦 My Borrowed Items
</h2>



<div class="item-container">


<?php

//if I borrow something
if(mysqli_num_rows($result)>0){


while($row=mysqli_fetch_assoc($result)){


?>


<div class="item-card">


<img src="uploads/<?php echo $row['image']; ?>"
class="item-image">



<h3>
<?php echo $row['item_name']; ?>
</h3>



<p>
<b>Category:</b>
<?php echo $row['category']; ?>
</p>



<p>
<b>Condition:</b>
<?php echo $row['condition_status']; ?>
</p>



<p>
<b>Status:</b>

<span class="status borrowed">
Borrowed
</span>

</p>



<a href="return_item.php?id=<?php echo $row['item_id']; ?>">

<button class="return-btn">
↩ Return Item
</button>

</a>



</div>



<?php

}

}

else{

echo "

<div class='empty-box'>

<h3>No Borrowed Items Found</h3>

</div>

";

}


?>


</div>


</div>


</body>

</html>