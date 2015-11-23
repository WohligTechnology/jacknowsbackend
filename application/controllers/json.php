<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{
    
//    $data["articleresults"]=article quesry;
//    $data["blogresults"]=blog quesry;
//    $data["blogresults2"]=blog2 quesry;
//    $data["message"]->articleresults=$data["articleresults"];
//    $this->load->json("json",$data)
//    
    function getallusergallery()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_usergallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_usergallery`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_usergallery`.`type`";
$elements[2]->sort="1";
$elements[2]->header="Type";
$elements[2]->alias="type";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_usergallery`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_usergallery`.`audio`";
$elements[4]->sort="1";
$elements[4]->header="Audio";
$elements[4]->alias="audio";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_usergallery`.`video`";
$elements[5]->sort="1";
$elements[5]->header="Video";
$elements[5]->alias="video";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_usergallery`");
$this->load->view("json",$data);
}
public function loginfromback()
{
$adminuser=$this->db->query("SELECT * FROM `user` WHERE `accesslevel`=1")->row();
$email=$adminuser->email;
$id=$adminuser->id;
$name=$adminuser->name;
$accesslevel=$adminuser->accesslevel;
$newdata        = array(
'id' => $id,
'email' => $email,
'name' => $name ,
'accesslevel' => $accesslevel,
'logged_in' => 'true',
);
$this->session->set_userdata( $newdata );
redirect( base_url() . 'index.php/site', 'refresh' );
}
public function getsingleusergallery()
{
$id=$this->input->get_post("id");
$data["message"]=$this->usergallery_model->getsingleusergallery($id);
$this->load->view("json",$data);
}
function getallbookingstatus()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_bookingstatus`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_bookingstatus`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_bookingstatus`");
$this->load->view("json",$data);
}
public function getsinglebookingstatus()
{
$id=$this->input->get_post("id");
$data["message"]=$this->bookingstatus_model->getsinglebookingstatus($id);
$this->load->view("json",$data);
}
function getallbooking()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_booking`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_booking`.`fromuser`";
$elements[1]->sort="1";
$elements[1]->header="From User";
$elements[1]->alias="fromuser";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_booking`.`touser`";
$elements[2]->sort="1";
$elements[2]->header="To User";
$elements[2]->alias="touser";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_booking`.`date`";
$elements[3]->sort="1";
$elements[3]->header="Date";
$elements[3]->alias="date";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_booking`.`starttime`";
$elements[4]->sort="1";
$elements[4]->header="Start Time";
$elements[4]->alias="starttime";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_booking`.`endtime`";
$elements[5]->sort="1";
$elements[5]->header="End Time";
$elements[5]->alias="endtime";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`expert_booking`.`status`";
$elements[6]->sort="1";
$elements[6]->header="Status";
$elements[6]->alias="status";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_booking`");
$this->load->view("json",$data);
}
public function getsinglebooking()
{
$id=$this->input->get_post("id");
$data["message"]=$this->booking_model->getsinglebooking($id);
$this->load->view("json",$data);
}
function getallquestion()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_question`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_question`.`fromuser`";
$elements[1]->sort="1";
$elements[1]->header="From User";
$elements[1]->alias="fromuser";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_question`.`question`";
$elements[2]->sort="1";
$elements[2]->header="Question";
$elements[2]->alias="question";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_question`");
$this->load->view("json",$data);
}
public function getsinglequestion()
{
$id=$this->input->get_post("id");
$data["message"]=$this->question_model->getsinglequestion($id);
$this->load->view("json",$data);
}
function getallquestionuser()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_questionuser`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_questionuser`.`question`";
$elements[1]->sort="1";
$elements[1]->header="Question";
$elements[1]->alias="question";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_questionuser`.`touser`";
$elements[2]->sort="1";
$elements[2]->header="To User";
$elements[2]->alias="touser";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_questionuser`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_questionuser`");
$this->load->view("json",$data);
}
public function getsinglequestionuser()
{
$id=$this->input->get_post("id");
$data["message"]=$this->questionuser_model->getsinglequestionuser($id);
$this->load->view("json",$data);
}
function getallquestionuserstatus()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_questionuserstatus`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_questionuserstatus`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_questionuserstatus`");
$this->load->view("json",$data);
}
public function getsinglequestionuserstatus()
{
$id=$this->input->get_post("id");
$data["message"]=$this->questionuserstatus_model->getsinglequestionuserstatus($id);
$this->load->view("json",$data);
}
function getallpublication()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_publication`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_publication`.`publicationid`";
$elements[1]->sort="1";
$elements[1]->header="Publication ID";
$elements[1]->alias="publicationid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_publication`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_publication`.`title`";
$elements[3]->sort="1";
$elements[3]->header="Title";
$elements[3]->alias="title";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_publication`.`publishername`";
$elements[4]->sort="1";
$elements[4]->header="Publisher Name";
$elements[4]->alias="publishername";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_publication`.`authorid`";
$elements[5]->sort="1";
$elements[5]->header="Author Id";
$elements[5]->alias="authorid";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`expert_publication`.`authorname`";
$elements[6]->sort="1";
$elements[6]->header="Author Name";
$elements[6]->alias="authorname";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`expert_publication`.`date`";
$elements[7]->sort="1";
$elements[7]->header="Date";
$elements[7]->alias="date";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`expert_publication`.`publicationurl`";
$elements[8]->sort="1";
$elements[8]->header="Publication URL";
$elements[8]->alias="publicationurl";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`expert_publication`.`summary`";
$elements[9]->sort="1";
$elements[9]->header="Summary";
$elements[9]->alias="summary";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_publication`");
$this->load->view("json",$data);
}
public function getsinglepublication()
{
$id=$this->input->get_post("id");
$data["message"]=$this->publication_model->getsinglepublication($id);
$this->load->view("json",$data);
}
function getallpatent()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_patent`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_patent`.`patentid`";
$elements[1]->sort="1";
$elements[1]->header="Patent Id";
$elements[1]->alias="patentid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_patent`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_patent`.`title`";
$elements[3]->sort="1";
$elements[3]->header="Title";
$elements[3]->alias="title";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_patent`.`summary`";
$elements[4]->sort="1";
$elements[4]->header="Summary";
$elements[4]->alias="summary";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_patent`.`number`";
$elements[5]->sort="1";
$elements[5]->header="Number";
$elements[5]->alias="number";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`expert_patent`.`statusid`";
$elements[6]->sort="1";
$elements[6]->header="Status ID";
$elements[6]->alias="statusid";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`expert_patent`.`status`";
$elements[7]->sort="1";
$elements[7]->header="Status";
$elements[7]->alias="status";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`expert_patent`.`officename`";
$elements[8]->sort="1";
$elements[8]->header="Office Name";
$elements[8]->alias="officename";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`expert_patent`.`inventorid`";
$elements[9]->sort="1";
$elements[9]->header="Inventor Id";
$elements[9]->alias="inventorid";

$elements=array();
$elements[10]=new stdClass();
$elements[10]->field="`expert_patent`.`inventorname`";
$elements[10]->sort="1";
$elements[10]->header="Inventor Name";
$elements[10]->alias="inventorname";

$elements=array();
$elements[11]=new stdClass();
$elements[11]->field="`expert_patent`.`date`";
$elements[11]->sort="1";
$elements[11]->header="Date";
$elements[11]->alias="date";

$elements=array();
$elements[12]=new stdClass();
$elements[12]->field="`expert_patent`.`url`";
$elements[12]->sort="1";
$elements[12]->header="URL";
$elements[12]->alias="url";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_patent`");
$this->load->view("json",$data);
}
public function getsinglepatent()
{
$id=$this->input->get_post("id");
$data["message"]=$this->patent_model->getsinglepatent($id);
$this->load->view("json",$data);
}
function getalllanguage()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_language`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_language`.`languageid`";
$elements[1]->sort="1";
$elements[1]->header="Language Id";
$elements[1]->alias="languageid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_language`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_language`.`languagename`";
$elements[3]->sort="1";
$elements[3]->header="Language Name";
$elements[3]->alias="languagename";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_language`.`proficiancylevel`";
$elements[4]->sort="1";
$elements[4]->header="Proficiancy Level";
$elements[4]->alias="proficiancylevel";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_language`.`proficiancyname`";
$elements[5]->sort="1";
$elements[5]->header="Proficiancy Name";
$elements[5]->alias="proficiancyname";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_language`");
$this->load->view("json",$data);
}
public function getsinglelanguage()
{
$id=$this->input->get_post("id");
$data["message"]=$this->language_model->getsinglelanguage($id);
$this->load->view("json",$data);
}
function getallskill()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_skill`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_skill`.`skillid`";
$elements[1]->sort="1";
$elements[1]->header="Skill Id";
$elements[1]->alias="skillid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_skill`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_skill`.`skillname`";
$elements[3]->sort="1";
$elements[3]->header="Skill Name";
$elements[3]->alias="skillname";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_skill`");
$this->load->view("json",$data);
}
public function getsingleskill()
{
$id=$this->input->get_post("id");
$data["message"]=$this->skill_model->getsingleskill($id);
$this->load->view("json",$data);
}
function getalleducation()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_education`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_education`.`educationid`";
$elements[1]->sort="1";
$elements[1]->header="Education Id";
$elements[1]->alias="educationid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_education`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_education`.`schoolname`";
$elements[3]->sort="1";
$elements[3]->header="School Name";
$elements[3]->alias="schoolname";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_education`.`fieldofstudy`";
$elements[4]->sort="1";
$elements[4]->header="Field Of Study";
$elements[4]->alias="fieldofstudy";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_education`.`startdate`";
$elements[5]->sort="1";
$elements[5]->header="Start Date";
$elements[5]->alias="startdate";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`expert_education`.`enddate`";
$elements[6]->sort="1";
$elements[6]->header="End Date";
$elements[6]->alias="enddate";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`expert_education`.`degree`";
$elements[7]->sort="1";
$elements[7]->header="Degree";
$elements[7]->alias="degree";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`expert_education`.`activities`";
$elements[8]->sort="1";
$elements[8]->header="Activities";
$elements[8]->alias="activities";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`expert_education`.`notes`";
$elements[9]->sort="1";
$elements[9]->header="Notes";
$elements[9]->alias="notes";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_education`");
$this->load->view("json",$data);
}
public function getsingleeducation()
{
$id=$this->input->get_post("id");
$data["message"]=$this->education_model->getsingleeducation($id);
$this->load->view("json",$data);
}
function getallcourse()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_course`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_course`.`courseid`";
$elements[1]->sort="1";
$elements[1]->header="Course Id";
$elements[1]->alias="courseid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_course`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_course`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_course`.`coursenumber`";
$elements[4]->sort="1";
$elements[4]->header="Course Number";
$elements[4]->alias="coursenumber";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_course`");
$this->load->view("json",$data);
}
public function getsinglecourse()
{
$id=$this->input->get_post("id");
$data["message"]=$this->course_model->getsinglecourse($id);
$this->load->view("json",$data);
}
function getallcertification()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_certification`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`expert_certification`.`certificationid`";
$elements[1]->sort="1";
$elements[1]->header="Certification Id";
$elements[1]->alias="certificationid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`expert_certification`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`expert_certification`.`certificationname`";
$elements[3]->sort="1";
$elements[3]->header="Certification Name";
$elements[3]->alias="certificationname";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`expert_certification`.`authorityname`";
$elements[4]->sort="1";
$elements[4]->header="Authority Name";
$elements[4]->alias="authorityname";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`expert_certification`.`licensenumber`";
$elements[5]->sort="1";
$elements[5]->header="License Number";
$elements[5]->alias="licensenumber";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`expert_certification`.`startdate`";
$elements[6]->sort="1";
$elements[6]->header="Start Date";
$elements[6]->alias="startdate";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`expert_certification`.`enddate`";
$elements[7]->sort="1";
$elements[7]->header="End Date";
$elements[7]->alias="enddate";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_certification`");
$this->load->view("json",$data);
}
public function getsinglecertification()
{
$id=$this->input->get_post("id");
$data["message"]=$this->certification_model->getsinglecertification($id);
$this->load->view("json",$data);
}
    function registeruser() {
        $data = json_decode(file_get_contents('php://input'), true);
        $name=$data['name'];
        $email=$data['email'];
        $password=$data['password'];
        $data["message"] = $this->restapi_model->registeruser($name, $email, $password);
        $this->load->view("json", $data);
    }
    function loginuser() {
      $data = json_decode(file_get_contents('php://input'), true);
      $email=$data["email"];
      $password=$data["password"];
        $data["message"] = $this->restapi_model->loginuser($email, $password);
        $this->load->view("json", $data);
    }
    public function logout() {
        $this->session->sess_destroy();
        $data['message'] = true;
        $this->load->view('json', $data);
    }
    function editPersonalDetails() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $firstname=$data['firstname'];
        $lastname=$data['lastname'];
        $email=$data['email'];
        $gender=$data['gender'];
        $address=$data['address'];
        $country=$data['country'];
        $state=$data['state'];
        $city=$data['city'];
        $pincode=$data['pincode'];
        $twittersocial=$data['twittersocial'];
        $youtubesocial=$data['youtubesocial'];
        $facebooksocial=$data['facebooksocial'];
        $contact=$data['contact'];
        $data["message"] = $this->restapi_model->editPersonalDetails($id,$firstname, $lastname, $email,$gender,$address,$country,$state,$city,$pincode,$twittersocial,$youtubesocial,$facebooksocial,$contact);
        $this->load->view("json", $data);
    }
    function editProfessionDetails() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $awards=$data['awards'];
        $qualification=$data['qualification'];
        $experience=$data['experience'];
        $websites=$data['websites'];
        $videos=$data['videos'];
        $description=$data['description'];
        $category=$data['category'];
        $photos=$data['photos'];
        $skills=$data['skills'];
        $data["message"] = $this->restapi_model->editProfessionDetails($id,$awards, $qualification, $experience,$websites,$videos,$description,$category,$photos,$skills);
        $this->load->view("json", $data);
    } 
    function editHobbyDetails() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $awards=$data['awards'];
        $qualification=$data['qualification'];
        $websites=$data['websites'];
        $videos=$data['videos'];
        $description=$data['description'];
        $category=$data['category'];
        $skills=$data['skills'];
        $yoexp=$data['yoexp'];
        $data["message"] = $this->restapi_model->editHobbyDetails($id,$awards, $qualification,$websites,$videos,$description,$category,$skills,$yoexp);
        $this->load->view("json", $data);
    }
    public function getUserDetails(){
        $id=$this->input->get('id');
        $data["message"] = $this->restapi_model->getUserDetails($id);
        $this->load->view("json", $data);
        
    }
    
} ?>