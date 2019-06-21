<?php  //https://github.com/hedii/Codeigniter-login-logout-register
// https://github.com/DaBourz/SimpleLoginSecure
// https://dialect.ca/code/ci-simple-login-secure/
// http://blog.pisyek.com/5-best-authentication-libraries-for-codeigniter/
// http://getbootstrap.com/getting-started/#download
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation', 'email'));
		$this->load->database();
		$this->load->model('user_model');
		$this->load->helper('security');
		$this->session->unset_userdata('signpage');
		
	}
	
	function index()
	{
		//echo "index!!!!!";
		$this->register();
	}

    function register($id = NULL)
    {
    	if ($id!=NULL) {
    		redirect('user/verify/'.$id);
    	}
    	 
    	//echo "register!!!!!";
		//set validation rules
    	$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha|min_length[3]|max_length[20]|xss_clean');
    	$this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|md5|matches[password]');
		
		//validate form input
		if ($this->form_validation->run() == FALSE)
        {
        	if ($this->input->post('btn_login') == "Login") {
        		redirect('user/login');
        	}
			// fails
        	$this->session->set_userdata('signpage',1);
        	$data['title']='';
        	$this->load->view('templates/header', $data);
			$this->load->view('user_registration_view');
			$this->load->view('templates/footer');
				
        }
		else
		{
			//insert the user registration details into database
			$data = array(
				'username' => $this->input->post('username'),
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);
			
			// insert form data into database
			if ($this->user_model->insertUser($data))
			{
				// send email
				if ($this->user_model->sendEmail($this->input->post('email')))
				{
					// successfully sent mail
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Sa oled registreeritud! Palun kinnita oma konto vajutades kinnitusmeilis linki!!!</div>');
					redirect('user/login');
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Viga.  Palun proovi hiljem uuesti!!!</div>');
					redirect('user/register');
				}
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Viga.  Palun proovi hiljem uuesti!!!</div>');
				redirect('user/register');
			}
		}
	}
	
	function verify($hash=NULL)
	{
		
		if ($this->user_model->verifyEmailID($hash))
		{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Sinu Emaili aadress on kinnitatud! Palun logi oma kontoga sisse!</div>');
			redirect('user/login');
		}
		else
		{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! Tekkis viga Sinu emaili aadressi kinnitamisel!</div>');
			redirect('user/register');
		}
	}
	
	public function truncate() {
		$this->load->model('auctions_model');
		$this->load->model('bids_model');
		$this->load->model('investments_model');
		$this->load->model('secondary_model');
		$this->auctions_model->truncate();
		$this->bids_model->truncate();
		$this->investments_model->truncate();
		$this->secondary_model->truncate();
		redirect('secondary/download');
	}
	
	public function login()
	{
		//echo "login!!!!!";
		if ($this->session->has_userdata('login')) {
			$this->session->unset_userdata('login');
			$this->session->unset_userdata('username');
		}
		
		//get the posted values
		$username = $this->input->post("txt_username");
		$password = $this->input->post("txt_password");
	
		//set validations
		$this->form_validation->set_rules("txt_username", "Username", "trim|required");
		$this->form_validation->set_rules("txt_password", "Password", "trim|required");
	
		if ($this->form_validation->run() == FALSE)
		{
			//validation fails
			if ($this->input->post('btn_signup') == "Signup") {
				redirect('user/register');
			}
			$data['title']='';
			$this->load->view('templates/header', $data);
			$this->load->view('login_view');
			$this->load->view('templates/footer');
				
		}
		else
		{
			if ($this->input->post('btn_signup') == "Signup") {
				redirect('user/register');
			} else
			//validation succeeds
			if ($this->input->post('btn_resend') == "Resend")
			{
				$email = $this->user_model->get_email($username, $password);
				
				// send email
				if ($this->user_model->sendEmail($email))
				{
					// successfully sent mail
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Sulle on uuesti saadetud kinnitusmeil! Palun kinnita oma email vajutades linki, mis saadeti Sinu emaili aadressil!!!</div>');
					redirect('user/login');
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Viga.  Palun proovi hiljem uuesti!!!</div>');
					redirect('user/login');
				}
				
			} else 
			if ($this->input->post('btn_login') == "Login")
			{
				//check if username and password is correct
				$usr_result = $this->user_model->get_user($username, $password);
				
				if ($usr_result > 0) //active user record is present
				{
					//set the session variables
					$user_data = $this->user_model->get_userdata($username, $password);
					$sessiondata = array(
							'username' => $username,
							'loginuser' => TRUE
					);
					$this->session->set_userdata('login',$user_data);
					$this->session->set_userdata('username',$username);
					//$this->session->set_userdata('login',$user_data);
					redirect("auctions/index");
				} 
				else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Vigane username ja password!</div>');
					redirect('user/login');
				}
			}
			else
			{
				redirect('user/login');
			}
		}
	}
}