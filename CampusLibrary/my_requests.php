<?php

include "includes/session.php";
include "includes/db.php";


$user_id = $_SESSION['user_id'];



$sql = "SELECT 
        borrow_requests.request_id,
        borrow_requests.item_id,
        borrow_requests.owner_id,
        borrow_requests.status,
        borrow_requests.request_date,
        items.item_name,
        users.name AS owner_name

        FROM borrow_requests

        JOIN items
        ON borrow_requests.item_id = items.item_id

        JOIN users
        ON borrow_requests.owner_id = users.user_id

        WHERE borrow_requests.borrower_id='$user_id'

        ORDER BY borrow_requests.request_date DESC";

$result = mysqli_query($conn,$sql);
if(!$result){
    die(mysqli_error($conn));
}


?>


<!DOCTYPE html>
<html>

<head>

<title>My Borrow Requests</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<h2 class="page-title">
📩 My Request Table
</h2>



<div class="table-box">


<table>


<tr>

<th>
Request ID
</th>


<th>
Item Name
</th>


<th>
Owner
</th>


<th>
Status
</th>


<th>
Date
</th>


</tr>




<?php


if(mysqli_num_rows($result)>0){


while($row=mysqli_fetch_assoc($result)){


?>


<tr>


<td>

<?php echo $row['request_id']; ?>

</td>



<td>

<?php echo $row['item_name']; ?>

</td>



<td>

<?php echo $row['owner_name']; ?>

</td>



<td>


<?php


if($row['status']=="Pending"){


echo "<span class='pending'>Pending</span>";


}

elseif($row['status']=="Approved"){


echo "<span class='approved'>Approved</span>";


}

else{


echo "<span class='rejected'>Rejected</span>";


}


?>


</td>




<td>

<?php echo $row['request_date']; ?>

</td>



</tr>


<?php


}


}

else{

//if there is  no request then show No Borrow Requests Found
echo "<tr><td colspan='5'>No Borrow Requests Found</td></tr>";


}


?>



</table>


</div>



</body>

</html>