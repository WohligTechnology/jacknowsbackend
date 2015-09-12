<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class course_model extends CI_Model
{
    public function create($courseid,$user,$name,$coursenumber)
    {
        $data=array("courseid" => $courseid,"user" => $user,"name" => $name,"coursenumber" => $coursenumber);
        $query=$this->db->insert( "expert_course", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_course")->row();
        return $query;
    }
    function getsinglecourse($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_course")->row();
        return $query;
    }
    public function edit($id,$courseid,$user,$name,$coursenumber)
    {
        $data=array("courseid" => $courseid,"user" => $user,"name" => $name,"coursenumber" => $coursenumber);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_course", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_course` WHERE `id`='$id'");
        return $query;
    }
}
?>
