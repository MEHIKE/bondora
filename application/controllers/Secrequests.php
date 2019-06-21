<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Secrequests extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('secrequest_model');
                $this->load->helper('url_helper');
                //$this->load->helper('url');
                $this->load->library('table');
                
                $this->load->library('session');
                $this->load->helper('form');
                $this->load->helper('url');
                //$this->load->database();
                $this->load->library('form_validation');
                //$this->load->model('Filters_model');
                if ($this->session->has_userdata('login'))
                	$sessiondata=$this->session->userdata('login');
                	
                else
                	redirect('user/login');
                
                
        }

        //public function index()
        //{
        //        $data['filters'] = $this->filters_model->get_filters();
        //}

        public function view($id = NULL)
        {
                $data['requests_item'] = $this->secrequest_model->get_secondary($id);
                
                if (empty($data['requests_item']))
                {
                	show_404();
                }
                
                $data['title'] = $data['requests_item']['user'];
                
                
                $this->load->view('templates/header', $data);
                $this->load->view('secrequests/view', $data);
                $this->load->view('templates/footer');
                
        }

        public function query($id = NULL)
        {
        	$data['requests_item'] = $this->secrequest_model->get_secondary($id);
        
        	if (empty($data['requests_item']))
        	{
        		show_404();
        	}
        
        	$data['title'] = $data['requests_item']['user'];
        
        
        	$this->load->view('templates/header', $data);
        	$this->load->view('secrequest/view', $data);
        	$this->load->view('templates/footer');
        
        }
        
        public function delete($id = NULL, $del = 2)
        {	//echo "del=".$del;
        	if ($del==1) {
        		$data['requests_item'] = $this->secrequest_model->get_secondary($id);
        		$arr= $data['requests_item'];
        		$data['desc'] = $arr['description'];
        		$data['nam'] = $arr['name'];
        		//var_dump($data);
        		if (empty($data['requests_item']))
        		{
        			show_404();
        		}
        		
        	}
        	if ($del==2) {
 		       	$this->secrequest_model->del_secondary($id);
 		       	//$data['title'] = $data['filters_item']['description'];
 		       	 
        	}
        	$data['title'] = "Kustutamine";
			$data['id'] = $id;        
			$data['arv'] = $id;

			if ($del==1) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
			$this->session->set_flashdata('redirect', 'secrequests/delete/'.$id."/2");
			$this->session->set_flashdata('redirect_msg', 'Kustuta Secondary Marketi filter');
			$this->session->set_flashdata('redirect_back', 'secrequests/index');
			$this->session->set_flashdata('redirect_back_msg', 'Tagasi nimeirja');
			$this->session->set_flashdata('tagasi', 1);
			$data['arv'] = $id;
			$data['tagasi']=1;
				
			$this->load->view('templates/header', $data);
			$this->load->view('secrequests/success', $data);
			$this->load->view('templates/footer');
				
			} else redirect('secrequests/index');
        
        }
        
        public function index($token = NULL)
        {
        	//$token1=NULL;
        	$provider=NULL;
        	$token_obj=NULL;
        	if ($token == NULL)
        	if ($this->session->userdata('user_session')) {
        		$token = $this->session->userdata('user_session');
        	}
        	 
/*        	if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        	} else
        		$provider = $this->oauth2->providerB("Bondoora");
       			$balance = $provider->get_balance($token);
        		//echo "eeee=".$balance['balance']->Balance;
        		//var_dump($balance['balance']);
        		$bal=$balance['balance'];
        		$suc=$balance['success'];
        		$err=$balance['errors'];
        		if ($balance['success'])
        			echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
 */       		
        		 
        	$data['secrequests'] = $this->secrequest_model->get_requests();
        	$data['title'] = 'Bondoora ajutised ja määratud otsingud';
        	$data['token'] = $token;
        	//$data['balance'] = $bal->Balance;
        	$data['balance'] = 'Pole määratud veel';
        
        	$this->load->view('templates/header', $data);
        	$this->load->view('secrequests/index', $data);
        	$this->load->view('templates/footer');
        }
        
        public function edit($id = NULL)
        {
        	$this->load->helper('form');
        	$this->load->library('form_validation');
        	 
        	$this->output->enable_profiler(TRUE);
        	$sections = array(
        			'config'  => TRUE,
        			'queries' => TRUE,
        			'controller_info' => TRUE,
        			'memory_usage' => TRUE,
        			'uri_string' => TRUE,
        			'http_headers' => TRUE,
        			'session_data' => TRUE,
        			'post' => TRUE,
        			'get' => TRUE
        			
        	);
        	
        	$this->output->set_profiler_sections($sections);
        	 
        	//echo "id=".$id;
        	//kui pole id, siis inser/create muidu edit
        	//echo "id=".$id;
        	//$str=$str."test";
        	//if ($id == NULL ) {
        	//	$data['filter'] = $this->filters_model->get_filters(0);
        	//	$data['is_new'] = TRUE;
        	//	$is_new = TRUE;
        	//	echo "leidsin uue rea";
        	//}
        	//else {
        	$data['id'] = $id;
        	//if ($id != NULL && !$_POST) {
        	if ($id != NULL) {
        		echo "leidsin olemasoleva rea";
        		echo "id=".$id;
        		$data['requests_item'] = $this->secrequest_model->get_requests($id);
        		$data['is_new'] = 0;
        		
        		
        		$is_new = FALSE;
        	//	}
        		echo "is_new=".$data['is_new']."* ja id=".$id." ja uus is_new=".$is_new;
        	} 
        	if ($id == 0)
        		$data['title'] = 'Uus bondora Secondary Marketi fiter';
        	else 
        		$data['title'] = 'Muudame bondoora Secondary Marketi filtrit';
        
        		if ($this->input->post('countries')) {
        			if (!$this->input->post('countriesEE')) 
        				$_POST['countriesEE'] = 0;
       				if (!$this->input->post('countriesFI'))
       					$_POST['countriesFI'] = 0;
   					if (!$this->input->post('countriesES'))
   						$_POST['countriesES'] = 0;
        						 
        		} else {

        		}
        		if ($this->input->post('ratings')) {
        			if (!$this->input->post('ratingsAA'))
        				$_POST['ratingsAA'] = 0;
        			if (!$this->input->post('ratingsA'))
        				$_POST['ratingsA'] = 0;
        			if (!$this->input->post('ratingsB'))
        				$_POST['ratingsB'] = 0;
       				if (!$this->input->post('ratingsC'))
      					$_POST['ratingsC'] = 0;
    				if (!$this->input->post('ratingsD'))
    					$_POST['ratingsD'] = 0;
    				if (!$this->input->post('ratingsE'))
    					$_POST['ratingsE'] = 0;
    				if (!$this->input->post('ratingsF'))
    					$_POST['ratingsF'] = 0;
					if (!$this->input->post('ratingsH'))
						$_POST['ratingsHR'] = 0;
        								
        		} else {
        		
        		}
        		
        	$pagecount = $this->session->userdata('current');
        	if ($pagecount === FALSE) $pagecount = 1;
        	$pagecount += 1;
        	$this->session->set_userdata('current',$pagecount);
        	
        	date_default_timezone_set('Europe/London');
        	$now = date("H:i:s");
        	$time = date("Y-m-d H:i:s");
        	$data["tstamp"] = $now;
        	$data["time"] = $time;
        	$data['pagecount'] = $pagecount;
        	
        		$this->form_validation->set_rules('jrk', 'Jrk.', 'required',
        				array(
        						'required' => 'K�ivitamise j�rjekord on oluline! Sisesta see.'
        				));
        		
        		//$this->form_validation->set_rules('countries', 'Riigid', 'required');
        		//$this->form_validation->set_rules('ratings', 'Reitingud', 'required');
        
        	$this->form_validation->set_rules('user', 'User', 'required',
        	array(
                'required'      => 'Sa pole sisestanud: %s.'
        	));
        	$this->form_validation->set_rules('amount', 'Summa', 'required|min_length[1]|numeric|integer|greater_than[4.99]|callback_check_amount',
			array(
                'required'      => 'Sa pole sisestanud: %s.'
        	));
        
        	if ($this->form_validation->run() === FALSE)
        	{
        		$formSubmit = $this->input->post('submit');
        		if( $formSubmit == 'formBack' )
        			redirect('secrequests/index/');
        	
        		$this->load->view('templates/header', $data);
        		//if ($id == NULL ) 
        		$data=	$this->load->view('secrequests/edit', $data);
        		//else 
        		//	$this->load->view(anchor("filters/edit,"filters/edit/".$id), $data);
        		$this->load->view('templates/footer');
        		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Viga filtri muutmisel!</div>');
        
        	}
        	else
        	{
        		//if ($data['is_new'] == TRUE)
        		//	$id = 0;
        		$formSubmit = $this->input->post('submit');
        		if( $formSubmit == 'formBack' )
        			redirect('secrequests/index/');
        		else {
        			$arv=$this->secrequest_model->set_filters($id);
        			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Filter on muudetud!  Muudetud ridasid='.$arv.'</div>');
        			$this->session->set_flashdata('redirect', 'secrequests/index');
        			$this->session->set_flashdata('redirect_msg', 'Tagasi Secondary Marketi filtrite nimekirja');
        			$dat['arv'] = $arv;
        			//$this->load->view('filters/success/',$dat);
        			redirect('secrequests/success/' . $arv);
        		}
        		//redirect('updateEmployee/index/' . $empno);
        		
        	}
        }
        
        public function buttons() {
        	$formSubmit = $this->input->post('submit');
        	if( $formSubmit == 'formTOBid' )
        		redirect('bids/makebids');
        	else if ($formSubmit == 'formAuctions') {
        		redirect('auctions/download/');
        	} else if ($formSubmit == 'formInvestments') {
        		redirect('investments/index');
        	} else if ($formSubmit == 'formFilterList') {
        		redirect('filters/index');
        	} else if ($formSubmit == 'formFilter') {
        		redirect('filters/edit');
        	} else if ($formSubmit == 'formBids') {
        		redirect('bids/download');
        	}
        }
        
        public function success($arv = NULL) {
        	$dat['arv'] = $arv;
        	$this->load->view('secrequests/success', $dat);
        }

        public function balance($token = NULL) {
        	//$token1=NULL;
        	$provider=NULL;
        	$token_obj=NULL;
        	if ($token == NULL)
        	if ($this->session->userdata('user_session')) {
        		$token = $this->session->userdata('user_session');
        	}
        	
        	if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        	} else 
        		$provider = $this->oauth2->providerB("Bondoora");
        		

        	if ($this->session->userdata('user_token')) {
        		$token_obj = $this->session->userdata('user_token');
        	} 
        	 
        	//fetch_json_url();
        	//$data=	$this->load->view('filters/index');
        //	fetch_json_url();
        //}
        	 
        //public function fetch_json_url(){
