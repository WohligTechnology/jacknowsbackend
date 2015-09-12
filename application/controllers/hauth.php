<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends CI_Controller {

	public function index()
	{
		$this->load->view('hauth/home');
	}

	public function login($provider)
	{
		$logid=$this->input->get("logid");
		log_message('debug', "controllers.HAuth.login($provider) called");
		$logvalue="";
		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
//			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();

                    $sociallogin=$this->user_model->sociallogin($user_profile,$provider);
										$logvalue="SUCCESS";

                    //redirect($this->input->get_post("returnurl"));

					// $data['message'] = $sociallogin;

					// $this->load->view('json',$data);
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
					$logvalue="ERROR";
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
				$logvalue="ERROR";
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}
			$logvalue="ERROR";

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');



		}
		if($logid!="")
		{
				$this->db->query("UPDATE `login_log` SET `value` = '$logvalue' WHERE `login_log`.`id` = $logid;");
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}

	public function checkLogin()
	{
		$type=$this->input->get("type");
		$isConnected=$this->hybridauthlib->isConnectedWith($type);
		$data["message"]="";
		if($isConnected)
		{
			$data["message"]= array("value"=>true);
		}
		else {
			$this->db->query("INSERT INTO `login_log` (`id`, `type`, `value`, `timestamp`) VALUES (NULL, '$type', NULL, CURRENT_TIMESTAMP)");
			$id=$this->db->insert_id();
			$data["message"]= array("value"=>false,"id"=>$id);
		}
		$this->load->view("json",$data);
	}

	public function checkLogid() {
		$logid=$this->input->get("logid");
		$data["message"]=$this->db->query("SELECT * FROM `login_log` WHERE `id`='$logid'")->row();
		$this->load->view("json",$data);
	}


		public function posttweet()
    {

        $twitter = $this->hybridauthlib->authenticate("Twitter");
				$message=$this->input->get_post("message");
				if ($twitter->isUserConnected())
				{
						$message=$this->input->get_post("message");
						$post=$this->input->get('id');
						$project=$this->input->get('project');
						$twitterid = $twitter->getUserProfile();
						$twitterid = $twitterid->identifier;
						$message=urlencode($message);



						$data["message"]=$twitter->api()->post("statuses/update.json?status=$message");
						if(isset($data["message"]->id_str))
						{
						    // $this->userpost_model->addpostid($data["message"]->id_str,$post);
						    $orderid=$this->user_model->updatetweet($data["message"]->id_str,$project,$twitterid);
                            $hashvalue=base64_encode ($orderid."&powerforone");
									$redirecturlvalue=$this->input->get_post("returnurl")."/".$hashvalue;
									redirect($redirecturlvalue);
						 //   $this->load->view("json",$data);
						}
						else
						{
						    redirect($this->input->get_post("returnurl"));
						    $this->load->view("json",$data);
						}
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}



    }
    public function getFacebookImages()
    {
        $limit=50;
        try
        {
        $facebook = $this->hybridauthlib->authenticate("Facebook");
        $message=$this->input->get_post("message");
//$message=urlencode($message);
        $image=$this->input->get_post("image");
        $link=$this->input->get_post("link");
        $project=$this->input->get_post("project");
//        echo "out".$message;


				if ($facebook->isUserConnected())
				{

					$facebookid = $facebook->getUserProfile();
	                $facebookid = $facebookid->identifier;

                    $images=$facebook->api()->api("v2.4/me/photos/uploaded?fields=images&limit=$limit", "GET", array(
                            "message" => "$message",
                            "link"=>"$link"
                    ));

                    $images=$images["data"];
                    for($i=0;$i<sizeof($images);$i++)
                    {
                        $images[$i]=$images[$i]["images"][0]["source"];
                    }
                    $data["message"]=$images;
                    $this->load->view("json",$data);


				}
				else // Cannot authenticate user
				{
                    redirect("http://www.wohlig.com");
					show_error('Cannot authenticate user');
				}
        }
		catch(Exception $e)
		{
            redirect("http://www.powerforone.org/#/campaign/$project");
        }




    }


		public function getInstagramImages()
    {
        $limit=50;
        try
        {
        $instagram = $this->hybridauthlib->authenticate("Instagram");


				if ($instagram->isUserConnected())
				{


                    $images=$instagram->api()->api("users/self/media/recent/");
                    $images=$images->data;
                    for($i=0;$i<sizeof($images);$i++)
                    {
                        $images[$i]=$images[$i]->images->standard_resolution->url;
                    }
                    $data["message"]=$images;
                    $this->load->view("json",$data);


				}
				else // Cannot authenticate user
				{
                    redirect("http://www.wohlig.com");
					show_error('Cannot authenticate user');
				}
        }
		catch(Exception $e)
		{
            redirect("http://www.powerforone.org/#/campaign/$project");
        }




    }


    public function logout()
    {
        $this->hybridauthlib->logoutAllProviders();
    }

}
//http://www.powerforone.org/admin/index.php/hauth/postfb?message=I%20support%20%40NanhiKali%20%26%20education%20for%20girls.%20%40Themisconsult%20matched%20my%20contribution%20http%3A%2F%2Fbit.ly%2F1OCnrI8%20&project=15&returnurl=http%3A%2F%2Fwww.powerforone.org%2Fthankyou
//http://www.powerforone.org/admin/index.php/hauth/postfb?message=I%20support%20%40NanhiKali%20%26%20education%20for%20girls.%20%40Themisconsult%20matched%20my%20contribution%20http%3A%2F%2Fbit.ly%2F1OCnrI8%20&project=15&returnurl=http%3A%2F%2Fwww.powerforone.org%2Fthankyou
/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
