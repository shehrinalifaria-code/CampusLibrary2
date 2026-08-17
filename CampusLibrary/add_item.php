<?php

include "includes/session.php";//without login cannot access this page
include "includes/db.php";


if(isset($_POST['add']))//used POST method for hide url
    {
//taking input
$item_name = $_POST['item_name'];
$category = $_POST['category'];
$description = $_POST['description'];
$condition_status = $_POST['condition_status'];
$location = $_POST['location'];


$owner_id = $_SESSION['user_id'];


$image = $_FILES['image']['name'];

$tmp_name = $_FILES['image']['tmp_name'];//fetch uploaded img path


$upload_path = "uploads/".$image;


move_uploaded_file($tmp_name, $upload_path);



$sql = "INSERT INTO items

(owner_id, item_name, category, description, condition_status, availability, location, image)

VALUES

('$owner_id',
'$item_name',
'$category',
'$description',
'$condition_status',
'Available',
'$location',
'$image')";


//if connection right massage show on top
if(mysqli_query($conn,$sql)){


echo "<script>

alert('Item Added Successfully');

window.location.href='my_items.php';

</script>";


}
else{

echo "Error: ".mysqli_error($conn);

}


}


?>


<!DOCTYPE html>
<html>

<head>

<title>Add Item</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php

include "includes/navbar.php";

?>



<div class="add-item-card">


<h2>
➕ Add New Item
</h2>



<form method="POST" enctype="multipart/form-data">



<label>
Item Name
</label>


<input type="text" name="item_name" required>




<label>
Category
</label>


<select name="category">


<option>Electronics</option>

<option>Tools</option>

<option>Books</option>

<option>Others</option>


</select>





<label>
Description
</label>


<textarea name="description" required></textarea>





<label>
Condition
</label>


<select name="condition_status">


<option>Excellent</option>

<option>Good</option>

<option>Average</option>


</select>





<label>
Location
</label>


<input type="text" name="location" required>





<label>
Image
</label>


<input type="file" name="image" required>





<button class="submit-btn" name="add">

Add Item

</button>



</form>


</div>



</body>

</html>