<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobbywebsite_model extends CI_Model
{
public function create($user,$hobby,$website)
{
$data=array("user" => $user,"hobby" => $hobby,"website" => $website);
$query=$this->db->insert( "expert_hobbywebsite", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbywebsite")->row();
return $query;
}
function getsinglehobbywebsite($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbywebsite")->row();
return $query;
}
public function edit($id,$user,$hobby,$website)
{
$data=array("user" => $user,"hobby" => $hobby,"website" => $website);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobbywebsite", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobbywebsite` WHERE `id`='$id'");
return $query;
}
}
?>
