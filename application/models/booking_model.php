<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class booking_model extends CI_Model
{
    public function create($fromuser,$touser,$date,$starttime,$endtime,$status,$round,$price)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"date" => $date,"starttime" => $starttime,"endtime" => $endtime,"status" => $status,"round" => $round,"price" => $price);
        $query=$this->db->insert( "expert_booking", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_booking")->row();
        return $query;
    }
    function getsinglebooking($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_booking")->row();
        return $query;
    }
    public function edit($id,$fromuser,$touser,$date,$starttime,$endtime,$status,$round,$price)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"date" => $date,"starttime" => $starttime,"endtime" => $endtime,"status" => $status,"round" => $round,"price" => $price);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_booking", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_booking` WHERE `id`='$id'");
        return $query;
    }
    public function viewdetailsofbooking($id)
    {
        $query=$this->db->query("SELECT `expert_booking`.`id`  AS `id` ,  `expert_booking`.`fromuser`  AS `fromuser` ,  `expert_booking`.`touser`  AS `touser` ,  `expert_booking`.`date`  AS `date` ,  `expert_booking`.`starttime`  AS `starttime` ,  `expert_booking`.`endtime`  AS `endtime` ,  `expert_booking`.`status`  AS `statusid` ,  `expert_bookingstatus`.`name`  AS `status` ,  `tab1`.`name`  AS `fromusername` ,  `tab2`.`name`  AS `tousername` ,  `tab1`.`contact`  AS `fromcontact` ,  `tab2`.`contact`  AS `tocontact` 
        FROM `expert_booking`  
        LEFT OUTER JOIN `expert_bookingstatus` ON `expert_bookingstatus`.`id`=`expert_booking`.`status` 
        LEFT OUTER JOIN `user` AS `tab1` ON `expert_booking`.`fromuser`= `tab1`.`id`  
        LEFT OUTER JOIN `user` AS `tab2` ON `expert_booking`.`touser`= `tab2`.`id`
        WHERE `expert_booking`.`id`='$id'")->row();
        return $query;
    }
    public function changestatus($id,$status)
    {
        $q=$this->db->query("UPDATE `expert_booking` SET `status`='$status' WHERE `id`='$id'");
        return $q;
    }
}
?>
