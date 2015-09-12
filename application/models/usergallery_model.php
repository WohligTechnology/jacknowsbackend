<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class usergallery_model extends CI_Model
{
    public function create($user,$type,$image,$audio,$video)
    {
        $data=array("user" => $user,"type" => $type,"image" => $image,"audio" => $audio,"video" => $video);
        $query=$this->db->insert( "expert_usergallery", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_usergallery")->row();
        return $query;
    }
    function getsingleusergallery($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_usergallery")->row();
        return $query;
    }
    public function edit($id,$user,$type,$image,$audio,$video)
    {
        $data=array("user" => $user,"type" => $type,"image" => $image,"audio" => $audio,"video" => $video);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_usergallery", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_usergallery` WHERE `id`='$id'");
        return $query;
    }
    public function getusergallerymediabyid($id)
	{
		$query=$this->db->query("SELECT * FROM `expert_usergallery` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
