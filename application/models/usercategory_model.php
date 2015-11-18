<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class usercategory_model extends CI_Model
{
public function create($user,$category)
{
$data=array("user" => $user,"category" => $category);
$query=$this->db->insert( "expert_usercategory", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_usercategory")->row();
return $query;
}
function getsingleusercategory($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_usercategory")->row();
return $query;
}
public function edit($id,$user,$category)
{
$data=array("user" => $user,"category" => $category);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_usercategory", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_usercategory` WHERE `id`='$id'");
return $query;
}
}
?>
