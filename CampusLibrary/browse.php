<?php

include "includes/session.php";
include "includes/db.php";

?>


<!DOCTYPE html>
<html>

<head>

<title>Browse Items</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

//this page will show only available item

//available item info fetching
$sql = "SELECT items.*, users.name
        FROM items
        JOIN users
        ON items.owner_id = users.user_id
        WHERE items.availability='Available'";

$result = mysqli_query($conn,$sql);


?>


<h2 class="page-title">
Browse All Items
</h2>



<div class="item-container">


<?php

//finding number of rows in result
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
<b>Owner:</b>
<?php echo $item['name']; ?>
</p>



<p>
<b>Status:</b>
<?php echo $item['availability']; ?>
</p>




<a class="btn" 
href="item_details.php?id=<?php echo $item['item_id']; ?>">

View Details

</a>



</div>



<?php


}


}

else{


echo "No Items Available";


}


?>


</div>


</body>

</html>