/*        	$url = 'https://api-sandbox.bondora.com/api/v1/login';
        	$username = 'rynno.ruul@emt.ee';
        	$password = 'mehike2472';
        	echo $url;
        	$uspas = array(
        			'username' => $username,
        			'password' => $password
        	);

        	$auth=$username.":".$password;
        	$encoded = base64_encode($auth);
        	 
        	// Initialize session and set URL.
        	$ch = curl_init();
        	// Set URL to download
        	curl_setopt($ch, CURLOPT_URL, $url);
        	// Include header in result? (0 = yes, 1 = no)
        	curl_setopt($ch, CURLOPT_HEADER, 0);
        	//Set content Type
        	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: application/json'));
        	// Should cURL return or print out the data? (true = return, false = print)
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        	//to blindly accept any server certificate, without doing any verification //optional
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        	//The most important is
        	curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        	// Download the given URL, and return output
        	 
        	$result = curl_exec($ch);
        	//$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
        	$status_code = curl_getinfo($ch);   //get status code
        	print_r($status_code);echo "\n\n";
        	//echo "status=".$status_code;
        	 
        	// Close the cURL resource, and free system resources
        	echo ($result);
        	curl_close($ch);
        	$data = json_decode($result, true);
        	print_r($data);
        	echo "\n\n**************";
        	
        	
        	$ch1 = curl_init();
        	curl_setopt($ch1, CURLOPT_URL, $url);
        	curl_setopt($ch1, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        	curl_setopt($ch1, CURLOPT_RETURNTRANSFER,1);
        	curl_setopt($ch1, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        	curl_setopt($ch1, CURLOPT_USERPWD, "$username:$password");
        	curl_setopt($ch1, CURLOPT_POST, true);
        	curl_setopt($ch1, CURLOPT_POSTFIELDS, $uspas);
        	curl_setopt($ch1, CURLOPT_HTTPHEADER,array('Content-type: application/json'));
        	$headers = array("Authorization: Basic ".$encoded);
        	curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        	 
        	$result=curl_exec ($ch1);
        	//$status_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);   //get status code
        	$status_code = curl_getinfo($ch1);   //get status code
        	print_r($status_code);
        	//echo "status2=".$status_code;
        	echo "\n\n****************";
        	curl_close ($ch1);
        	echo ($result);
        	//curl_close($ch1);
        	$data = json_decode($result, true);
        	print_r($data);
        	echo "data=".$data;
        	
        	 
        	$url = 'https://api.bondora.com/api/v1/login';
        	$ch2 = curl_init();
        	curl_setopt($ch2, CURLOPT_URL, $url);
        	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        	//curl_setopt($ch2, CURLOPT_USERPWD, "$username:$password");
        	curl_setopt($ch2, CURLOPT_USERPWD, $encoded);
        	curl_setopt($ch2, CURLOPT_HTTPHEADER,array('Content-type: application/json'));
        	$auth=$username.":".$password;
        	$encoded = base64_encode($auth);
        	$headers = array("Authorization: Basic ".$encoded);
        	curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
        	 
        	curl_setopt($ch2, CURLOPT_POST, true);
        	curl_setopt($ch2, CURLOPT_POSTFIELDS, $uspas);
        	 
        	curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        	$output = curl_exec($ch2);
        	$info = curl_getinfo($ch2);
        	curl_close($ch2);
			//$data = json_decode($info, true);
        	print_r($info);  
        	echo "output=".$output; 
        	
        	
        	$this->load->library('Curl');
        	//curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        	echo $this->curl->simple_post($url, false, array(CURLOPT_USERAGENT => true));
  */
        	//echo "balance=".$token;
        	//$this->load->library('session');
        	//$this->load->helper('url_helper');
        	
        	//$this->load->spark('oauth2/0.4.0');
        	 
