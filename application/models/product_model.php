<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class product_model extends CI_Model
{
public function create($subcategory,$quantity,$name,$type,$description,$visibility,$price,$relatedproduct,$category,$color,$size,$sizechart,$status,$sku,$image1,$image2,$image3,$image4,$image5,$baseproduct)
{
$data=array("subcategory" => $subcategory,"quantity" => $quantity,"name" => $name,"type" => $type,"description" => $description,"visibility" => $visibility,"price" => $price,"category" => $category,"color" => $color,"size" => $size,"sizechart" => $sizechart,"status" => $status,"sku" => $sku,"image1" => $image1,"image2" => $image2,"image3" => $image3,"image4" => $image4,"image5" => $image5,"baseproduct" => $baseproduct);
$query=$this->db->insert( "fynx_product", $data );
$id=$this->db->insert_id();
    foreach($relatedproduct AS $key=>$value)
        {
            $this->product_model->createrelatedproduct($value,$id);
        }
if(!$query)
return  0;
else
return  $id;
}
    public function createrelatedproduct($value,$productid)
	{
		$data  = array(
			'relatedproduct' => $value,
			'product' => $productid
		);
		$query=$this->db->insert( 'relatedproduct', $data );
		return  1;
	}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("fynx_product")->row();
return $query;
}
function getsingleproduct($id){
$this->db->where("id",$id);
$query=$this->db->get("fynx_product")->row();
return $query;
}
public function edit($id,$subcategory,$quantity,$name,$type,$description,$visibility,$price,$relatedproduct,$category,$color,$size,$sizechart,$status, $sku,$image1,$image2,$image3,$image4,$image5,$baseproduct)
{
$data=array("subcategory" => $subcategory,"quantity" => $quantity,"name" => $name,"type" => $type,"description" => $description,"visibility" => $visibility,"price" => $price,"category" => $category,"color" => $color,"size" => $size,"sizechart" => $sizechart,"status" => $status,"sku" => $sku,"image1" => $image1,"image2" => $image2,"image3" => $image3,"image4" => $image4,"image5" => $image5,"baseproduct" => $baseproduct);
    if($image1 != "")
			$data['image1']=$image1;
		if($image2 != "")
			$data['image2']=$image2;
    if($image3 != "")
			$data['image3']=$image3;
    if($image4 != "")
			$data['image4']=$image4;
    if($image5 != "")
			$data['image5']=$image5;
         $query1=$this->db->query("DELETE FROM `relatedproduct` WHERE `product`='$id'");
    foreach($relatedproduct AS $key=>$value)
        {
            $this->product_model->createrelatedproduct($value,$id);
        }
$this->db->where( "id", $id );
$query=$this->db->update( "fynx_product", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `fynx_product` WHERE `id`='$id'");
return $query;
}
    	public function getproductdropdown()
	{
		$query=$this->db->query("SELECT * FROM `fynx_product`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => "Choose an option"
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    public function getvisibility()
	{
		$status= array(
            "" => "Choose an option",
			 "1" => "Yes",
			 "0" => "No",
			);
		return $status;
	}
    public function getcategorydropdown()
	{
		$query=$this->db->query("SELECT * FROM `fynx_category`  ORDER BY `id` ASC")->result();
		$return=array(
		
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    public function getrelatedproductcount($id)
	{
        $return=array();
		$query=$this->db->query("SELECT `fynx_product`.`id`,`fynx_product`.`name` FROM `fynx_product` LEFT OUTER JOIN `relatedproduct` ON `relatedproduct`.`relatedproduct`=`fynx_product`.`id` WHERE `relatedproduct`.`product`='$id'");
		  if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->id;
            }
        }
         return $return;
	}
    function getProductDetails($product,$user,$size,$color)
	{
        $where=" ";
        if($size){
            $where .="AND `fynx_product`.`size`='$size' ";
        }
        else{}
        if($color){
            $where .="AND `fynx_product`.`color`='$color'";
        }
          else{}
        $query['product']=$this->db->query("SELECT `fynx_product`.`id`, `fynx_product`.`subcategory`, `fynx_product`.`quantity`, `fynx_product`.`name`, `fynx_product`.`type`, `fynx_product`.`description`, `fynx_product`.`visibility`, `fynx_product`.`price`, `fynx_product`.`relatedproduct`, `fynx_product`.`category`, `fynx_product`.`color`, `fynx_product`.`size`, `fynx_product`.`sizechart`, `fynx_product`.`status`, `fynx_product`.`sku`, `fynx_product`.`image1`, `fynx_product`.`image2`, `fynx_product`.`image3`, `fynx_product`.`image4`, `fynx_product`.`image5`,`fynx_wishlist`.`user`,`fynx_product`.`baseproduct` FROM `fynx_product`
        LEFT OUTER JOIN `fynx_wishlist` ON `fynx_wishlist`.`product`=`fynx_product`.`id` AND `fynx_wishlist`.`user`='$user' 
        WHERE `fynx_product`.`id`='$product' $where")->row();
        
        $baseproduct=$query['product']->baseproduct;
		
        
      if($baseproduct !=""){
          $query['relatedproduct'] = $this->db->query("SELECT `relatedproduct`.`relatedproduct`,`fynx_product`.`id`, `fynx_product`.`subcategory`, `fynx_product`.`quantity`, `fynx_product`.`name`, `fynx_product`.`type`, `fynx_product`.`description`, `fynx_product`.`visibility`, `fynx_product`.`price`, `fynx_product`.`relatedproduct`, `fynx_product`.`category`, `fynx_product`.`color`, `fynx_product`.`size`, `fynx_product`.`sizechart`, `fynx_product`.`status`, `fynx_product`.`sku`, `fynx_product`.`image1`, `fynx_product`.`image2`, `fynx_product`.`image3`, `fynx_product`.`image4`, `fynx_product`.`image5` FROM `fynx_product`
LEFT OUTER JOIN `relatedproduct` ON `relatedproduct`.`relatedproduct`=`fynx_product`.`id`
WHERE `relatedproduct`.`product`='$product'")->result();
           $query['size'] = $this->db->query("SELECT DISTINCT `fynx_size`.`id`,`fynx_size`.`name` FROM `fynx_size` 
        WHERE `fynx_size`.`id` IN (SELECT `size` FROM `fynx_product` WHERE `baseproduct`='$baseproduct')")->result();
          $query['color'] = $this->db->query("SELECT DISTINCT `fynx_color`.`id`,`fynx_color`.`name` FROM `fynx_color` 
        WHERE `fynx_color`.`id` IN (SELECT `color` FROM `fynx_product` WHERE `baseproduct`='$baseproduct')")->result();
      }
      
		return $query;
	}
      function addtowishlist($user,$product,$color,$size)
    {
           $where="";
            if($color){
                $where .=" `color`='$color' AND ";
            }
            else{
                 $where .="1 AND ";
            }
          if($size){
                $where .=" `size`='$size' AND ";
            }
            else{
                 $where .="1 AND ";
            }
        if($user!="")
        {
             $getexactproduct=$this->db->query("SELECT `id` FROM `fynx_product` WHERE $where `baseproduct`=(SELECT `baseproduct` FROM `fynx_product` WHERE `id`='$product')")->row();
            $exactproduct=$getexactproduct->id;
            if($exactproduct)
            {
                $userwishlist=$this->db->query("SELECT * FROM `fynx_wishlist` WHERE `user`='$user' AND `product`='$exactproduct' AND `color`='$color' AND `size`='$size'")->row();
                if(empty($userwishlist))
                {
                    $query=$this->db->query("INSERT INTO `fynx_wishlist`(`user`,`product`,`color`,`size`) VALUES ('$user','$exactproduct','$color','$size')");
                    return $query;
                }
                else
                {
                    return 0;
                }
            }
        }
        
        return 0;
 
    }
    
    public function createbycsv($file)
	{
        foreach ($file as $row)
        {
            $subcategory=$row['subcategory'];
            $quantity=$row['quantity'];
            $name=$row['name'];
            $type=$row['type'];
            $description=$row['description'];
            $price=$row['price'];
            $relatedproduct=$row['relatedproduct'];
            $category=$row['category'];
            $color=$row['color'];
            $size=$row['size'];
            $sizechart=$row['sizechart'];
            $sku=$row['sku'];
            $image1=$row['image1'];
            $image2=$row['image2'];
            $image3=$row['image3'];
            $image4=$row['image4'];
            $image5=$row['image5'];
            $baseproduct=$row['baseproduct'];
            $sizechartimage=$row['sizechartimage'];
            if($relatedproduct){
             $allrelatedproduct=explode(",",$relatedproduct);
                }
            
            
		$data  = array(
            "quantity" => $quantity,
            "name" => $name,
            "description" => $description,
            "visibility" => 1,
            "price" => $price,
            "status" => 2,
            "sku" => $sku,
            "image1" => $image1,
            "image2" => $image2,
            "image3" => $image3,
            "image4" => $image4,
            "image5" => $image5,
            "baseproduct" => $baseproduct
		);
		$query=$this->db->insert( 'fynx_product', $data );
		$productid=$this->db->insert_id();
            
            //INSERT CATEGORY
             $query1=$this->db->query("SELECT `id` FROM `fynx_category` WHERE `name` = '$category'")->row();
            
            if(empty($query1))
            {
                $data=array("name" => $category,"status" => 1);
                $query=$this->db->insert( "fynx_category", $data );
                $categoryid=$this->db->insert_id();
                
                //SUB CATEGORY
                
                  $querysubcat=$this->db->query("SELECT `id` FROM `fynx_subcategory` WHERE `name` = '$subcategory' AND `category`='$categoryid'")->row();
                if(empty($querysubcat))
                {
                    $data=array("name" => $subcategory,"status" => 1,"category" => $categoryid);
                    $query=$this->db->insert( "fynx_subcategory", $data );
                    $subcategoryid=$this->db->insert_id();
                    
                    $data=array("subcategory" => $subcategoryid);
                    $this->db->where( "id", $productid );
                    $query=$this->db->update( "fynx_product", $data );
                    
                }
                else
                {
                    $subcategoryid=$querysubcat->id;
                    $data=array("subcategory" => $subcategoryid);
                    $this->db->where( "id", $productid );
                    $query=$this->db->update( "fynx_product", $data );
                }
                // update product
                
                $data=array("category" => $categoryid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            else
            {
                  $categoryid=$query1->id;
                //SUB CATEGORY
                
                  $querysubcat=$this->db->query("SELECT `id` FROM `fynx_subcategory` WHERE `name` = '$subcategory' AND `category`='$categoryid'")->row();
                if(empty($querysubcat))
                {
                    $data=array("name" => $subcategory,"status" => 1,"category" => $categoryid);
                    $query=$this->db->insert( "fynx_subcategory", $data );
                    $subcategoryid=$this->db->insert_id();
                    
                    $data=array("subcategory" => $subcategoryid);
                    $this->db->where( "id", $productid );
                    $query=$this->db->update( "fynx_product", $data );
                    
                }
                else
                {
                    $subcategoryid=$querysubcat->id;
                    $data=array("subcategory" => $subcategoryid);
                    $this->db->where( "id", $productid );
                    $query=$this->db->update( "fynx_product", $data );
                }
                  // update product
                $data=array("category" => $categoryid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            //INSERT type
             $query2=$this->db->query("SELECT `id` FROM `fynx_type` WHERE `name` = '$type'")->row();
            
            if(empty($query2))
            {
                $data=array("name" => $type,"status" => 1);
                $query=$this->db->insert( "fynx_type", $data );
                $typeid=$this->db->insert_id();
                
                // update product
                $data=array("type" => $typeid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            else
            {
                  $typeid=$query2->id;
                  // update product
                $data=array("type" => $typeid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            //INSERT color
             $query3=$this->db->query("SELECT `id` FROM `fynx_color` WHERE `name` = '$color'")->row();
            
            if(empty($query3))
            {
                $data=array("name" => $color,"status" => 1);
                $query=$this->db->insert( "fynx_color", $data );
                $colorid=$this->db->insert_id();
                
                // update product
                $data=array("color" => $colorid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            else
            {
                  $colorid=$query3->id;
                  // update product
                $data=array("color" => $colorid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            
            //INSERT size
             $query4=$this->db->query("SELECT `id` FROM `fynx_size` WHERE `name` = '$size'")->row();
            
            if(empty($query4))
            {
                $data=array("name" => $size,"status" => 1);
                $query=$this->db->insert( "fynx_size", $data );
                $sizeid=$this->db->insert_id();
                
                // update product
                $data=array("size" => $sizeid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            else
            {
                  $sizeid=$query4->id;
                  // update product
                $data=array("size" => $sizeid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            //INSERT sizechart
             $query5=$this->db->query("SELECT `id` FROM `fynx_sizechart` WHERE `name` = '$sizechart' AND `image`='$sizechartimage'")->row();
            
            if(empty($query5))
            {
                $data=array("name" => $sizechart,"image" => $sizechartimage);
                $query=$this->db->insert( "fynx_sizechart", $data );
                $sizechartid=$this->db->insert_id();
                
                // update product
                $data=array("sizechart" => $sizechartid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            else
            {
                  $sizechartid=$query5->id;
                  // update product
                $data=array("sizechart" => $sizechartid);
                $this->db->where( "id", $productid );
                $query=$this->db->update( "fynx_product", $data );
            }
            
            if($allrelatedproduct){
            foreach($allrelatedproduct as $key => $relatedproduct)
			{
                $relatedproduct=trim($relatedproduct);
                $relatedproductquery=$this->db->query("SELECT * FROM `fynx_product` where `name` LIKE '$relatedproduct'")->row();
                if(empty($relatedproductquery))
                {
                    
                }
                else
                {
                    $relatedproduct=$relatedproductquery->id;
                }
            
				$data2  = array(
					'product' => $productid,
					'relatedproduct' => $relatedproduct,
				);
				$queryproductrelatedproduct=$this->db->insert( 'relatedproduct', $data2 );
			}
                }
            
            
            
        }
			return  1;
	}
    
}
?>
