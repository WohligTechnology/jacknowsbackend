<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class professionexperience_model extends CI_Model
{
public function create($profession,$user,$companyname,$jobtitle,$companylogo,$jobdescription,$startdate,$enddate)
{
$data=array("profession" => $profession,"user" => $user,"companyname" => $companyname,"jobtitle" => $jobtitle,"companylogo" => $companylogo,"jobdescription" => $jobdescription,"startdate" => $startdate,"enddate" => $enddate);
$query=$this->db->insert( "expert_professionexperience", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("expert_professionexperience")->row();
return $query;
}
function getsingleprofessionexperience($id){
$this->db->where("id",$id);
$query=$this->db->get("expert_professionexperience")->row();
return $query;
}
public function edit($id,$profession,$user,$companyname,$jobtitle,$companylogo,$jobdescription,$startdate,$enddate)
{
$data=array("profession" => $profession,"user" => $user,"companyname" => $companyname,"jobtitle" => $jobtitle,"companylogo" => $companylogo,"jobdescription" => $jobdescription,"startdate" => $startdate,"enddate" => $enddate);
$this->db->where( "id", $id );
$query=$this->db->update( "expert_professionexperience", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `expert_professionexperience` WHERE `id`='$id'");
return $query;
}
    public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `companylogo` FROM `expert_professionexperience` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
