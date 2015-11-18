<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
    public function registerUser($name, $email, $password)
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
   
    
}
?>
