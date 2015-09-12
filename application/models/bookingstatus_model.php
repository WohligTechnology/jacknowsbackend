<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class bookingstatus_model extends CI_Model
{
    public function create($name)
    {
        $data=array("name" => $name);
        $query=$this->db->insert( "expert_bookingstatus", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_bookingstatus")->row();
        return $query;
    }
    function getsinglebookingstatus($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_bookingstatus")->row();
        return $query;
    }
    public function edit($id,$name)
    {
        $data=array("name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_bookingstatus", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_bookingstatus` WHERE `id`='$id'");
        return $query;
    }
    
    public function getbookingstatusdropdown()
	{
		$query=$this->db->query("SELECT * FROM `expert_bookingstatus`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
}
?>
