<?php
class Facebook_model extends CI_model {
	
	public function __construct()
	{
		parent::__construct();

		$config = array(
			'appId' => '',
			'secret' => '',
			'fileUpload' => true,
		);

		$this->load->library('Facebook', $config);

		$profile = null;
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
						'redirect_uri' => $this->uri->base_url()
						)
					),
						'logoutUrl' => $this->facebook->getLogoutUrl(),
			);
		$this->session->set_userdata('fb_data', $fb_data);
	}
}