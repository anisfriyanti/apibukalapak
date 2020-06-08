<?php
$kode=$_GET['kode'];
$token=$_GET['token'];
$id=$_GET['id'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/products/$kode/sold.json");

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_USERPWD,  $id.':'.$token);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "delete");


//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//
// curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $kode);

// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
// 'Authorization: Bearer MY_API_TOKEN')
// );

//curl_setopt($ch,CURLOPT_HEADER, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
  //  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close ($ch);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
// $result = curl_exec($ch);
// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);
// //$var = json_decode($result, true);
// echo $result;
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $kode);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $result = curl_exec($ch);
    //$result1 = json_decode($result);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
   curl_close($ch);
//$result = curl_exec($ch);
//echo $result1;


// echo '-';
// echo $token;
// echo '-';
// echo $id;
// echo '-';
// echo $kode;
//
//
//  ?>
