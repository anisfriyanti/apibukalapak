<?php

$kode = $_GET['kode'];


$jsonfile = "https://api.bukalapak.com/v2/products/$kode.json";
$data = json_decode(file_get_contents($jsonfile), true);
if (isset($data['product'])){
	$n=count($data['product']);
}else{
	$n=0;
}



?>



<!DOCTYPE html>
<html>
<head>
<title> Data pRODUK BUKALAPAK </title>
</head>
<body>
<h1 align="center"> Detail Produk </h1>
<table width="745" border="1" cellspacing="0" cellpadding="5" align="center">

<tr>
<td>Nama Produk</td>
<td><?php echo $data['product']['name'];?></td>

<?php
$img=count($data['product']['images']);

	for ($a=0;$a<$img; $a++){

?>
<td rowspan="11" align="center"><img  height="120" width="120" src="<?php echo $data['product']['images'][$a];?>"
<?php }?>
</td>

</tr>


<tr>
<td>Harga</td>
<td><?php
$money=$data['product']['price'];
$jadi = "Rp " . number_format($money);
echo $jadi;
?></td>
</tr>
<td>Berat</td>
<td><?php echo $data['product']['weight'];?></td>
</tr>
<td>Kondisi</td>
<td><?php echo $data['product']['condition'];?></td>
</tr>
<tr>
<td>Stok</td>
<td><?php echo $data['product']['stock'];?></td>
</tr>
<tr>
<td>URL Product</td>
<td><a href="<?php echo $data['product']['url'];?>">Link here</a></td>
</tr>
<tr>
<td>Brand</td>
<td><?php echo $data['product']['brand'];?></td>
</tr>
<tr>
<tr>
<td>Kategori</td>
<td><?php echo $data['product']['category'];?></td>
</tr>
<tr>
<td>Rating</td>
<td>

<?php
echo $data['product']['rating']['average_rate'];?></td>
</tr>
<tr>


<td >Kurir</td>
<td>
	<table width="200" border="0">
  <tr>
  <?php
$n=count($data['product']['courier']);

	for ($i=0;$i<$n; $i++){

		?>
<th scope="row">
		<?php
echo  $data['product']['courier'][$i];
	 ?>
   </th>

  </tr>
	<?php }?>
</table></td>
</td>

</tr>
<tr>
<td >Description</td>
<td colspan="2" ><?php echo $data['product']['desc'];?></td>
</tr>


</table>
<h1 align="center"> Detail Seller </h1>
<table width="745" border="1" cellspacing="0" cellpadding="5" align="center">

<tr>
<td>Nama Seller</td>
<td><?php echo $data['product']['seller_name'];?></td>
<td rowspan="10" align="center"><img src="<?php echo $data['product']['seller_avatar'];?>" title="<?php echo $data['product']['seller_name'];?>" /></td></td>
</tr>


<td>Asal</td>
<td><?php echo $data['product']['city'];?> , <?php echo $data['product']['province'];?></td>
</tr>

<tr>
<td>Positif Feedback</td>
<td><?php echo $data['product']['seller_positive_feedback'];?></td>
</tr>
<tr>
<td>Seller level</td>
<td><?php echo $data['product']['seller_level'];?></td>
</tr>


</table>



</body>
</html>
