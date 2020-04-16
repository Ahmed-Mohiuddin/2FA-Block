<?php
$ran=$_POST['ran'];
$userip=$_POST['code'];

if($ran==$userip)
echo "Valid User";
else
echo "Invalid User";
 ?>
