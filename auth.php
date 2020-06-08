<?php
if (($_POST['username']) and ($_POST['password']))
{
  $alamat='http://localhost/bukalapak/';
		$pwd=$_POST['password'];
		$username=$_POST['username'];



    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/authenticate.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$pwd);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close ($ch);
    $var = json_decode($result, true);
    $token= $var['token'];
    $id=$var['user_id'];
    if ($var['status']=='OK') {
        header("location:".$alamat."mylapak.php?token=$token&id=$id");
    }else{
      echo "gagal";
    }

  }


// 			else
// 			{
//
// 				header("location:".$alamat."login.php");
//
// 			}
//
// }
// else
// {
//
// 		header("location:".$alamat."login.php");
// }




 ?>
