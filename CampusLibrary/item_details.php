<?php

include "includes/session.php";
include "includes/db.php";


if(isset($_GET['id'])){

    $id = $_GET['id'];


    $sql = "SELECT items.*, users.name
            FROM items

            JOIN users

            ON items.owner_id = users.user_id

            WHERE item_id='$id'";


    $result = mysqli_query($conn,$sql);


    $item = mysqli_fetch_assoc($result);


}


?>


<!DOCTYPE html>
<html>

<head>

<title>Item Details</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<div class="details-card">



<img src="uploads/<?php echo $item['image']; ?>">



<h1>
<?php echo $item['item_name']; ?>
</h1>



<p>
<b>Category:</b>
<?php echo $item['category']; ?>
</p>



<p>
<b>Description:</b>
<?php echo $item['description']; ?>
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
<b>Owner:</b>
<?php echo $item['name']; ?>
</p>



<p>
<b>Status:</b>
<?php echo $item['availability']; ?>
</p>




<?php

if($item['availability']=="Available"){


?>


<a class="btn"
href="borrow_request.php?id=<?php echo $item['item_id']; ?>">

Request 

</a>



<?php

}

else{


?>

<h3>
Item Not Available
</h3>


<?php

}

?>



</div>



</body>

</html>