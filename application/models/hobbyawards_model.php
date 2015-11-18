<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobbyawards_model extends CI_Model
{
public function create($user,$hobby,$awards)
{
$data=array("user" => $user,"hobby" => $hobby,"awards" => $awards);
$query=$this->db->insert( "expert_hobbyawards", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyawards")->row();
return $query;
}
function getsinglehobbyawards($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyawards")->row();
return $query;
}
public function edit($id,$user,$hobby,$awards)
{
$data=array("user" => $user,"hobby" => $hobby,"awards" => $awards);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobbyawards", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobbyawards` WHERE `id`='$id'");
return $query;
}
}
?>
