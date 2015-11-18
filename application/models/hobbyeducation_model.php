<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobbyeducation_model extends CI_Model
{
public function create($user,$hobby,$degree,$institute,$yearofpassing)
{
$data=array("user" => $user,"hobby" => $hobby,"degree" => $degree,"institute" => $institute,"yearofpassing" => $yearofpassing);
$query=$this->db->insert( "expert_hobbyeducation", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyeducation")->row();
return $query;
}
function getsinglehobbyeducation($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyeducation")->row();
return $query;
}
public function edit($id,$user,$hobby,$degree,$institute,$yearofpassing)
{
$data=array("user" => $user,"hobby" => $hobby,"degree" => $degree,"institute" => $institute,"yearofpassing" => $yearofpassing);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobbyeducation", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobbyeducation` WHERE `id`='$id'");
return $query;
}
}
?>
