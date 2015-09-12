<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class skill_model extends CI_Model
{
    public function create($skillid,$user,$skillname)
    {
        $data=array("skillid" => $skillid,"user" => $user,"skillname" => $skillname);
        $query=$this->db->insert( "expert_skill", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_skill")->row();
        return $query;
    }
    function getsingleskill($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_skill")->row();
        return $query;
    }
    public function edit($id,$skillid,$user,$skillname)
    {
        $data=array("skillid" => $skillid,"user" => $user,"skillname" => $skillname);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_skill", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_skill` WHERE `id`='$id'");
        return $query;
    }
}
?>
