<?php

include "includes/session.php";
include "includes/db.php";


$user_id = $_SESSION['user_id'];
//session store user info temp

$sql = "SELECT * FROM items 
        WHERE owner_id='$user_id'";


$result = mysqli_query($conn,$sql);


?>


<!DOCTYPE html>
<html>

<head>

<title>My Items</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>


<h2 class="page-title">
📦 My Items
</h2>



<div class="items-container">


<?php


if(mysqli_num_rows($result)>0){


while($item=mysqli_fetch_assoc($result)){


?>


<div class="item-card">



<img src="uploads/<?php echo $item['image']; ?>">



<h3>
<?php echo $item['item_name']; ?>
</h3>



<p>
<b>Category:</b>
<?php echo $item['category']; ?>
</p>



<p>
<b>Condition:</b>
<?php echo $item['condition_status']; ?>
</p>



<p>
<b>Location:</b>
<?php echo $item['location']; ?>
</p>



<p>
<b>Status:</b>

<span class="status">

<?php echo $item['availability']; ?>

</span>

</p>



<div class="item-buttons">


<a href="edit_item.php?id=<?php echo $item['item_id']; ?>"
class="edit-btn">

Edit

</a>




<a href="delete_item.php?id=<?php echo $item['item_id']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete?');">

Delete

</a>


</div>



</div>


<?php


}


}

else{


echo "<h3>No Items Added Yet</h3>";


}


?>


</div>



</body>

</html>