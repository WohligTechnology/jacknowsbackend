<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class questionuserstatus_model extends CI_Model
{
    public function create($name)
    {
        $data=array("name" => $name);
        $query=$this->db->insert( "expert_questionuserstatus", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_questionuserstatus")->row();
        return $query;
    }
    function getsinglequestionuserstatus($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_questionuserstatus")->row();
        return $query;
    }
    public function edit($id,$name)
    {
        $data=array("name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_questionuserstatus", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_questionuserstatus` WHERE `id`='$id'");
        return $query;
    }
    
    public function getquestionuserstatus()
	{
		$query=$this->db->query("SELECT * FROM `expert_questionuserstatus`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    
}
?>
