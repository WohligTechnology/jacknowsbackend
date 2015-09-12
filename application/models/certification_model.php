<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class certification_model extends CI_Model
{
    public function create($certificationid,$user,$certificationname,$authorityname,$licensenumber,$startdate,$enddate)
    {
        $data=array("certificationid" => $certificationid,"user" => $user,"certificationname" => $certificationname,"authorityname" => $authorityname,"licensenumber" => $licensenumber,"startdate" => $startdate,"enddate" => $enddate);
        $query=$this->db->insert( "expert_certification", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_certification")->row();
        return $query;
    }
    function getsinglecertification($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_certification")->row();
        return $query;
    }
    public function edit($id,$certificationid,$user,$certificationname,$authorityname,$licensenumber,$startdate,$enddate)
    {
        $data=array("certificationid" => $certificationid,"user" => $user,"certificationname" => $certificationname,"authorityname" => $authorityname,"licensenumber" => $licensenumber,"startdate" => $startdate,"enddate" => $enddate);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_certification", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_certification` WHERE `id`='$id'");
        return $query;
    }
}
?>
