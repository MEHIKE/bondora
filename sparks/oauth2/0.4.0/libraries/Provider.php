<?php
/**
 * OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

abstract class OAuth2_Provider
{
	
	
	/**
	 * @var  string  provider name
	 */
	public $name;

	/**
	 * @var  string  uid key name
	 */
	public $uid_key = 'uid';

	/**
	 * @var  string  additional request parameters to be used for remote requests
	 */
	public $callback;

	/**
	 * @var  array  additional request parameters to be used for remote requests
	 */
	protected $params = array();

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	protected $method = 'POST';

	/**
	 * @var  string  default scope (useful if a scope is required for user info)
	 */
	protected $scope;

	/**
	 * @var  string  scope separator, most use "," but some like Google are spaces
	 */
	protected $scope_seperator = ' ';

	/**
	 * Overloads default class properties from the options.
	 *
	 * Any of the provider options can be set here, such as app_id or secret.
	 *
	 * @param   array   provider options
	 * @return  void
	 */
	public function __construct(array $options = array())
	{
		if ( ! $this->name)
		{
			// Attempt to guess the name from the class name
			$this->name = strtolower(substr(get_class($this), strlen('OAuth2_Provider_')));
		}

		if (empty($options['id']))
		{
			$options['id']="";
//			throw new Exception('Required option not provided: id');
		}

		$this->client_id = $options['id'];
		
		isset($options['callback']) and $this->callback = $options['callback'];
		isset($options['secret']) and $this->client_secret = $options['secret'];
		isset($options['scope']) and $this->scope = $options['scope'];

		$this->redirect_uri = site_url(get_instance()->uri->uri_string());
		//echo "Provider constr  uri=".$this->redirect_uri;
	}

	/**
	 * Return the value of any protected class variable.
	 *
	 *     // Get the provider signature
	 *     $signature = $provider->signature;
	 *
	 * @param   string  variable name
	 * @return  mixed
	 */
	public function __get($key)
	{
		return $this->$key;
	}

	/**
	 * Returns the authorization URL for the provider.
	 *
	 *     $url = $provider->url_authorize();
	 *
	 * @return  string
	 */
	abstract public function url_authorize();

	/**
	 * Returns the access token endpoint for the provider.
	 *
	 *     $url = $provider->url_access_token();
	 *
	 * @return  string
	 */
	abstract public function url_access_token();

	/*
	* Get an authorization code from Facebook.  Redirects to Facebook, which this redirects back to the app using the redirect address you've set.
	*/	
	public function authorize($options = array())
	{
		$state = md5(uniqid(rand(), TRUE));
		get_instance()->session->set_userdata('state', $state);

		//echo "authorize= uri=".$options['redirect_uri'];;
		$params = array(
			'client_id' 		=> $this->client_id,
			'redirect_uri' 		=> isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri,
			'state' 			=> $state,
			'scope'				=> is_array($this->scope) ? implode($this->scope_seperator, $this->scope) : $this->scope,
			'response_type' 	=> 'code',
			'approval_prompt'   => 'force' // - google force-recheck
		);
		//echo http_build_query($params);
		return $this->url_authorize().'?'.http_build_query($params);
	}

	/*
	* Get access to the API
	*
	* @param	string	The access code
	* @return	object	Success or failure along with the response details
	*/	
	public function access($code, $options = array())
	{
		sleep(1);
		$params = array(
			'grant_type' 	=> isset($options['grant_type']) ? $options['grant_type'] : 'authorization_code',
			'client_id' 	=> isset($options['id']) ?$options['id']:$this->client_id,
			'client_secret' => isset($options['secret']) ?$options['secret']:$this->client_secret,
		);

		switch ($params['grant_type'])
		{
			case 'authorization_code':
				$params['code'] = $code;
				//$params['redirect_uri'] = isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri;
				$params['redirect_uri'] = $this->redirect_uri;
			break;

			case 'refresh_token':
				$params['refresh_token'] = $code;
			break;
		}

		$response = null;	
		$url = $this->url_access_token();
		//echo "url3=".$url."*****";
		//print_r($params);
		//echo "methd=".$this->method."********";
		switch ($this->method)
		{
			case 'GET':

				// Need to switch to Request library, but need to test it on one that works
				//$url .= '?'.http_build_query($params);
				$url = $url."?".http_build_query($params);
				//echo "url1=*?".http_build_query($params)."*";
				//echo "url2=".$url;
				//if ($response==null)
					
				$response = file_get_contents($url);

				parse_str($response, $return);

			break;

			case 'POST':

				$postdata = http_build_query($params);
				//echo "postdata=";
				//print_r($postdata);
				$json = "[".json_encode($params)."]";
				//echo "<br>******json=".$json."******";
				//$postdata=urlencode($postdata);
				//echo "postdata after=";
				//print_r($postdata);
				
				$opts = array(
					'http' => array(
						'method'  => 'POST',
							'ignore_errors' => TRUE,
						'header'  => 'Content-type: application/x-www-form-urlencoded',//.'Content-Lenght: 350\r\n',
//						'header'  => 'Content-type: application/json',
//						'header' =>		'Content-Lenght: 300',
						'content' => $postdata
//							'content' => $json
					)
				);
				$http = array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						//						'header'  => 'Content-type: application/json',
						'content' => $postdata
				);
				/*$w = stream_get_wrappers();
				echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
				echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
				echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
				echo 'wrappers: ', var_dump($w);
				*/
				$context  = stream_context_create($opts);
				//echo "<br>Opts=";
				//var_dump($opts);
				//echo "<br>context=".$context;
				//print_r($opts);
				//echo "<br>url4=".$url."<br>";
				//$url = urlencode($url);
				//if ($url!='')
//	**************************

			/*	$ctx = stream_context_create($opts);
				$fp = @fopen($url, 'rb', false, $ctx);
				if (!$fp)
				{
					throw new Exception("Problem with $url, ");
				}
				
				$response = @stream_get_contents($fp);
				if ($response === false)
				{
					throw new Exception("Problem reading data from $sUrl, $php_errormsg");
				}
				echo "response=".$response;
				*/
//	**************************			
				$response = file_get_contents($url, false, $context);
				//print_r($this->parseHeaders($http_response_header));
				//var_dump($http_response_header);
				//echo "<br>SSSSSSSSSSSSSSS response=".$response;
				
				$return = get_object_vars(json_decode($response));

			break;

			default:
				throw new OutOfBoundsException("Method '{$this->method}' must be either GET or POST");
		}

		if ( ! empty($return['error']))
		{
			//echo "<br>VIGA=".$return['error'];
			redirect("auth/session/bondoora");
			//throw new OAuth2_Exception($return);
		}
		
		return OAuth2_Token::factory('access', $return);
	}

	public function parseHeaders( $headers )
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
