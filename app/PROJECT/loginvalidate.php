<?php
// require  'qr.class.php';
require  'QRCode.php';
$name=$_POST['name'];
$password=$_POST['password'];
$dbname="project";
$hostname="localhost";
$username="root";
$pass="";

$link=mysqli_connect($hostname,$username,$pass,$dbname);
if(!$link)
  die('could not connect'.mysql_error());

  $query="SELECT `imei` FROM `final` WHERE Name='$name' and password='$password'";
  $result = $link->query($query);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $im=$row['imei'];
    $ran=mt_rand(1000,9999);
    $en=$im.$ran;
    $cipher = "rijndael-128";
  $mode = "cbc";
  $secret_key = "D4:6E:AC:3F:F0:BE";
  $iv = "fedcba9876543210";
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
  $cyper_text = mcrypt_generic($td,$en);
  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);
  $encrypt=bin2hex($cyper_text);
  $oQRC = new QRCode;
  $oQRC->data($encrypt);
  //<img src=$oQRC->get(300) />
  $oQRC->display();

  }
  else {
    echo "Invalid password";
  }
?>
</br>
<form action="result.php" method="post">
  <label>4 digit code </label><input type="text" name="code">
  <input type="hidden" name="ran" value="<?php echo $ran ?>" />
  <input type="submit" value="submit">
  </form>

