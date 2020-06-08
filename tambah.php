<?php
$id_category=$_POST['Kategori'];
$name=$_POST['name'];
$new=$_POST['new'];
$price=$_POST['price'];
$weight=$_POST['weight'];
$stock=$_POST['stock'];
$desc=$_POST['description_bb'];
$brand=$_POST['brand'];
$type=$_POST['type'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/products.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \n\t\"product\": { \"category_id\":\"'.$id_category.'\", \"name\":\"'.$name.'\", \"new\":\"'.$new.'\", \"price\":\"'.$price.'\", \"negotiable\":\"true\", \"weight\":\"'.$weight.'\", \"stock\":\"'.$stock.'\", \"description_bb\":\"'.$desc.'\", \n\t\"product_detail_attributes\":{ \"type\":\"'.$type.'\", \"brand\":\"'.$brand.'\" } }, \n\t\"images\":\"'.$images.'\"}");
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \n\t\"product\": { \"category_id\":\"2443\", \"name\":\"Tas selempang kalibre\", \"new\":\"true\", \"price\":\"3300000\", \"negotiable\":\"true\", \"weight\":\"5\", \"stock\":\"2\", \"description_bb\":\"Aman dan nyaman aman dibaw afidnfid fjbfbj  dhbsh\",\n\t\"product_detail_attributes\":{ \"type\":\"null\", \"brand\":\"Kalibre\" } },  \n\t\"images\":\"2842028639\"}");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, "35867267" . ":" . "6wTtazJK9TEH4tNTzGd9");

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
