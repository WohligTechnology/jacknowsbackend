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
    
    public function editProfessionDetails($id,$awards, $qualification, $experience,$websites,$videos,$description){
//        echo $id;
//        print_r($awards);
//        print_r($qualification);
//        print_r($experience);
//        print_r($websites);
//        print_r($videos);
//        echo $description;
//        
//        echo "  countofaward".count($awards);
//        echo "   countofqua".count($qualification);
//        echo "    countofexp".count($experience);
//        echo "   countofweb".count($websites);
//        echo "   countofvideo".count($videos);
//        
//        foreach(
//        
//        )
        
    }
   
    
}
?>
