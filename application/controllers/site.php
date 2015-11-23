<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2","3");
		$this->checkaccess($access);
        $accesslevel=$this->session->userdata('accesslevel');
//        echo $accesslevel;
        if($accesslevel==1)
        {
            $data[ 'page' ] = 'dashboard';
            $data[ 'title' ] = 'Welcome';
        }
        else if($accesslevel==2)
        {
            $data[ 'page' ] = 'moderatordashboard';
            $data[ 'title' ] = 'Welcome';
        }
        else if($accesslevel==3)
        {
            $data[ 'page' ] = 'accountantdashboard';
            $data[ 'title' ] = 'Welcome';
        }
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'type' ] =$this->user_model->getameturetypedropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data[ 'gender' ] =$this->user_model->getgenderdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'type' ] =$this->user_model->getameturetypedropdown();
             $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $contact=$this->input->post('contact');
            $wallet=$this->input->post('wallet');
            $percent=$this->input->post('percent');
            $type=$this->input->post('type');
            $ametureprice=$this->input->post('ametureprice');
            $professionalprice=$this->input->post('professionalprice');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $country=$this->input->post('country');
            $city=$this->input->post('city');
            $state=$this->input->post('state');
            $pincode=$this->input->post('pincode');
            $twittersocial=$this->input->post('twittersocial');
            $youtubesocial=$this->input->post('youtubesocial');
            $facebooksocial=$this->input->post('facebooksocial');
    
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$wallet,$contact,$percent,$type,$ametureprice,$professionalprice,$gender,$address,$country,$city,$state,$pincode,$twittersocial,$youtubesocial,$facebooksocial)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
//        print_r($data);
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
        $where="WHERE 1 AND `user`.`accesslevel`=4 ";
        
        $accesslevel=$this->session->userdata('accesslevel');
        if($accesslevel==2)
        {
            $where.=" AND `user`.`accesslevel` >= 2";
        }
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`type`";
        $elements[8]->sort="1";
        $elements[8]->header="Type";
        $elements[8]->alias="type";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","$where");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data[ 'type' ] =$this->user_model->getameturetypedropdown();
        $data[ 'gender' ] =$this->user_model->getgenderdropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['before1']=$this->input->get('id');
		$data['before2']=$this->input->get('id');
		$data['before3']=$this->input->get('id');
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'type' ] =$this->user_model->getameturetypedropdown();
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('templatewith2',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
            $contact=$this->input->get_post('contact');
            $wallet=$this->input->get_post('wallet');
            $percent=$this->input->get_post('percent');
            
            $type=$this->input->post('type');
            $ametureprice=$this->input->post('ametureprice');
            $professionalprice=$this->input->post('professionalprice');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $country=$this->input->post('country');
            $city=$this->input->post('city');
            $state=$this->input->post('state');
            $pincode=$this->input->post('pincode');
            $twittersocial=$this->input->post('twittersocial');
            $youtubesocial=$this->input->post('youtubesocial');
            $facebooksocial=$this->input->post('facebooksocial');
            
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$wallet,$contact,$percent,$type,$ametureprice,$professionalprice,$gender,$address,$country,$city,$state,$pincode,$twittersocial,$youtubesocial,$facebooksocial)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function viewusergallery()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewusergallery";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewusergalleryjson?id=".$this->input->get('id'));
        $data["title"]="View usergallery?id=".$this->input->get('id');
        $this->load->view("templatewith2",$data);
    }
    function viewusergalleryjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_usergallery`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_usergallery`.`user`";
        $elements[1]->sort="1";
        $elements[1]->header="User";
        $elements[1]->alias="user";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_usergallery`.`type`";
        $elements[2]->sort="1";
        $elements[2]->header="Type";
        $elements[2]->alias="type";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_usergallery`.`image`";
        $elements[3]->sort="1";
        $elements[3]->header="Image";
        $elements[3]->alias="image";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_usergallery`.`audio`";
        $elements[4]->sort="1";
        $elements[4]->header="Audio";
        $elements[4]->alias="audio";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_usergallery`","WHERE `expert_usergallery`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createusergallery()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createusergallery";
        $data["title"]="Create usergallery";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['type']=$this->user_model->gettypedropdown();
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createusergallerysubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("type","Type","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("audio","Audio","trim");
        $this->form_validation->set_rules("video","Video","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createusergallery";
            $data["title"]="Create usergallery";
            $data["page2"]="block/userblock";
            $data['type']=$this->user_model->gettypedropdown();
            $data['user']=$this->input->get_post('user');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $user=$this->input->get_post("user");
            $type=$this->input->get_post("type");
//            $image=$this->input->get_post("image");
//            $audio=$this->input->get_post("audio");
//            $video=$this->input->get_post("video");
            $image="";
            $audio="";
            $video="";
            $config['upload_path'] = './uploads/';
            if($type==0)
            {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename="image";
                $image="";
                if (  $this->upload->do_upload($filename))
                {
                    $uploaddata = $this->upload->data();
                    $image=$uploaddata['file_name'];
                }
            }
            else if($type==1)
            {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename="audio";
                $audio="";
                if (  $this->upload->do_upload($filename))
                {
                    $uploaddata = $this->upload->data();
                    $audio=$uploaddata['file_name'];
                }
            }
            else if($type==2)
            {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename="video";
                $video="";
                if (  $this->upload->do_upload($filename))
                {
                    $uploaddata = $this->upload->data();
                    $video=$uploaddata['file_name'];
                }
            }
            
//            if($image=="")
//            {
//                $image=$this->user_model->getuserimagebyid($id);
//                $image=$image->image;
//            }
            if($this->usergallery_model->create($user,$type,$image,$audio,$video)==0)
            $data["alerterror"]="New usergallery could not be created.";
            else
            $data["alertsuccess"]="usergallery created Successfully.";
            $data["redirect"]="site/viewusergallery?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editusergallery()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editusergallery";
        $data["title"]="Edit usergallery";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['type']=$this->user_model->gettypedropdown();
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforegallery"]=$this->usergallery_model->beforeedit($this->input->get("galleryid"));
        $this->load->view("templatewith2",$data);
    }
    public function editusergallerysubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("type","Type","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("audio","Audio","trim");
        $this->form_validation->set_rules("video","Video","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editusergallery";
            $data["title"]="Edit usergallery";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get_post('user');
            $data['type']=$this->user_model->gettypedropdown();
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforegallery"]=$this->usergallery_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $user=$this->input->get_post("user");
            $type=$this->input->get_post("type");
//            $image=$this->input->get_post("image");
//            $audio=$this->input->get_post("audio");
//            $video=$this->input->get_post("video");
            $image="";
            $audio="";
            $video="";
            $config['upload_path'] = './uploads/';
            if($type==0)
            {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename="image";
                $image="";
                if (  $this->upload->do_upload($filename))
                {
                    $uploaddata = $this->upload->data();
                    $image=$uploaddata['file_name'];
                }
                
                if($image=="")
                {
                    $image=$this->usergallery_model->getusergallerymediabyid($id);
                    $image=$image->image;
                }
            }
            else if($type==1)
            {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename="audio";
                $audio="";
                if (  $this->upload->do_upload($filename))
                {
                    $uploaddata = $this->upload->data();
                    $audio=$uploaddata['file_name'];
                }
                
                if($audio=="")
                {
                    $audio=$this->usergallery_model->getusergallerymediabyid($id);
                    $audio=$audio->audio;
                }
            }
            else if($type==2)
            {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename="video";
                $video="";
                if (  $this->upload->do_upload($filename))
                {
                    $uploaddata = $this->upload->data();
                    $video=$uploaddata['file_name'];
                }
                
                if($video=="")
                {
                    $video=$this->usergallery_model->getusergallerymediabyid($id);
                    $video=$video->video;
                }
            }
            
            if($this->usergallery_model->edit($id,$user,$type,$image,$audio,$video)==0)
            $data["alerterror"]="New usergallery could not be Updated.";
            else
            $data["alertsuccess"]="usergallery Updated Successfully.";
            $data["redirect"]="site/viewusergallery?id=".$user;
            $this->load->view("redirect",$data);
        }
    }
    public function deleteusergallery()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->usergallery_model->delete($this->input->get("galleryid"));
        $data["redirect"]="site/viewusergallery?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function viewbookingstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewbookingstatus";
    $data["base_url"]=site_url("site/viewbookingstatusjson");
    $data["title"]="View bookingstatus";
    $this->load->view("template",$data);
    }
    function viewbookingstatusjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`expert_bookingstatus`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
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
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_bookingstatus`");
    $this->load->view("json",$data);
    }

    public function createbookingstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createbookingstatus";
    $data["title"]="Create bookingstatus";
    $this->load->view("template",$data);
    }
    public function createbookingstatussubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("name","Name","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createbookingstatus";
    $data["title"]="Create bookingstatus";
    $this->load->view("template",$data);
    }
    else
    {
    $name=$this->input->get_post("name");
    if($this->bookingstatus_model->create($name)==0)
    $data["alerterror"]="New bookingstatus could not be created.";
    else
    $data["alertsuccess"]="bookingstatus created Successfully.";
    $data["redirect"]="site/viewbookingstatus";
    $this->load->view("redirect",$data);
    }
    }
    public function editbookingstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editbookingstatus";
    $data["title"]="Edit bookingstatus";
    $data["before"]=$this->bookingstatus_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function editbookingstatussubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("name","Name","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="editbookingstatus";
    $data["title"]="Edit bookingstatus";
    $data["before"]=$this->bookingstatus_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $name=$this->input->get_post("name");
    if($this->bookingstatus_model->edit($id,$name)==0)
    $data["alerterror"]="New bookingstatus could not be Updated.";
    else
    $data["alertsuccess"]="bookingstatus Updated Successfully.";
    $data["redirect"]="site/viewbookingstatus";
    $this->load->view("redirect",$data);
    }
    }
    public function deletebookingstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->bookingstatus_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewbookingstatus";
    $this->load->view("redirect",$data);
    }
    public function viewbooking()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="viewbooking";
        $data["base_url"]=site_url("site/viewbookingjson");
        $data["title"]="View booking";
        $this->load->view("template",$data);
    }
    function viewbookingjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_booking`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_booking`.`fromuser`";
        $elements[1]->sort="1";
        $elements[1]->header="From User";
        $elements[1]->alias="fromuser";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_booking`.`touser`";
        $elements[2]->sort="1";
        $elements[2]->header="To User";
        $elements[2]->alias="touser";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_booking`.`date`";
        $elements[3]->sort="1";
        $elements[3]->header="Date";
        $elements[3]->alias="date";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_booking`.`starttime`";
        $elements[4]->sort="1";
        $elements[4]->header="Start Time";
        $elements[4]->alias="starttime";
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_booking`.`endtime`";
        $elements[5]->sort="1";
        $elements[5]->header="End Time";
        $elements[5]->alias="endtime";
        $elements[6]=new stdClass();
        $elements[6]->field="`expert_booking`.`status`";
        $elements[6]->sort="1";
        $elements[6]->header="Statusid";
        $elements[6]->alias="statusid";
        
        $elements[7]=new stdClass();
        $elements[7]->field="`expert_bookingstatus`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
        
        $elements[8]=new stdClass();
        $elements[8]->field="`tab1`.`name`";
        $elements[8]->sort="1";
        $elements[8]->header="fromusername";
        $elements[8]->alias="fromusername";
        
        $elements[9]=new stdClass();
        $elements[9]->field="`tab2`.`name`";
        $elements[9]->sort="1";
        $elements[9]->header="tousername";
        $elements[9]->alias="tousername";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_booking` LEFT OUTER JOIN `expert_bookingstatus` ON `expert_bookingstatus`.`id`=`expert_booking`.`status` LEFT OUTER JOIN `user` AS `tab1` ON `expert_booking`.`fromuser`= `tab1`.`id`  LEFT OUTER JOIN `user` AS `tab2` ON `expert_booking`.`touser`= `tab2`.`id` ");
        $this->load->view("json",$data);
    }

    public function createbooking()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="createbooking";
        $data["title"]="Create booking";
        $data["user"]=$this->user_model->getuserdropdown();
        $data["status"]=$this->bookingstatus_model->getbookingstatusdropdown();
        $this->load->view("template",$data);
    }
    public function createbookingsubmit() 
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $this->form_validation->set_rules("fromuser","From User","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("starttime","Start Time","trim");
        $this->form_validation->set_rules("endtime","End Time","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createbooking";
            $data["title"]="Create booking";
            $data["user"]=$this->user_model->getuserdropdown();
            $data["status"]=$this->bookingstatus_model->getbookingstatusdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $fromuser=$this->input->get_post("fromuser");
            $touser=$this->input->get_post("touser");
            $date=$this->input->get_post("date");
            $starttime=$this->input->get_post("starttime");
            $endtime=$this->input->get_post("endtime");
            $status=$this->input->get_post("status");
            if($this->booking_model->create($fromuser,$touser,$date,$starttime,$endtime,$status)==0)
            $data["alerterror"]="New booking could not be created.";
            else
            $data["alertsuccess"]="booking created Successfully.";
            $data["redirect"]="site/viewbooking";
            $this->load->view("redirect",$data);
        }
    }
    public function editbooking()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="editbooking";
        $data["title"]="Edit booking";
        $data["user"]=$this->user_model->getuserdropdown();
        $data["status"]=$this->bookingstatus_model->getbookingstatusdropdown();
        $data["user"]=$this->user_model->getuserdropdown();
        $data["before"]=$this->booking_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editbookingsubmit()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("fromuser","From User","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("starttime","Start Time","trim");
        $this->form_validation->set_rules("endtime","End Time","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editbooking";
            $data["title"]="Edit booking";
            $data["user"]=$this->user_model->getuserdropdown();
            $data["status"]=$this->bookingstatus_model->getbookingstatusdropdown();
            $data["before"]=$this->booking_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $fromuser=$this->input->get_post("fromuser");
            $touser=$this->input->get_post("touser");
            $date=$this->input->get_post("date");
            $starttime=$this->input->get_post("starttime");
            $endtime=$this->input->get_post("endtime");
            $status=$this->input->get_post("status");
            if($this->booking_model->edit($id,$fromuser,$touser,$date,$starttime,$endtime,$status)==0)
            $data["alerterror"]="New booking could not be Updated.";
            else
            $data["alertsuccess"]="booking Updated Successfully.";
            $data["redirect"]="site/viewbooking";
            $this->load->view("redirect",$data);
        }
    }
    public function deletebooking()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $this->booking_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewbooking";
        $this->load->view("redirect",$data);
    }
    public function viewquestion()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="viewquestion";
        $data["base_url"]=site_url("site/viewquestionjson");
        $data["title"]="View question";
        $this->load->view("template",$data);
    }
    function viewquestionjson()
    {
        $elements=array();
        
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_question`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_question`.`fromuser`";
        $elements[1]->sort="1";
        $elements[1]->header="From User";
        $elements[1]->alias="fromuserid";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_question`.`question`";
        $elements[2]->sort="1";
        $elements[2]->header="Question";
        $elements[2]->alias="question";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`name`";
        $elements[3]->sort="1";
        $elements[3]->header="fromuser";
        $elements[3]->alias="fromuser";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_question` LEFT OUTER JOIN `user` ON `user`.`id`=`expert_question`.`fromuser`");
        $this->load->view("json",$data);
    }

    public function createquestion()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="createquestion";
        $data["title"]="Create question";
        $data["user"]=$this->user_model->getuserdropdown();
        $this->load->view("template",$data);
    }
    public function createquestionsubmit() 
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $this->form_validation->set_rules("fromuser","From User","trim");
        $this->form_validation->set_rules("question","Question","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createquestion";
            $data["title"]="Create question";
            $data["user"]=$this->user_model->getuserdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $fromuser=$this->input->get_post("fromuser");
            $question=$this->input->get_post("question");
            if($this->question_model->create($fromuser,$question)==0)
            $data["alerterror"]="New question could not be created.";
            else
            $data["alertsuccess"]="question created Successfully.";
            $data["redirect"]="site/viewquestion";
            $this->load->view("redirect",$data);
        }
    }
    public function editquestion()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="editquestion";
        $data["page2"]="block/questionblock";
        $data["title"]="Edit question";
        $data["user"]=$this->user_model->getuserdropdown();
        $data["before"]=$this->question_model->beforeedit($this->input->get("id"));
        $this->load->view("templatewith2",$data);
    }
    public function editquestionsubmit()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("fromuser","From User","trim");
        $this->form_validation->set_rules("question","Question","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editquestion";
            $data["title"]="Edit question";
            $data["user"]=$this->user_model->getuserdropdown();
            $data["before"]=$this->question_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $fromuser=$this->input->get_post("fromuser");
            $question=$this->input->get_post("question");
            if($this->question_model->edit($id,$fromuser,$question)==0)
            $data["alerterror"]="New question could not be Updated.";
            else
            $data["alertsuccess"]="question Updated Successfully.";
            $data["redirect"]="site/viewquestion";
            $this->load->view("redirect",$data);
        }
    }
    public function deletequestion()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $this->question_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewquestion";
        $this->load->view("redirect",$data);
    }
    public function viewquestionuser()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewquestionuser";
        $data["page2"]="block/questionblock";
        $data['question']=$this->input->get('id');
        $data['before']=$this->question_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewquestionuserjson?id=".$this->input->get('id'));
        $data["title"]="View questionuser";
        $this->load->view("templatewith2",$data);
    }
    function viewquestionuserjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_questionuser`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_questionuser`.`question`";
        $elements[1]->sort="1";
        $elements[1]->header="Question";
        $elements[1]->alias="question";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_questionuser`.`touser`";
        $elements[2]->sort="1";
        $elements[2]->header="To User Id";
        $elements[2]->alias="touserid";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_questionuser`.`status`";
        $elements[3]->sort="1";
        $elements[3]->header="Statusid";
        $elements[3]->alias="statusid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="To User";
        $elements[4]->alias="touser";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_questionuserstatus`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="Status";
        $elements[5]->alias="status";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_questionuser` LEFT OUTER JOIN `user` ON `user`.`id`=`expert_questionuser`.`touser` LEFT OUTER JOIN `expert_questionuserstatus` ON `expert_questionuserstatus`.`id`=`expert_questionuser`.`status`","WHERE `expert_questionuser`.`question`='$id'");
        $this->load->view("json",$data);
    }

    public function createquestionuser()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createquestionuser";
        $data["title"]="Create questionuser";
        $data["page2"]="block/questionblock";
        $data['question']=$this->input->get('id');
        $data['user']=$this->user_model->getuserdropdown();
        $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
        $data['before']=$this->question_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createquestionusersubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("question","Question","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createquestionuser";
            $data["title"]="Create questionuser";
            $data["page2"]="block/questionblock";
            $data['question']=$this->input->get('id');
            $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
            $data['before']=$this->question_model->beforeedit($this->input->get('id'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $question=$this->input->get_post("question");
            $touser=$this->input->get_post("touser");
            $status=$this->input->get_post("status");
            if($this->questionuser_model->create($question,$touser,$status)==0)
            $data["alerterror"]="New questionuser could not be created.";
            else
            $data["alertsuccess"]="questionuser created Successfully.";
            $data["redirect"]="site/viewquestionuser?id=".$question;
            $this->load->view("redirect2",$data);
        }
    }
    public function editquestionuser()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editquestionuser";
        $data["title"]="Edit questionuser";
        $data["page2"]="block/questionblock";
        $data['question']=$this->input->get('id');
        $data['user']=$this->user_model->getuserdropdown();
        $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
        $data['before']=$this->question_model->beforeedit($this->input->get('id'));
        $data["beforequestionuser"]=$this->questionuser_model->beforeedit($this->input->get("questionuserid"));
        $this->load->view("templatewith2",$data);
    }
    public function editquestionusersubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("question","Question","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editquestionuser";
            $data["title"]="Edit questionuser";
            $data["page2"]="block/questionblock";
            $data['question']=$this->input->get_post('question');
            $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
            $data['before']=$this->question_model->beforeedit($this->input->get_post('question'));
            $data["beforequestionuser"]=$this->questionuser_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $question=$this->input->get_post("question");
            $touser=$this->input->get_post("touser");
            $status=$this->input->get_post("status");
            if($this->questionuser_model->edit($id,$question,$touser,$status)==0)
            $data["alerterror"]="New questionuser could not be Updated.";
            else
            $data["alertsuccess"]="questionuser Updated Successfully.";
            $data["redirect"]="site/viewquestionuser?id=".$question;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletequestionuser()
    {
        $access=array("1");
        $this->checkaccess($access);
        $question=$this->input->get_post('id');
        $this->questionuser_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewquestionuser?id=".$question;
        $this->load->view("redirect2",$data);
    }
    public function viewquestionuserstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewquestionuserstatus";
    $data["base_url"]=site_url("site/viewquestionuserstatusjson");
    $data["title"]="View questionuserstatus";
    $this->load->view("template",$data);
    }
    function viewquestionuserstatusjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`expert_questionuserstatus`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
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
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_questionuserstatus`");
    $this->load->view("json",$data);
    }

    public function createquestionuserstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createquestionuserstatus";
    $data["title"]="Create questionuserstatus";
    $this->load->view("template",$data);
    }
    public function createquestionuserstatussubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("name","Name","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createquestionuserstatus";
    $data["title"]="Create questionuserstatus";
    $this->load->view("template",$data);
    }
    else
    {
    $name=$this->input->get_post("name");
    if($this->questionuserstatus_model->create($name)==0)
    $data["alerterror"]="New questionuserstatus could not be created.";
    else
    $data["alertsuccess"]="questionuserstatus created Successfully.";
    $data["redirect"]="site/viewquestionuserstatus";
    $this->load->view("redirect",$data);
    }
    }
    public function editquestionuserstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editquestionuserstatus";
    $data["title"]="Edit questionuserstatus";
    $data["before"]=$this->questionuserstatus_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function editquestionuserstatussubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("name","Name","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="editquestionuserstatus";
    $data["title"]="Edit questionuserstatus";
    $data["before"]=$this->questionuserstatus_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $name=$this->input->get_post("name");
    if($this->questionuserstatus_model->edit($id,$name)==0)
    $data["alerterror"]="New questionuserstatus could not be Updated.";
    else
    $data["alertsuccess"]="questionuserstatus Updated Successfully.";
    $data["redirect"]="site/viewquestionuserstatus";
    $this->load->view("redirect",$data);
    }
    }
    public function deletequestionuserstatus()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->questionuserstatus_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewquestionuserstatus";
    $this->load->view("redirect",$data);
    }
    public function viewpublication()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewpublication";
        
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        
        $data["base_url"]=site_url("site/viewpublicationjson?id=".$this->input->get('id'));
        $data["title"]="View publication";
        $this->load->view("templatewith2",$data);
    }
    function viewpublicationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_publication`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_publication`.`publicationid`";
        $elements[1]->sort="1";
        $elements[1]->header="Publication ID";
        $elements[1]->alias="publicationid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_publication`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_publication`.`title`";
        $elements[3]->sort="1";
        $elements[3]->header="Title";
        $elements[3]->alias="title";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_publication`.`publishername`";
        $elements[4]->sort="1";
        $elements[4]->header="Publisher Name";
        $elements[4]->alias="publishername";
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_publication`.`authorid`";
        $elements[5]->sort="1";
        $elements[5]->header="Author Id";
        $elements[5]->alias="authorid";
        $elements[6]=new stdClass();
        $elements[6]->field="`expert_publication`.`authorname`";
        $elements[6]->sort="1";
        $elements[6]->header="Author Name";
        $elements[6]->alias="authorname";
        $elements[7]=new stdClass();
        $elements[7]->field="`expert_publication`.`date`";
        $elements[7]->sort="1";
        $elements[7]->header="Date";
        $elements[7]->alias="date";
        $elements[8]=new stdClass();
        $elements[8]->field="`expert_publication`.`publicationurl`";
        $elements[8]->sort="1";
        $elements[8]->header="Publication URL";
        $elements[8]->alias="publicationurl";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_publication`","WHERE `expert_publication`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createpublication()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createpublication";
        $data["title"]="Create publication";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createpublicationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("publicationid","Publication ID","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("title","Title","trim");
        $this->form_validation->set_rules("publishername","Publisher Name","trim");
        $this->form_validation->set_rules("authorid","Author Id","trim");
        $this->form_validation->set_rules("authorname","Author Name","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("publicationurl","Publication URL","trim");
        $this->form_validation->set_rules("summary","Summary","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createpublication";
            $data["title"]="Create publication";
            $this->load->view("template",$data);
        }
        else
        {
            $publicationid=$this->input->get_post("publicationid");
            $user=$this->input->get_post("user");
            $title=$this->input->get_post("title");
            $publishername=$this->input->get_post("publishername");
            $authorid=$this->input->get_post("authorid");
            $authorname=$this->input->get_post("authorname");
            $date=$this->input->get_post("date");
            $publicationurl=$this->input->get_post("publicationurl");
            $summary=$this->input->get_post("summary");
            if($this->publication_model->create($publicationid,$user,$title,$publishername,$authorid,$authorname,$date,$publicationurl,$summary)==0)
                $data["alerterror"]="New publication could not be created.";
            else
                $data["alertsuccess"]="publication created Successfully.";
            $data["redirect"]="site/viewpublication?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editpublication()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editpublication";
        $data["title"]="Edit publication";
        
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforepublication"]=$this->publication_model->beforeedit($this->input->get("publicationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editpublicationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("publicationid","Publication ID","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("title","Title","trim");
        $this->form_validation->set_rules("publishername","Publisher Name","trim");
        $this->form_validation->set_rules("authorid","Author Id","trim");
        $this->form_validation->set_rules("authorname","Author Name","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("publicationurl","Publication URL","trim");
        $this->form_validation->set_rules("summary","Summary","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editpublication";
            $data["title"]="Edit publication";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["before"]=$this->publication_model->beforeedit($this->input->get_post("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $publicationid=$this->input->get_post("publicationid");
            $user=$this->input->get_post("user");
            $title=$this->input->get_post("title");
            $publishername=$this->input->get_post("publishername");
            $authorid=$this->input->get_post("authorid");
            $authorname=$this->input->get_post("authorname");
            $date=$this->input->get_post("date");
            $publicationurl=$this->input->get_post("publicationurl");
            $summary=$this->input->get_post("summary");
            if($this->publication_model->edit($id,$publicationid,$user,$title,$publishername,$authorid,$authorname,$date,$publicationurl,$summary)==0)
                $data["alerterror"]="New publication could not be Updated.";
            else
                $data["alertsuccess"]="publication Updated Successfully.";
            $data["redirect"]="site/viewpublication?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletepublication()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get('id');
        $this->publication_model->delete($this->input->get("publicationid"));
        $data["redirect"]="site/viewpublication?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function viewpatent()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewpatent";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewpatentjson?id=".$this->input->get('id'));
        $data["title"]="View patent";
        $this->load->view("templatewith2",$data);
    }
    function viewpatentjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_patent`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_patent`.`patentid`";
        $elements[1]->sort="1";
        $elements[1]->header="Patent Id";
        $elements[1]->alias="patentid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_patent`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_patent`.`title`";
        $elements[3]->sort="1";
        $elements[3]->header="Title";
        $elements[3]->alias="title";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_patent`.`summary`";
        $elements[4]->sort="1";
        $elements[4]->header="Summary";
        $elements[4]->alias="summary";
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_patent`.`number`";
        $elements[5]->sort="1";
        $elements[5]->header="Number";
        $elements[5]->alias="number";
        $elements[6]=new stdClass();
        $elements[6]->field="`expert_patent`.`statusid`";
        $elements[6]->sort="1";
        $elements[6]->header="Status ID";
        $elements[6]->alias="statusid";
        $elements[7]=new stdClass();
        $elements[7]->field="`expert_patent`.`status`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
        $elements[8]=new stdClass();
        $elements[8]->field="`expert_patent`.`officename`";
        $elements[8]->sort="1";
        $elements[8]->header="Office Name";
        $elements[8]->alias="officename";
        $elements[9]=new stdClass();
        $elements[9]->field="`expert_patent`.`inventorid`";
        $elements[9]->sort="1";
        $elements[9]->header="Inventor Id";
        $elements[9]->alias="inventorid";
        $elements[10]=new stdClass();
        $elements[10]->field="`expert_patent`.`inventorname`";
        $elements[10]->sort="1";
        $elements[10]->header="Inventor Name";
        $elements[10]->alias="inventorname";
        $elements[11]=new stdClass();
        $elements[11]->field="`expert_patent`.`date`";
        $elements[11]->sort="1";
        $elements[11]->header="Date";
        $elements[11]->alias="date";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_patent`","WHERE `expert_patent`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createpatent()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createpatent";
        $data["title"]="Create patent";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createpatentsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("patentid","Patent Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("title","Title","trim");
        $this->form_validation->set_rules("summary","Summary","trim");
        $this->form_validation->set_rules("number","Number","trim");
        $this->form_validation->set_rules("statusid","Status ID","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("officename","Office Name","trim");
        $this->form_validation->set_rules("inventorid","Inventor Id","trim");
        $this->form_validation->set_rules("inventorname","Inventor Name","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("url","URL","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createpatent";
            $data["title"]="Create patent";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $patentid=$this->input->get_post("patentid");
            $user=$this->input->get_post("user");
            $title=$this->input->get_post("title");
            $summary=$this->input->get_post("summary");
            $number=$this->input->get_post("number");
            $statusid=$this->input->get_post("statusid");
            $status=$this->input->get_post("status");
            $officename=$this->input->get_post("officename");
            $inventorid=$this->input->get_post("inventorid");
            $inventorname=$this->input->get_post("inventorname");
            $date=$this->input->get_post("date");
            $url=$this->input->get_post("url");
            if($this->patent_model->create($patentid,$user,$title,$summary,$number,$statusid,$status,$officename,$inventorid,$inventorname,$date,$url)==0)
                $data["alerterror"]="New patent could not be created.";
            else
                $data["alertsuccess"]="patent created Successfully.";
            $data["redirect"]="site/viewpatent?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editpatent()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editpatent";
        $data["title"]="Edit patent";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforepatent"]=$this->patent_model->beforeedit($this->input->get("patentid"));
        $this->load->view("templatewith2",$data);
    }
    public function editpatentsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("patentid","Patent Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("title","Title","trim");
        $this->form_validation->set_rules("summary","Summary","trim");
        $this->form_validation->set_rules("number","Number","trim");
        $this->form_validation->set_rules("statusid","Status ID","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("officename","Office Name","trim");
        $this->form_validation->set_rules("inventorid","Inventor Id","trim");
        $this->form_validation->set_rules("inventorname","Inventor Name","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("url","URL","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editpatent";
            $data["title"]="Edit patent";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get_post('user');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforepatent"]=$this->patent_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $patentid=$this->input->get_post("patentid");
            $user=$this->input->get_post("user");
            $title=$this->input->get_post("title");
            $summary=$this->input->get_post("summary");
            $number=$this->input->get_post("number");
            $statusid=$this->input->get_post("statusid");
            $status=$this->input->get_post("status");
            $officename=$this->input->get_post("officename");
            $inventorid=$this->input->get_post("inventorid");
            $inventorname=$this->input->get_post("inventorname");
            $date=$this->input->get_post("date");
            $url=$this->input->get_post("url");
            if($this->patent_model->edit($id,$patentid,$user,$title,$summary,$number,$statusid,$status,$officename,$inventorid,$inventorname,$date,$url)==0)
            $data["alerterror"]="New patent could not be Updated.";
            else
            $data["alertsuccess"]="patent Updated Successfully.";
            $data["redirect"]="site/viewpatent?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletepatent()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->patent_model->delete($this->input->get("patentid"));
        $data["redirect"]="site/viewpatent?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function viewlanguage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewlanguage";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewlanguagejson?id=".$this->input->get('id'));
        $data["title"]="View language";
        $this->load->view("templatewith2",$data);
    }
    function viewlanguagejson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_language`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_language`.`languageid`";
        $elements[1]->sort="1";
        $elements[1]->header="Language Id";
        $elements[1]->alias="languageid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_language`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_language`.`languagename`";
        $elements[3]->sort="1";
        $elements[3]->header="Language Name";
        $elements[3]->alias="languagename";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_language`.`proficiancylevel`";
        $elements[4]->sort="1";
        $elements[4]->header="Proficiancy Level";
        $elements[4]->alias="proficiancylevel";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_language`","WHERE `expert_language`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createlanguage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createlanguage";
        $data["title"]="Create language";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createlanguagesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("languageid","Language Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("languagename","Language Name","trim");
        $this->form_validation->set_rules("proficiancylevel","Proficiancy Level","trim");
        $this->form_validation->set_rules("proficiancyname","Proficiancy Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createlanguage";
            $data["title"]="Create language";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $languageid=$this->input->get_post("languageid");
            $user=$this->input->get_post("user");
            $languagename=$this->input->get_post("languagename");
            $proficiancylevel=$this->input->get_post("proficiancylevel");
            $proficiancyname=$this->input->get_post("proficiancyname");
            if($this->language_model->create($languageid,$user,$languagename,$proficiancylevel,$proficiancyname)==0)
            $data["alerterror"]="New language could not be created.";
            else
            $data["alertsuccess"]="language created Successfully.";
            $data["redirect"]="site/viewlanguage?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editlanguage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlanguage";
        $data["title"]="Edit language";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforelanguage"]=$this->language_model->beforeedit($this->input->get("languageid"));
        $this->load->view("templatewith2",$data);
    }
    public function editlanguagesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("languageid","Language Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("languagename","Language Name","trim");
        $this->form_validation->set_rules("proficiancylevel","Proficiancy Level","trim");
        $this->form_validation->set_rules("proficiancyname","Proficiancy Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editlanguage";
            $data["title"]="Edit language";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforelanguage"]=$this->language_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $languageid=$this->input->get_post("languageid");
            $user=$this->input->get_post("user");
            $languagename=$this->input->get_post("languagename");
            $proficiancylevel=$this->input->get_post("proficiancylevel");
            $proficiancyname=$this->input->get_post("proficiancyname");
            if($this->language_model->edit($id,$languageid,$user,$languagename,$proficiancylevel,$proficiancyname)==0)
            $data["alerterror"]="New language could not be Updated.";
            else
            $data["alertsuccess"]="language Updated Successfully.";
            $data["redirect"]="site/viewlanguage?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletelanguage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->language_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewlanguage?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function viewskill()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewskill";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewskilljson?id=".$this->input->get('id'));
        $data["title"]="View skill";
        $this->load->view("templatewith2",$data);
    }
    function viewskilljson()
    {
        $id=$this->input->get("id");
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_skill`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_skill`.`skillid`";
        $elements[1]->sort="1";
        $elements[1]->header="Skill Id";
        $elements[1]->alias="skillid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_skill`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_skill`","WHERE `expert_skill`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createskill()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createskill";
        $data["title"]="Create skill";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createskillsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("skillid","Skill Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("skillname","Skill Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createskill";
            $data["title"]="Create skill";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get_post('user');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('id'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $skillid=$this->input->get_post("skillid");
            $user=$this->input->get_post("user");
            $skillname=$this->input->get_post("skillname");
            if($this->skill_model->create($skillid,$user,$skillname)==0)
            $data["alerterror"]="New skill could not be created.";
            else
            $data["alertsuccess"]="skill created Successfully.";
            $data["redirect"]="site/viewskill?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editskill()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editskill";
        $data["title"]="Edit skill";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforeskill"]=$this->skill_model->beforeedit($this->input->get("skillid"));
        $this->load->view("templatewith2",$data);
    }
    public function editskillsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("skillid","Skill Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("skillname","Skill Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editskill";
            $data["title"]="Edit skill";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforeskill"]=$this->skill_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $skillid=$this->input->get_post("skillid");
            $user=$this->input->get_post("user");
            $skillname=$this->input->get_post("skillname");
            if($this->skill_model->edit($id,$skillid,$user,$skillname)==0)
            $data["alerterror"]="New skill could not be Updated.";
            else
            $data["alertsuccess"]="skill Updated Successfully.";
            $data["redirect"]="site/viewskill?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deleteskill()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->skill_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewskill?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function vieweducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="vieweducation";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/vieweducationjson?id=".$this->input->get('id'));
        $data["title"]="View education";
        $this->load->view("templatewith2",$data);
    }
    function vieweducationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_education`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_education`.`educationid`";
        $elements[1]->sort="1";
        $elements[1]->header="Education Id";
        $elements[1]->alias="educationid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_education`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_education`.`schoolname`";
        $elements[3]->sort="1";
        $elements[3]->header="School Name";
        $elements[3]->alias="schoolname";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_education`.`fieldofstudy`";
        $elements[4]->sort="1";
        $elements[4]->header="Field Of Study";
        $elements[4]->alias="fieldofstudy";
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_education`.`startdate`";
        $elements[5]->sort="1";
        $elements[5]->header="Start Date";
        $elements[5]->alias="startdate";
        $elements[6]=new stdClass();
        $elements[6]->field="`expert_education`.`enddate`";
        $elements[6]->sort="1";
        $elements[6]->header="End Date";
        $elements[6]->alias="enddate";
        $elements[7]=new stdClass();
        $elements[7]->field="`expert_education`.`degree`";
        $elements[7]->sort="1";
        $elements[7]->header="Degree";
        $elements[7]->alias="degree";
        $elements[8]=new stdClass();
        $elements[8]->field="`expert_education`.`activities`";
        $elements[8]->sort="1";
        $elements[8]->header="Activities";
        $elements[8]->alias="activities";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_education`","WHERE `expert_education`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createeducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createeducation";
        $data["title"]="Create education";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createeducationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("educationid","Education Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("schoolname","School Name","trim");
        $this->form_validation->set_rules("fieldofstudy","Field Of Study","trim");
        $this->form_validation->set_rules("startdate","Start Date","trim");
        $this->form_validation->set_rules("enddate","End Date","trim");
        $this->form_validation->set_rules("degree","Degree","trim");
        $this->form_validation->set_rules("activities","Activities","trim");
        $this->form_validation->set_rules("notes","Notes","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createeducation";
            $data["title"]="Create education";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $educationid=$this->input->get_post("educationid");
            $user=$this->input->get_post("user");
            $schoolname=$this->input->get_post("schoolname");
            $fieldofstudy=$this->input->get_post("fieldofstudy");
            $startdate=$this->input->get_post("startdate");
            $enddate=$this->input->get_post("enddate");
            $degree=$this->input->get_post("degree");
            $activities=$this->input->get_post("activities");
            $notes=$this->input->get_post("notes");
            if($this->education_model->create($educationid,$user,$schoolname,$fieldofstudy,$startdate,$enddate,$degree,$activities,$notes)==0)
            $data["alerterror"]="New education could not be created.";
            else
            $data["alertsuccess"]="education created Successfully.";
            $data["redirect"]="site/vieweducation?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editeducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editeducation";
        $data["title"]="Edit education";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforeeducation"]=$this->education_model->beforeedit($this->input->get("educationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editeducationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("educationid","Education Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("schoolname","School Name","trim");
        $this->form_validation->set_rules("fieldofstudy","Field Of Study","trim");
        $this->form_validation->set_rules("startdate","Start Date","trim");
        $this->form_validation->set_rules("enddate","End Date","trim");
        $this->form_validation->set_rules("degree","Degree","trim");
        $this->form_validation->set_rules("activities","Activities","trim");
        $this->form_validation->set_rules("notes","Notes","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editeducation";
            $data["title"]="Edit education";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforeeducation"]=$this->education_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $educationid=$this->input->get_post("educationid");
            $user=$this->input->get_post("user");
            $schoolname=$this->input->get_post("schoolname");
            $fieldofstudy=$this->input->get_post("fieldofstudy");
            $startdate=$this->input->get_post("startdate");
            $enddate=$this->input->get_post("enddate");
            $degree=$this->input->get_post("degree");
            $activities=$this->input->get_post("activities");
            $notes=$this->input->get_post("notes");
            if($this->education_model->edit($id,$educationid,$user,$schoolname,$fieldofstudy,$startdate,$enddate,$degree,$activities,$notes)==0)
            $data["alerterror"]="New education could not be Updated.";
            else
            $data["alertsuccess"]="education Updated Successfully.";
            $data["redirect"]="site/vieweducation?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deleteeducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->education_model->delete($this->input->get("id"));
        $data["redirect"]="site/vieweducation?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function viewcourse()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewcourse";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewcoursejson?id=".$this->input->get('id'));
        $data["title"]="View course";
        $this->load->view("templatewith2",$data);
    }
    function viewcoursejson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_course`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_course`.`courseid`";
        $elements[1]->sort="1";
        $elements[1]->header="Course Id";
        $elements[1]->alias="courseid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_course`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_course`.`name`";
        $elements[3]->sort="1";
        $elements[3]->header="Name";
        $elements[3]->alias="name";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_course`","WHERE `expert_course`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createcourse()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createcourse";
        $data["title"]="Create course";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createcoursesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("courseid","Course Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("coursenumber","Course Number","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createcourse";
            $data["title"]="Create course";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $courseid=$this->input->get_post("courseid");
            $user=$this->input->get_post("user");
            $name=$this->input->get_post("name");
            $coursenumber=$this->input->get_post("coursenumber");
            if($this->course_model->create($courseid,$user,$name,$coursenumber)==0)
            $data["alerterror"]="New course could not be created.";
            else
            $data["alertsuccess"]="course created Successfully.";
            $data["redirect"]="site/viewcourse?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editcourse()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editcourse";
        $data["title"]="Edit course";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforecourse"]=$this->course_model->beforeedit($this->input->get("courseid"));
        $this->load->view("templatewith2",$data);
    }
    public function editcoursesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("courseid","Course Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("coursenumber","Course Number","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editcourse";
            $data["title"]="Edit course";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforecourse"]=$this->course_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $courseid=$this->input->get_post("courseid");
            $user=$this->input->get_post("user");
            $name=$this->input->get_post("name");
            $coursenumber=$this->input->get_post("coursenumber");
            if($this->course_model->edit($id,$courseid,$user,$name,$coursenumber)==0)
            $data["alerterror"]="New course could not be Updated.";
            else
            $data["alertsuccess"]="course Updated Successfully.";
            $data["redirect"]="site/viewcourse?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletecourse()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->course_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewcourse?id=".$user;
        $this->load->view("redirectwith2",$data);
    }
    public function viewcertification()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewcertification";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewcertificationjson?id=".$this->input->get('id'));
        $data["title"]="View certification";
        $this->load->view("templatewith2",$data);
    }
    function viewcertificationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_certification`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_certification`.`certificationid`";
        $elements[1]->sort="1";
        $elements[1]->header="Certification Id";
        $elements[1]->alias="certificationid";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_certification`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_certification`.`certificationname`";
        $elements[3]->sort="1";
        $elements[3]->header="Certification Name";
        $elements[3]->alias="certificationname";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_certification`.`authorityname`";
        $elements[4]->sort="1";
        $elements[4]->header="Authority Name";
        $elements[4]->alias="authorityname";
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_certification`.`licensenumber`";
        $elements[5]->sort="1";
        $elements[5]->header="License Number";
        $elements[5]->alias="licensenumber";
        $elements[6]=new stdClass();
        $elements[6]->field="`expert_certification`.`startdate`";
        $elements[6]->sort="1";
        $elements[6]->header="Start Date";
        $elements[6]->alias="startdate";
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
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_certification`","WHERE `expert_certification`.`user`='$id'");
        $this->load->view("json",$data);
    }

    public function createcertification()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createcertification";
        $data["title"]="Create certification";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createcertificationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("certificationid","Certification Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("certificationname","Certification Name","trim");
        $this->form_validation->set_rules("authorityname","Authority Name","trim");
        $this->form_validation->set_rules("licensenumber","License Number","trim");
        $this->form_validation->set_rules("startdate","Start Date","trim");
        $this->form_validation->set_rules("enddate","End Date","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createcertification";
            $data["title"]="Create certification";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $certificationid=$this->input->get_post("certificationid");
            $user=$this->input->get_post("user");
            $certificationname=$this->input->get_post("certificationname");
            $authorityname=$this->input->get_post("authorityname");
            $licensenumber=$this->input->get_post("licensenumber");
            $startdate=$this->input->get_post("startdate");
            $enddate=$this->input->get_post("enddate");
            if($this->certification_model->create($certificationid,$user,$certificationname,$authorityname,$licensenumber,$startdate,$enddate)==0)
            $data["alerterror"]="New certification could not be created.";
            else
            $data["alertsuccess"]="certification created Successfully.";
            $data["redirect"]="site/viewcertification?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function editcertification()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editcertification";
        $data["title"]="Edit certification";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforecertification"]=$this->certification_model->beforeedit($this->input->get("certificationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editcertificationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("certificationid","Certification Id","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("certificationname","Certification Name","trim");
        $this->form_validation->set_rules("authorityname","Authority Name","trim");
        $this->form_validation->set_rules("licensenumber","License Number","trim");
        $this->form_validation->set_rules("startdate","Start Date","trim");
        $this->form_validation->set_rules("enddate","End Date","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editcertification";
            $data["title"]="Edit certification";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
            $data['before']=$this->user_model->beforeedit($this->input->get_post('user'));
            $data["beforecertification"]=$this->certification_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $certificationid=$this->input->get_post("certificationid");
            $user=$this->input->get_post("user");
            $certificationname=$this->input->get_post("certificationname");
            $authorityname=$this->input->get_post("authorityname");
            $licensenumber=$this->input->get_post("licensenumber");
            $startdate=$this->input->get_post("startdate");
            $enddate=$this->input->get_post("enddate");
            if($this->certification_model->edit($id,$certificationid,$user,$certificationname,$authorityname,$licensenumber,$startdate,$enddate)==0)
            $data["alerterror"]="New certification could not be Updated.";
            else
            $data["alertsuccess"]="certification Updated Successfully.";
            $data["redirect"]="site/viewcertification?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletecertification()
    {
        $access=array("1");
        $this->checkaccess($access);
        $user=$this->input->get("id");
        $this->certification_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewcertification?id=".$user;
        $this->load->view("redirect2",$data);
    }
    public function viewtransaction()
    {
        $access=array("1","3");
        $this->checkaccess($access);
        $data["page"]="viewtransaction";
        $data["base_url"]=site_url("site/viewtransactionjson");
        $data["title"]="View transaction";
        $this->load->view("template",$data);
    }
    function viewtransactionjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_transaction`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_transaction`.`fromuser`";
        $elements[1]->sort="1";
        $elements[1]->header="From User";
        $elements[1]->alias="fromuser";
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_transaction`.`touser`";
        $elements[2]->sort="1";
        $elements[2]->header="To User";
        $elements[2]->alias="touser";
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_transaction`.`amount`";
        $elements[3]->sort="1";
        $elements[3]->header="Amount";
        $elements[3]->alias="amount";
        $elements[4]=new stdClass();
        $elements[4]->field="`expert_transaction`.`type`";
        $elements[4]->sort="1";
        $elements[4]->header="Type";
        $elements[4]->alias="type";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`tab1`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="fromusername";
        $elements[5]->alias="fromusername";
        
        $elements[6]=new stdClass();
        $elements[6]->field="`tab2`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="tousername";
        $elements[6]->alias="tousername";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_transaction`  LEFT OUTER JOIN `user` AS `tab1` ON `expert_transaction`.`fromuser`= `tab1`.`id`  LEFT OUTER JOIN `user` AS `tab2` ON `expert_transaction`.`touser`= `tab2`.`id` ");
        $this->load->view("json",$data);
    }

    public function createtransaction()
    {
        $access=array("1","3");
        $this->checkaccess($access);
        $data["page"]="createtransaction";
        $data["title"]="Create transaction";
        $data["user"]=$this->user_model->getuserdropdown();
        $this->load->view("template",$data);
    }
    public function createtransactionsubmit() 
    {
        $access=array("1","3");
        $this->checkaccess($access);
        $this->form_validation->set_rules("fromuser","From User","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("amount","Amount","trim");
        $this->form_validation->set_rules("type","Type","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createtransaction";
            $data["title"]="Create transaction";
            $data["user"]=$this->user_model->getuserdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $fromuser=$this->input->get_post("fromuser");
            $touser=$this->input->get_post("touser");
            $amount=$this->input->get_post("amount");
            $type=$this->input->get_post("type");
            if($this->transaction_model->create($fromuser,$touser,$amount,$type)==0)
            $data["alerterror"]="New transaction could not be created.";
            else
            $data["alertsuccess"]="transaction created Successfully.";
            $data["redirect"]="site/viewtransaction";
            $this->load->view("redirect",$data);
        }
    }
    public function edittransaction()
    {
        $access=array("1","3");
        $this->checkaccess($access);
        $data["page"]="edittransaction";
        $data["title"]="Edit transaction";
        $data["user"]=$this->user_model->getuserdropdown();
        $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function edittransactionsubmit()
    {
        $access=array("1","3");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("fromuser","From User","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("amount","Amount","trim");
        $this->form_validation->set_rules("type","Type","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="edittransaction";
            $data["title"]="Edit transaction";
            $data["user"]=$this->user_model->getuserdropdown();
            $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $fromuser=$this->input->get_post("fromuser");
            $touser=$this->input->get_post("touser");
            $amount=$this->input->get_post("amount");
            $type=$this->input->get_post("type");
            if($this->transaction_model->edit($id,$fromuser,$touser,$amount,$type)==0)
            $data["alerterror"]="New transaction could not be Updated.";
            else
            $data["alertsuccess"]="transaction Updated Successfully.";
            $data["redirect"]="site/viewtransaction";
            $this->load->view("redirect",$data);
        }
    }
    public function deletetransaction()
    {
        $access=array("1","3");
        $this->checkaccess($access);
        $this->transaction_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewtransaction";
        $this->load->view("redirect",$data);
    }
    
    public function viewuserquestion()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewuserquestion";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewuserquestionjson?id=".$this->input->get('id'));
        $data["title"]="View userquestion";
        $this->load->view("templatewith2",$data);
    }
    function viewuserquestionjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`expert_questionuser`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`expert_questionuser`.`question`";
        $elements[1]->sort="1";
        $elements[1]->header="Questionid";
        $elements[1]->alias="questionid";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`expert_questionuser`.`touser`";
        $elements[2]->sort="1";
        $elements[2]->header="To User Id";
        $elements[2]->alias="touserid";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`expert_questionuser`.`status`";
        $elements[3]->sort="1";
        $elements[3]->header="Statusid";
        $elements[3]->alias="statusid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="To User";
        $elements[4]->alias="touser";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`expert_questionuserstatus`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="Status";
        $elements[5]->alias="status";
        
        $elements[6]=new stdClass();
        $elements[6]->field="`expert_question`.`question`";
        $elements[6]->sort="1";
        $elements[6]->header="Question";
        $elements[6]->alias="question";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_questionuser` LEFT OUTER JOIN `user` ON `user`.`id`=`expert_questionuser`.`touser` LEFT OUTER JOIN `expert_questionuserstatus` ON `expert_questionuserstatus`.`id`=`expert_questionuser`.`status` LEFT OUTER JOIN `expert_question` ON `expert_question`.`id`=`expert_questionuser`.`question`","WHERE `expert_questionuser`.`touser`='$id'");
        $this->load->view("json",$data);
    }

    public function createuserquestion()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createuserquestion";
        $data["title"]="Create userquestion";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
//        $data['user']=$this->user_model->getuserdropdown();
        $data['question']=$this->question_model->getquestiondropdown();
        $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createuserquestionsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("question","Question","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createuserquestion";
            $data["title"]="Create userquestion";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
    //        $data['user']=$this->user_model->getuserdropdown();
            $data['question']=$this->question_model->getquestiondropdown();
            $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
            $data['before']=$this->user_model->beforeedit($this->input->get('id'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $question=$this->input->get_post("question");
            $touser=$this->input->get_post("touser");
            $status=$this->input->get_post("status");
            if($this->questionuser_model->create($question,$touser,$status)==0)
            $data["alerterror"]="New questionuser could not be created.";
            else
            $data["alertsuccess"]="questionuser created Successfully.";
            $data["redirect"]="site/viewuserquestion?id=".$touser;
            $this->load->view("redirect2",$data);
        }
    }
    public function edituserquestion()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="edituserquestion";
        $data["title"]="Edit userquestion";
        $data["page2"]="block/userblock";
        $data['user']=$this->input->get('id');
//        $data['user']=$this->user_model->getuserdropdown();
        $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
        $data['question']=$this->question_model->getquestiondropdown();
        $data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $data["beforequestionuser"]=$this->questionuser_model->beforeedit($this->input->get("questionuserid"));
        $this->load->view("templatewith2",$data);
    }
    public function edituserquestionsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("question","Question","trim");
        $this->form_validation->set_rules("touser","To User","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="edituserquestion";
            $data["title"]="Edit userquestion";
            $data["page2"]="block/userblock";
            $data['user']=$this->input->get('id');
    //        $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->questionuserstatus_model->getquestionuserstatus();
            $data['question']=$this->question_model->getquestiondropdown();
            $data['before']=$this->user_model->beforeedit($this->input->get('id'));
            $data["beforequestionuser"]=$this->questionuser_model->beforeedit($this->input->get("questionuserid"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $question=$this->input->get_post("question");
            $touser=$this->input->get_post("touser");
            $status=$this->input->get_post("status");
            if($this->questionuser_model->edit($id,$question,$touser,$status)==0)
            $data["alerterror"]="New questionuser could not be Updated.";
            else
            $data["alertsuccess"]="questionuser Updated Successfully.";
            $data["redirect"]="site/viewuserquestion?id=".$touser;
            $this->load->view("redirect2",$data);
        }
    }
    public function deleteuserquestion()
    {
        $access=array("1");
        $this->checkaccess($access);
        $touser=$this->input->get_post('id');
        $this->questionuser_model->delete($this->input->get("questionuserid"));
        $data["redirect"]="site/viewuserquestion?id=".$touser;
        $this->load->view("redirect2",$data);
    }
    
    public function viewdetailsofbooking()
    {
        $access=array("1","2");
        $this->checkaccess($access);
        $data["page"]="viewdetailsofbooking";
        $data["title"]="view Booking Details";
        $data['bookingid']=$this->input->get('id');
        $data['booking']=$this->booking_model->viewdetailsofbooking($this->input->get('id'));
        $data["status"]=$this->bookingstatus_model->getbookingstatusdropdown();
        $this->load->view("template",$data);
    }
    public function changestatus()
    {
        $id=$this->input->get_post('id');
        $status=$this->input->get_post('status');
        $data['message']=$this->booking_model->changestatus($id,$status);
        $this->load->view("json",$data);
        
    }
    
    //for admin users
	public function createuseradmin()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data[ 'page' ] = 'createuseradmin';
		$data[ 'title' ] = 'Create Admins';
		$this->load->view( 'template', $data );	
	}
	function createuseradminsubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuseradmin';
            $data[ 'title' ] = 'Create Admins';
            $this->load->view( 'template', $data );		
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $wallet=$this->input->post('wallet');
            $contact=$this->input->post('contact');
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->createadmin($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$wallet,$contact)==0)
			$data['alerterror']="New Admin could not be created.";
			else
			$data['alertsuccess']="Admin created Successfully.";
			$data['redirect']="site/viewuseradmin";
			$this->load->view("redirect",$data);
		}
	}
    function viewuseradmin()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data['page']='viewuseradmin';
        $data['base_url'] = site_url("site/viewuseradminjson");
//        print_r($data);
		$data['title']='View User Admin';
		$this->load->view('template',$data);
	} 
    function viewuseradminjson()
	{
        $where="WHERE 1 AND `user`.`accesslevel`<=3 ";
        
//        $accesslevel=$this->session->userdata('accesslevel');
//        if($accesslevel==2)
//        {
//            $where.=" AND `user`.`accesslevel` >= 2";
//        }
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`contact`";
        $elements[8]->sort="1";
        $elements[8]->header="Contact";
        $elements[8]->alias="contact";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","$where");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituseradmin()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituseradmin';
		$data['title']='Edit User Admin';
		$this->load->view('template',$data);
	}
	function edituseradminsubmit()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('templatewith2',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
            $wallet=$this->input->get_post('wallet');
            $contact=$this->input->get_post('contact');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->editadmin($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$wallet,$contact)==0)
			$data['alerterror']="Admin Editing was unsuccesful";
			else
			$data['alertsuccess']="Admin edited Successfully.";
			
			$data['redirect']="site/viewuseradmin";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuseradmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Admin Deleted Successfully";
		$data['redirect']="site/viewuseradmin";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
    
    // NEW TABLES ADDED
    
    
     
    public function viewprofession()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofession";
$data["page2"]="block/userblock";
$data['before1']=$this->input->get('id');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data["base_url"]=site_url("site/viewprofessionjson");
$data["title"]="View profession";
$this->load->view("templatewith2",$data);
}
function viewprofessionjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_profession`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`user`.`name`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_category`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Category";
$elements[2]->alias="category";
    
$elements[3]=new stdClass();
$elements[3]->field="`expert_profession`.`user`";
$elements[3]->sort="1";
$elements[3]->header="userid";
$elements[3]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_profession` LEFT OUTER JOIN `user` ON `user`.`id`=`expert_profession`.`user` LEFT OUTER JOIN `expert_category` ON `expert_category`.`id`=`expert_profession`.`category`");
$this->load->view("json",$data);
}

public function createprofession()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofession";
$data["title"]="Create profession";
$data['category']=$this->user_model->getcategorydropdown();
$data['user']=$this->user_model->getuserdropdown();
$this->load->view("template",$data);
}
public function createprofessionsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("category","Category","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofession";
$data['category']=$this->user_model->getcategorydropdown();
$data['user']=$this->user_model->getuserdropdown();
$data["title"]="Create profession";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$category=$this->input->get_post("category");
$description=$this->input->get_post("description");
if($this->profession_model->create($user,$category,$description)==0)
$data["alerterror"]="New profession could not be created.";
else
$data["alertsuccess"]="profession created Successfully.";
$data["redirect"]="site/viewprofession?id=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofession()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofession";
$data["page2"]="block/professionblock";
$data["title"]="Edit profession";
$data['before']=$this->user_model->beforeedit($this->input->get('id'));
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data['category']=$this->user_model->getcategorydropdown();
$data['user']=$this->user_model->getuserdropdown();
$data["before"]=$this->profession_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("category","Category","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofession";
$data["title"]="Edit profession";
$data['category']=$this->user_model->getcategorydropdown();
    $data['user']=$this->user_model->getuserdropdown();
$data["before"]=$this->profession_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$category=$this->input->get_post("category");
$description=$this->input->get_post("description");
if($this->profession_model->edit($id,$user,$category,$description)==0)
$data["alerterror"]="New profession could not be Updated.";
else
$data["alertsuccess"]="profession Updated Successfully.";
$data["redirect"]="site/viewprofession?id=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofession()
{
$access=array("1");
$this->checkaccess($access);
$this->profession_model->delete($this->input->get("id"));
$id=$this->input->get("id");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofession?id=".$userid;
$this->load->view("redirect2",$data);
}
public function viewcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcategory";
$data["base_url"]=site_url("site/viewcategoryjson");
$data["title"]="View category";
$this->load->view("template",$data);
}
function viewcategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_category`.`name`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_category`");
$this->load->view("json",$data);
}

public function createcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcategory";
$data["title"]="Create category";
$this->load->view("template",$data);
}
public function createcategorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcategory";
$data["title"]="Create category";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
if($this->category_model->create($name)==0)
$data["alerterror"]="New category could not be created.";
else
$data["alertsuccess"]="category created Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function editcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcategory";
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcategory";
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
if($this->category_model->edit($id,$name)==0)
$data["alerterror"]="New category could not be Updated.";
else
$data["alertsuccess"]="category Updated Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function deletecategory()
{
$access=array("1");
$this->checkaccess($access);
$this->category_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
public function viewusercategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewusercategory";
$data["base_url"]=site_url("site/viewusercategoryjson");
$data["title"]="View usercategory";
$this->load->view("template",$data);
}
function viewusercategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_usercategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_usercategory`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_usercategory`.`category`";
$elements[2]->sort="1";
$elements[2]->header="Category";
$elements[2]->alias="category";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_usercategory`");
$this->load->view("json",$data);
}

public function createusercategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createusercategory";
$data["title"]="Create usercategory";
$this->load->view("template",$data);
}
public function createusercategorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("category","Category","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createusercategory";
$data["title"]="Create usercategory";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$category=$this->input->get_post("category");
if($this->usercategory_model->create($user,$category)==0)
$data["alerterror"]="New usercategory could not be created.";
else
$data["alertsuccess"]="usercategory created Successfully.";
$data["redirect"]="site/viewusercategory";
$this->load->view("redirect",$data);
}
}
public function editusercategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editusercategory";
$data["title"]="Edit usercategory";
$data["before"]=$this->usercategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editusercategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("category","Category","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editusercategory";
$data["title"]="Edit usercategory";
$data["before"]=$this->usercategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$category=$this->input->get_post("category");
if($this->usercategory_model->edit($id,$user,$category)==0)
$data["alerterror"]="New usercategory could not be Updated.";
else
$data["alertsuccess"]="usercategory Updated Successfully.";
$data["redirect"]="site/viewusercategory";
$this->load->view("redirect",$data);
}
}
public function deleteusercategory()
{
$access=array("1");
$this->checkaccess($access);
$this->usercategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewusercategory";
$this->load->view("redirect",$data);
}
public function viewprofessionexperience()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessionexperience";
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewprofessionexperiencejson");
$data["title"]="View professionexperience";
$this->load->view("templatewith2",$data);
}
function viewprofessionexperiencejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professionexperience`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professionexperience`.`profession`";
$elements[1]->sort="1";
$elements[1]->header="Profession";
$elements[1]->alias="profession";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professionexperience`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";
$elements[3]=new stdClass();
$elements[3]->field="`expert_professionexperience`.`companyname`";
$elements[3]->sort="1";
$elements[3]->header="companyname";
$elements[3]->alias="companyname";
$elements[4]=new stdClass();
$elements[4]->field="`expert_professionexperience`.`jobtitle`";
$elements[4]->sort="1";
$elements[4]->header="jobtitle";
$elements[4]->alias="jobtitle";
$elements[5]=new stdClass();
$elements[5]->field="`expert_professionexperience`.`companylogo`";
$elements[5]->sort="1";
$elements[5]->header="Company Logo";
$elements[5]->alias="companylogo";
$elements[6]=new stdClass();
$elements[6]->field="`expert_professionexperience`.`jobdescription`";
$elements[6]->sort="1";
$elements[6]->header="jobdescription";
$elements[6]->alias="jobdescription";
$elements[7]=new stdClass();
$elements[7]->field="`expert_professionexperience`.`startdate`";
$elements[7]->sort="1";
$elements[7]->header="Start date";
$elements[7]->alias="startdate";
$elements[8]=new stdClass();
$elements[8]->field="`expert_professionexperience`.`enddate`";
$elements[8]->sort="1";
$elements[8]->header="End Date";
$elements[8]->alias="enddate";
    
$elements[9]=new stdClass();
$elements[9]->field="`expert_professionexperience`.`profession`";
$elements[9]->sort="1";
$elements[9]->header="professionid";
$elements[9]->alias="professionid";
    
$elements[10]=new stdClass();
$elements[10]->field="`expert_professionexperience`.`user`";
$elements[10]->sort="1";
$elements[10]->header="userid";
$elements[10]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professionexperience`");
$this->load->view("json",$data);
}

public function createprofessionexperience()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessionexperience";
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["title"]="Create professionexperience";
$this->load->view("templatewith2",$data);
}
public function createprofessionexperiencesubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("companyname","companyname","trim");
$this->form_validation->set_rules("jobtitle","jobtitle","trim");
$this->form_validation->set_rules("companylogo","Company Logo","trim");
$this->form_validation->set_rules("jobdescription","jobdescription","trim");
$this->form_validation->set_rules("startdate","Start date","trim");
$this->form_validation->set_rules("enddate","End Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofessionexperience";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Create professionexperience";
$this->load->view("template",$data);
}
else
{
$profession=$this->input->get_post("profession");
$user=$this->input->get_post("user");
$companyname=$this->input->get_post("companyname");
$jobtitle=$this->input->get_post("jobtitle");
//$companylogo=$this->input->get_post("companylogo");
$jobdescription=$this->input->get_post("jobdescription");
$startdate=$this->input->get_post("startdate");
$enddate=$this->input->get_post("enddate");
    $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$companylogo="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$companylogo=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $companylogo=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->professionexperience_model->create($profession,$user,$companyname,$jobtitle,$companylogo,$jobdescription,$startdate,$enddate)==0)
$data["alerterror"]="New professionexperience could not be created.";
else
$data["alertsuccess"]="professionexperience created Successfully.";
$data["redirect"]="site/viewprofessionexperience?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessionexperience()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessionexperience";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Edit professionexperience";
$data["before"]=$this->professionexperience_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionexperiencesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("companyname","companyname","trim");
$this->form_validation->set_rules("jobtitle","jobtitle","trim");
$this->form_validation->set_rules("companylogo","Company Logo","trim");
$this->form_validation->set_rules("jobdescription","jobdescription","trim");
$this->form_validation->set_rules("startdate","Start date","trim");
$this->form_validation->set_rules("enddate","End Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessionexperience";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionexperience";
$data["before"]=$this->professionexperience_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$profession=$this->input->get_post("profession");
$user=$this->input->get_post("user");
$companyname=$this->input->get_post("companyname");
$jobtitle=$this->input->get_post("jobtitle");
//$companylogo=$this->input->get_post("companylogo");
$jobdescription=$this->input->get_post("jobdescription");
$startdate=$this->input->get_post("startdate");
$enddate=$this->input->get_post("enddate");
    $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$companylogo="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$companylogo=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $companylogo=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($companylogo=="")
            {
            $companylogo=$this->professionexperience_model->getimagebyid($id);
               // print_r($companylogo);
                $companylogo=$companylogo->companylogo;
            }
if($this->professionexperience_model->edit($id,$profession,$user,$companyname,$jobtitle,$companylogo,$jobdescription,$startdate,$enddate)==0)
$data["alerterror"]="New professionexperience could not be Updated.";
else
$data["alertsuccess"]="professionexperience Updated Successfully.";
$data["redirect"]="site/viewprofessionexperience?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofessionexperience()
{
$access=array("1");
$this->checkaccess($access);
$this->professionexperience_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessionexperience?id=".$professionid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewprofessionaward()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessionaward";
$data["base_url"]=site_url("site/viewprofessionawardjson");
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="View professionaward";
$this->load->view("templatewith2",$data);
}
function viewprofessionawardjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professionaward`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professionaward`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professionaward`.`profession`";
$elements[2]->sort="1";
$elements[2]->header="Profession";
$elements[2]->alias="profession";
    
$elements[3]=new stdClass();
$elements[3]->field="`expert_professionaward`.`award`";
$elements[3]->sort="1";
$elements[3]->header="award";
$elements[3]->alias="award";

    
$elements[4]=new stdClass();
$elements[4]->field="`expert_professionaward`.`user`";
$elements[4]->sort="1";
$elements[4]->header="userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_professionaward`.`profession`";
$elements[5]->sort="1";
$elements[5]->header="Professionid";
$elements[5]->alias="professionid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professionaward`");
$this->load->view("json",$data);
}

