<?php
    require"header.php";
?>

<main>
<?php
    if (isset($_SESSION['userId']))
    {
        echo '<p class="login-status"> You are logged in! </p>
        <div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>ID</th>
<th>Image Title</th>
<th>Image Order</th>
<th>Image Details</th>
</tr>
</thead>
<tfoot>
<tr>
<th>ID</th>
<th>Name of Image</th>
<th>Image order</th>
<th>Image Details</th>
</tr>
</tfoot>';
include_once "includes/dbh.inc.php";
$userGallery = $_SESSION['userId'];
$sql = "SELECT * from gallery WHERE userGallery=$userGallery";
if (mysqli_query($conn, $sql)) {
echo "";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$count=1;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) { 
echo '<tbody>
<tr>
<td>';
 echo $row["idGallery"]; 
echo '</td>
<td>';
 echo $row["titleGallery"]; 
echo'</td>
<td>';

echo $row["orderGallery"]; 
echo'</td>
<td>';
 echo $row["descGallery"]; 
echo'</td>
</tr>
</tbody>';

$count++;
}
} else {
echo "0 results";
}

echo'</table>';
    }

    else{
        echo"<p class='login-status'> You are logged out! </p>";
    };
?>
</main>

<?php
    require"footer.php";
?>
