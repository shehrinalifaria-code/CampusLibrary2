<?php

include "includes/session.php";
include "includes/db.php";


$id = $_GET['id'];//id value  in $id



$sql = "SELECT * FROM items WHERE item_id='$id'";

$result = mysqli_query($conn,$sql);

$item = mysqli_fetch_assoc($result);



if(isset($_POST['update'])){


$item_name = $_POST['item_name'];
$category = $_POST['category'];
$description = $_POST['description'];
$condition_status = $_POST['condition_status'];
$location = $_POST['location'];



$image = $_FILES['image']['name'];



if($image != ""){


$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file(
$tmp,
"uploads/".$image
);



$sql = "UPDATE items SET

item_name='$item_name',
category='$category',
description='$description',
condition_status='$condition_status',
location='$location',
image='$image'

WHERE item_id='$id'";


}

else{


$sql = "UPDATE items SET

item_name='$item_name',
category='$category',
description='$description',
condition_status='$condition_status',
location='$location'

WHERE item_id='$id'";


}



if(mysqli_query($conn,$sql)){


echo "<script>

alert('Item Updated Successfully');

window.location.href='my_items.php';

</script>";


}


}



?>


<!DOCTYPE html>
<html>

<head>

<title>Edit Item</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<div class="form-card">


<h2>
✏️ Edit Item
</h2>



<form method="POST" enctype="multipart/form-data">



<label>
Item Name
</label>

<input type="text" 
name="item_name"
value="<?php echo $item['item_name']; ?>">





<label>
Category
</label>

<select name="category">

<option>
<?php echo $item['category']; ?>
</option>

<option>Electronics</option>

<option>Tools</option>

<option>Books</option>

<option>Others</option>

</select>





<label>
Description
</label>


<textarea name="description">

<?php echo $item['description']; ?>

</textarea>





<label>
Condition
</label>


<select name="condition_status">


<option>
<?php echo $item['condition_status']; ?>
</option>

<option>Excellent</option>

<option>Good</option>

<option>Average</option>


</select>





<label>
Location
</label>


<input type="text"
name="location"
value="<?php echo $item['location']; ?>">





<label>
Current Image
</label>


<img class="preview-img"
src="uploads/<?php echo $item['image']; ?>">





<label>
Change Image
</label>


<input type="file" name="image">





<button class="btn" name="update">

Update Item

</button>



</form>


</div>



</body>

</html>