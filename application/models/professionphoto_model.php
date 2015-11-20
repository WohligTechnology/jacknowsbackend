<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professionphoto_model extends CI_Model
{
public function create($user,$profession,$image)
{
$data=array("user" => $user,"profession" => $profession,"image" => $image);
$query=$this->db->insert( "expert_professionphoto", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professionphoto")->row();
return $query;
}
function getsingleprofessionphoto($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professionphoto")->row();
return $query;
}
public function edit($id,$user,$profession,$image)
{
$data=array("user" => $user,"profession" => $profession,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professionphoto", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professionphoto` WHERE `id`='$id'");
return $query;
}
}
?>
