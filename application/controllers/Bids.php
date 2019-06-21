<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bids extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('bids_model');
                $this->load->model('secrequest_model');
                
                $this->load->helper('url_helper');
                //$this->load->helper('url');
                $this->load->library('table');
                
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

        public function makesecbids() {
        	$formSubmit = $this->input->post('submit');
        	if ($formSubmit == 'formAuctions') {
        		redirect('auctions/download');
        	} else if ($formSubmit == 'formInvestments') {
        		redirect('investments/index');
        	} else if ($formSubmit == 'formFilterList') {
        		redirect('filters/index');
        	} else if ($formSubmit == 'formSecondaryDownload') {
        		redirect('secondary/download');
        		} else if ($formSubmit == 'formSecondary') {
        			redirect('secondary/index');
        	} else if ($formSubmit == 'formBids') {
        		redirect('bids/download');
        	}
        	 
        }
        
        public function secondarybuy() {
                				if (isset($_POST) && $this->input->post('submit')!=NULL ) 
        				{
        					$formSubmit = $this->input->post('submit');
        					//$formSubmit = $pos['submit'];
        					
        					//$dd=$ff;
        					//echo "***********<br>Bids.secondaryBuy<br>********";
        					//var_dump($_POST);
        					if ($formSubmit == 'formSecondaryDownload') {
        						redirect('secondary/download');
        					} else if ($formSubmit == 'formSecondary') {
        						redirect('secondary/index');
        					} else if ($formSubmit == 'formAuctions') {
        						redirect('auctions/index');
        					} else if ($formSubmit == 'formInvestments') {
        						redirect('investments/index');
        					} else if ($formSubmit == 'formFilterList') {
        						redirect('secrequests/index');
        					}  else if ($formSubmit == 'formFilter') {
        						redirect('secrequests/edit');
        					}  else if ($formSubmit == 'formBids') {
        						redirect('bids/download');
        					} else 
        					if ($formSubmit == 'formSecondaryFilter') {
        						$id=$this->input->post('r_id');
        						$date = date('Y-m-d H:i:s');
        						$filter= array(
        								'hasDebt' => $this->input->post('hasDebt')==1?1:0,
        								'showMyItems' => $this->input->post('showMyItems'), //1-NULL=ALL, 2-TRUE=only main, 3-FALSE other
        								'countries' => $this->input->post('countries'),
        								'ratings' => $this->input->post('ratings'),
        								'principalMax' => $this->input->post('principalMax')==''?9999:$this->input->post('principalMax'),
        								'interestMin' => $this->input->post('interestMin')==''?0:$this->input->post('interestMin'),
        								'lengthMax' => $this->input->post('lengthMax')==''?120:$this->input->post('lengthMax'),
        								'creditScoreMin' => $this->input->post('creditScoreMin')==''?0:$this->input->post('creditScoreMin'),
        								'ageMax' => $this->input->post('ageMax')==''?150:$this->input->post('ageMax'),
        								'incomeVerificationStatus' => $this->input->post('incomeVerificationStatus')==''?NULL:$this->input->post('incomeVerificationStatus'),
        								'desiredDiscountRateMax' => $this->input->post('desiredDiscountRateMax')==''?9999:$this->input->post('desiredDiscountRateMax'),
        								'xirrMin' => $this->input->post('xirrMin')==''?0:$this->input->post('xirrMin'),
        								'isLocalSearch' => 0,
        								'lastUsedTime' => $date
        						);
        						//var_dump($filter);
        						//$rr=$fff;
        						$this->secrequest_model->set_request($filter, $id);
        						redirect('secondary/download');
        					} else if ($formSubmit == 'formSecondaryLocalFilter') {
        						$id=$this->input->post('l_id');
        						 
        						//$date= date("Y-m-d");
        						//$time=date("H:m");
        						//$datetime=$date."T".$time;
        						 
        						$date = date('Y-m-d H:i:s');
        						$filter1 = array(
        								'hasDebt' => $this->input->post('l_hasDebt')==1?1:0,
        								'hasDebtSecondary' => $this->input->post('l_hasDebtSecondary')==1?1:0,
        								'countries' => $this->input->post('l_countries'),
        								'ratings' => $this->input->post('l_ratings'),
        								'principalMax' => $this->input->post('l_principalMax')==''?9999:$this->input->post('l_principalMax'),
        								'interestMin' => $this->input->post('l_interestMin')==''?0:$this->input->post('l_interestMin'),
        								'lengthMax' => $this->input->post('l_lengthMax')==''?120:$this->input->post('l_lengthMax'),
        								'creditScoreMin' => $this->input->post('l_creditScoreMin')==''?0:$this->input->post('l_creditScoreMin'),
        								'ageMax' => $this->input->post('l_ageMax')==''?150:$this->input->post('l_ageMax'),
        								'incomeVerificationStatus' => $this->input->post('l_incomeVerificationStatus')==''?NULL:$this->input->post('l_incomeVerificationStatus'),
        								'desiredDiscountRateMax' => $this->input->post('l_desiredDiscountRateMax')==''?9999:$this->input->post('l_desiredDiscountRateMax'),
        								'xirrMin' => $this->input->post('l_xirrMin')==''?0:$this->input->post('l_xirrMin'),
        								'nextPaymentNrMin' => $this->input->post('l_nextPaymentNrMin')==''?0:$this->input->post('l_nextPaymentNrMin'),
        								'isLocalSearch' => 1,
        								'lastUsedTime' => $date,
        						);
        						
        						$this->secrequest_model->set_request($filter1, $id);
        						
        						redirect('secondary/index');
        					} else {
        					
        						//formSecondaryCancel -> secondary/cancel
        					//formBuySecondary -> bids/secondarybuy
        					$this->load->model('secondary_model');
        				
        					//if ($this->input->post('countries')) {
        					//echo "POST=<br>";
        					//var_dump($_POST);
        					$idx=0;
        					$cancel=NULL;
        					$size=sizeof($_POST);
        					$bids=array();
        					if ($formSubmit=='formBuySecondary') {
        						foreach ($_POST[1] as $post):
        						$idx++;
        						if ($idx<$size) {
        							//echo "idx=".$post."<br>";
        							$current=$this->secondary_model->get_secondary((int)$post);
        							$bid=array();
        							//  	      		$bid[]=$current['secondaryId'];
        							//$bid['Amount']=5;
        							//$bid['MinAmount']=5;
        							$bids[]=$current['secondaryId'];
        						}
        						endforeach;
        						$nn['ItemIds']=array($bids);
        						 
        						$json = '{"ItemIds": '.json_encode($bids).'}';
        						//echo "<br>JSON=".$json."<br>";
        					} else if ($formSubmit=='formCancelSecondary') {
        						$current=$this->secondary_model->get_secondary((int)$_POST[1]);
        						$cancel=$current['secondaryId'];
        						//echo "cancelId=".$cancel."<br>";
        						//echo "postId=".$_POST[1]."*<br>";
        					}
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
        					if ($formSubmit=='formBuySecondary')
        						$result = $provider->buy_secondary($token, $json);
        					else  if ($formSubmit=='formCancelSecondary')
        						$result = $provider->cancel_secondary($token, $cancel);
        							//$result = $provider->make_bids($token, $bids);
        					//echo "<br>*****<br>";
        					//var_dump($result);
        					//sleep(10);
        					if ($result['success']) {
        						//echo "sucecss<br>";
        						redirect('investments/download');
        					}
        					//else {
        					//	redirect('secondary/index');
        					//}			//        		echo "not success<br>";
        								//redirect('investments/download');
        					}		
        				        	
        				}
        }
        

        public function cancel() {
        	$formSubmit = $this->input->post('submit');
        	/*if ($formSubmit == 'formBids') {
        		redirect('bids/download');
        	} else if ($formSubmit == 'formInvestments') {
        		redirect('investments/index');
        	} else if ($formSubmit == 'formAuctions') {
        		redirect('auctions/download');
        	} else if ($formSubmit == 'formFilter') {
        		redirect('filters/edit');
        	} */
        	if ($formSubmit == 'formCancelBid') {
        		 
        	//$this->load->model('auctions_model');
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
        	 
        	//if ($this->input->post('countries')) {
        	//var_dump($_POST);
        	$idx=0;
        	$posts=$this->bids_model->get_post($_POST);
        	$size=sizeof($posts);
        	$bids=array();
        	$result=array();
        	$ids=NULL;
        	if ($size>0)
        	foreach ($posts as $post):
        	$idx++;
        	
        	
        	if ($idx<=$size) {
        		//echo "idx=".$post."<br>";
        		$current=$this->bids_model->get_bids((int)$post);
        		$bid=array();
        		$id=$current['bidId'];
        		$result[] = $provider->cancel_bid($token, $id);
        		$ids[] = $current;
        		//echo "<br>*****<br>";
        		//var_dump($result);
        		
        	}
        	endforeach;
        	$data['results']=$result;
        	//var_dump($result);
        	$data['ids'] = $ids;
        	$data['title'] = "Enda investeeringute pakkumise katkestamine l�ppes j�rgmiste tulemustega";
        	//if ($result==NULL)
        		//redirect('bids/index');
        	$this->load->view('templates/header', $data);
        	$this->load->view('bids/cancel', $data);
        	$this->load->view('templates/footer');
        	
        	//$result = $provider->make_bids($token, $bids);
        	//sleep(10);
        	//redirect('bids/download');
        }
        }
        
        public function index($bid = NULL)
        {
        	$token=NULL;
        	$this->session->set_flashdata('msg','Kohalikud laenupakkumised');
        	$provider=NULL;
        	$token_obj=NULL;
        	if ($token == NULL)
        		if ($this->session->userdata('user_session')) {
        			$token = $this->session->userdata('user_session');
        		}
        
        	if ($this->session->userdata('user_provider')) {
        		$provider = $this->session->userdata('user_povider');
        		echo "leidsin olemasoleva provideri";
        	} else {
        		$provider = $this->oauth2->providerB("Bondoora");
        		echo "provider leitud";
        	}
/*        		$balance = $provider->get_balance($token);
        		//echo "eeee=".$balance['balance']->Balance;
        		//var_dump($balance['balance']);
        		$bal=$balance['balance'];
        		$suc=$balance['success'];
        		$err=$balance['errors'];
        		//$count=$balance['count'];
        		if ($balance['success'])
        			echo "BIDS token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
*/        
        			$start = $this->time_float();
        			if ($this->bids_model->get_count(0) ==0) {
						 //echo "laen bidid=<br>";       				
        				$data['all'] = $this->bids_model->load_bids($provider, $token);
        			}
        			$data['bids'] = $this->bids_model->get_bids();
        			$all_elapsed=$this->elapsed_time($start);
        			$data['all']=0;
        			 
        			$data['title'] = 'Bondoora investeeringu pakkumised';
        			$data['token'] = $token;
        			$data['bid'] = $bid;
        			//$data['balance'] = $bal->Balance;
        			$data['balance'] = 'Pole hetkel teada';
        			//$data['total'] = $bal->TotalAvailable;
        			$data['total'] = 'Pole hetkel teada';
        			//$data['waiting'] = $bal->BidRequestAmount;
        			$data['waiting'] = 'Pole hetkel teada';
        			 
        			if ($this->form_validation->run() === FALSE)
        			{
        				$data['stat1']=$this->input->post('stat');
        				 
        				$this->load->view('templates/header', $data);
        				$this->load->view('bids/index', $data);
        				$this->load->view('templates/footer');
        			} else {
        				 
        			}
        			 
        }
        
        public function download($bid = NULL)
        {
        	$token=NULL;
//echo "down-----------------------------------------------------";        	 
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
        		//echo "provider uuesti leitud";
        	}
        	$balance = $provider->get_balance($token, $this->session);
        	//$data['all'] = $this->bids_model->load_bids($provider, $token);
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        	$bal='';//$balance['balance'];
        	$suc='';//$balance['success'];
        	$err='';//$balance['errors'];
        	//if (isset($balance['count']))
	        	//$count=$balance['count'];
        	//else 
        		//echo "pole counti";
        	//if ($balance['success'])
        		//echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;
        
        		$start = $this->time_float();
        			$data['all'] = $this->bids_model->load_bids($provider, $token);
        			//var_dump($data['all']);
        		$data['bids'] = $this->bids_model->get_bids();
        		$all_elapsed=$this->elapsed_time($start);
        		$data['all1']=0;
        		$data['title'] = 'Bondoora investeeringu pakkumised';
        		$data['token'] = $token;
        		$data['bid'] = $bid;
        		$data['balance'] = '';//$bal->Balance;
        		$data['total'] = '';//$bal->TotalAvailable;
        		$data['waiting'] = '';//$bal->BidRequestAmount;
        		
        		//$data['sum'] = $sum;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Laeti alla '.$data["all"]["sum"].' hetkel olemasolevat investeeringu pakkumist!</div>');
        		$this->session->set_flashdata('msg', 'Laeti alla '.$data["all"]["sum"].' hetkel olemasolevat investeeringu pakkumist!');
        		
        		if ($this->form_validation->run() === FALSE)
        			{
        				$data['stat1']=$this->input->post('stat');
        				 
        				$this->load->view('templates/header', $data);
        				$this->load->view('bids/index', $data);
        				$this->load->view('templates/footer');
        			} else {
        				 
        			}
        }
}