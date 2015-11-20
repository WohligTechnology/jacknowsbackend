<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hobbyphotos_model extends CI_Model
{
public function create($user,$hobby,$image)
{
$data=array("user" => $user,"hobby" => $hobby,"image" => $image);
$query=$this->db->insert( "expert_hobbyphotos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyphotos")->row();
return $query;
}
function getsinglehobbyphotos($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_hobbyphotos")->row();
return $query;
}
public function edit($id,$user,$hobby,$image)
{
$data=array("user" => $user,"hobby" => $hobby,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_hobbyphotos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_hobbyphotos` WHERE `id`='$id'");
return $query;
}
    public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `expert_hobbyphotos` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
