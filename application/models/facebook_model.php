<?php
class Facebook_model extends CI_model {
	
	public function __construct()
	{
		parent::__construct();

		/**
		* Facebook API Configuration
		*/
		$config = array(
			'appId' => '118757384981558',
			'secret' => 'b8661a50b28b325634ea1fceb6d31572',
			'fileUpload' => true,
			'cookie' => true
		);

		/* Load our Facebook library */
		$this->load->library('Facebook', $config);

		$user = $this->facebook->getUser();
		$profile = null; // We'll build off this for the user.

		if($user)
		{
			try {
				$profile = $this->facebook->api('/me?fields=id,name,link,email');
			} catch (FacebookApiException $e) {
				error_log($e);
				$user = null;
			}
		}

		$fb_data = array(
				'logged' => '1',
				'me' => $profile,
				'uid' => $user,
				'loginUrl' => $this->facebook->getLoginUrl(
					array(
						'scope' => 'email, publish_stream',
						'redirect_uri' => base_url() . 'auth/facebook',
						'code' => $_GET['code']
						)
					),
						'logoutUrl' => $this->facebook->getLogoutUrl(),
			);
		$this->session->set_userdata('fb_data', $fb_data);
	}
}