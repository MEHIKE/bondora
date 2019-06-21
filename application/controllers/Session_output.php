 <?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Session_output extends CI_Controller {

	public function index() {

		//load the session library
		$this->load->driver('session');

		//get the session
		//if there is no session
		if (!$this->session->userdata('user_input')) {
			//prompt users that there is no session
			$data["msg"] = "<b>No session!</b>";
		} else {
			//get the session[user_input]
			$userinput = $this->session->userdata('user_input');
			$data["msg"] = "User input say's: $userinput";
		}
		$this->load->view("session_output",$data);
	}

}