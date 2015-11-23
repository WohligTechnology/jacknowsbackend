<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professionskill_model extends CI_Model
{
public function create($user,$profession,$skills)
{
$data=array("user" => $user,"profession" => $profession,"skills" => $skills);
$query=$this->db->insert( "expert_professionskill", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professionskill")->row();
return $query;
}
function getsingleprofessionskill($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professionskill")->row();
return $query;
}
public function edit($id,$user,$profession,$skills)
{
$data=array("user" => $user,"profession" => $profession,"skills" => $skills);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professionskill", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professionskill` WHERE `id`='$id'");
return $query;
}
    public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `photo` FROM `expert_professionskill` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
