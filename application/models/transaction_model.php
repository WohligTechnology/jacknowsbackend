<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class transaction_model extends CI_Model
{
    public function create($fromuser,$touser,$amount,$type)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"amount" => $amount,"type" => $type);
        $query=$this->db->insert( "expert_transaction", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_transaction")->row();
        return $query;
    }
    function getsingletransaction($id) 
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_transaction")->row();
        return $query;
    }
    public function edit($id,$fromuser,$touser,$amount,$type)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"amount" => $amount,"type" => $type);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_transaction", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_transaction` WHERE `id`='$id'");
        return $query;
    }
}
?>
