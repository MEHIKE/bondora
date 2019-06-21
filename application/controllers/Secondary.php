<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Secondary extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('secondary_model');
                $this->load->model('secrequest_model');
                
                $this->load->helper('url_helper');
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

        public function loanpart($id =NULL) {
        	$token=NULL;
        	//echo "**********<br>POST<br>";
        	//var_dump($_POST);
        	//else
        	//{
        	//$ff=$rr;
        		//echo "**********<b>POST<br>";
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
        		$balance = $provider->get_balance($token, $this->session);

        		
        		//echo "eeee=".$balance['balance']->Balance;
        		//var_dump($balance['balance']);
        	
        		/*if ($balance['success']) {
        			$bal=$balance['balance'];
        			$suc=$balance['success'];
        			$err=$balance['errors'];
        		} else {
        			$bal='';
        			$suc=$balance['success'];;
        			$err=$balance['errors'];
        			 
        		}*/
        		//if ($balance['success'])
        		//	echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;

        			$data['title'] = 'Bondoora Secondary Market';
        			$data['token'] = $token;
        			//$data['filter'] = $filter;
        			/*if ($balance['success'])
        				$data['balance'] = $bal->Balance;
        			else 
        				$data['balance'] = '';*/
        			 
        			$loanpart = $provider->get_loanpart($token, $id);
        			
        			if ($loanpart['success']) {
						$data['loanpart']=$loanpart['loanpart'];
						$data['id']=$id;
        				//var_dump($data['loanpart']);
        				$this->load->view('templates/header', $data);
        				$this->load->view('secondary/loanpart', $data);
        				$this->load->view('templates/footer');
        			} else {
        				$data['title']="Ei õnnestunud laenuosa andmete laadimine";
        				 
        				$data['success']=$loanpart['success'];
        				$data['errors']=$loanpart['errors'];
        				//$data['payloads'] = $result['payload'];
        				 
        				$viga="";
        				foreach ($loanpart['errors'] as $post):
        				$viga=$viga."<strong>".$post->Message." -> Details:</strong> ".$post->Details."<br>";
        				endforeach;
        				//$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible text-center" role="alert"><br> '.$viga.'</div>');
        				$this->session->set_flashdata('msg', ''.$viga);
        				 
        				//$ss=$fff;
        				//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Kas kustutada filter?  Kustutame rea (nimi->kirjeldus)='.$data['nam']."->".$data['desc'].'</div>');
        				$this->session->set_flashdata('redirect', 'secondary/index');
        				$this->session->set_flashdata('redirect_msg', 'Tagasi järelturu nimekirja');
        				 
        				$this->session->set_flashdata('redirect_back', 'secondary/download');
        				$this->session->set_flashdata('redirect_back_msg', 'Lae bondoorast uuesti järelturg');
        				 
        				$this->session->set_flashdata('tagasi', 0);
        				//$data['arv'] = $id;
        				$data['tagasi']=1;
        				
        				$this->load->view('templates/header', $data);
        				$this->load->view('secondary/notsuccess', $data);
        				$this->load->view('templates/footer');
        				
        			}
        }
        
        public function index($filter = NULL)
        {
        	$token=NULL;
        	//echo "**********<br>POST<br>";
        	//var_dump($_POST);
        	//else 
//        	$this->session->set_flashdata('msg','Kohalik Second Market');
        	{
        	//echo "**********<b>POST<br>";
        	$provider=NULL;
        	$token_obj=NULL;
        	
        	$current_url=current_url();
        	get_instance()->session->set_userdata('current_url', $current_url);
        	
        	if ($token == NULL)
        		if ($this->session->userdata('user_session')) {
        			$token = $this->session->userdata('user_session');
        		}
        
/*        	if ($this->session->userdata('user_provider')) {
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
				$data['all']=0;   
        		$data['localfilter'] = $this->secrequest_model->get_last_filter(1);
        		$data['filter'] = $this->secrequest_model->get_last_filter(0);
        		//var_dump($data['filter']);
        		if (!(isset($_POST) && $this->input->post('submit')!=NULL)) {
					if ($data['localfilter']!=NULL && $data['filter']['showMyItems']!='true')
        				$data['secondarys'] = $this->secondary_model->get_filter_secondary($data['localfilter'], $data['filter']);
					else
						$data['secondarys'] = $this->secondary_model->get_secondary();
        		}
        			$data['title'] = 'Bondoora Secondary Market';
        			$data['token'] = $token;
        			//$data['filter'] = $filter;
        			//$data['balance'] = $bal->Balance;
        			$data['balance'] = 'Pole hetkel teada';
        			if ($this->form_validation->run() === FALSE)
        			{
        				//echo "-----------------------------------<br>";
        				//var_dump($_POST);
        					 
        				if (isset($_POST) && $this->input->post('submit')!=NULL ) 
        				{
        					$formSubmit = $this->input->post('submit');
        					//$formSubmit = $pos['submit'];
        					
        					//$dd=$ff;
        					//echo "***********<br>Bids.secondaryBuy<br>********";
        					//var_dump($_POST);
        					$user=$this->session->userdata('username');
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
        					} else if ($formSubmit == 'formSecondaryFilter') {
        						$id=$this->input->post('r_id');
        						$date = date('Y-m-d H:i:s');
        						$filter= array(
        								'hasDebt' => $this->input->post('hasDebt')==1?1:0,
        								'showMyItems' => ($this->input->post('showMyItems'))==''?'false':$this->input->post('showMyItems'), //1-NULL=ALL, 2-TRUE=only main, 3-FALSE other
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
        								'lastUsedTime' => $date,
        								'userName' => $user
        						);
        						//var_dump($filter);
        						//$rr=$fff;
        						$this->secrequest_model->set_request($filter, $id);
        						redirect('secondary/download');
        					} else if ($formSubmit == 'formSecondaryLocalFilter') {
        						$lid=$this->input->post('l_id');
        						 
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
        								'loanStatusCode' => $this->input->post('l_loanstatus'),
        								'userName' => $user,
        						);
//var_dump($filter1);        						
        						$this->secrequest_model->set_request($filter1, $lid);
        						$data['localfilter'] = $this->secrequest_model->get_last_filter(1);
        						$data['filter'] = $this->secrequest_model->get_last_filter(0);
        						
        						
        						//redirect('secondary/index');
        					} else {
        					
        						//formSecondaryCancel -> secondary/cancel
        					//formBuySecondary -> bids/secondarybuy
        					$this->load->model('secondary_model');
        				
        					//if ($this->input->post('countries')) {
        					//echo "POST=<br>";
        					//var_dump($_POST);
        					$idx=0;
        					$cancel=NULL;
        					$bids=array();
        					$arr=$this->secondary_model->get_post($_POST);
        					$size=sizeof($arr);
        					 
        					if ($formSubmit=='formBuySecondary') {
        						if (sizeof($arr)>0)
        						foreach ($arr as $post):
        						$idx++;
        						if ($idx<=$size) {
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
        						$arr=$this->secondary_model->get_post($_POST);
        						
        						$current=$this->secondary_model->get_secondary((int)$arr[0]);
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
        						//redirect('investments/download');
        						//var_dump($result);
        						$teade="";
        						//foreach ($result['errors'] as $post):
        							//$teade=$teade.$post->Message."-> id=".$post->Details."<br>";
        						//endforeach;
        						//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Second Marketi ost �nnestus!<br> '.$teade.'</div>');
        						$this->session->set_flashdata('msg', 'Second Marketi ost õnnestus!<br> '.$teade);
        						
        					}
        					else {
        					//	redirect('secondary/index');
								$viga="";
								foreach ($result['errors'] as $post):
									$viga=$viga.$post->Message."-> id=".$post->Details."<br>";
								endforeach;
        						//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Vead-><br> '.$viga.'</div>');
								$this->session->set_flashdata('msg', 'Vead-><br> '.$viga);
        					}			//        		echo "not success<br>";
        								//redirect('investments/download');
        					}		
        					if ($data['localfilter']!=NULL && $data['filter']['showMyItems']!='true')
        						$data['secondarys'] = $this->secondary_model->get_filter_secondary($data['localfilter'], $data['filter']);
        					else
        						$data['secondarys'] = $this->secondary_model->get_secondary();
        							 
        				}
        				
        				$data['count']=count($data['secondarys']);
        				$this->session->set_flashdata('msg','Kohalik Second Market: '.$data['count']."tk.");
        				
        			$this->load->view('templates/header', $data);
        			$this->load->view('secondary/index', $data);
        			$this->load->view('templates/footer');
        			} else {
        			}
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
        	$balance = $provider->get_balance($token, $this->session);
	
        	//********************************
        	
        	//var_dump($_POST);
        	
        	if (isset($_POST) && $this->input->post('submit')!=NULL )
        	{
        		$formSubmit = $this->input->post('submit');
        		//$formSubmit = $pos['submit'];
        		 
        		//$dd=$ff;
        		//echo "***********<br>Bids.secondaryBuy<br>********";
        		//var_dump($_POST);
        		$user=$this->session->userdata('username');
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
        		} else if ($formSubmit == 'formSecondaryFilter') {
        			$id=$this->input->post('r_id');
        			$date = date('Y-m-d H:i:s');
        			$filter= array(
        					'hasDebt' => $this->input->post('hasDebt')==1?1:0,
        					'showMyItems' => ($this->input->post('showMyItems')=='')?'false':$this->input->post('showMyItems'), //1-NULL=ALL, 2-TRUE=only main, 3-FALSE other
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
        					'lastUsedTime' => $date,
        					'userName' => $user
        			);
        			//var_dump($filter);
        			//$rr=$fff;
        			$this->secrequest_model->set_request($filter, $id);
        			//redirect('secondary/download');
        		} else if ($formSubmit == 'formSecondaryLocalFilter') {
        			$lid=$this->input->post('l_id');
        	
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
        					'userName' => $user
        			);
        			//var_dump($filter1);
        			$this->secrequest_model->set_request($filter1, $lid);
        	
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
        			$bids=array();
        			$arr=$this->secondary_model->get_post($_POST);
        			$size=sizeof($arr);
        	
        			if ($formSubmit=='formBuySecondary') {
        				if ($arr>0)
        					foreach ($arr as $post):
        					$idx++;
        					if ($idx<=$size) {
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
        				$arr=$this->secondary_model->get_post($_POST);
        	
        				$current=$this->secondary_model->get_secondary((int)$arr[0]);
        				$cancel=$current['secondaryId'];
        				//echo "cancelId=".$cancel."<br>";
        				//echo "postId=".$_POST[1]."*<br>";
        			}
        			/*        					$token=NULL;
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
        			 */
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
        			 		else {
        			 			//	redirect('secondary/index');
        			 			$viga="";
        			 			foreach ($result['errors'] as $post):
        			 			$viga=$viga.$post->Message."-> id=".$post->Details."<br>";
        			 			endforeach;
        			 			//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Vead-><br> '.$viga.'</div>');
        			 			$this->session->set_flashdata('msg', 'Vead-><br> '.$viga);
        			 		}			//        		echo "not success<br>";
        			 		//redirect('investments/download');
        		}
        		 
        	}
        	//********************************
        	
        	$filterarray=$this->secrequest_model->get_remote_filter();
        	if ($filterarray==NULL) 
        		$filterarray=array(
        			'ShowMyItems' => 'false', 
        			'Countries' => 'EE', 
        			'AgeMax' => 50, 
        			'PrincipalMax' => 5, 
        			'CreditScoreMin' => 900, 
        			'HasDebt' => 'false', 
        			'InterestMin' => 20, 
        			'XirrMin' => 20, 
        			'LenghtMax' => 60,
//        			'Ratings' => 'AA,A,B,C,D,E,F,HR',
        			'DesiredDiscountRateMax' => 5
        				
        		);
        		//echo "filterarray=<br>---------------";
        		//var_dump($filterarray);
        	//$data['all'] = $this->secondary_model->load_secondary($provider, $token, $filterarray);
        		$data['localfilter'] = $this->secrequest_model->get_last_filter(1);
        		$data['filter'] = $this->secrequest_model->get_last_filter(0);
        		if (!isset($filterarray['ShowMyItems']) || $filterarray['ShowMyItems']=='true')// || $filterarray['ShowMyItems']=='')
        			$this->secondary_model->load_secondary_batch($provider, $token, array('ShowMyItems' => 'true'));
        		else {
        			$data['all_my']=$this->secondary_model->load_secondary_batch($provider, $token, array('ShowMyItems' => 'true'));
        			$data['all'] = $this->secondary_model->load_secondary_batch($provider, $token, $filterarray);
        		}
        		//$ee=$rr;
