<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class designs_model extends CI_Model
{
public function create($designer,$image,$status,$timestamp)
{
$data=array("designer" => $designer,"image" => $image,"status" => $status,"timestamp" => $timestamp);
$query=$this->db->insert( "fynx_designs", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("fynx_designs")->row();
return $query;
}
function getsingledesigns($id){
$this->db->where("id",$id);
$query=$this->db->get("fynx_designs")->row();
return $query;
}
public function edit($id,$designer,$image,$status,$timestamp)
{
$data=array("designer" => $designer,"image" => $image,"status" => $status,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "fynx_designs", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `fynx_designs` WHERE `id`='$id'");
return $query;
}
}
?>