public function createprofessionaward()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessionaward";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Create professionaward";
$this->load->view("templatewith2",$data);
}
public function createprofessionawardsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("website","Website","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
$this->form_validation->set_rules("photo","photo","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofessionaward";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Create professionaward";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$award=$this->input->get_post("award");

if($this->professionaward_model->create($user,$profession,$award)==0)
$data["alerterror"]="New professionaward could not be created.";
else
$data["alertsuccess"]="professionaward created Successfully.";
$data["redirect"]="site/viewprofessionaward?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessionaward()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessionaward";
$data["title"]="Edit professionaward";
$data["user"]=$this->user_model->getuserdropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data['profession']=$this->user_model->getprofessiondropdown();
$data["before"]=$this->professionaward_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionawardsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("website","Website","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
$this->form_validation->set_rules("photo","photo","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessionaward";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionaward";
$data["before"]=$this->professionaward_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$award=$this->input->get_post("award");

if($this->professionaward_model->edit($id,$user,$profession,$award)==0)
$data["alerterror"]="New professionaward could not be Updated.";
else
$data["alertsuccess"]="professionaward Updated Successfully.";
$data["redirect"]="site/viewprofessionaward?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofessionaward()
{
$access=array("1");
$this->checkaccess($access);
$this->professionaward_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessionaward?id=".$professionid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewhobby()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobby";
$data["page2"]="block/userblock";
$data['before1']=$this->input->get('id');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data["base_url"]=site_url("site/viewhobbyjson");
$data["title"]="View hobby";
$this->load->view("templatewith2",$data);
}
function viewhobbyjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobby`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobby`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobby`.`category`";
$elements[2]->sort="1";
$elements[2]->header="Category";
$elements[2]->alias="category";
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobby`.`expinyrs`";
$elements[3]->sort="1";
$elements[3]->header="Experience In Years";
$elements[3]->alias="expinyrs";
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobby`.`description`";
$elements[4]->sort="1";
$elements[4]->header="Description";
$elements[4]->alias="description";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobby`.`skills`";
$elements[5]->sort="1";
$elements[5]->header="Skills";
$elements[5]->alias="skills";
    
$elements[6]=new stdClass();
$elements[6]->field="`expert_hobby`.`user`";
$elements[6]->sort="1";
$elements[6]->header="Userid";
$elements[6]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobby`");
$this->load->view("json",$data);
}

public function createhobby()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobby";
$data["page2"]="block/userblock";
$data['before1']=$this->input->get('id');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['category']=$this->user_model->getcategorydropdown();
$data['user']=$this->user_model->getuserdropdown();
$data["title"]="Create hobby";
$this->load->view("templatewith2",$data);
}
public function createhobbysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("expinyrs","Experience In Years","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("skills","Skills","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhobby";
$data['user']=$this->user_model->getuserdropdown();
$data['category']=$this->user_model->getcategorydropdown();
$data["title"]="Create hobby";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$category=$this->input->get_post("category");
$expinyrs=$this->input->get_post("expinyrs");
$description=$this->input->get_post("description");
$skills=$this->input->get_post("skills");
if($this->hobby_model->create($user,$category,$expinyrs,$description,$skills)==0)
$data["alerterror"]="New hobby could not be created.";
else
$data["alertsuccess"]="hobby created Successfully.";
$data["redirect"]="site/viewhobby?id=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobby()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobby";
$data["title"]="Edit hobby";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['category']=$this->user_model->getcategorydropdown();
$data['user']=$this->user_model->getuserdropdown();
$data["before"]=$this->hobby_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("expinyrs","Experience In Years","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("skills","Skills","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithobby";
$data['category']=$this->user_model->getcategorydropdown();
$data['user']=$this->user_model->getuserdropdown();
$data["title"]="Edit hobby";
$data["before"]=$this->hobby_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$category=$this->input->get_post("category");
$expinyrs=$this->input->get_post("expinyrs");
$description=$this->input->get_post("description");
$skills=$this->input->get_post("skills");
if($this->hobby_model->edit($id,$user,$category,$expinyrs,$description,$skills)==0)
$data["alerterror"]="New hobby could not be Updated.";
else
$data["alertsuccess"]="hobby Updated Successfully.";
$data["redirect"]="site/viewhobby?id=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobby()
{
$access=array("1");
$this->checkaccess($access);
$this->hobby_model->delete($this->input->get("id"));
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobby?id=".$userid;
$this->load->view("redirect2",$data);
}
public function viewhobbyawards()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobbyawards";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewhobbyawardsjson");
$data["title"]="View hobbyawards";
$this->load->view("templatewith2",$data);
}
function viewhobbyawardsjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobbyawards`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobbyawards`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobbyawards`.`hobby`";
$elements[2]->sort="1";
$elements[2]->header="Hobby";
$elements[2]->alias="hobby";
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobbyawards`.`awards`";
$elements[3]->sort="1";
$elements[3]->header="Awards";
$elements[3]->alias="awards";
    
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobbyawards`.`user`";
$elements[4]->sort="1";
$elements[4]->header="Userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobbyawards`.`hobby`";
$elements[5]->sort="1";
$elements[5]->header="Hobbyid";
$elements[5]->alias="hobbyid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobbyawards`");
$this->load->view("json",$data);
}

public function createhobbyawards()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobbyawards";
$data["page2"]="block/hobbyblock";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["title"]="Create hobbyawards";
$this->load->view("templatewith2",$data);
}
public function createhobbyawardssubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("awards","Awards","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["page"]="createhobbyawards";
$data["title"]="Create hobbyawards";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$awards=$this->input->get_post("awards");
if($this->hobbyawards_model->create($user,$hobby,$awards)==0)
$data["alerterror"]="New hobbyawards could not be created.";
else
$data["alertsuccess"]="hobbyawards created Successfully.";
$data["redirect"]="site/viewhobbyawards?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobbyawards()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobbyawards";
$data["title"]="Edit hobbyawards";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["before"]=$this->hobbyawards_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbyawardssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("awards","Awards","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithobbyawards";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Edit hobbyawards";
$data["before"]=$this->hobbyawards_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$awards=$this->input->get_post("awards");
if($this->hobbyawards_model->edit($id,$user,$hobby,$awards)==0)
$data["alerterror"]="New hobbyawards could not be Updated.";
else
$data["alertsuccess"]="hobbyawards Updated Successfully.";
$data["redirect"]="site/viewhobbyawards?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobbyawards()
{
$access=array("1");
$this->checkaccess($access);
$this->hobbyawards_model->delete($this->input->get("id"));
$hobbyid=$this->input->get("hobbyid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobbyawards?id=".$hobbyid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewhobbyeducation()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobbyeducation";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewhobbyeducationjson");
$data["title"]="View hobbyeducation";
$this->load->view("templatewith2",$data);
}
function viewhobbyeducationjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobbyeducation`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobbyeducation`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobbyeducation`.`hobby`";
$elements[2]->sort="1";
$elements[2]->header="Hobby";
$elements[2]->alias="hobby";
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobbyeducation`.`degree`";
$elements[3]->sort="1";
$elements[3]->header="Degree";
$elements[3]->alias="degree";
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobbyeducation`.`institute`";
$elements[4]->sort="1";
$elements[4]->header="Institute";
$elements[4]->alias="institute";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobbyeducation`.`yearofpassing`";
$elements[5]->sort="1";
$elements[5]->header="Year of Passing";
$elements[5]->alias="yearofpassing";
$elements[6]=new stdClass();
$elements[6]->field="`expert_hobbyeducation`.`user`";
$elements[6]->sort="1";
$elements[6]->header="Userid";
$elements[6]->alias="userid";
$elements[7]=new stdClass();
$elements[7]->field="`expert_hobbyeducation`.`hobby`";
$elements[7]->sort="1";
$elements[7]->header="Hobbyid";
$elements[7]->alias="hobbyid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobbyeducation`");
$this->load->view("json",$data);
}

public function createhobbyeducation()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobbyeducation";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Create hobbyeducation";
$this->load->view("templatewith2",$data);
}
public function createhobbyeducationsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("degree","Degree","trim");
$this->form_validation->set_rules("institute","Institute","trim");
$this->form_validation->set_rules("yearofpassing","Year of Passing","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhobbyeducation";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Create hobbyeducation";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$degree=$this->input->get_post("degree");
$institute=$this->input->get_post("institute");
$yearofpassing=$this->input->get_post("yearofpassing");
if($this->hobbyeducation_model->create($user,$hobby,$degree,$institute,$yearofpassing)==0)
$data["alerterror"]="New hobbyeducation could not be created.";
else
$data["alertsuccess"]="hobbyeducation created Successfully.";
$data["redirect"]="site/viewhobbyeducation?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobbyeducation()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobbyeducation";
$data["title"]="Edit hobbyeducation";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["before"]=$this->hobbyeducation_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbyeducationsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("degree","Degree","trim");
$this->form_validation->set_rules("institute","Institute","trim");
$this->form_validation->set_rules("yearofpassing","Year of Passing","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithobbyeducation";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Edit hobbyeducation";
$data["before"]=$this->hobbyeducation_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$degree=$this->input->get_post("degree");
$institute=$this->input->get_post("institute");
$yearofpassing=$this->input->get_post("yearofpassing");
if($this->hobbyeducation_model->edit($id,$user,$hobby,$degree,$institute,$yearofpassing)==0)
$data["alerterror"]="New hobbyeducation could not be Updated.";
else
$data["alertsuccess"]="hobbyeducation Updated Successfully.";
$data["redirect"]="site/viewhobbyeducation?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobbyeducation()
{
$access=array("1");
$this->checkaccess($access);
$this->hobbyeducation_model->delete($this->input->get("id"));
$hobbyid=$this->input->get("hobbyid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobbyeducation?id=".$hobbyid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewhobbywebsite()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobbywebsite";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewhobbywebsitejson");
$data["title"]="View hobbywebsite";
$this->load->view("templatewith2",$data);
}
function viewhobbywebsitejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobbywebsite`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobbywebsite`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobbywebsite`.`hobby`";
$elements[2]->sort="1";
$elements[2]->header="Hobby";
$elements[2]->alias="hobby";
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobbywebsite`.`website`";
$elements[3]->sort="1";
$elements[3]->header="Website";
$elements[3]->alias="website";
    
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobbywebsite`.`user`";
$elements[4]->sort="1";
$elements[4]->header="Userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobbywebsite`.`hobby`";
$elements[5]->sort="1";
$elements[5]->header="Hobbyid";
$elements[5]->alias="hobbyid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobbywebsite`");
$this->load->view("json",$data);
}

