<?php

include 'includes/db.php';
include 'includes/session.php';


// Approve Request
//when owner approve request get the id

// Approve Request

if(isset($_GET['approve'])){

    $id = $_GET['approve'];

    // Get item ID from selected request
    $get = mysqli_query($conn,
        "SELECT item_id
         FROM borrow_requests
         WHERE request_id='$id'
         AND status='Pending'"
    );

    if(mysqli_num_rows($get) > 0){

        $data = mysqli_fetch_assoc($get);

        $item_id = $data['item_id'];


        // Approve selected request
        mysqli_query($conn,

            "UPDATE borrow_requests
             SET status='Approved'
             WHERE request_id='$id'"
        );


        // Reject all other pending requests
        // for the same item
        mysqli_query($conn,

            "UPDATE borrow_requests
             SET status='Rejected'
             WHERE item_id='$item_id'
             AND status='Pending'
             AND request_id!='$id'"
        );


        // Make item Borrowed
        mysqli_query($conn,

            "UPDATE items
             SET availability='Borrowed'
             WHERE item_id='$item_id'"
        );

    }


    header("Location: manage_requests.php");
    exit();

}



// Reject Request

if(isset($_GET['reject'])){


    $id=$_GET['reject'];



    mysqli_query($conn,

    "UPDATE borrow_requests
     SET status='Rejected'
     WHERE request_id=$id"

    );



    header("Location: manage_requests.php");
    exit();


}




$owner_id=$_SESSION['user_id'];



$sql="SELECT borrow_requests.*, items.item_name

FROM borrow_requests

JOIN items

ON borrow_requests.item_id=items.item_id

WHERE borrow_requests.owner_id='$owner_id'

ORDER BY request_date DESC";



$result=mysqli_query($conn,$sql);



?>



<!DOCTYPE html>

<html>

<head>

<title>Manage Requests</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<h2 class="page-title">
📩 Manage Request Box
</h2>




<div class="table-box">


<table>


<tr>

<th>Request ID</th>

<th>Item</th>

<th>Borrower ID</th>

<th>Status</th>

<th>Date</th>

<th>Action</th>

</tr>



<?php while($row=mysqli_fetch_assoc($result)){ ?>


<tr>


<td>
<?php echo $row['request_id']; ?>
</td>



<td>
<?php echo $row['item_name']; ?>
</td>



<td>
<?php echo $row['borrower_id']; ?>
</td>



<td>


<?php

if($row['status']=="Pending"){
//spam used for styling small part
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




<td>


<?php if($row['status']=="Pending"){ ?>


<a class="approve-btn"

href="manage_requests.php?approve=<?php echo $row['request_id']; ?>">

Approve

</a>



<a class="reject-btn"

href="manage_requests.php?reject=<?php echo $row['request_id']; ?>">

Reject

</a>



<?php }

else{

echo "Completed";

}

?>


</td>



</tr>



<?php } ?>


</table>


</div>



</body>

</html>