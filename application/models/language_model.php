<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class language_model extends CI_Model
{
    public function create($languageid,$user,$languagename,$proficiancylevel,$proficiancyname)
    {
        $data=array("languageid" => $languageid,"user" => $user,"languagename" => $languagename,"proficiancylevel" => $proficiancylevel,"proficiancyname" => $proficiancyname);
        $query=$this->db->insert( "expert_language", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_language")->row();
        return $query;
    }
    function getsinglelanguage($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_language")->row();
        return $query;
    }
    public function edit($id,$languageid,$user,$languagename,$proficiancylevel,$proficiancyname)
    {
        $data=array("languageid" => $languageid,"user" => $user,"languagename" => $languagename,"proficiancylevel" => $proficiancylevel,"proficiancyname" => $proficiancyname);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_language", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_language` WHERE `id`='$id'");
        return $query;
    }
}
?>