public function createhobbywebsite()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobbywebsite";
$data["title"]="Create hobbywebsite";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$this->load->view("templatewith2",$data);
}
public function createhobbywebsitesubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("website","Website","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhobbywebsite";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Create hobbywebsite";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$website=$this->input->get_post("website");
if($this->hobbywebsite_model->create($user,$hobby,$website)==0)
$data["alerterror"]="New hobbywebsite could not be created.";
else
$data["alertsuccess"]="hobbywebsite created Successfully.";
$data["redirect"]="site/viewhobbywebsite?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobbywebsite()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobbywebsite";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["title"]="Edit hobbywebsite";
$data["before"]=$this->hobbywebsite_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbywebsitesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("website","Website","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithobbywebsite";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Edit hobbywebsite";
$data["before"]=$this->hobbywebsite_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$website=$this->input->get_post("website");
if($this->hobbywebsite_model->edit($id,$user,$hobby,$website)==0)
$data["alerterror"]="New hobbywebsite could not be Updated.";
else
$data["alertsuccess"]="hobbywebsite Updated Successfully.";
$data["redirect"]="site/viewhobbywebsite?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobbywebsite()
{
$access=array("1");
$this->checkaccess($access);
$this->hobbywebsite_model->delete($this->input->get("id"));
$hobbyid=$this->input->get("hobbyid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobbywebsite?id=".$hobbyid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewhobbyvideolinks()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobbyvideolinks";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewhobbyvideolinksjson");
$data["title"]="View hobbyvideolinks";
$this->load->view("templatewith2",$data);
}
function viewhobbyvideolinksjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobbyvideolinks`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobbyvideolinks`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobbyvideolinks`.`hobby`";
$elements[2]->sort="1";
$elements[2]->header="Hobby";
$elements[2]->alias="hobby";
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobbyvideolinks`.`videolink`";
$elements[3]->sort="1";
$elements[3]->header="Video Link";
$elements[3]->alias="videolink";
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobbyvideolinks`.`user`";
$elements[4]->sort="1";
$elements[4]->header="Userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobbyvideolinks`.`hobby`";
$elements[5]->sort="1";
$elements[5]->header="Hobbyid";
$elements[5]->alias="hobbyid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobbyvideolinks`");
$this->load->view("json",$data);
}

