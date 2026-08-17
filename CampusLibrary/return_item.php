<?php

include "includes/session.php";
include "includes/db.php";


if(isset($_GET['id'])){


$item_id = $_GET['id'];

$user_id = $_SESSION['user_id'];



// Check borrowed item belongs to user
//fetching info of the items which already given
$sql = "SELECT * FROM borrow_requests
        WHERE item_id='$item_id'

        AND borrower_id='$user_id'

        AND status='Approved'";


$result = mysqli_query($conn,$sql);



if(mysqli_num_rows($result)>0){



    // when item return Change item status

    mysqli_query($conn,

    "UPDATE items

     SET availability='Available'

     WHERE item_id='$item_id'"

    );



    // Update request status

    mysqli_query($conn,

    "UPDATE borrow_requests

     SET status='Returned'

     WHERE item_id='$item_id'

     AND borrower_id='$user_id'

     AND status='Approved'"

    );



    echo "<script>

    alert('Item Returned Successfully');

    window.location.href='my_borrowed.php';

    </script>";



}

else{


echo "<script>

alert('You cannot return this item');

window.location.href='browse.php';

</script>";

}



}


?>