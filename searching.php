<?php
include('database.php');
if($_POST)
{
    $q = mysqli_real_escape_string($connection,$_POST['search']);
    $strSQL_Result = mysqli_query($connection,"select id,name,price from ecomm where name like '%$q%' or name like '%$q%' order by id LIMIT 5");
    while($row=mysqli_fetch_array($strSQL_Result))
    {
        $name   = $row['name'];
        $price      = $row['price'];
        $b_name = '<strong>'.$q.'</strong>';
        $b_price    = '<strong>'.$q.'</strong>';
        $final_name = str_ireplace($q, $b_name, $name);
        $final_price = str_ireplace($q, $b_price, $price);
     ?>
            <div class="show" align="left">
                <span class="name"><?php echo $final_name; ?></span>
            </div>
        <?php
    }
}
?>