public function createhobbyvideolinks()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobbyvideolinks";
$data["title"]="Create hobbyvideolinks";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$this->load->view("templatewith2",$data);
}
public function createhobbyvideolinkssubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhobbyvideolinks";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Create hobbyvideolinks";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$videolink=$this->input->get_post("videolink");
if($this->hobbyvideolinks_model->create($user,$hobby,$videolink)==0)
$data["alerterror"]="New hobbyvideolinks could not be created.";
else
$data["alertsuccess"]="hobbyvideolinks created Successfully.";
$data["redirect"]="site/viewhobbyvideolinks?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobbyvideolinks()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobbyvideolinks";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["title"]="Edit hobbyvideolinks";
$data["before"]=$this->hobbyvideolinks_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbyvideolinkssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithobbyvideolinks";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Edit hobbyvideolinks";
$data["before"]=$this->hobbyvideolinks_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$videolink=$this->input->get_post("videolink");
if($this->hobbyvideolinks_model->edit($id,$user,$hobby,$videolink)==0)
$data["alerterror"]="New hobbyvideolinks could not be Updated.";
else
$data["alertsuccess"]="hobbyvideolinks Updated Successfully.";
$data["redirect"]="site/viewhobbyvideolinks?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobbyvideolinks()
{
$access=array("1");
$this->checkaccess($access);
$this->hobbyvideolinks_model->delete($this->input->get("id"));
$hobbyid=$this->input->get("hobbyid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobbyvideolinks?id=".$hobbyid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewhobbyphotos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobbyphotos";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewhobbyphotosjson");
$data["title"]="View hobbyphotos";
$this->load->view("templatewith2",$data);
}
function viewhobbyphotosjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobbyphotos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobbyphotos`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobbyphotos`.`hobby`";
$elements[2]->sort="1";
$elements[2]->header="Hobby";
$elements[2]->alias="hobby";
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobbyphotos`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
    
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobbyphotos`.`user`";
$elements[4]->sort="1";
$elements[4]->header="Userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobbyphotos`.`hobby`";
$elements[5]->sort="1";
$elements[5]->header="Hobbyid";
$elements[5]->alias="hobbyid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobbyphotos`");
$this->load->view("json",$data);
}

