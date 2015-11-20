<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professionwebsite_model extends CI_Model
{
public function create($user,$profession,$website)
{
$data=array("user" => $user,"profession" => $profession,"website" => $website);
$query=$this->db->insert( "expert_professionwebsite", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professionwebsite")->row();
return $query;
}
function getsingleprofessionwebsite($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professionwebsite")->row();
return $query;
}
public function edit($id,$user,$profession,$website)
{
$data=array("user" => $user,"profession" => $profession,"website" => $website);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professionwebsite", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professionwebsite` WHERE `id`='$id'");
return $query;
}
}
?>
