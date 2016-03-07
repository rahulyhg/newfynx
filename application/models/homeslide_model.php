<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class homeslide_model extends CI_Model
{
public function create($name,$link,$target,$status,$image,$template,$class,$text,$centeralign,$order)
{
$data=array("name" => $name,"link" => $link,"target" => $target,"status" => $status,"image" => $image,"template" => $template,"class" => $class,"text" => $text,"centeralign" => $centeralign,"order" => $order);
$query=$this->db->insert( "fynx_homeslide", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("fynx_homeslide")->row();
return $query;
}
function getsinglehomeslide($id){
$this->db->where("id",$id);
$query=$this->db->get("fynx_homeslide")->row();
return $query;
}
public function edit($id,$name,$link,$target,$status,$image,$template,$class,$text,$centeralign,$order)
{
                    if($image=="")
						{
						$image=$this->homeslide_model->getimagebyid($id);
						   // print_r($image);
							$image=$image->image;
						}
$data=array("name" => $name,"link" => $link,"target" => $target,"status" => $status,"image" => $image,"template" => $template,"class" => $class,"text" => $text,"centeralign" => $centeralign,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "fynx_homeslide", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `fynx_homeslide` WHERE `id`='$id'");
return $query;
}
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `fynx_homeslide` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
}
?>
