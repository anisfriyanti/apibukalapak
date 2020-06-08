<?php
$kode=$_GET['kode'];
$token=$_GET['token'];
$id=$_GET['id'];



$category="https://api.bukalapak.com/v2/categories.json";
$cate=json_decode(file_get_contents($category), true);
if(isset($cate['categories'])){
$c=count($cate['categories']);
}else{
	$c=0;
}






$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/products/$kode.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

curl_setopt($ch, CURLOPT_USERPWD, $id.':'.$token);

$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$var = json_decode($result, true);

function GetSelected($dt_tbl,$dt_form)
	{
	  if (trim($dt_tbl)==trim($dt_form)){
	    return "Selected='Selected'";
	  } else {
	    return "";
	  }
	}

 ?>


 <h1 align="center">View Product</h1>
 <a href="mylapak.php?id=<?php echo $id;?>&token=<?php echo $token;?>">home</a>
      <table width="745" border="1" cellspacing="0" cellpadding="5" align="center">
<form method="post" enctype="multipart/form-data" action="" name="form_input">






  <tr>
    <td>Category
    </td>
    <td>

      <?php if ($c!=0) {

        ?>
      <select id="Kategori" name="Kategori" >
    <?php for ($ab=0;$ab<$c; $ab++){?>

      <?php
   $child=count($cate['categories'][$ab]['children']);

 for ($cd=0;$cd<$child; $cd++){


   ?>
         <option type="number" value="<?php echo $cate['categories'][$ab]['children'][$cd]['id'];?>"<?php echo GetSelected($cate['categories'][$ab]['children'][$cd]['id'],$var['product']['category_id']);?>><?php echo $cate['categories'][$ab]['children'][$cd]['name'];?></option>

       <?php }} ?>

      </select>
    <?php }else{echo '<h3>TIDAK ADA</h3>';}?>
    </td>
  </tr>


   <tr>
     <td>Name Produk
     </td>
     <td><input type="text" name="name" id="name" value="<?php echo  $var['product']['name'];?>"/>
     </td>
     <?php
     $img=count($var['product']['images']);

     	for ($a=0;$a<$img; $a++){

     ?>
     <td rowspan="5" align="center"><img  height="120" width="120" src="<?php echo $var['product']['images'][$a];?>">
<?php }?>
     </td>
   </tr>

   <tr>
     <td>Price
     </td>
     <td><input type="number" name="price" id="price" value="<?php echo  $var['product']['price'];?>"/>
     </td>
   </tr>
   <tr>
     <td>Brand
     </td>
     <td><input type="text" name="brand" id="brand" value="<?php echo  $var['product']['brand'];?>" />
     </td>
   </tr>
   <tr>


     <td>Weight
     </td>
     <td><input type="text" name="weight" id="weight" value="<?php echo  $var['product']['weight'];?>" />
     </td>
   </tr>


   <tr>
     <td>Stok
     </td>
     <td><input type="number" name="stock" id="stock" value="<?php echo  $var['product']['stock'];?>" />
     </td>
   </tr>



   <tr>
     <td>Description
     </td>
     <td><textarea name ="description_bb" rows="4" cols="50">
<?php echo  $var['product']['desc'];?>
</textarea>
     </td>
   </tr>


   <tr>

<td></td>

   <td> <input type="submit" name="edit" value="Edit">
  <!-- <a href="delete.php?kode=<?php echo $kode;?>&id=<?php echo $id;?>&token=<?php echo $token;?>"> -->
	<input type="submit" name="delete"  value="Delete">
     </td>

   </tr>
   <tr>


   </tr>

   </table>
 </form>
<?php
 if(isset($_POST["edit"])){
   $kode=$_GET['kode'];
   $token=$_GET['token'];
   $id=$_GET['id'];
   $id_category=$_POST['Kategori'];
   $name=$_POST['name'];
  // $new=$_POST['new'];
   $price=$_POST['price'];
   $weight=$_POST['weight'];
   $stock=$_POST['stock'];
   $desc=$_POST['description_bb'];
   $brand=$_POST['brand'];
   //$kodeimage=$_POST['kodegambar'];

  //convert json_decode
  $myObj['product']['category_id'] =$id_category;
  $myObj['product']['name'] = $name;
  $myObj['product']['negotiable'] = 'true';
  $myObj['product']['price'] = $price;
  $myObj['product']['weight'] = $weight;
  $myObj['product']['stock'] = $stock;
  $myObj['product']['description_bb'] =$desc;
  $myObj['product']['product_detail_attributes']['type']='mewah';
  $myObj['product']['product_detail_attributes']['brand']=$brand;

  $myJSON = json_encode($myObj);
   $ch1 = curl_init();

   curl_setopt($ch1, CURLOPT_URL, "https://api.bukalapak.com/v2/products/$kode.json");
   curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch1, CURLOPT_POSTFIELDS,$myJSON);
   curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "PUT");
   curl_setopt($ch1,CURLOPT_USERPWD, $id.':'.$token);

   $headers1 = array();
   $headers1[] = "Content-Type: application/json";
   curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);

   $result1 = curl_exec($ch1);
   if (curl_errno($ch1)) {
       echo 'Error:' . curl_error($ch1);
   }
   curl_close ($ch1);

$var = json_decode($result, true);
echo $var['status'];
echo $var['message'];
//echo $result1;
 }

if(isset($_POST["delete"])){
	$kode=$_GET['kode'];
	$token=$_GET['token'];
	$id=$_GET['id'];
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/products/$kode/sold.json");

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_USERPWD,  $id.':'.$token);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// $headers = array();
	// $headers[] = "Content-Type: application/json";
	// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	// if (curl_errno($ch)) {
	//     echo 'Error:' . curl_error($ch);
	// }
	   curl_close($ch);
		 $var = json_decode($result, true);
		 echo $var['status'];
		 echo $var['message'];

}
//echo $result;
?>