/*        	$provider = $this->oauth2->provider("Bondoora", array(
			'id' => '3e6330cefc4c493393d71a70d9335997',
			'secret' => 'wBrZvmogJvQ6ksqMvUlJsAlHdkf9bC1KwhquiuouShCBwUVe',
		));
*/
        	//$provider = $this->oauth2->providerB("Bondoora");
        	 
        	//$token2 = $provider->access($_GET['code']);
        	 
        	//$token1 = OAuth2_Token::factory('access', array('access_token'=>$token));
        	 
        	$balance = $provider->get_balance($token);
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        	$bal=$balance['balance'];
        	$suc=$balance['success'];
        	$err=$balance['errors'];
        	if ($balance['success'])
	        	echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        }
        
        public function create($id = NULL)
        {
        	//echo "id=".$id;
        	//kui pole id, siis inser/create muidu edit
        	//echo "id=".$id;
        	//$str=$str."test";
        	//if ($id == -1 ) {
        		$data['requests_item'] = $this->secrequest_model->get_filters(0);
        		$data['is_new'] = 1;
        		$data['id'] = 0;
        		
        		$is_new = TRUE;
        		echo "leidsin uue rea";
        		echo "is_new=".$data['is_new']."* ja id=".$id." ja uus is_new=".$is_new;
        	//}
        	$data['title'] = 'Uus bondora Secondary Marketi filter';
        	//else {
        	//	echo "leidsin olemasoleva rea";
        	//	echo "id=".$id;
        	//	$data['filter'] = $this->filters_model->get_filters($id);
        	//	$data['is_new'] = FALSE;
        	//	$is_new = FALSE;
        	//}
        	//echo "is_new=".$data['is_new']."* ja id=".$id." ja uus is_new=".$is_new;
        	$this->load->helper('form');
        	$this->load->library('form_validation');
        
        	//if ($id == NULL)
        		
        	//else
        	//	$data['title'] = 'Muudame bondoora filtrit';
        
        			//if ($id == NULL)
        				$this->form_validation->set_rules('jrk', 'Jrk.', 'required|is_unique[auction_filter_adv.jrk]',
        						array(
        								'required' => 'K�ivitamise j�rjekord on oluline! Sisesta see.'
        						));
        			//else
        			//$this->form_validation->set_rules('jrk', 'Jrk.', 'required',
        			//		array(
        			//				'required' => 'K�ivitamise j�rjekord on oluline! Sisesta see.'
        			//		));
        
        			//$this->form_validation->set_rules('countries', 'Riigid', 'required');
        			//$this->form_validation->set_rules('ratings', 'Reitingud', 'required');
        
        			$this->form_validation->set_rules('user', 'User', 'required',
        					array(
        							'required'      => 'Sa pole sisestanud: %s.'
        					));
        			$this->form_validation->set_rules('amount', 'Summa', 'required|min_length[1]|numeric|integer|greater_than[5]|callback_check_amount',
        					array(
        							'required'      => 'Sa pole sisestanud: %s.'
        					));
        
        			if ($this->form_validation->run() === FALSE)
        			{
        				
        				$this->load->view('templates/header', $data);
        				//if ($id == NULL )
        				$this->load->view('secrequests/create', $data);
        				//else
        				//	$this->load->view(anchor("filters/edit,"filters/edit/".$id), $data);
        				$this->load->view('templates/footer');
        				print_r($this->input->post());
        			}
        			else
        			{
        				//if ($data['is_new'] == TRUE)
        				$id = 0;
        				$this->filters_model->set_filters($id);
        				$this->load->view('secrequests/success');
        			}
        }
        
        
        function is_start_date_valid($date) {
        	if (date('Y-m-d H:i:s', strtotime($date)) == $date) {
        		return TRUE;
        	} else {
        		$this->form_validation->set_message('start_date', 'The %s Start date must be in format "yyyy-mm-dd hh:mm:ss"');
        		return FALSE;
        	}
        }
        
        
        
        public function check_amount($str)
        {
        	if ($str == 0) 	{
        		$this->form_validation->set_message('check_amount', '{field} v�li ei saa olla "0"');
        		return FALSE;
        	} else 	{
        		if ($str/5 != (int) ($str/5) ) {
        			$this->form_validation->set_message('check_amount', '{field} v�li peab olema 5-ga jaguv t�isarv');
        			return FALSE;
        		} else 	return TRUE;
        	}
        }
        
        
}

