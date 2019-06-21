<?php
class User_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//insert into user table
	function insertUser($data)
	{
		return $this->db->insert('user', $data);
	}

	//send verification email to user's email id
	function sendEmail($to_email)
	{
		//$from_email = 'team@mydomain.com';
		$from_email = 'jooksust@gmail.com';
		$subject = 'Verify Your Email Address';
		$uri = site_url(get_instance()->uri->uri_string());
		echo "<br>uri=".$uri."<br>";
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> '.$uri.'/'. md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';

		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'mehike2472'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);

		//send mail
		$this->email->from($from_email, 'roosamehike.bondora.com');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}

	//activate user account
	function verifyEmailID($key)
	{
		$data = array('status' => 1);
		$this->db->where('md5(email)', $key);
		return $this->db->update('user', $data);
	}
	
	//get the username & password from tbl_usrs
	function get_user($usr, $pwd)
	{
		$sql = "select * from user where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status = '1'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	//get the username & password from tbl_usrs
	function get_email($usr, $pwd)
	{
		$sql = "select * from user where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status != '1'";
		$query = $this->db->query($sql);
		//var_dump($query->row_array());
		return $query->row_array()['email'];
	}

	function get_userdata($usr, $pwd)
	{
		$sql = "select * from user where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status = '1'";
		$query = $this->db->query($sql);
		//var_dump($query->row_array());
		return $query->row_array();
	}

	function get_userdataName($usr)
	{
		$sql = "select * from user where username = '" . $usr . "' and status = '1'";
		$query = $this->db->query($sql);
		//var_dump($query->row_array());
		return $query->row_array();
	}
	
}