public function createhobbyphotos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobbyphotos";
$data["title"]="Create hobbyphotos";
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$this->load->view("templatewith2",$data);
}
public function createhobbyphotossubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhobbyphotos";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["title"]="Create hobbyphotos";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
//$image=$this->input->get_post("image");
    $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->hobbyphotos_model->create($user,$hobby,$image)==0)
$data["alerterror"]="New hobbyphotos could not be created.";
else
$data["alertsuccess"]="hobbyphotos created Successfully.";
$data["redirect"]="site/viewhobbyphotos?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobbyphotos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobbyphotos";
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data["title"]="Edit hobbyphotos";
$data["before"]=$this->hobbyphotos_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbyphotossubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","Hobby","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["user"]=$this->user_model->getuserdropdown();
$data["hobby"]=$this->user_model->gethobbydropdown();
$data["page"]="edithobbyphotos";
$data["title"]="Edit hobbyphotos";
$data["before"]=$this->hobbyphotos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
//$image=$this->input->get_post("image");
$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->hobbyphotos_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
if($this->hobbyphotos_model->edit($id,$user,$hobby,$image)==0)
$data["alerterror"]="New hobbyphotos could not be Updated.";
else
$data["alertsuccess"]="hobbyphotos Updated Successfully.";
$data["redirect"]="site/viewhobbyphotos?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobbyphotos()
{
$access=array("1");
$this->checkaccess($access);
$this->hobbyphotos_model->delete($this->input->get("id"));
$hobbyid=$this->input->get("hobbyid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobbyphotos?id=".$hobbyid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
    //new tables for profession
    
    public function viewprofessionwebsite()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessionwebsite";
$data["base_url"]=site_url("site/viewprofessionwebsitejson");
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="View professionwebsite";
$this->load->view("templatewith2",$data);
}
function viewprofessionwebsitejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professionwebsite`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professionwebsite`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professionwebsite`.`profession`";
$elements[2]->sort="1";
$elements[2]->header="Profession";
$elements[2]->alias="profession";
$elements[3]=new stdClass();
$elements[3]->field="`expert_professionwebsite`.`website`";
$elements[3]->sort="1";
$elements[3]->header="Website";
$elements[3]->alias="website";
    
$elements[4]=new stdClass();
$elements[4]->field="`expert_professionwebsite`.`profession`";
$elements[4]->sort="1";
$elements[4]->header="professionid";
$elements[4]->alias="professionid";
    
$elements[5]=new stdClass();
$elements[5]->field="`expert_professionwebsite`.`user`";
$elements[5]->sort="1";
$elements[5]->header="userid";
$elements[5]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professionwebsite`");
$this->load->view("json",$data);
}

