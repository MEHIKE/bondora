<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller
{
	
	public $client_id='3e6330cefc4c493393d71a70d9335997';
	public $secret='wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe';
	//public $client_id='a8725bee5e9e4dbc8735cd2b577851ca';
	//public $secret='c1bbBm68T5Ty1Cu74Bh8HM4eur5VyST0RwgB5NDFJWbZqTwL';
	
	public function newsession($provider)
	{
		$token=NULL;
		$newprovider=NULL;
		$token_obj=NULL;
		if ($token == NULL)
			if ($this->session->userdata('user_session')) {
				$token = $this->session->userdata('user_session');
			}
		if ($this->session->userdata('user_provider')) {
			$newprovider = $this->session->userdata('user_povider');
			//echo "leidsin olemasoleva provideri";
		} else {
			$newprovider = $this->oauth2->providerB($provider);
			//echo "provider leitud";
		}
		if ($token!=NULL)
			$newprovider->revoke_token($token);
		sleep(5);
		redirect('auth/session/Bondoora');
		//$this->session($provider);
	}

	//public function refreshsession($provider, $token=NULL)
	public function refreshsession($provider)
	{	
		if (!isset($token) || $token==NULL)
			if ($this->session->userdata('user_session')) {
				$token = $this->session->userdata('user_session');
			}
		if (isset($token) && $token!=NULL) {
			$new_token = $provider->refresh_token($token);
			$this->session->set_userdata('user_session', $new_token->access_token);

			//$user_data=$this->session->userdata('login');  //leiame olemasolevad kasutajaandmed
			//$username = $user_data['username'];  //leiame kasutajanime
$username=$this->session->userdata('username'); //leiame olemasoleva kasutajanime
$user_data = $this->user_model->get_userdataName($username);  //leiame hetke kasutaja andmed tabelis
$this->session->set_userdata('login',$user_data);  //salvestame ueudndatud andmed sessiooni
			//$this->session->set_userdata('username',$username);
$current_url=get_instance()->session->userdata('current_url');
$current_url='auctions/index';
$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Currnent url is='.$current_url.' Bondoorasse uuesti sisse logitud!</div>');
redirect($current_url);
	//return $new_token->access_token;
		}
		$provider = $this->oauth2->provider($provider, array(
				'id' => $this->client_id,
				'secret' => $this->secret,
				'grant_type' => 'refresh_token',
		));
		$new_token = $provider->access($token, array(
				'id' => $this->client_id,
				'secret' => $this->secret,
				'grant_type' => 'refresh_token',
		));	
		$this->session->set_userdata('user_session', $new_token->access_token);
		
		//$user_data=$this->session->userdata('login');  //leiame olemasolevad kasutajaandmed
		//$username = $user_data['username'];  //leiame kasutajanime
$username=$this->session->userdata('username'); //leiame olemasoleva kasutajanime
$user_data = $this->user_model->get_userdataName($username);  //leiame hetke kasutaja andmed tabelis
$this->session->set_userdata('login',$user_data);  //salvestame ueudndatud andmed sessiooni
		//$this->session->set_userdata('username',$username);
		
$current_url=get_instance()->session->userdata('current_url');
$current_url='auctions/index';
$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Currnent url is='.$current_url.' Bondoorasse uuesti sisse logitud!</div>');
redirect($current_url);
		//return $new_token->access_token;
	}
	
	public function refreshsession1($provider, $token=NULL)
	{
		if ($token==NULL)
			if ($this->session->userdata('user_session')) {
				$token = $this->session->userdata('user_session');
			}
		if (isset($token) && $token!=NULL) {
			$new_token = $provider->refresh_token($token);
			return $new_token();
		}
		$provider = $this->oauth2->provider($provider, array(
				'id' => $this->client_id,
				'secret' => $this->secret,
				'grant_type' => 'refresh_token',
		));
		$new_token = $provider->access($token, array(
				'id' => $this->client_id,
				'secret' => $this->secret,
				'grant_type' => 'refresh_token',
		));
		return $new_token->access_token;
	}
	

	public function session($provider)
	{
		//$this->load->library('session');
		//$this->load->driver('session');
		//$this->load->helper('url_helper');
		
		//$this->load->spark('oauth2/0.4.0');
		//$this->load('oauth2');
	
		$provider = $this->oauth2->provider($provider, array(
			'id' => $this->client_id,
			'secret' => $this->secret,
		));

/*		$provider = $this->oauth2->provider($provider, array(
				'id' => '2d65d925e6f54a318186887c71000e52',
				'secret' => 'ZRxmqWKK8uKKsRyiFcV41VWJgiy54K3DP5OUdOYZvHLkWyVa',
		));
*/		
//		$url = $provider->authorize();
		
//		redirect($url);
		//echo "<br>GET=";
		//var_dump($_GET);
		//echo "<br>POST=";
		//var_dump($_POST);
		
		if ( ! $this->input->get('code'))
		{
			$count = $this->session->userdata('auth');
			if ($count === FALSE) $count = 1;
			$count += 1;
			$this->session->set_userdata('auth',$count);
			//echo "<br>GET=";	
			//var_dump($_GET);
			//echo "<br>POST=";
			//var_dump($_POST);
			//echo "<br>authorise GET code<br>";
				// By sending no options it'll come back here
			$url = $provider->authorize();
			//echo "redirect url to get=".$url."<br>";
			//http://roosamehike.synology.me/~mehike/bondora/index.php/investments/index
			if ($count>3) {
				$this->session->unset_userdata('auth');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Üle 3korra üritatud logida Bondoorasse API kaudu, mingi Bondoora poolne viga</div>');
				//var_dump($_GET);
				//var_dump($_POST);
				//$ee=$ff;
				redirect('auctions/index');
			} else
				redirect($url);
			//$ff=$rr;
		}
		else
		{
			$count1 = $this->session->userdata('auth1');
			if ($count1 === FALSE) $count1 = 1;
			$count1 += 1;
			$this->session->set_userdata('auth1',$count1);
			if ($count1>3) {
				$this->session->unset_userdata('auth1');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Üle 3korra üritatud logida Bondoorasse API kaudu, mingi Bondoora poolne viga</div>');
				//var_dump($_GET);
				//var_dump($_POST);
				//$ee=$ff;
				redirect('auctions/index');
			}
				
			try
			{
				
/*				$this->load->spark('codeigniter-curl-master');
				$code = $_GET['code'];
				echo "---------------".$code;
				$this->curl->create("https://api.bondora.com/oauth/access_token");
				//$postdata1="grant_type=authorization_code&client_id=3e6330cefc4c493393d71a70d9335997&client_secret=wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe&code=cTDgNDBsQ7mOACkqeTmSdioA6hbfVIUnx92W3uLMlVt9uCR0&redirect_uri=http%3A%2F%2Flocalhost%3A88%2Fbondora%2Findex.php%2Fauth%2Fsession%2Fbondoora";
				$postdata="grant_type=authorization_code&client_id=3e6330cefc4c493393d71a70d9335997&client_secret=wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe&code=".$code."&redirect_uri=http://localhost:88/bondora/index.php/auth/session/bondoora";
				$postdata2="grant_type=authorization_code&client_id=3e6330cefc4c493393d71a70d9335997&client_secret=wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe&code=".$code."&redirect_uri=http\:\/\/localhost:88\/bondora\/index.php\/auth\/session\/bondoora";
				
				$opts = array(
						'http' => array(
								'method'  => 'POST',
								'header'  => 'Content-type: application/x-www-form-urlencoded',
								//						'header'  => 'Content-type: application/json',
						//						'header' =>		'Content-Lenght: 200',
								'content' => $postdata
				));
				$this->curl->post($opts);
				
				echo "*******execute=".$this->curl->execute()."********************";
				
				$this->curl->simple_post("https://api.bondora.com/oauth/access_token", $opts, array(CURLOPT_BUFFERSIZE => 10));
			
				//***********************
				
				$ch = curl_init();
				$headers = array('Content-Lenght: 400', 'Content-type: application/x-www-form-urlencoded');
				
				curl_setopt($ch, CURLOPT_FRESH_CONNECT,  true);
				
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_URL, "https://api.bondora.com/oauth/access_token"); # URL to post to
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); # return into a variable
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers ); # custom headers, see above
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_REFERER, "https://api.bondora.com/oauth/access_token");
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata2);
				//$result = curl_exec( $ch ); # run!
				//echo "\r\n *result=".$result."*+++++++++++++++++++";
				curl_close($ch);
				
				//************************
*/				
				// Have a go at creating an access token from the code
				//echo "GET-CODE=".$_GET['code']."<br>";
				$token = $provider->access($_GET['code']);
				
				// Use this object to try and get some user details (username, full name, etc)
				//$user = $provider->get_user_info($token);
			
				// Here you should use this information to A) look for a user B) help a new user sign up with existing data.
				// If you store it all in a cookie and redirect to a registration page this is crazy-simple.
				//echo "<pre>Tokens: ";
				//var_dump($token);
				//echo "and token is: ".$token->access_token;
				//$user = $provider->get_balance1($token->access_token);
				//var_dump($user);
				//redirect("http://localhost:88/bondora/index.php/filters/balance/".$token->access_token."?code=".$code);
	
				$this->session->set_userdata('user_session', $token->access_token);
				$this->session->set_userdata('user_expires', $token->expires);
				
				$this->session->set_userdata('provider_client_id', $provider->client_id);
				$this->session->set_userdata('provider_client_secret', $provider->client_secret);
				$this->session->set_userdata('provider_client_redirect', $provider->redirect_uri);
				
				$this->session->set_userdata('provider_scope', $provider->scope);
				
				//$this->session->set_userdata('user_token', $token);
				//$this->session->set_userdata('user_povider', $provider);
				
//				redirect("http://localhost:88/bondora/index.php/filters/index/".$token->access_token);
				$current_url=get_instance()->session->userdata('current_url');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Currnent url is='.$current_url.' Bondoorasse uuesti sisse logitud!</div>');
				
				redirect($current_url);			
				//echo "\n\nUser Info: ";
				//var_dump($user);
			}
		
			catch (OAuth2_Exception $e)
			{
				show_error('That didnt work: '.$e);
			}
		
		}
	}
	
	function parseHeaders( $headers )
	{
		$head = array();
		foreach( $headers as $k=>$v )
		{
			$t = explode( ':', $v, 2 );
			if( isset( $t[1] ) )
				$head[ trim($t[0]) ] = trim( $t[1] );
				else
				{
					$head[] = $v;
					if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
						$head['reponse_code'] = intval($out[1]);
				}
		}
		return $head;
	}
	
} 