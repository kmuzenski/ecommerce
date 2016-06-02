<?php
require_once('database.php');
if($_POST)
{
    $pdo = Database::connect();
    
    $q = mysqli_real_escape_string($connection,$_POST['search']);
    $strSQL_Result = mysqli_query($connection,"select id,name,price from ecomm where name like '%$q%' or name like '%$q%' order by id LIMIT 5");
    while($row=mysqli_fetch_array($strSQL_Result))
    {
        $name   = $row['name'];
        $price      = $row['price'];
        
       
     ?>
            <div class="show" align="left">
                <span class="name"><?php echo $name; ?></span>
            </div>
        <?php
    }
}
?>