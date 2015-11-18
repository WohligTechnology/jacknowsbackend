<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobby_model extends CI_Model
{
public function create($user,$category,$expinyrs,$description,$skills)
{
$data=array("user" => $user,"category" => $category,"expinyrs" => $expinyrs,"description" => $description,"skills" => $skills);
$query=$this->db->insert( "expert_hobby", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobby")->row();
return $query;
}
function getsinglehobby($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobby")->row();
return $query;
}
public function edit($id,$user,$category,$expinyrs,$description,$skills)
{
$data=array("user" => $user,"category" => $category,"expinyrs" => $expinyrs,"description" => $description,"skills" => $skills);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobby", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobby` WHERE `id`='$id'");
return $query;
}
}
?>
