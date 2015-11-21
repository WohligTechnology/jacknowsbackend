<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class profession_model extends CI_Model
{
public function create($user,$category,$description)
{
$data=array("user" => $user,"category" => $category,"description" => $description);
$query=$this->db->insert( "expert_profession", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_profession")->row();
return $query;
}
function getsingleprofession($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_profession")->row();
return $query;
}
public function edit($id,$user,$category,$description)
{
$data=array("user" => $user,"category" => $category,"description" => $description);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_profession", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_profession` WHERE `id`='$id'");
return $query;
}
}
?>
