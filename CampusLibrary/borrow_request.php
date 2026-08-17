<?php

include "includes/session.php";
include "includes/db.php";


if(isset($_GET['id'])){


$item_id = $_GET['id'];

$borrower_id = $_SESSION['user_id'];



// get Item owner 

// Get item information,finding owner of item

$sql = "SELECT owner_id, availability
        FROM items
        WHERE item_id='$item_id'";


$result = mysqli_query($conn,$sql);


$item = mysqli_fetch_assoc($result);


$owner_id = $item['owner_id'];

$item_status = $item['availability'];



// Check item availability
//already borrowed item  user cannot request 
//window.location used for indicate present location 
//href used for set new location
if($item_status == "Borrowed"){

    echo "<script>
    alert('This item is already borrowed.');
    window.location.href='browse.php';
    </script>";

    exit();

}

// User cannot borrow own item
if($owner_id == $borrower_id){

    echo "<script>
    alert('You cannot borrow your own item.');
    window.location.href='browse.php';
    </script>";

    exit();

}

// Check duplicate request
//first borrow request info fetching 
// where same brower and same id
$check = mysqli_query($conn,
"SELECT * FROM borrow_requests
WHERE item_id='$item_id'
AND borrower_id='$borrower_id'
AND status IN ('Pending','Approved')");
//counting row if its 0 means first time requesting 
// else same id same item before requested 
if(mysqli_num_rows($check) > 0){

    echo "<script>
    alert('You have already requested this item.');
    window.location.href='browse.php';
    </script>";

    exit();

}

// Insert request


$insert = "INSERT INTO borrow_requests

(item_id, borrower_id, owner_id, status)

VALUES

('$item_id',
'$borrower_id',
'$owner_id',
'Pending')";



if(mysqli_query($conn,$insert)){


echo "<script>

alert('Borrow Request Sent');

window.location.href='browse.php';

</script>";


}

else{


echo "Error: ".mysqli_error($conn);


}



}


?>