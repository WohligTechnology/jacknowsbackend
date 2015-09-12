<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class question_model extends CI_Model
{
    public function create($fromuser,$question)
    {
        $data=array("fromuser" => $fromuser,"question" => $question);
        $query=$this->db->insert( "expert_question", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_question")->row();
        return $query;
    }
    function getsinglequestion($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_question")->row();
        return $query;
    }
    public function edit($id,$fromuser,$question)
    {
        $data=array("fromuser" => $fromuser,"question" => $question);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_question", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_question` WHERE `id`='$id'");
        return $query;
    }
    
    public function getquestiondropdown()
	{
		$query=$this->db->query("SELECT * FROM `expert_question`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->question;
		}
		
		return $return;
	}
    
}
?>