public function createprofessionwebsite()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessionwebsite";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Create professionwebsite";
$this->load->view("templatewith2",$data);
}
public function createprofessionwebsitesubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("website","Website","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page"]="createprofessionwebsite";
$data["title"]="Create professionwebsite";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$website=$this->input->get_post("website");
if($this->professionwebsite_model->create($user,$profession,$website)==0)
$data["alerterror"]="New professionwebsite could not be created.";
else
$data["alertsuccess"]="professionwebsite created Successfully.";
$data["redirect"]="site/viewprofessionwebsite?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessionwebsite()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessionwebsite";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionwebsite";
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["before"]=$this->professionwebsite_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionwebsitesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("website","Website","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessionwebsite";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionwebsite";
$data["before"]=$this->professionwebsite_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$website=$this->input->get_post("website");
if($this->professionwebsite_model->edit($id,$user,$profession,$website)==0)
$data["alerterror"]="New professionwebsite could not be Updated.";
else
$data["alertsuccess"]="professionwebsite Updated Successfully.";
$data["redirect"]="site/viewprofessionwebsite?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofessionwebsite()
{
$access=array("1");
$this->checkaccess($access);
$this->professionwebsite_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessionwebsite?id=".$professionid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewprofessioneducation()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessioneducation";
$data["base_url"]=site_url("site/viewprofessioneducationjson");
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="View professioneducation";
$this->load->view("templatewith2",$data);
}
function viewprofessioneducationjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professioneducation`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professioneducation`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professioneducation`.`profession`";
$elements[2]->sort="1";
$elements[2]->header="Profession";
$elements[2]->alias="profession";
$elements[3]=new stdClass();
$elements[3]->field="`expert_professioneducation`.`degree`";
$elements[3]->sort="1";
$elements[3]->header="Degree";
$elements[3]->alias="degree";
$elements[4]=new stdClass();
$elements[4]->field="`expert_professioneducation`.`institute`";
$elements[4]->sort="1";
$elements[4]->header="Institute";
$elements[4]->alias="institute";
$elements[5]=new stdClass();
$elements[5]->field="`expert_professioneducation`.`yearofpassing`";
$elements[5]->sort="1";
$elements[5]->header="Year of Passing";
$elements[5]->alias="yearofpassing";

$elements[6]=new stdClass();
$elements[6]->field="`expert_professioneducation`.`profession`";
$elements[6]->sort="1";
$elements[6]->header="professionid";
$elements[6]->alias="professionid";
    
$elements[7]=new stdClass();
$elements[7]->field="`expert_professioneducation`.`user`";
$elements[7]->sort="1";
$elements[7]->header="userid";
$elements[7]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professioneducation`");
$this->load->view("json",$data);
}

