<html>
<head><title>2FA</title></head>
<body>
  <?php

  $dbname="project";
  $hostname="localhost";
  $username="root";
  $password="";
  $link=mysqli_connect($hostname,$username,$password,$dbname);
  if(!$link)
  	die('could not connect'.mysql_error());
    echo "connected";
  //  extract($_POST);
    $name=$_POST['imeinumber'];
    $cipher = "rijndael-128";
  $mode = "cbc";
  $secret_key = "D4:6E:AC:3F:F0:BE";
  //iv length should be 16 bytes
  $iv = "fedcba9876543210";

  // Make sure the key length should be 16 bytes
  $key_len = strlen($secret_key);
  if($key_len < 16 ){
  $addS = 16 - $key_len;
  for($i =0 ;$i < $addS; $i++){
  $secret_key.=" ";
  }
  }else{
  $secret_key = substr($secret_key, 0, 16);
  }

  $td = mcrypt_module_open($cipher, "", $mode, $iv);
  mcrypt_generic_init($td, $secret_key, $iv);
  $cyper_text = mcrypt_generic($td, $name.'1452');
  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);
  echo bin2hex($cyper_text);
  $encrypt=bin2hex($cyper_text);


    $query="INSERT into enimei(imeinum) values('$encrypt')";


    if ($link->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


  ?>
<form method="post">
  Enter IMEi number
  <input type="text" name="imeinumber">
  <input type="submit" value="submit">

</form>
</body>
</html>
