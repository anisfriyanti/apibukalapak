<?php
$id=$_GET['id'];
$token=$_GET['token'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/users/info.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

curl_setopt($ch, CURLOPT_USERPWD, $id.':'.$token);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);


$var = json_decode($result, true);




//produk
$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_URL, "https://api.bukalapak.com/v2/products/mylapak.json");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");

curl_setopt($ch1, CURLOPT_USERPWD, $id.':'.$token);

$result1 = curl_exec($ch1);
if (curl_errno($ch1)) {
    echo 'Error:' . curl_error($ch1);
}
curl_close ($ch1);
$var1 = json_decode($result1, true);
if (isset($var1['products'])){
	$n=count($var1['products']);
}else{
	$n=0;
}
 ?>
 <!DOCTYPE html>
<html>
<head>
<title> BUKALAPAK</title>
</head>
<body>

<h1 align="center"> Detail User Login</h1>
<a href="upload.php?id=<?php echo $id;?>&token=<?php echo $token;?>">tambah</a>
<table border="1" width="745"  cellspacing="0" cellpadding="5" align="center">
<!-- <tr>
<td>Nama</td>
<td><?php echo $var['user']['name'];?></td>
</tr> -->
<tr>
<td>Nama Seller</td>
<td><?php echo  $var['user']['name'];?></td>
<td rowspan="3" align="center"><img width="100" height="100" src="<?php echo  $var['user']['avatar'];?>" title="<?php echo  $var['user']['name'];?>" /></td></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $var['user']['email']; ?></td>
</tr>
<tr>
<td>Phone</td>
<td><?php echo $var['user']['phone']; ?></td>
</tr>


</table>

<!-- batas -->
<?php if ($n!=0) {?>
  <h1 align="center">My lapak </h1>
<table border="1" width="745"  cellspacing="0" cellpadding="5" align="center">
<tr>


	<th colspan="2">Nama Produk</th>
	<th>Harga</th>
	<th>Categr</th>
	<th>Link Bukalapak</th>
  <th>Action</th>

</tr>
<?php
	for ($i=0;$i<$n; $i++){
?>

<tr>

	<td>
		<?php
		$img=array($var1['products'][$i]['images']);


				foreach ($img as $value) {

		?>
		<img  height="120" width="120" src="<?php echo $value[0];?>" /><?php }?> </td>
	<td><?php echo $var1['products'][$i]['name'];?></td>
	<td><?php
	$money=$var1['products'][$i]['price'];
$jadi = "Rp " . number_format($money);
echo $jadi;
	?></td>
	<td><?php echo $var1['products'][$i]['category'];?></td>

	<td><a href="<?php echo $var1['products'][$i]['url'];?>">Link here</a></td>

	<td>

<a href="action.php?token=<?php echo $token;?>&id=<?php echo $id;?>&kode=<?php echo $var1['products'][$i]['id'];?>">pilih</a>

</tr>



<!-- batas -->
<?php }?>
</table>
<?php }else{echo '<h3>TIDAK ADA</h3>';}?>
</body>
</html>
