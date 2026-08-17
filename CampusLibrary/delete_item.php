<?php

include "includes/session.php";
include "includes/db.php";


if(isset($_GET['id'])){


$id = $_GET['id'];


// before image delete 
$sql = "SELECT image FROM items WHERE item_id='$id'";

$result = mysqli_query($conn,$sql);

$item = mysqli_fetch_assoc($result);


if($item['image']!=""){

    unlink("uploads/".$item['image']);

}


//   delete from only browse page bt stored in db

$delete = "UPDATE items
SET availability='Not Available'
WHERE item_id='$id'";

if(mysqli_query($conn,$delete)){


echo "<script>

alert('Item Deleted Successfully');

window.location.href='my_items.php';

</script>";


}


}


?>