<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class publication_model extends CI_Model
{
    public function create($publicationid,$user,$title,$publishername,$authorid,$authorname,$date,$publicationurl,$summary)
    {
        $data=array("publicationid" => $publicationid,"user" => $user,"title" => $title,"publishername" => $publishername,"authorid" => $authorid,"authorname" => $authorname,"date" => $date,"publicationurl" => $publicationurl,"summary" => $summary);
        $query=$this->db->insert( "expert_publication", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_publication")->row();
        return $query;
    }
    function getsinglepublication($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_publication")->row();
        return $query;
    }
    public function edit($id,$publicationid,$user,$title,$publishername,$authorid,$authorname,$date,$publicationurl,$summary)
    {
        $data=array("publicationid" => $publicationid,"user" => $user,"title" => $title,"publishername" => $publishername,"authorid" => $authorid,"authorname" => $authorname,"date" => $date,"publicationurl" => $publicationurl,"summary" => $summary);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_publication", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_publication` WHERE `id`='$id'");
        return $query;
    }
}
?>
