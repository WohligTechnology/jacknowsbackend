<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professionvideolink_model extends CI_Model
{
public function create($user,$profession,$videolink)
{
$data=array("user" => $user,"profession" => $profession,"videolink" => $videolink);
$query=$this->db->insert( "expert_professionvideolink", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professionvideolink")->row();
return $query;
}
function getsingleprofessionvideolink($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professionvideolink")->row();
return $query;
}
public function edit($id,$user,$profession,$videolink)
{
$data=array("user" => $user,"profession" => $profession,"videolink" => $videolink);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professionvideolink", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professionvideolink` WHERE `id`='$id'");
return $query;
}
}
?>
