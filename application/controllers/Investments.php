<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Investments extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('investments_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
                $this->load->library('table');
                //$this->load->library('log');
                $this->load->library('session');
                $this->load->helper('form');
                $this->load->helper('url');
                //$this->load->database();
                $this->load->library('form_validation');
                $this->output->enable_profiler(TRUE);
                //$this->load->model('Filters_model');
                if ($this->session->has_userdata('login'))
                	$sessiondata=$this->session->userdata('login');
               	else
               		redirect('user/login');
        }

        public $balance;

        function time_float()
        {
        	list($usec, $sec) = explode(" ", microtime());
        	return ((float)$usec + (float)$sec);
        }
        
        function elapsed_time($time_start) {
        	$time_end=$this->time_float();
        	$time = $time_end - $time_start;
        	return $time;
        }
        
        public function cancelSecondary($id=NULL) {
        	$token=NULL;
        	$provider=NULL;
        	$token_obj=NULL;
        	
        	if ($token == NULL)
        		if ($this->session->userdata('user_session')) {
        			$token = $this->session->userdata('user_session');
        		}
        	if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        		//echo "leidsin olemasoleva provideri";
        		//log_message('error', 'Some variable did not contain a value.');
        	} else {
        		$provider = $this->oauth2->providerB("Bondoora");
        		//echo "provider leitud";
        		//log_message('error', 'Some variable did not contain a value.');
        	}
        	$result = $provider->cancel_secondary($token, $id);
        	if ($result['success']) {
        		//echo "sucecss<br>";
        		//redirect('investments/download');
        		//var_dump($result);
        		$teade="";
        		$this->load->model('secondary_model');
        		$this->secondary_model->load_secondary_batch($provider, $token, array('ShowMyItems' => 'true'));
        		//foreach ($result['errors'] as $post):
        		//$teade=$teade.$post->Message."-> id=".$post->Details."<br>";
        		//endforeach;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Second Marketi müük �nnestus!<br> '.$teade.'</div>');
        		$this->session->set_flashdata('msg', 'Second Marketi müük õnnestus!<br> SecondaryId='.$id);
        		$data['secondaryId'] = $id;

        		//$this->session->set_flashdata('msg', 'Investeeringu müük õnnelikult edastatud');
        		 
        		//$ss=$fff;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        		$this->session->set_flashdata('redirect', 'investments/index');
        		$this->session->set_flashdata('redirect_msg', 'Tagasi investeeringute nimekirja');
        		 
        		$this->session->set_flashdata('redirect_back', 'investments/download');
        		$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti investeeringud');
        		 
        		$this->session->set_flashdata('tagasi', 1);
        		//$data['payloads'] = $bids;
        		$data['tagasi']=1;
        		$data['pocent']=2;
        		$data['title']="Katkestatud Järelturu müük antud investeeringul: secondaryId=".$id;
        		//$data['secondaryId']=$id;
        		
        		$this->load->view('templates/header', $data);
        		$this->load->view('investments/cancelled', $data);
        		$this->load->view('templates/footer');
        		
        		 
        	}
        	else {
        		//	redirect('secondary/index');
        		$viga="";
        		foreach ($result['errors'] as $post):
        		$viga=$viga.$post->Message."-> id=".$post->Details."<br>";
        		endforeach;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Vead-><br> '.$viga.'</div>');
        		$this->session->set_flashdata('msg', '<strong>Vead</strong><br> '.$viga);
        		
        		$this->session->set_flashdata('err', 'Second Marketi müük ei õnnestunud!<br> SecondaryId='.$id);
        		$data['secondaryId'] = $id;
        		
        		//$this->session->set_flashdata('msg', 'Investeeringu müük õnnelikult edastatud');
        		 
        		//$ss=$fff;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        		$this->session->set_flashdata('redirect', 'investments/index');
        		$this->session->set_flashdata('redirect_msg', 'Tagasi investeeringute nimekirja');
        		 
        		$this->session->set_flashdata('redirect_back', 'investments/download');
        		$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti investeeringud');
        		 
        		$this->session->set_flashdata('tagasi', 1);
        		//$data['payloads'] = $bids;
        		$data['tagasi']=1;
        		$data['pocent']=2;
        		$data['title']="Järelturu müügi katkestamine ei õnnestunud antud investeeringul: secondaryId=".$id;
        		//$data['secondaryId']=$id;
        		
        		$this->load->view('templates/header', $data);
        		$this->load->view('investments/notcancelled', $data);
        		$this->load->view('templates/footer');
        		
        		
        		//redirect('investments/download');
        	}			//        		echo "not success<br>";
        		
        	//redirect('investments/download');
        	 
        }
        
        public function button() {
        	//$gg=$tt;
        	$formSubmit = $this->input->post('submitForm');
        	/*if ($formSubmit == 'formAuctions') {
        	//	redirect('auctions/index');
        	} else if ($formSubmit == 'formInvestments') {
        	//	redirect('investments/download');
        	} else if ($formSubmit == 'formToSecond') {
        	//	redirect('secondary/index');
        	} else if ($formSubmit == 'formFilter') {
        	//	redirect('filters/index');
        	} else if ($formSubmit == 'formBids') {
        	//	redirect('bids/index');
        	} else*/ 
        	if ($formSubmit == 'formFilter') {
        	} else
        if ($formSubmit == 'formSellSecond') {
        	//var_dump($_POST);
        	//echo "formSubmit=".$formSubmit."<br>";
        	//if ($formSubmit == 'formSellSecond') {
        	$this->load->model('secondary_model');
        	
        	//if ($this->input->post('countries')) {
        	//echo "POST=<br>";
        	//var_dump($_POST);
        	$idx=0;
        	$posts=$this->investments_model->get_post($_POST);
        	$size=sizeof($posts);
        	//echo "size=".$size."  protsent=".$_POST['procent'];
        	$bids=array();
        	if ($size>0)
        	foreach ($posts as $post):
        	$idx++;
        	if ($idx<=$size) {
        		//echo "idx=".$post."<br>";
        		$current=$this->investments_model->get_investments((int)$post);
        		$bid=array();
        		$bid['LoanPartId']=$current['loanPartId'];
        		$bid['DesiredDiscountRate']=$_POST['procent'];
        		//$bid['MinAmount']=5;
        		$bids[]=$bid;
        	}
        	endforeach;
        	 
        	$nn['Items']=array($bids);
        	
        	$json = '{"Items": '.json_encode($bids).'}';
        	//echo "<br>JSON=".$json."<br>";
        	$token=NULL;
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
        	$result = $provider->sell_investments($token, $json);
        	 
        	//$result = $provider->make_bids($token, $bids);
        	//echo "<br>*****<br>";
        	 
        	//var_dump($result);
        	//sleep(10);
        	//$dd=$fff;
        	if ($result['success']) 
        	{
        		//echo "sucecss<br>";
        		//redirect('investments/download');
        		$this->secondary_model->load_secondary_batch($provider, $token, array('ShowMyItems' => 'true'));
        		$data['title'] = "Investeeringute müüki panemine õnnestus";
        		//$data['id'] = $id;
        		//$data['arv'] = $id;
        		$data['success']=$result['success'];
        		$data['errors']=$result['errors'];
        		//$data['payloads'] = $result['payload'];
        		 
        		$viga="";
//        		foreach ($result['payload'] as $post):
//        		$viga=$viga.$post->Message."-> id=".$post->Details."<br>";
//        		endforeach;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Investeeringu müük õnnelikult edastatud</div>');
        		$this->session->set_flashdata('msg', 'Investeeringu müük õnnelikult edastatud');
        		 
        		//$ss=$fff;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        		$this->session->set_flashdata('redirect', 'investments/index');
        		$this->session->set_flashdata('redirect_msg', 'Tagasi investeeringute nimekirja');
        		 
        		$this->session->set_flashdata('redirect_back', 'investments/download');
        		$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti investeeringud');
        		 
        		$this->session->set_flashdata('tagasi', 1);
        		$data['payloads'] = $bids;
        		$data['tagasi']=1;
        		$data['pocent']=2; 
        		
        		$this->load->view('templates/header', $data);
        		$this->load->view('investments/success', $data);
        		$this->load->view('templates/footer');
        		//$data['ff']=$result1['gg'];
        	}
        	else {
        		//redirect('secondary/index');
        		//echo "not success<br>";
        		//echo "sucecss<br>";
        		//redirect('investments/download');
        		$data['title'] = "Investeeringute müüki panemine ei õnnestunud";
        		//$data['id'] = $id;
        		//$data['arv'] = $id;
        		$data['success']=$result['success'];
        		$data['errors']=$result['errors'];
        		//$data['payloads'] = $result['payload'];
        		 
        		$viga="";
        		foreach ($result['errors'] as $post):
        		$viga=$viga.$post->Message."-> id=".$post->Details."<br>";
        		endforeach;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Vead-><br> '.$viga.'</div>');
        		$this->session->set_flashdata('msg', 'Vead-><br> '.$viga);
        		 
        		//$ss=$fff;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        		$this->session->set_flashdata('redirect', 'investments/index');
        		$this->session->set_flashdata('redirect_msg', 'Tagasi investeeringute nimekirja');
        		 
        		$this->session->set_flashdata('redirect_back', 'investments/download');
        		$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti investeeringud');
        		 
        		$this->session->set_flashdata('tagasi', 1);
        		//$data['arv'] = $id;
        		$data['tagasi']=1;
        		 
        		$this->load->view('templates/header', $data);
        		$this->load->view('investments/notsuccess', $data);
        		$this->load->view('templates/footer');
        		//$data['ff']=$result1['gg'];
        		
        		//redirect('investments/download');
        	}
        	 
        }
        	//}
        }
        
        public function index($investment = NULL)
        {
        	$token=NULL;
        	//log_message('debug', '******************investments index.');
        	//$this->log->write_log('debug', "OOOOOOOOOOOOOOO");
        	$provider=NULL;
        	$token_obj=NULL;
        	//$this->session->umark_flash('msg');
        	$this->session->set_flashdata('msg','Kohalikud investeeringud');
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
/*        		$balance = $provider->get_balance($token);
        		//echo "eeee=".$balance['balance']->Balance;
        		//var_dump($balance['balance']);
        		$bal=$balance['balance'];
        		$suc=$balance['success'];
        		$err=$balance['errors'];
        		//$count=$balance['count'];
        		if ($balance['success'])
        			echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
  */      
        			$start = $this->time_float();
        			if ($this->investments_model->get_count(0) ==0) {
						        				
        				//$data['all'] = $this->investments_model->load_investments($provider, $token);
        				$data['all'] = $this->investments_model->load_investments_batch($provider, $token);
        			}
        			$data['investments'] = $this->investments_model->get_investments();
        			$all_elapsed=$this->elapsed_time($start);
        			$data['all']=0;
        			 
        			$data['title'] = 'Bondoora investeeringud';
        			$data['token'] = $token;
        			$data['investment'] = $investment;
        			//$data['balance'] = $bal->Balance;
        			$data['balance'] = 'Pole hetkel teada';
        			//$data['total'] = $bal->TotalAvailable;
        			$data['total'] = 'Pole hetkel teada';
        			//$data['waiting'] = $bal->BidRequestAmount;
        			$data['waiting'] = 'Pole hetkel teada';
        			$data['procent'] = 2;
        			if ($this->form_validation->run() === FALSE)
        			{
       		 			$data['riik1']=$this->input->post('riik');
            		    //if (isset($data['stat'])) {
        					$data['stat1']=$this->input->post('stat');
        					//$data['stat']=$this->input->post('stat');
        				//}        					 
       			 		//else { 
       		 			//	$data['stat']=-1;
       		 			//	$data['stat1']=-1;
       		 			//}
       		 			$data['contr1']=$this->input->post('contr');
        				$data['score1']=$this->input->post('score');
        				$data['pik1']=$this->input->post('pik');
        			 
        				$this->load->view('templates/header', $data);
        				$this->load->view('investments/index', $data);
        				$this->load->view('templates/footer');
        			} else {
        				
        			}
        }
        
        public function download($investment = NULL)
        {
        	$token=NULL;
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
        	$balance = $provider->get_balance($token, $this->session);
//var_dump($balance);
        	//$data['all'] = $this->investments_model->load_investments($provider, $token);
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        	$bal='';//$balance['balance'];
        	$suc='';//$balance['success'];
        	$err='';//$balance['errors'];
        	//if (isset($balance['count']))
	        	//$count=$balance['count'];
        	//if ($balance['success'])
        		//echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        
        		$start = $this->time_float();
        			//$data['all'] = $this->investments_model->load_investments($provider, $token);
        		$data['all'] = $this->investments_model->load_investments_batch($provider, $token);
        			//var_dump($data['all']);
        		$data['investments'] = $this->investments_model->get_investments();
        		$all_elapsed=$this->elapsed_time($start);
        		$data['all1']=0;
        		$data['title'] = 'Bondoora investeeringud';
        		$data['token'] = $token;
        		$data['investment'] = $investment;
        		$data['balance'] = '';//$bal->Balance;
        		$data['total'] = '';//$bal->TotalAvailable;
        		$data['waiting'] = '';//$bal->BidRequestAmount;
        		$data['procent'] = 2;
        		//$data['sum'] = $sum;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Laeti alla '.$data["all"]["sum"].' hetkel olemasolevat investeeringut!</div>');
        		//$this->session->set_flashdata('msg', 'Laeti alla '.$data["all"]["sum"].' hetkel olemasolevat investeeringut!');
        		$this->session->set_flashdata('msg', 'Laeti alla Bondoorast hetkel olemasolevad investeeringud');

        		if ($this->form_validation->run() === FALSE)
        		{
        			$data['riik1']=$this->input->post('riik');
        		    if (isset($data['stat'])) {
        					$data['stat1']=$this->input->post('stat');
        					$data['stat']=$this->input->post('stat');
        			}        					 
       		 		else { 
       		 				$data['stat']=-1;
       		 				$data['stat1']=-1;
       		 		}
        			$data['contr1']=$this->input->post('contr');
        			$data['score1']=$this->input->post('score');
        			$data['pik1']=$this->input->post('pik');
        			
        			$this->load->view('templates/header', $data);
        			$this->load->view('investments/index', $data);
        			$this->load->view('templates/footer');
        		} else {
        		
        		}
        		
        		//$this->load->view('templates/header', $data);
        		//$this->load->view('investments/index', $data);
        		//$this->load->view('templates/footer');
        }
}