<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class category_model extends CI_Model
{
public function create($name)
{
$data=array("name" => $name);
$query=$this->db->insert( "expert_category", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_category")->row();
return $query;
}
function getsinglecategory($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_category")->row();
return $query;
}
public function edit($id,$name)
{
$data=array("name" => $name);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_category", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_category` WHERE `id`='$id'");
return $query;
}
     
}
?>
