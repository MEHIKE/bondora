<?php
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
/**
 * Facebook OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Bondoora extends OAuth2_Provider
{
	
	public $client_id='3e6330cefc4c493393d71a70d9335997';
	public $secret='wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe';
	//private $client_id='a8725bee5e9e4dbc8735cd2b577851ca';
	//private $secret='c1bbBm68T5Ty1Cu74Bh8HM4eur5VyST0RwgB5NDFJWbZqTwL';
	
/*	public function __constructor() {
		$this->load->library('session');
	}
	*/
	
	//BidsEdit%20BidsRead%20Investments%20SmBuy%20SmSell
	//Investments,BidsRead,BidsEdit,SmSell,SmBuy
	protected $scope = array('Investments', 'BidsRead', 'BidsEdit', 'SmSell', 'SmBuy');
	//protected $scope = array('Investments');

	public function url_authorize()
	{
		return 'https://www.bondora.com/oauth/authorize';
	}

	public function url_access_token()
	{
		return 'https://api.bondora.com/oauth/access_token';
	}

	public function url_revoke_token()
	{
		return 'https://api.bondora.com/oauth/access_token/revoke';
	}
	
	public function url_api()
	{
		return 'https://api.bondora.com';
	}
	
	function is_more_than_30min($time_stamp, $refresh=FALSE)
	{
		$time_difference = strtotime('now') - $time_stamp;
		//echo "<br>time=".$time_difference."<br>";
		//echo "<br>diff=".$time_difference.">".(60*30)."<br>";
		if ($refresh==TRUE)
			return true;
		
		if ($time_difference >= 60 * 30)
		{
			//echo "<br>time difference=".$time_difference.">".(1800)."<br>";
				
			/*
			 * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
			 * This means that the time difference is 1 year or more
			 */
			return true;
		} else return false;
	}
	
	public function get_balance($token, $sess=NULL, $refresh=FALSE)
	{
		//$this->load->library('session');
		if ($sess->has_userdata('balance_time')) { //kui viimane sessioniaeg>30min tagasi, sisi siseneme
			$lasttime=$sess->userdata('balance_time');
			
			$bool=$this->is_more_than_30min($lasttime, $refresh);
			//var_dump($bool);
			if (!$bool) {
				$sess->unset_userdata('bondora_new');
				return 	$sess->userdata('bondora');
			}
			//else 
				//echo "<br>bool=false<br>";
		} else {
			$sess->set_userdata('balance_time', strtotime('now'));  //kui viimane sessioniaeg>30min tagasi, sisi siseneme
					
			//echo "<br>tulemus=".$sess->userdata('balance_time')."<br>";
			//$sess->has_userdata('balance_time', strtotime('now'));
		}
		
			$url = 'https://api.bondora.com/api/v1/account/balance';//?'.http_build_query(array(
			//'access_token' => $token->access_token,
			//));
	
			$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						'header'  => 'Authorization: Bearer '.$token
						//							'content' => $json
				)
			);
			$context  = stream_context_create($opts);
		
			$balance = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin balance ".$url;
		
			//if (!$balance->Success)
				//redirect('auth/session/Bondoora');
			
			//balance peab salvestama siin sessiooni sisse
			//$this->session->set_userdata('balance_tim', time());
				
			//else var_dump($balance->Payload);
			//return $balance;
			// Create a response from the request
			if ($balance->Success) {
				$tim=array(
					'balance' => $balance->Payload,
					'success' => $balance->Success,
					'errors' => $balance->Errors,
				);
				$sess->set_userdata('balance_time',strtotime('now'));
				//$sess->set_userdata('bondora', $tim);
				$sess->set_userdata('bondora', $balance->Payload);
				$sess->set_userdata('bondora_new', 1);
				return $tim;
			} else {
				$sess->unset_userdata('balance_time');
				$sess->unset_userdata('bondora');
				$sess->unset_userdata('bondora_new');
				//var_dump($balance->Errors[0]->Code);
				if ($balance->Errors[0]->Code=='401')
					$this->access($token, array(
							'id' => '3e6330cefc4c493393d71a70d9335997',
							'secret' => 'wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe',
							'grant_type' => 'refresh_token',
					));
				
				return array(
						'success' => $balance->Success,
						'errors' => $balance->Errors,
				);
			}
		//}
		//else {  //kui balance muutuja on olemas ja aeg on <30min, siis kasutame olemasolevat
		//	$balance=$this->session->userdata('balance');
		//	return $balance;
		//}
	}
	
	public function refresh_token($token)
	{
		$url = $this->url_access_token();
		$params = array(
				'id' => $this->client_id,
				'secret' => $this->secret,
				'grant_type' => 'refresh_token',
				'refresh_token' => $token,
		);
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						//'content' => $json
						'content' => http_build_query($params)
				)
		);
		$context  = stream_context_create($opts);
	
		$refresh = json_decode(file_get_contents($url, false, $context));
		//var_dump($refresh);
		$new_token = OAuth2_Token::factory('access', $refresh)->access_token;
		$this->session->set_userdata('user_session', $new_token);
		return $new_token;
	}
	
	
	public function get_auction($token, $id)
	{
		$url = 'https://api.bondora.com/api/v1/auction/'.$id;//?'.http_build_query(array(
		//'access_token' => $token->access_token,
		//));
	
		$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						'header'  => 'Authorization: Bearer '.$token
						//							'content' => $json
				)
		);
		$context  = stream_context_create($opts);
	
		$auction = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin balance ".$url;
		//var_dump($auction);
		//if (!$balance->Success)
			//redirect('auth/session/Bondoora');
			//else var_dump($balance->Payload);
			//return $balance;
			// Create a response from the request
		if ($auction->Success)
			return array(
					'auction' => $auction->Payload,
					'success' => $auction->Success,
					'errors' => $auction->Errors,
			);
		else 
			return array(
					'success' => $auction->Success,
					'errors' => $auction->Errors,
			);
				
	}

	public function get_auctions($token)
	{
		$url = 'https://api.bondora.com/api/v1/auctions';//?'.http_build_query(array(
		//'access_token' => $token->access_token,
		//));
	
		$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						'header'  => 'Authorization: Bearer '.$token
						//							'content' => $json
				)
		);
		$context  = stream_context_create($opts);
	
		$auctions = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin balance ".$url;
	
		if (!$auctions->Success)
		//	redirect('auth/session/Bondoora');
			//else var_dump($balance->Payload);
			return $auctions;
			// Create a response from the request
			
			return array(
					'auctions' => $auctions->Payload,
					'success' => $auctions->Success,
					'errors' => $auctions->Errors,
			);
	}

	
	public function get_loanpart($token, $id)
	{
		$url = 'https://api.bondora.com/api/v1/loanpart/'.$id;//?'.http_build_query(array(
		//'access_token' => $token->access_token,
		//));
	
		$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						'header'  => 'Authorization: Bearer '.$token
						//							'content' => $json
				)
		);
		$context  = stream_context_create($opts);
	
		$loanpart = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin loanpart-i ".$url;
	
		//var_dump($loanpart);
		//if (!$balance->Success)
			//redirect('auth/session/Bondoora');
			//else var_dump($balance->Payload);
			//return $balance;
			// Create a response from the request
		if (!$loanpart->Success)
			return array(
					'success' => $loanpart->Success,
					'errors' => $loanpart->Errors,
			);
		else
			return array(
					'loanpart' => $loanpart->Payload,
					'success' => $loanpart->Success,
					'errors' => $loanpart->Errors,
			);
	}
	
	public function get_investments($token)
	{
		$url = 'https://api.bondora.com/api/v1/account/investments';//?'.http_build_query(array(
		//'access_token' => $token->access_token,
		//));
	
		$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						'header'  => 'Authorization: Bearer '.$token
						//							'content' => $json
				)
		);
		$context  = stream_context_create($opts);
	
		$investments = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin investeeringud ".$url;
	
		//if (!$investments->Success)
		//	redirect('auth/session/Bondoora');
			//else var_dump($balance->Payload);
			//return $balance;
			// Create a response from the request
			if ($investments->Success)
			return array(
					'investments' => $investments->Payload,
					'success' => $investments->Success,
					'errors' => $investments->Errors,
					'count' => $investments->TotalCount,
			);
			else 
				return array(
						'success' => $investments->Success,
						'errors' => $investments->Errors,
				);
				
	}
	
	public function get_bids($token, $query = FALSE)
	{
		if (!$query)
			$url = 'https://api.bondora.com/api/v1/bids';//?'.http_build_query(array(
		else 
			$url = 'https://api.bondora.com/api/v1/bids?'.http_build_query($query);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						'header'  => 'Authorization: Bearer '.$token
						//							'content' => $json
				)
		);
		$context  = stream_context_create($opts);
	
		$bids = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin pakkumised ".$url;
	
		if (!$bids->Success)
			redirect('auth/session/Bondoora');
			//else var_dump($balance->Payload);
			//return $balance;
			// Create a response from the request
		return array(
				'bids' => $bids->Payload,
				'success' => $bids->Success,
				'errors' => $bids->Errors,
				'count' => $bids->TotalCount,
					
		);
	}

	public function get_eventlog($token, $filter = FALSE)
	{
/*		if (!$filter)
			$url = 'https://api.bondora.com/api/v1/eventlog';//?'.http_build_query(array(
		else
			$url = 'https://api.bondora.com/api/v1/eventlog?'.http_build_query($filter);
		$opts = array(
					'http' => array(
							'method'  => 'GET',
							'ignore_errors' => TRUE,
							'header'  => 'Authorization: Bearer '.$token
							//							'content' => $json
					)
		);
		$context  = stream_context_create($opts);
		$events = json_decode(file_get_contents($url, false, $context));
*/
		//var_dump($filter);
		$url1 = 'https://api.bondora.com/api/v1/eventlog';
		$header=array('Authorization' =>' Bearer '.$token, 'Content-type' => 'application/json');
		$this->bondora($url1, $filter, 'GET', $header);
		$body = $this->getBody();
		$events = json_decode($body);
		//var_dump($events);
		if ($events->Success)
			return array(
							'events' => $events->Payload,
							'success' => $events->Success,
							'errors' => $events->Errors,
							'count' => $events->TotalCount,
				);
		else 
			return array(
							'success' => $events->Success,
							'errors' => $events->Errors,
				);
	}
	
	public function make_bids($token, $json = FALSE)
	{
		//if (!$query)
			$url = 'https://api.bondora.com/api/v1/bid';//?'.http_build_query(array(
		//else
			//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
				//'access_token' => $token->access_token,
				//));
				//echo "<br>build_qury=".http_build_query($json)."<br>";
				//echo "<br>URL*****=".$url;
				$opts = array(
						'http' => array(
								'method'  => 'POST',
								'ignore_errors' => TRUE,
								'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
								//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
								'content' => $json
								//'content' => http_build_query($json)
						)
				);
				//var_dump($opts);
				$context  = stream_context_create($opts);
	
				$bids = json_decode(file_get_contents($url, false, $context));
				//echo "leidsin pakkumised ".$url."********".$bids;
	//sleep(15);
				//if (!$bids->Success) {
					//sleep(15);
				//	redirect('auth/session/Bondoora');
					
				//}
					//else var_dump($balance->Payload);
					//return $balance;
					// Create a response from the request
					return array(
							'bids' => $bids->Payload,
							'success' => $bids->Success,
							'errors' => $bids->Errors,
								
					);
	}

	public function buy_secondary($token, $json = FALSE)
	{
		//if (!$query)
		$url = 'https://api.bondora.com/api/v1/secondarymarket/buy';//?'.http_build_query(array(
		//else
		//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>build_qury=".http_build_query($json)."<br>";
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						'content' => $json
						//'content' => http_build_query($json)
				)
		);
		//var_dump($opts);
		$context  = stream_context_create($opts);
	
		$bids = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin pakkumised ".$url."********".$bids;
		//sleep(15);
		//var_dump($bids);
		//if (!$bids->Success) {
		//	redirect('auth/session/Bondoora');
		//}
		//else var_dump($balance->Payload);
		//return $balance;
		// Create a response from the request
		return array(
				'success' => $bids->Success,
				'errors' => $bids->Errors,
	
		);
	}


	public function cancel_secondaries($token, $json = FALSE)
	{
		//if (!$query)
		//$ff=$fff;
		$url = 'https://api.bondora.com/api/v1/secondarymarket/cancel';//?'.http_build_query(array(
		//else
		//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>build_qury=".http_build_query($json)."<br>";
		$json = array('id' => $cancel);
	
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						'content' => $json
						//'content' => http_build_query($json)
				)
		);
		//var_dump($opts);
		$context  = stream_context_create($opts);
	
		$cancels = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin pakkumised ".$url."********".$bids;
		//sleep(15);
		//if (!$bids->Success) {
		//	redirect('auth/session/Bondoora');
		//}
		//else var_dump($balance->Payload);
		//return $balance;
		// Create a response from the request
		return array(
				'success' => $cancels->Success,
				'errors' => $cancels->Errors,
	
		);
	}
	
	public function cancel_secondary($token, $cancel = FALSE)
	{
		//if (!$query)
		//$ff=$fff;
		$url = 'https://api.bondora.com/api/v1/secondarymarket/'.$cancel.'/cancel';//?'.http_build_query(array(
		//else
		//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>build_qury=".http_build_query($json)."<br>";
		$json = array('id' => $cancel);
		
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						//'content' => $json
						'content' => http_build_query($json)
				)
		);
		//var_dump($opts);
		$context  = stream_context_create($opts);
	
		$bids = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin pakkumised ".$url."********".$bids;
		//sleep(15);
		//if (!$bids->Success) {
		//	redirect('auth/session/Bondoora');
		//}
		//else var_dump($balance->Payload);
		//return $balance;
		// Create a response from the request
		return array(
				'success' => $bids->Success,
				'errors' => $bids->Errors,
	
		);
	}
	
	public function sell_investments($token, $json = FALSE)
	{
		//if (!$query)
		$url = 'https://api.bondora.com/api/v1/secondarymarket/sell';//?'.http_build_query(array(
		//else
		//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>build_qury=".http_build_query($json)."<br>";
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						'content' => $json
						//'content' => http_build_query($json)
				)
		);
		//var_dump($opts);
		$context  = stream_context_create($opts);
	
		$bids = json_decode(file_get_contents($url, false, $context));
		//echo "leidsin pakkumised ".$url."********".$bids;
		//sleep(15);
		//if (!$bids->Success) {
		//	redirect('auth/session/Bondoora');
		//}
		//else var_dump($balance->Payload);
		//return $balance;
		//var_dump($bids);
		// Create a response from the request
		return array(
				'success' => $bids->Success,
				'errors' => $bids->Errors,
	
		);
	}
	
	public function cancel_bid($token, $id = FALSE)
	{
		//if (!$query)
		$url = 'https://api.bondora.com/api/v1/bid/'.$id."/cancel";//?'.http_build_query(array(
		//else
		//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>build_qury=".http_build_query($json)."<br>";
		$json = array('id' => $id);
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						//'header'  => 'Authorization: Bearer '.$token,//." \r\n Content-type: application/json'",
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						//'content' => '',
						'content' => http_build_query($json)
				)
		);
		//var_dump($opts);
		$context  = stream_context_create($opts);
	
		$bids = json_decode(file_get_contents($url, false, $context));
		//var_dump($bids);
		//echo "leidsin pakkumised ".$url."********".$bids;
		//sleep(15);
		//if (!$bids->Success) {
			//sleep(15);
			//redirect('auth/session/Bondoora');
				
		//}
		//else var_dump($balance->Payload);
		//return $balance;
		// Create a response from the request
		return array(
				'success' => $bids->Success,
				'errors' => $bids->Errors,
	
		);
	}

	
	public function revoke_token($token)
	{
		//if (!$query)
		//$ff=$fff;
		//$url = 'https://api.bondora.com/api/v1/secondarymarket/'.$cancel.'/cancel';//?'.http_build_query(array(
		$url = $this->url_revoke_token();
		//else
		//$url = 'https://api.bondora.com/api/v1/bid?'.http_build_query($json);
		//'access_token' => $token->access_token,
		//));
		//echo "<br>build_qury=".http_build_query($json)."<br>";
		//$json = array('id' => $cancel);
	
		//echo "<br>URL*****=".$url;
		$opts = array(
				'http' => array(
						'method'  => 'POST',
						'ignore_errors' => TRUE,
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),//." \r\n Content-type: application/json'",
						//'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
						//'content' => $json
						//'content' => http_build_query($json)
				)
		);
		//var_dump($opts);
		$context  = stream_context_create($opts);
	
		$revoke = json_decode(file_get_contents($url, false, $context));
		//echo ($revoke);
		//echo "leidsin pakkumised ".$url."********".$bids;
		//sleep(15);
		//if (!$bids->Success) {
		//	redirect('auth/session/Bondoora');
		//}
		//else var_dump($balance->Payload);
		//return $balance;
		// Create a response from the request
		/*return array(
				'success' => $revoke->Success,
				'errors' => $revoke->Errors,
	
		);*/
	}
	
	public function get_secondary($token, $filter)
	{
		//echo "<br>loadseconary algus<br>";
		$url = 'https://api.bondora.com/api/v1/secondarymarket/?'.http_build_query($filter);
		//'access_token' => $token->access_token,
		//));
		//echo "filter=".http_build_query($filter)."<br>";
		//$dd=$rrr;
		$opts = array(
				'http' => array(
						'method'  => 'GET',
						'ignore_errors' => TRUE,
						//'header'  => 'Authorization: Bearer '.$token,
						//'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json', 'Content-Encoding: gzip, deflate'),
						'header'  => array('Authorization: Bearer '.$token, 'Content-type: application/json'),
						//							'content' => $json
						'content' => http_build_query($filter)
						
				)
		);

		$url1 = 'https://api.bondora.com/api/v1/secondarymarket/';
		$header=array('Authorization' =>' Bearer '.$token, 'Content-type' => 'application/json');
		$this->bondora($url1, $filter, 'GET', $header);
		$body = $this->getBody();
		//$json = json_decode($body, true);
		$json = json_decode($body);
	//var_dump($json);
	//echo "filter=".http_build_query($filter)."<br>";
	//echo $json1;	
	//$context  = stream_context_create($opts);
	//$content = file_get_contents($url ,false, $context);
	//$json = json_decode($content);
	//if (!$json->Success)
		//redirect('auth/session/Bondoora');
			// Create a response from the request
		return array(
					'secondary' => $json->Payload,
					'success' => $json->Success,
					'errors' => $json->Errors,
		);
	/*return array(
			'secondary' => $json['Payload'],
			'success' => $json['Success'],
			'errors' => $json['Errors'],
	);*/
	}
	
	
	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://graph.facebook.com/me?'.http_build_query(array(
			'access_token' => $token->access_token,
		));

		$user = json_decode(file_get_contents($url));

		// Create a response from the request
		return array(
			'uid' => $user->id,
			'nickname' => isset($user->username) ? $user->username : null,
			'name' => $user->name,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'email' => isset($user->email) ? $user->email : null,
			'location' => isset($user->hometown->name) ? $user->hometown->name : null,
			'description' => isset($user->bio) ? $user->bio : null,
			'image' => 'https://graph.facebook.com/me/picture?type=normal&access_token='.$token->access_token,
			'urls' => array(
			  'Facebook' => $user->link,
			),
		);
	}

	const METHOD_POST = 'post';
	const METHOD_GET = 'get';
	
	private $error_code;
	private $error_message;
	
	private $curl_info;
	
	private $http_header;
	private $http_body;
	
	public function bondora($url, $params, $method, $headers=array()) {
		if (!$url) {
			throw new \InvalidArgumentException('URL missing');
		}
	
		//if (!in_array($method, array(self::METHOD_GET, self::METHOD_POST))) {
		//    throw new \InvalidArgumentException('Invalid method type');
		//}
	
		$curl = curl_init();
		$options = array(
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_HEADER => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_URL => $url,
				CURLOPT_USERAGENT => 'roosamehike-php-bondora-api',
				CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
				),
				CURLOPT_CONNECTTIMEOUT => 60,
				CURLOPT_TIMEOUT => 60,
				CURLOPT_VERBOSE => false,
				CURLOPT_ENCODING => 'gzip, deflate',
		);
		if ($method == 'POST') {
			$options[CURLOPT_POST] = true;
			$options[CURLOPT_POSTFIELDS] = $params;
		} else if ($params) {
			if (parse_url($url, PHP_URL_QUERY)) {
				$options[CURLOPT_URL] .= '&';
			} else {
				$options[CURLOPT_URL] .= '?';
			}
			$options[CURLOPT_URL] .= http_build_query($params);
		}
		if ($headers) {
			foreach ($headers as $name=>$value) {
				$options[CURLOPT_HTTPHEADER][] = $name . ': ' . $value;
			}
		}
		curl_setopt_array($curl, $options);
	
		$response = curl_exec($curl);
		if (!$response) {
			$this->error_code = curl_errno($curl);
			$this->error_message = curl_error($curl);
			//throw new ClientException($this->error_message, $this->error_code);
			//echo "openssl.cafile: ", ini_get('openssl.cafile'), "\n";
			//echo "curl.cainfo: ", ini_get('curl.cainfo'), "\n";
			//var_dump(openssl_get_cert_locations());
			//echo $this->error_message." err ".$this->error_code;
		} else {
			$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
			$http_header = trim(substr($response, 0, $header_size));
			$http_header = explode("\n", $http_header);
			foreach ($http_header as $row) {
				$row = explode(': ', trim($row), 2);
				if (count($row) < 2) {
					continue;
				}
				$this->http_header[trim(strtolower($row[0]))] = trim($row[1]);
			}
			$this->http_body = substr($response, $header_size);
		}
	
		$this->curl_info = curl_getinfo($curl);
	
		curl_close($curl);
	}
	
	public function getHttpCode() {
		return (int) $this->curl_info['http_code'];
	}
	
	public function getHeader($name) {
		if (!isset($this->http_header[strtolower($name)])) {
			return false;
		}
		return $this->http_header[strtolower($name)];
	}
	
	public function getBody() {
		return $this->http_body;
	}

}
