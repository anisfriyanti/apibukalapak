<?php
//$kode=$_GET['kode'];
$token=$_GET['token'];
$id=$_GET['id'];


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/products/relist.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt($ch, CURLOPT_USERPWD, $id.':'.$token);

$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
echo $result;

 ?>