public function createprofessioneducation()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessioneducation";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Create professioneducation";
$this->load->view("templatewith2",$data);
}
public function createprofessioneducationsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("degree","Degree","trim");
$this->form_validation->set_rules("institute","Institute","trim");
$this->form_validation->set_rules("yearofpassing","Year of Passing","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofessioneducation";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Create professioneducation";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$degree=$this->input->get_post("degree");
$institute=$this->input->get_post("institute");
$yearofpassing=$this->input->get_post("yearofpassing");
if($this->professioneducation_model->create($user,$profession,$degree,$institute,$yearofpassing)==0)
$data["alerterror"]="New professioneducation could not be created.";
else
$data["alertsuccess"]="professioneducation created Successfully.";
$data["redirect"]="site/viewprofessioneducation?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessioneducation()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessioneducation";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professioneducation";
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["before"]=$this->professioneducation_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessioneducationsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("degree","Degree","trim");
$this->form_validation->set_rules("institute","Institute","trim");
$this->form_validation->set_rules("yearofpassing","Year of Passing","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessioneducation";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professioneducation";
$data["before"]=$this->professioneducation_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$degree=$this->input->get_post("degree");
$institute=$this->input->get_post("institute");
$yearofpassing=$this->input->get_post("yearofpassing");
if($this->professioneducation_model->edit($id,$user,$profession,$degree,$institute,$yearofpassing)==0)
$data["alerterror"]="New professioneducation could not be Updated.";
else
$data["alertsuccess"]="professioneducation Updated Successfully.";
$data["redirect"]="site/viewprofessioneducation";
$this->load->view("redirect",$data);
}
}
public function deleteprofessioneducation()
{
$access=array("1");
$this->checkaccess($access);
$this->professioneducation_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessioneducation?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
public function viewprofessionvideolink()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessionvideolink";
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["base_url"]=site_url("site/viewprofessionvideolinkjson");
$data["title"]="View professionvideolink";
$this->load->view("templatewith2",$data);
}
function viewprofessionvideolinkjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professionvideolink`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professionvideolink`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professionvideolink`.`profession`";
$elements[2]->sort="1";
$elements[2]->header="Profession";
$elements[2]->alias="profession";
$elements[3]=new stdClass();
$elements[3]->field="`expert_professionvideolink`.`videolink`";
$elements[3]->sort="1";
$elements[3]->header="Video Link";
$elements[3]->alias="videolink";
    
$elements[4]=new stdClass();
$elements[4]->field="`expert_professionvideolink`.`profession`";
$elements[4]->sort="1";
$elements[4]->header="professionid";
$elements[4]->alias="professionid";
    
$elements[5]=new stdClass();
$elements[5]->field="`expert_professionvideolink`.`user`";
$elements[5]->sort="1";
$elements[5]->header="userid";
$elements[5]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professionvideolink`");
$this->load->view("json",$data);
}

