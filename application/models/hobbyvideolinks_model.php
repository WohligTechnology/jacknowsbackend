<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobbyvideolinks_model extends CI_Model
{
public function create($user,$hobby,$videolink)
{
$data=array("user" => $user,"hobby" => $hobby,"videolink" => $videolink);
$query=$this->db->insert( "expert_hobbyvideolinks", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyvideolinks")->row();
return $query;
}
function getsinglehobbyvideolinks($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyvideolinks")->row();
return $query;
}
public function edit($id,$user,$hobby,$videolink)
{
$data=array("user" => $user,"hobby" => $hobby,"videolink" => $videolink);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobbyvideolinks", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobbyvideolinks` WHERE `id`='$id'");
return $query;
}
}
?>
