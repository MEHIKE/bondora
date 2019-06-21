<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Eventlog extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('eventlog_model');
                $this->load->helper('url_helper');
                //$this->load->helper('url');
                $this->load->library('table');
                
                $this->load->library('session');
                $this->load->helper('form');
                $this->load->helper('url');
                //$this->load->database();
                $this->output->enable_profiler(TRUE);
                
                $this->load->library('form_validation');
                //$this->load->model('Filters_model');
                //set the session variables
                /*$sessiondata = array(
                		'username' => $username,
                		'loginuser' => TRUE
                );
                */
                if ($this->session->has_userdata('login'))
                	$sessiondata=$this->session->userdata('login');
                else
                	redirect('user/login');
                
        }

        
        
        
        public function index($filter = NULL)
        {
        	$token=NULL;
        	
        	$provider=NULL;
        	$token_obj=NULL;
        	//$this->session->umark_flash('msg');
        	$this->session->set_flashdata('msg','Kohalikud laenud');
        	$current_url=current_url();
        	get_instance()->session->set_userdata('current_url', $current_url);
        	
        	if ($token == NULL)
        		if ($this->session->userdata('user_session')) {
        			$token = $this->session->userdata('user_session');
        		}
        
        	if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        		//echo "leidsin olemasoleva provideri";
        	} else {
        		$provider = $this->oauth2->providerB("Bondoora");
        		//echo "provider leitud";
        	}
        	/*	$balance = $provider->get_balance($token);
        		//echo "eeee=".$balance['balance']->Balance;
        		//var_dump($balance['balance']);
        		
        		$bal=$balance['balance'];
        		$suc=$balance['success'];
        		$err=$balance['errors'];
        		if ($balance['success'])
        			echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        	*/		
        	$bal='Pole laetud';
        	$suc=false;
        	$err='';
        	 if (isset($_POST['date']) && $_POST['date']!='') {
        	 	$date=$this->input->post('date');//."T00:00:00";
        	 	//echo "DATE=".$date;
        	 	$filter = array(
        	 			'EventDateFrom' => $date, 
        	 	);
        	 	//var_dump($filter);echo "<br>".$date;
        	 	//echo "POST=";var_dump($_POST);echo $this->input->post('date')."=POST";
        	 }
        		$data['all']=0;
					if ($filter!=NULL)
        				$data = $this->eventlog_model->load_eventlogs($provider, $token, $filter);
					else 	
						$data = $this->eventlog_model->load_eventlogs($provider, $token);
					
        			$data['title'] = 'Minu Bondoora tegemised';
        			$data['token'] = $token;
        			$data['filter'] = $filter;
        			//$data['balance'] = 'Pole laetud';//$bal->Balance;
        			//$data['laenusumma'] = 5;
        			
        			if ($this->form_validation->run() === FALSE)
        			{
    	    			$data['type1']=$this->input->post('type');
    	    			$data['ip1']=$this->input->post('ip');
    	    			
        			$this->load->view('templates/header', $data);
        			$this->load->view('eventlog/index', $data);
        			$this->load->view('templates/footer');
        			} else {
        			
        			}
        }
        
        public function download($filter = NULL)
        {
        	$token=NULL;
        	 
        	$current_url=current_url();
        	get_instance()->session->set_userdata('current_url', $current_url);
        	 
        	
        	$provider=NULL;
        	$token_obj=NULL;
        	if ($token == NULL)
        		if ($this->session->userdata('user_session')) {
        			$token = $this->session->userdata('user_session');
        		}
        
        	if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        		//echo "leidsin olemasoleva provideri";
        	} else {
        		$provider = $this->oauth2->providerB("Bondoora");
        		//echo "provider leitud";
        	}
        	if (!$this->session->has_userdata('bondora')) {
        		//tegelt v�iks logida bondoora sisselogimise lehele otse
        		redirect('auth/session/Bondoora');
        	}
        	 
        	$balance = $provider->get_balance($token, $this->session);

        	
        	//$data['all'] = $this->auctions_model->load_auctions($provider, $token);
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        	$bal='';//$balance['balance'];
        	$suc='';//$balance['success'];
        	$err='';//$balance['errors'];
        	//if ($balance['success'])
        		//echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        
        
        		//$data['auctions'] = $this->auctions_model->get_filter_auctions($filter);
        		//$data['title'] = 'Bondoora laenud';
        		$data['token'] = $token;
        		$data['filter'] = $filter;
        		//$data['balance'] = '';//$bal->Balance;
        		//$data['laenusumma'] = 5;
        		//$data['sum'] = $sum;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Laeti alla '.$data['all']['sum'].' hetkel aktiivset laenupakkumist!</div>');
        		$this->session->set_flashdata('msg', 'Laeti alla '.$data['all']['sum'].' hetkel aktiivset laenupakkumist!');
        		if ($this->form_validation->run() === FALSE)
        		{
        			$data['type1']=$this->input->post('type');
        			$data['ip1']=$this->input->post('ip');
        			
        			$this->load->view('templates/header', $data);
        			$this->load->view('auctions/index', $data);
        			$this->load->view('templates/footer');
        		} else {
        			 
        		}
        		
        		//$this->load->view('templates/header', $data);
        		//$this->load->view('auctions/index', $data);
        		//$this->load->view('templates/footer');
        }
        
        
}