public function createprofessionvideolink()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessionvideolink";
$data["title"]="Create professionvideolink";
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$this->load->view("templatewith2",$data);
}
public function createprofessionvideolinksubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofessionvideolink";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Create professionvideolink";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$videolink=$this->input->get_post("videolink");
if($this->professionvideolink_model->create($user,$profession,$videolink)==0)
$data["alerterror"]="New professionvideolink could not be created.";
else
$data["alertsuccess"]="professionvideolink created Successfully.";
$data["redirect"]="site/viewprofessionvideolink?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessionvideolink()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessionvideolink";
$data["title"]="Edit professionvideolink";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["before"]=$this->professionvideolink_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionvideolinksubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessionvideolink";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionvideolink";
$data["before"]=$this->professionvideolink_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$videolink=$this->input->get_post("videolink");
if($this->professionvideolink_model->edit($id,$user,$profession,$videolink)==0)
$data["alerterror"]="New professionvideolink could not be Updated.";
else
$data["alertsuccess"]="professionvideolink Updated Successfully.";
$data["redirect"]="site/viewprofessionvideolink?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofessionvideolink()
{
$access=array("1");
$this->checkaccess($access);
$this->professionvideolink_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessionvideolink?id=".$professionid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
public function viewprofessionphoto()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessionphoto";
$data["base_url"]=site_url("site/viewprofessionphotojson");
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="View professionphoto";
$this->load->view("templatewith2",$data);
}
function viewprofessionphotojson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professionphoto`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professionphoto`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professionphoto`.`profession`";
$elements[2]->sort="1";
$elements[2]->header="Profession";
$elements[2]->alias="profession";
$elements[3]=new stdClass();
$elements[3]->field="`expert_professionphoto`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";

$elements[4]=new stdClass();
$elements[4]->field="`expert_professionphoto`.`profession`";
$elements[4]->sort="1";
$elements[4]->header="professionid";
$elements[4]->alias="professionid";
    
$elements[5]=new stdClass();
$elements[5]->field="`expert_professionphoto`.`user`";
$elements[5]->sort="1";
$elements[5]->header="userid";
$elements[5]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professionphoto`");
$this->load->view("json",$data);
}

public function createprofessionphoto()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessionphoto";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Create professionphoto";
$this->load->view("templatewith2",$data);
}
public function createprofessionphotosubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofessionphoto";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Create professionphoto";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
//$image=$this->input->get_post("image");
$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->professionphoto_model->create($user,$profession,$image)==0)
$data["alerterror"]="New professionphoto could not be created.";
else
$data["alertsuccess"]="professionphoto created Successfully.";
$data["redirect"]="site/viewprofessionphoto?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessionphoto()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessionphoto";
$data["title"]="Edit professionphoto";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["before"]=$this->professionphoto_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionphotosubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessionphoto";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionphoto";
$data["before"]=$this->professionphoto_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
//$image=$this->input->get_post("image");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->professionphoto_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
if($this->professionphoto_model->edit($id,$user,$profession,$image)==0)
$data["alerterror"]="New professionphoto could not be Updated.";
else
$data["alertsuccess"]="professionphoto Updated Successfully.";
$data["redirect"]="site/viewprofessionphoto?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofessionphoto()
{
$access=array("1");
$this->checkaccess($access);
$this->professionphoto_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessionphoto?id=".$professionid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
    
    // PROFESSION SKILLS
    
    
    public function viewprofessionskill()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewprofessionskill";
$data["base_url"]=site_url("site/viewprofessionskilljson");
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="View professionskill";
$this->load->view("templatewith2",$data);
}
function viewprofessionskilljson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_professionskill`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_professionskill`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_professionskill`.`profession`";
$elements[2]->sort="1";
$elements[2]->header="Profession";
$elements[2]->alias="profession";
    
$elements[3]=new stdClass();
$elements[3]->field="`expert_professionskill`.`skills`";
$elements[3]->sort="1";
$elements[3]->header="skills";
$elements[3]->alias="skills";

    
$elements[4]=new stdClass();
$elements[4]->field="`expert_professionskill`.`user`";
$elements[4]->sort="1";
$elements[4]->header="userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_professionskill`.`profession`";
$elements[5]->sort="1";
$elements[5]->header="Professionid";
$elements[5]->alias="professionid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_professionskill`");
$this->load->view("json",$data);
}

public function createprofessionskill()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createprofessionskill";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Create professionskill";
$this->load->view("templatewith2",$data);
}
public function createprofessionskillsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("website","Website","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
$this->form_validation->set_rules("photo","photo","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createprofessionskill";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["user"]=$this->user_model->getuserdropdown();
$data["title"]="Create professionskill";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$skills=$this->input->get_post("skills");

if($this->professionskill_model->create($user,$profession,$skills)==0)
$data["alerterror"]="New professionskill could not be created.";
else
$data["alertsuccess"]="professionskill created Successfully.";
$data["redirect"]="site/viewprofessionskill?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function editprofessionskill()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editprofessionskill";
$data["title"]="Edit professionskill";
$data["user"]=$this->user_model->getuserdropdown();
$data["page2"]="block/professionblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data['profession']=$this->user_model->getprofessiondropdown();
$data["before"]=$this->professionskill_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editprofessionskillsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("profession","Profession","trim");
$this->form_validation->set_rules("website","Website","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
$this->form_validation->set_rules("photo","photo","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editprofessionskill";
$data["user"]=$this->user_model->getuserdropdown();
$data['profession']=$this->user_model->getprofessiondropdown();
$data["title"]="Edit professionskill";
$data["before"]=$this->professionskill_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$profession=$this->input->get_post("profession");
$skills=$this->input->get_post("skills");

if($this->professionskill_model->edit($id,$user,$profession,$skills)==0)
$data["alerterror"]="New professionskill could not be Updated.";
else
$data["alertsuccess"]="professionskill Updated Successfully.";
$data["redirect"]="site/viewprofessionskill?id=".$profession."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteprofessionskill()
{
$access=array("1");
$this->checkaccess($access);
$this->professionskill_model->delete($this->input->get("id"));
$professionid=$this->input->get("professionid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewprofessionskill?id=".$professionid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
    
    
    // HOBBY SKILLS
    
       public function viewhobbyskill()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewhobbyskill";
$data["base_url"]=site_url("site/viewhobbyskilljson");
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="View hobbyskill";
$this->load->view("templatewith2",$data);
}
function viewhobbyskilljson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`expert_hobbyskill`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`expert_hobbyskill`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`expert_hobbyskill`.`hobby`";
$elements[2]->sort="1";
$elements[2]->header="hobby";
$elements[2]->alias="hobby";
    
$elements[3]=new stdClass();
$elements[3]->field="`expert_hobbyskill`.`skills`";
$elements[3]->sort="1";
$elements[3]->header="skills";
$elements[3]->alias="skills";

    
$elements[4]=new stdClass();
$elements[4]->field="`expert_hobbyskill`.`user`";
$elements[4]->sort="1";
$elements[4]->header="userid";
$elements[4]->alias="userid";
$elements[5]=new stdClass();
$elements[5]->field="`expert_hobbyskill`.`hobby`";
$elements[5]->sort="1";
$elements[5]->header="hobbyid";
$elements[5]->alias="hobbyid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `expert_hobbyskill`");
$this->load->view("json",$data);
}

public function createhobbyskill()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createhobbyskill";
$data["user"]=$this->user_model->getuserdropdown();
$data['hobby']=$this->user_model->gethobbydropdown();
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data["title"]="Create hobbyskill";
$this->load->view("templatewith2",$data);
}
public function createhobbyskillsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","hobby","trim");
$this->form_validation->set_rules("website","Website","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
$this->form_validation->set_rules("photo","photo","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhobbyskill";
$data["user"]=$this->user_model->getuserdropdown();
$data['hobby']=$this->user_model->gethobbydropdown();
$data["user"]=$this->user_model->getuserdropdown();
$data["title"]="Create hobbyskill";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$skills=$this->input->get_post("skills");

if($this->hobbyskill_model->create($user,$hobby,$skills)==0)
$data["alerterror"]="New hobbyskill could not be created.";
else
$data["alertsuccess"]="hobbyskill created Successfully.";
$data["redirect"]="site/viewhobbyskill?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function edithobbyskill()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edithobbyskill";
$data["title"]="Edit hobbyskill";
$data["user"]=$this->user_model->getuserdropdown();
$data["page2"]="block/hobbyblock";
$data['before1']=$this->input->get('userid');
$data['before2']=$this->input->get('id');
$data['before3']=$this->input->get('id');
$data['before4']=$this->input->get('userid');
$data['before5']=$this->input->get('id');
$data['before6']=$this->input->get('userid');
$data['before7']=$this->input->get('id');
$data['before8']=$this->input->get('userid');
$data['before9']=$this->input->get('id');
$data['before10']=$this->input->get('userid');
$data['before11']=$this->input->get('id');
$data['before12']=$this->input->get('userid');
$data['before13']=$this->input->get('id');
$data['before14']=$this->input->get('userid');
$data['hobby']=$this->user_model->gethobbydropdown();
$data["before"]=$this->hobbyskill_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edithobbyskillsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("hobby","hobby","trim");
$this->form_validation->set_rules("website","Website","trim");
$this->form_validation->set_rules("videolink","Video Link","trim");
$this->form_validation->set_rules("photo","photo","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithobbyskill";
$data["user"]=$this->user_model->getuserdropdown();
$data['hobby']=$this->user_model->gethobbydropdown();
$data["title"]="Edit hobbyskill";
$data["before"]=$this->hobbyskill_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$hobby=$this->input->get_post("hobby");
$skills=$this->input->get_post("skills");

if($this->hobbyskill_model->edit($id,$user,$hobby,$skills)==0)
$data["alerterror"]="New hobbyskill could not be Updated.";
else
$data["alertsuccess"]="hobbyskill Updated Successfully.";
$data["redirect"]="site/viewhobbyskill?id=".$hobby."&userid=".$user;
$this->load->view("redirect2",$data);
}
}
public function deletehobbyskill()
{
$access=array("1");
$this->checkaccess($access);
$this->hobbyskill_model->delete($this->input->get("id"));
$hobbyid=$this->input->get("hobbyid");
$userid=$this->input->get("userid");
$data["redirect"]="site/viewhobbyskill?id=".$hobbyid."&userid=".$userid;
$this->load->view("redirect2",$data);
}
}
?>
