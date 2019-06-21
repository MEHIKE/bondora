<?php

include('Exception.php');
include('Token.php');
include('Provider.php');

/**
 * OAuth2.0
 *
 * @author Phil Sturgeon < @philsturgeon >
 */
class OAuth2 {

	/**
	 * Create a new provider.
	 *
	 *     // Load the Twitter provider
	 *     $provider = $this->oauth2->provider('twitter');
	 *
	 * @param   string   provider name
	 * @param   array    provider options
	 * @return  OAuth_Provider
	 */
	public static function provider($name, array $options = NULL)
	{
		$name = ucfirst(strtolower($name));

		include_once 'Provider/'.$name.'.php';

		$class = 'OAuth2_Provider_'.$name;

		if ($options==null)
			return new $class();
		else
			return new $class($options);
	}

	public static function providerB($name)
	{
		$name = ucfirst(strtolower($name));
	
		include_once 'Provider/'.$name.'.php';
	
		$class = 'OAuth2_Provider_'.$name;
	
		return new $class();
	}

/*	public static function client($name, $url, $params, $method, $headers=array())
	{
		$name = ucfirst(strtolower($name));
	
		include_once 'Bondora/'.$name.'.php';
	
		//$class = 'OAuth2_Provider_'.$name;
		$class = $name;
	
		return new $class($url, $params, $method, $headers=array());
	}

	public static function api($name, $arr)
	{
		$name = ucfirst(strtolower($name));
	
		include_once 'Bondora/'.$name.'.php';
	
		//$class = 'OAuth2_Provider_'.$name;
		$class = $name;
	
		return new $class($arr);
	}
	*/
}