<?php
$token=$_GET['token'];
$id=$_GET['id'];
$category="https://api.bukalapak.com/v2/categories.json";
$cate=json_decode(file_get_contents($category), true);
if(isset($cate['categories'])){
$c=count($cate['categories']);
}else{
	$c=0;
}

if(isset($_POST["submit"])){
$file_tmp=$_FILES['logo']['name'];
$imagePath = 'C:/xampp/htdocs/bukalapak/image/'.$file_tmp.'';
$file = curl_file_create($imagePath);
$body = ['file' => $file];
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://api.bukalapak.com/v2/images.json');
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_USERPWD,  $id.':'.$token);
//curl_setopt($ch, CURLOPT_CAINFO, 'C:/xampp/php/extras/ssl/cacert.pem');
curl_setopt($ch1, CURLOPT_POSTFIELDS, $body);

$hasil = curl_exec($ch1);
if (curl_errno($ch1)) {
    echo 'Error:' . curl_error($ch1);
}
curl_close ($ch1);
$isi = json_decode($hasil, true);
$imagekode= $isi['id'];

//
//
// $isi = json_decode($result1, true);
$t= $isi['status'];
if($t=="OK"){
  echo 'upload berhasil';
}else{
  echo 'upload gagal,';
	echo $isi['message'];

}
   echo "Destination: " . $_FILES['logo']['tmp_name'] . "<br>";

}

 ?>
 <h1 align="center"> Create Product</h1>
 <a href="mylapak.php?id=<?php echo $id;?>&token=<?php echo $token;?>">home</a>
      <table width="745" border="0" cellspacing="0" cellpadding="5" align="center">
<form method="post" enctype="multipart/form-data" action="" name="form_input">



       <tr>
             <td>
          Gambar
             </td>
             <td>

             <br><br>
             <input type="file" name="logo" value=""id="logo">
             </td>
           </tr>
           <tr>

             <td>
             </td>
             <td align="left">
               <input type="submit" name="submit" value="Submit">
             </td>
           </tr>

         </form>
         <form method="post"  enctype="multipart/form-data" action="" name="formdata">
					 <tr>
					 	<td>Kode Gambar
					 	</td>
					 	<td><input type="text" name="kodegambar" id="kodegambar" value="<?php echo $imagekode;?>"/>
					 	</td>
					 </tr>
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
          <option type="number" value="<?php echo $cate['categories'][$ab]['children'][$cd]['id'];?>"><?php echo $cate['categories'][$ab]['children'][$cd]['name'];?></option>

        <?php }} ?>

       </select>
     <?php }else{echo '<h3>TIDAK ADA</h3>';}?>
     </td>
   </tr>
   <tr>
     <td>Name
     </td>
     <td><input type="text" name="name" id="name" value=""/>
     </td>
   </tr>

   <tr>
     <td>Price
     </td>
     <td><input type="number" name="price" id="price" value=""/>
     </td>
   </tr>
   <tr>
     <td>Weight
     </td>
     <td><input type="text" name="weight" id="weight" value="" />
     </td>
   </tr>
   <tr>


     <td>description_bb
     </td>
     <td><input type="text" name="description_bb" id="description_bbt" value="" />
     </td>
   </tr>


   <tr>
     <td>Stok
     </td>
     <td><input type="number" name="stock" id="stock" value="" />
     </td>
   </tr>

   <tr>
     <td>Brand
     </td>
     <td><input type="text" name="brand" id="brand" value="" />
     </td>
   </tr>


   <tr>



   <td> <input type="submit" name="upload" value="Upload">
     </td>

   </tr>
   <tr>

     <td>
     </td>
     <td align="left">

     </td>
   </tr>

   </table>
 </form>


 <?php
if(isset($_POST["upload"])){

 $id_category=$_POST['Kategori'];
 $name=$_POST['name'];
// $new=$_POST['new'];
 $price=$_POST['price'];
 $weight=$_POST['weight'];
 $stock=$_POST['stock'];
 $desc=$_POST['description_bb'];
 $brand=$_POST['brand'];
 $kodeimage=$_POST['kodegambar'];

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
$myObj['images']=$kodeimage;


$myJSON = json_encode($myObj);





 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, "https://api.bukalapak.com/v2/products.json");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 //curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \n\t\"product\": { \"category_id\":\"'.$id_category.'\", \"name\":\"'.$name.'\", \"new\":\"'.$new.'\", \"price\":\"'.$price.'\", \"negotiable\":\"true\", \"weight\":\"'.$weight.'\", \"stock\":\"'.$stock.'\", \"description_bb\":\"'.$desc.'\", \n\t\"product_detail_attributes\":{ \"type\":\"'.$type.'\", \"brand\":\"'.$brand.'\" } }, \n\t\"images\":\"'.$images.'\"}");
//curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \n\t\"product\": { \"category_id\":\"676\", \"name\":\"Jaket scbhcb c caya\", \"new\":\"true\", \"price\":\"3300000\", \"negotiable\":\"true\", \"weight\":\"5\", \"stock\":\"2\", \"description_bb\":\"Aman dan nyaman aman dibaw afidnfid fjbfbj  dhbsh\",\n\t\"product_detail_attributes\":{ \"type\":\"null\", \"brand\":\"Kalibre\" } },  \n\t\"images\":\"2842072379\"}");

curl_setopt($ch, CURLOPT_POSTFIELDS,$myJSON);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_USERPWD,  $id.':'.$token);

 $headers = array();
 $headers[] = "Content-Type: application/json";
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $result = curl_exec($ch);
 if (curl_errno($ch)) {
     echo 'Error:' . curl_error($ch);
 }
 curl_close ($ch);
$option= json_decode($result, true);
 if ($option['status']=="OK") {

 echo 'berhasil di upload';
}else{
	echo 'gagal,';
	echo $option['message'];
}



}
  ?>
