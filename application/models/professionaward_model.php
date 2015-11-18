<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professionaward_model extends CI_Model
{
public function create($user,$profession,$website,$videolink,$photo)
{
$data=array("user" => $user,"profession" => $profession,"website" => $website,"videolink" => $videolink,"photo" => $photo);
$query=$this->db->insert( "expert_professionaward", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professionaward")->row();
return $query;
}
function getsingleprofessionaward($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professionaward")->row();
return $query;
}
public function edit($id,$user,$profession,$website,$videolink,$photo)
{
$data=array("user" => $user,"profession" => $profession,"website" => $website,"videolink" => $videolink,"photo" => $photo);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professionaward", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professionaward` WHERE `id`='$id'");
return $query;
}
}
?>
