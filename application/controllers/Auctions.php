<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auctions extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('auctions_model');
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

        
        public function auction($id = NULL)
        {
        	$token=NULL;
        	 
        	$provider=NULL;
        	$token_obj=NULL;
        	 
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
        	/*$balance = $provider->get_balance($token);
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        
        	$bal=$balance['balance'];
        	$suc=$balance['success'];
        	$err=$balance['errors'];
        	if ($balance['success'])
        		echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        	*/	 
        		$data['all']=0;
        		/*if ($filter!=NULL)
        			$data['auctions'] = $this->auctions_model->get_filter_auctions($filter);
        		else
        			$data['auctions'] = $this->auctions_model->get_auctions();*/
        		$result=$provider->get_auction($token, $id);
        		if ($result['success']) {
        			$data['auction']=$result['auction'];
        			$data['title'] = 'Bondora auction: '.$id;
        			$data['token'] = $token;
	        		//$data['filter'] = $filter;
    	    		//$data['balance'] = $bal->Balance;
        			$data['laenusumma'] = 5;
        				 
//        				if ($this->form_validation->run() === FALSE)
//        				{
        
        					$this->load->view('templates/header', $data);
        					$this->load->view('auctions/auction', $data);
        					$this->load->view('templates/footer');
        				} else {
        					
        				
        					$data['title']="Ei õnnestunud laenu andmete laadimine";
        					
        					$data['success']=$result['success'];
        					$data['errors']=$result['errors'];
        					//$data['payloads'] = $result['payload'];
        					
        					$viga="";
        					foreach ($result['errors'] as $post):
        					$viga=$viga."<strong>".$post->Message." -> Details:</strong> ".$post->Details."<br>";
        					endforeach;
        					//$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible text-center" role="alert"><br> '.$viga.'</div>');
        					$this->session->set_flashdata('msg', ''.$viga);
        					
        					//$ss=$fff;
        					//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        					$this->session->set_flashdata('redirect', 'auctions/index');
        					$this->session->set_flashdata('redirect_msg', 'Tagasi laenude nimekirja');
        					
        					$this->session->set_flashdata('redirect_back', 'auctions/download');
        					$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti laenu küsimised');
        					
        					$this->session->set_flashdata('tagasi', 1);
        					//$data['arv'] = $id;
        					$data['tagasi']=1;        				
        				
        					$this->load->view('templates/header', $data);
        					$this->load->view('auctions/notsuccess', $data);
        					$this->load->view('templates/footer');
        					 
        				}
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
        
        	/*if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        		echo "leidsin olemasoleva provideri";
        	} else {
        		$provider = $this->oauth2->providerB("Bondoora");
        		echo "provider leitud";
        	}
        		$balance = $provider->get_balance($token);
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
        	 
        		$data['all']=0;
					if ($filter!=NULL)
        				$data['auctions'] = $this->auctions_model->get_filter_auctions($filter);
					else 	
						$data['auctions'] = $this->auctions_model->get_auctions();
        			$data['title'] = 'Bondoora laenud';
        			$data['token'] = $token;
        			$data['filter'] = $filter;
        			$data['balance'] = 'Pole laetud';//$bal->Balance;
        			$data['laenusumma'] = 5;
        			
        			if ($this->form_validation->run() === FALSE)
        			{
        				$data['riik1']=$this->input->post('riik');
        				$data['pik1']=$this->input->post('pik');
        				$data['contr1']=$this->input->post('contr');
        				$data['score1']=$this->input->post('score');
        				$data['rat1']=$this->input->post('rat');
        				
        			$this->load->view('templates/header', $data);
        			$this->load->view('auctions/index', $data);
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

        	
        	$data['all'] = $this->auctions_model->load_auctions($provider, $token);
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        	$bal='';//$balance['balance'];
        	$suc='';//$balance['success'];
        	$err='';//$balance['errors'];
        	//if ($balance['success'])
        		//echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        
        
        		$data['auctions'] = $this->auctions_model->get_filter_auctions($filter);
        		$data['title'] = 'Bondoora laenud';
        		$data['token'] = $token;
        		$data['filter'] = $filter;
        		$data['balance'] = '';//$bal->Balance;
        		$data['laenusumma'] = 5;
        		//$data['sum'] = $sum;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Laeti alla '.$data['all']['sum'].' hetkel aktiivset laenupakkumist!</div>');
        		//$this->session->set_flashdata('msg', 'Laeti alla '.$data['all']['sum'].' hetkel aktiivset laenupakkumist!');
        		$this->session->set_flashdata('msg', 'Laeti alla Bondoorast hetkel aktiivsed laenupakkumised');
        		if ($this->form_validation->run() === FALSE)
        		{
        			$data['riik1']=$this->input->post('riik');
        			$data['rat1']=$this->input->post('rat');
        			$data['contr1']=$this->input->post('contr');
        			$data['score1']=$this->input->post('score');
        			$data['pik1']=$this->input->post('pik');
        			
        			$this->load->view('templates/header', $data);
        			$this->load->view('auctions/index', $data);
        			$this->load->view('templates/footer');
        		} else {
        			 
        		}
        		
        		//$this->load->view('templates/header', $data);
        		//$this->load->view('auctions/index', $data);
        		//$this->load->view('templates/footer');
        }
        
        public function makebids() {
        	 
        	$formSubmit = $this->input->post('submit');
        	/*        		if ($formSubmit == 'formAuctions') {
        	 redirect('auctions/download');
        	 } else if ($formSubmit == 'formInvestments') {
        	 redirect('investments/index');
        	 } else if ($formSubmit == 'formFilterList') {
        	 redirect('filters/index');
        	 } else if ($formSubmit == 'formFilter') {
        	 redirect('filters/edit');
        	 } else if ($formSubmit == 'formBids') {
        	 redirect('bids/download');
        	 }  else if ($formSubmit == 'formSecondary') {
        	 redirect('secondary/index');
        	 }
        	 */      		if ($formSubmit == 'formTOBid') {
        	  
        	 
        	 $this->load->model('auctions_model');
        
        	 //if ($this->input->post('countries')) {
        	 //var_dump($_POST);
        	 $idx=0;
        	 $posts=$this->auctions_model->get_post($_POST);
        	 $size=sizeof($posts);
        	 //echo "size=".$size."  laenusumma=".$_POST['laenusumma'];
        	 
        	 $bids=array();
        	 if ($size<=0)
        	 	redirect('auctions/index');
        	 
        	 foreach ($posts as $post):
        	 $idx++;
        	 if ($idx<=$size) {
        	 	//echo "idx=".$post."<br>";
        	 	$current=$this->auctions_model->get_auctions((int)$post);
        	 	$bid=array();
        	 	$bid['AuctionId']=$current['auctionId'];
        	 	$bid['Amount']=$_POST['laenusumma'];
        	 	$bid['MinAmount']=$_POST['laenusumma'];
        	 	$bids[]=$bid;
        	 }
        	 endforeach;
        	 $nn['Bids']=array($bids);
        	  
        	 $json = '{"Bids": '.json_encode($bids).'}';
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
        	 $result = $provider->make_bids($token, $json);
        	 //$result = $provider->make_bids($token, $bids);
        	 //echo "<br>*****<br>";
        	 //var_dump($result);
        	 //sleep(10);
        	 //redirect('auctions/index')
        	 if ($result['success'])
        	 {
        	 	//echo "sucecss<br>";
        	 	//redirect('investments/download');
        	 	$data['title'] = "Investeeringu pakkumiste tegemine";
        	 	//$data['id'] = $id;
        	 	//$data['arv'] = $id;
        	 	$data['success']=$result['success'];
        	 	$data['errors']=$result['errors'];
        	 	//$data['payloads'] = $result['payload'];
        	 	 
        	 	$viga="";
        	 	//        		foreach ($result['payload'] as $post):
        	 	//        		$viga=$viga.$post->Message."-> id=".$post->Details."<br>";
        	 	//        		endforeach;
        	 	//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Investeerimispakkumine �nnelikult edastatud</div>');
        	 	$this->session->set_flashdata('msg', 'Investeerimispakkumine õnnelikult edastatud');
        	 	 
        	 	//$ss=$fff;
        	 	//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        	 	$this->session->set_flashdata('redirect', 'auctions/index');
        	 	$this->session->set_flashdata('redirect_msg', 'Tagasi laenude nimekirja');
        	 	 
        	 	$this->session->set_flashdata('redirect_back', 'auctions/download');
        	 	$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti laenuküsimised');
        	 	 
        	 	$this->session->set_flashdata('tagasi', 1);
        	 	//$data['arv'] = $id;
        	 	$data['tagasi']=1;
        	 	$data['pocent']=2;
        		$data['bids']=$bids;
        		//var_dump($bids);
        	 	$this->load->view('templates/header', $data);
        	 	$this->load->view('auctions/success', $data);
        	 	$this->load->view('templates/footer');
        	 	//$data['ff']=$result1['gg'];
        	 }
        	 else {
        	 	//redirect('secondary/index');
        	 	//echo "not success<br>";
        	 	//echo "sucecss<br>";
        	 	//redirect('investments/download');
        	 	$data['title'] = "Investeeringu pakkumiste tegemine eba�nnestus";
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
        	 	$this->session->set_flashdata('msg', '<strong>Vead-></strong> '.$viga);
        	 	 
        	 	//$ss=$fff;
        	 	//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        	 	$this->session->set_flashdata('redirect', 'auctions/index');
        	 	$this->session->set_flashdata('redirect_msg', 'Tagasi laenude nimekirja');
        	 	 
        	 	$this->session->set_flashdata('redirect_back', 'auctions/download');
        	 	$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti laenu küsimised');
        	 	 
        	 	$this->session->set_flashdata('tagasi', 1);
        	 	//$data['arv'] = $id;
        	 	$data['tagasi']=1;
        	 	 
        	 	$this->load->view('templates/header', $data);
        	 	$this->load->view('auctions/notsuccess', $data);
        	 	$this->load->view('templates/footer');
        	 	//$data['ff']=$result1['gg'];
        
        	 	//redirect('investments/download');
        	 }
        	 ;
        	} else {
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Vale k�sk v�i polnud midagi m�rgitud!<br></div>');
        		$this->session->set_flashdata('msg', 'Vale käsk või polnud midagi märgitud!<br>');
        		
        		redirect('auctions/index');;
        	}
        }
        
}