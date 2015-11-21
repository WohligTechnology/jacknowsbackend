<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
    public function registeruser($name, $email, $password)
    {
        $newdata=0;
        $password=md5($password);
        //echo $email;
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
				$num=$query->num_rows();

        if($num == 0)
        {
             $this->db->query("INSERT INTO `user`(`name`, `email`, `password`) VALUE('$name','$email','$password')");
            $user=$this->db->insert_id();
//            $newdata = array(
//                    'id' => $user,
//                    'email' => $email,
//                    'name' => $name,
//                    'logged_in' => 'true'
//            );
            $newdata=$this->db->query("SELECT `id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `firstname`, `lastname`, `maidenname`, `type`, `shortspecialities`, `interests`, `honorsawards`, `wallet`, `access`, `contact`, `percent`, `ameturetype`, `ametureprice`, `professionalprice` FROM `user` WHERE `id`=$user")->row();
            $this->session->set_userdata($newdata);
        }
        else
        {
            $newdata=false;
				}
        return $newdata;
    }
    
      function loginuser($email,$password)
    {
        $password=md5($password);
        $query=$this->db->query("SELECT `id`,`name` FROM `user` WHERE `email`='$email' AND `password`= '$password'");
        if($query->num_rows > 0)
        {
            $user=$query->row();
            $userid=$user->id;
            $name=$user->name;

$newdata=$this->db->query("SELECT `id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `firstname`, `lastname`, `maidenname`, `type`, `shortspecialities`, `interests`, `honorsawards`, `wallet`, `access`, `contact`, `percent`, `ameturetype`, `ametureprice`, `professionalprice` FROM `user` WHERE `id`=$userid")->row();
//            $newdata = array(
//                'email'     => $email,
//                'name'     => $name,
//                'logged_in' => 'true',
//                'id'=> $userid
//            );

            $this->session->set_userdata($newdata);

            return $newdata;
        }
        else
        return false;
    }
    
    public function editPersonalDetails($id,$firstname, $lastname, $email,$gender,$address,$country,$state,$city,$pincode,$twittersocial,$youtubesocial,$facebooksocial)
	{
        
		$data  = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'gender' => $gender,
            'address'=> $address,
            'country'=> $country,
            'state'=> $state,
            'city'=> $city,
            'pincode'=> $pincode,
            'twittersocial'=>$twittersocial,
            'youtubesocial'=>$youtubesocial,
            'facebooksocial'=>$facebooksocial
		);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
        if($query)
		return 1;
        else
        return 0;
	}
    
    public function editProfessionDetails($id,$awards, $qualification, $experience,$websites,$videos,$description,$category,$photos,$skills){
        
        $query=$this->db->query("SELECT * FROM `expert_category` WHERE `name` LIKE '$category'")->row();
        $categoryid=$query->id;
//        
//        // Hoby
//        
        $this->db->query("INSERT INTO `expert_profession`( `user`, `category`,`description`) VALUE('$id','$categoryid','$description')");
        $professionid=$this->db->insert_id();
        
        // AWARDS
        for($i=0; $i<count($awards); $i++){
         $data=array("user" => $id,"profession" => $professionid,"award" => $awards[$i]['awards']);
        $query=$this->db->insert( "expert_professionaward", $data );
        $awardid=$this->db->insert_id();
            
        } 
        // SKILLS
        for($i=0; $i<count($skills); $i++){
         $data=array("user" => $id,"profession" => $professionid,"skills" => $skills[$i]['text']);
        $query=$this->db->insert( "expert_professionskill", $data );
        $skillid=$this->db->insert_id();
            
        }

        
//        //QUALIFICATION
          for($i=0; $i<count($qualification); $i++){
         $data=array("user" => $id,"profession" => $professionid,"degree" => $qualification[$i]['degree'],"institute" => $qualification[$i]['institute'],"yearofpassing" => $qualification[$i]['year']);
        $query=$this->db->insert( "expert_professioneducation", $data );
        $qualificationid=$this->db->insert_id();
            
        }

        
//        // WORK EXPERIENCE
        
         for($i=0; $i<count($experience); $i++){
         $data=array("user" => $id,"profession" => $professionid,"companyname" => $experience[$i]['companyname'],"jobtitle" => $experience[$i]['jobtitle'],"companylogo" => $experience[$i]['joblogo'],"jobdescription" => $experience[$i]['jobdesc'],"startdate" => $experience[$i]['startdate'],"enddate" => $experience[$i]['enddate']);
        $query=$this->db->insert( "expert_professionexperience", $data );
        $qualificationid=$this->db->insert_id();
            
        }
        for($i=0; $i<count($photos); $i++){
         $data=array("user" => $id,"profession" => $professionid,"image" => $photos[$i]);
        $query=$this->db->insert( "expert_professionphoto", $data );
        $photoid=$this->db->insert_id();
            
        }
        
         // VIDEOLINKS
        
        for($i=0; $i<count($videos); $i++){
         $data=array("user" => $id,"profession" => $professionid,"videolink" => $videos[$i]['videos']);
        $query=$this->db->insert( "expert_professionvideolink", $data );
        $videosid=$this->db->insert_id();
            
        }

        // WEBSITE
            
         for($i=0; $i<count($websites); $i++){
         $data=array("user" => $id,"profession" => $professionid,"website" => $websites[$i]['websites']);
        $query=$this->db->insert( "expert_professionwebsite", $data );
        $videosid=$this->db->insert_id();
            
        }

        return 1;
        
    }
    
    
    public function editHobbyDetails($id,$awards, $qualification,$websites,$videos,$description,$category,$skills){
        
        $query=$this->db->query("SELECT * FROM `expert_category` WHERE `name` LIKE '$category'")->row();
        $categoryid=$query->id;
//        
//        // HOBBY
//        
        $this->db->query("INSERT INTO `expert_hobby`( `user`, `category`,`description`,`expinyrs`) VALUE('$id','$categoryid','$description','$yoexp')");
        $hobbyid=$this->db->insert_id();
        
        // Skills
        for($i=0; $i<count($skills); $i++){
         $data=array("user" => $id,"hobby" => $hobbyid,"skills" => $skills[$i]['text']);
        $query=$this->db->insert( "expert_hobbyskill", $data );
        $skillsid=$this->db->insert_id();
            
        }
        
        // AWARDS
        for($i=0; $i<count($awards); $i++){
         $data=array("user" => $id,"hobby" => $hobbyid,"awards" => $awards[$i]['awards']);
        $query=$this->db->insert( "expert_hobbyawards", $data );
        $awardid=$this->db->insert_id();
            
        }

        
//        //QUALIFICATION
          for($i=0; $i<count($qualification); $i++){
         $data=array("user" => $id,"hobby" => $hobbyid,"degree" => $qualification[$i]['degree'],"institute" => $qualification[$i]['institute'],"yearofpassing" => $qualification[$i]['year']);
        $query=$this->db->insert( "expert_hobbyeducation", $data );
        $hobbyid=$this->db->insert_id();
            
        }

    
        for($i=0; $i<count($photos); $i++){
         $data=array("user" => $id,"hobby" => $hobbyid,"image" => $photos[$i]);
        $query=$this->db->insert( "expert_hobbyphotos", $data );
        $photoid=$this->db->insert_id();
            
        }
        
         // VIDEOLINKS
        
        for($i=0; $i<count($videos); $i++){
         $data=array("user" => $id,"hobby" => $hobbyid,"videolink" => $videos[$i]['videos']);
        $query=$this->db->insert( "expert_hobbyvideolinks", $data );
        $videosid=$this->db->insert_id();
            
        }

        // WEBSITE
            
         for($i=0; $i<count($websites); $i++){
         $data=array("user" => $id,"hobby" => $hobbyid,"website" => $websites[$i]['websites']);
        $query=$this->db->insert( "expert_hobbywebsite", $data );
        $websitesid=$this->db->insert_id();
            
        }

        return 1;
        
    }
    
    public function getUserDetails($id){
        $query['user']=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `firstname`, `lastname`, `maidenname`, `type`, `shortspecialities`, `interests`, `honorsawards`, `wallet`, `access`, `contact`, `percent`, `ameturetype`, `ametureprice`, `professionalprice`, `gender`, `twittersocial`, `youtubesocial`, `facebooksocial` FROM `user` WHERE `id`='$id'")->row();
        
         $query['profession']=$this->db->query("SELECT `id`, `user`, `category`, `description` FROM `expert_profession` WHERE `user`='$id'")->row();
        $professionid=$query['profession']->id;
         $query['profession']->awards=$this->db->query("SELECT `id`, `user`, `profession`, `award` as `awards` FROM `expert_professionaward` WHERE `user`='$id' AND `profession`='$professionid'")->result();
        
        $query['profession']->experience=$this->db->query("SELECT `id`, `profession`, `user`, `companyname`, `jobtitle`, `companylogo` as `logo`, `jobdescription`as `jobdesc`, `startdate`, `enddate` FROM `expert_professionexperience` WHERE `user`='$id' AND `profession`='$professionid'")->result();
        
        $query['profession']->qualification=$this->db->query("SELECT `id`, `user`, `profession`, `degree`, `institute`, `yearofpassing` as `year` FROM `expert_professioneducation` WHERE `user`='$id' AND `profession`='$professionid'")->result(); 
        
        $query['profession']->skills=$this->db->query("SELECT `id`, `user`, `profession`, `skills` as `text` FROM `expert_professionskill` WHERE `user`='$id' AND `profession`='$professionid'")->result();
        
        $query['profession']->videos=$this->db->query("SELECT `id`, `user`, `profession`, `videolink` as `videos` FROM `expert_professionvideolink` WHERE `user`='$id' AND `profession`='$professionid'")->result();
        
        $query['profession']->websites=$this->db->query("SELECT `id`, `user`, `profession`, `website` as `websites` FROM `expert_professionwebsite` WHERE `user`='$id' AND `profession`='$professionid'")->result(); 
        
        $query['profession']->photos=$this->db->query("SELECT `id`, `user`, `profession`, `image` FROM `expert_professionphoto` WHERE `user`='$id' AND `profession`='$professionid'")->result(); 
        
        //HOBBY
        
        
        
        $query['hobby']=$this->db->query("SELECT `id`, `user`, `category`, `expinyrs`, `description`, `skills` FROM `expert_hobby` WHERE `user`='$id'")->row();
        $hobbyid=$query['hobby']->id;
         $query['hobby']->awards=$this->db->query("SELECT `id`, `user`, `hobby`, `awards` FROM `expert_hobbyawards` WHERE `user`='$id' AND `hobby`='$hobbyid'")->result();
        
        
        $query['hobby']->qualification=$this->db->query("SELECT `id`, `user`, `hobby`, `degree`, `institute`, `yearofpassing` as `year` FROM `expert_hobbyeducation` WHERE `user`='$id' AND `hobby`='$hobbyid'")->result(); 
        
        $query['hobby']->skills=$this->db->query("SELECT `id`, `user`, `hobby`, `skills` as `text` FROM `expert_hobbyskill` WHERE `user`='$id' AND `hobby`='$hobbyid'")->result();
        
        $query['hobby']->videos=$this->db->query("SELECT `id`, `user`, `hobby`, `videolink` as `videos` FROM `expert_hobbyvideolinks` WHERE `user`='$id' AND `hobby`='$hobbyid'")->result();
        
        $query['hobby']->websites=$this->db->query("SELECT `id`, `user`, `hobby`, `website` as `websites` FROM `expert_hobbywebsite` WHERE `user`='$id' AND `hobby`='$hobbyid'")->result(); 
        
        $query['hobby']->photos=$this->db->query("SELECT `id`, `user`, `hobby`, `image` FROM `expert_hobbyphotos` WHERE `user`='$id' AND `hobby`='$hobbyid'")->result(); 
        
        return $query;
   
        
    }
   
    
}
?>
