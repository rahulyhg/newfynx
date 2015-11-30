<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class sizechart_model extends CI_Model
{
public function create($name,$image)
{
$data=array("name" => $name,"image" => $image);
$query=$this->db->insert( "fynx_sizechart", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("fynx_sizechart")->row();
return $query;
}
function getsinglesizechart($id){
$this->db->where("id",$id);
$query=$this->db->get("fynx_sizechart")->row();
return $query;
}
public function edit($id,$name,$image)
{
$data=array("name" => $name,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "fynx_sizechart", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `fynx_sizechart` WHERE `id`='$id'");
return $query;
}
}
?>
