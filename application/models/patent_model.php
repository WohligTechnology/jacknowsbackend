<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class patent_model extends CI_Model
{
    public function create($patentid,$user,$title,$summary,$number,$statusid,$status,$officename,$inventorid,$inventorname,$date,$url)
    {
        $data=array("patentid" => $patentid,"user" => $user,"title" => $title,"summary" => $summary,"number" => $number,"statusid" => $statusid,"status" => $status,"officename" => $officename,"inventorid" => $inventorid,"inventorname" => $inventorname,"date" => $date,"url" => $url);
        $query=$this->db->insert( "expert_patent", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_patent")->row();
        return $query;
    }
    function getsinglepatent($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_patent")->row();
        return $query;
    }
    public function edit($id,$patentid,$user,$title,$summary,$number,$statusid,$status,$officename,$inventorid,$inventorname,$date,$url)
    {
        $data=array("patentid" => $patentid,"user" => $user,"title" => $title,"summary" => $summary,"number" => $number,"statusid" => $statusid,"status" => $status,"officename" => $officename,"inventorid" => $inventorid,"inventorname" => $inventorname,"date" => $date,"url" => $url);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_patent", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_patent` WHERE `id`='$id'");
        return $query;
    }
}
?>