//        	$data['all'] = $this->secondary_model->load_secondary($provider, $token, array('ShowMyItems' => 'true'));
        	//echo "eeee=".$balance['balance']->Balance;
        	//var_dump($balance['balance']);
        	$bal='';//$balance['balance'];
        	$suc='';//$balance['success'];
        	$err='';//$balance['errors'];
        	//if ($balance['success'])
        		//echo "token=".$token."   palanss=".($bal->Balance)."   totalAvaible=".$bal->TotalAvailable."  bidRequest=".$bal->BidRequestAmount;

        		//$data['all']=0;
        		//var_dump($data['filter']);
        		if ($data['localfilter']!=NULL && $data['filter']['showMyItems']!='true')
        			$data['secondarys'] = $this->secondary_model->get_filter_secondary($data['localfilter'],$data['filter']);
        		else if ($data['localfilter']!=NULL && $data['filter']['showMyItems']=='true') {
        			//$this->secondary_model->setMy();
        			$data['secondarys'] = $this->secondary_model->get_secondary();
        		} else {	
        			//$this->secondary_model->setMy();
        			$data['secondarys'] = $this->secondary_model->get_secondary();
        		}
        		$data['title'] = 'Bondoora Second Market';
        		$data['token'] = $token;
        		//$data['filter'] = $filter;
        		$data['balance'] = $bal->Balance;
        		//$data['sum'] = $sum;
        		//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Laeti alla '.$data['all']['sum'].' hetkel aktiivset pakkumist Secondary Marketis!</div>');
        		$this->session->set_flashdata('msg', 'Laeti alla '.$data['all']['sum'].' hetkel aktiivset pakkumist Secondary Marketis!');

        		if ($this->form_validation->run() === FALSE)
        		{
        			//echo "-----------------------------------<br>";

        			//******************************************
        			redirect("secondary/index");
        			$this->load->view('templates/header', $data);
        			$this->load->view('secondary/index', $data);
        			$this->load->view('templates/footer');
        		} else {
        		}
        		
        		//$this->load->view('templates/header', $data);
        		//$this->load->view('secondary/index', $data);
        		//$this->load->view('templates/footer');
        }
}