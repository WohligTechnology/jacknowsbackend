<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class questionuser_model extends CI_Model
{
    public function create($question,$touser,$status)
    {
        $data=array("question" => $question,"touser" => $touser,"status" => $status);
        $query=$this->db->insert( "expert_questionuser", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_questionuser")->row();
        return $query;
    }
    function getsinglequestionuser($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_questionuser")->row();
        return $query;
    }
    public function edit($id,$question,$touser,$status)
    {
        $data=array("question" => $question,"touser" => $touser,"status" => $status);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_questionuser", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_questionuser` WHERE `id`='$id'");
        return $query;
    }
}
?>
