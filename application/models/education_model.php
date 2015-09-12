<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class education_model extends CI_Model
{
    public function create($educationid,$user,$schoolname,$fieldofstudy,$startdate,$enddate,$degree,$activities,$notes)
    {
        $data=array("educationid" => $educationid,"user" => $user,"schoolname" => $schoolname,"fieldofstudy" => $fieldofstudy,"startdate" => $startdate,"enddate" => $enddate,"degree" => $degree,"activities" => $activities,"notes" => $notes);
        $query=$this->db->insert( "expert_education", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_education")->row();
        return $query;
    }
    function getsingleeducation($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_education")->row();
        return $query;
    }
    public function edit($id,$educationid,$user,$schoolname,$fieldofstudy,$startdate,$enddate,$degree,$activities,$notes)
    {
        $data=array("educationid" => $educationid,"user" => $user,"schoolname" => $schoolname,"fieldofstudy" => $fieldofstudy,"startdate" => $startdate,"enddate" => $enddate,"degree" => $degree,"activities" => $activities,"notes" => $notes);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_education", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_education` WHERE `id`='$id'");
        return $query;
    }
}
?>
