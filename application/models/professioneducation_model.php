<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professioneducation_model extends CI_Model
{
public function create($user,$profession,$degree,$institute,$yearofpassing)
{
$data=array("user" => $user,"profession" => $profession,"degree" => $degree,"institute" => $institute,"yearofpassing" => $yearofpassing);
$query=$this->db->insert( "expert_professioneducation", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professioneducation")->row();
return $query;
}
function getsingleprofessioneducation($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professioneducation")->row();
return $query;
}
public function edit($id,$user,$profession,$degree,$institute,$yearofpassing)
{
$data=array("user" => $user,"profession" => $profession,"degree" => $degree,"institute" => $institute,"yearofpassing" => $yearofpassing);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professioneducation", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professioneducation` WHERE `id`='$id'");
return $query;
}
}
?>
