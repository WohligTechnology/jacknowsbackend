<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobbyskill_model extends CI_Model
{
public function create($user,$hobby,$skills)
{
$data=array("user" => $user,"hobby" => $hobby,"skills" => $skills);
$query=$this->db->insert( "expert_hobbyskill", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyskill")->row();
return $query;
}
function getsinglehobbyskill($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyskill")->row();
return $query;
}
public function edit($id,$user,$hobby,$skills)
{
$data=array("user" => $user,"hobby" => $hobby,"skills" => $skills);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobbyskill", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobbyskill` WHERE `id`='$id'");
return $query;
}
    public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `photo` FROM `expert_hobbyskill` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
