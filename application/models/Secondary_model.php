<?php
class Secondary_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_secondary($id = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
//        		$query = $this->db->get('secondary');
        		$query = $this->db->query('SELECT secondary.*, auction_payload.age,period_diff(date_format(now(), "%Y%m"), date_format(signedDate, "%Y%m")) as months'.
        				' FROM secondary LEFT JOIN auction_payload ON auction_payload.auctionId=secondary.auctionId and auction_payload.user=secondary.user where secondary.user="'.$user.'" group by secondary.loanPartId order by secondary.auctionId');
        		
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
//        		$query = $this->db->get('secondary');
        		$query = $this->db->query('SELECT secondary.*, auction_payload.age,period_diff(date_format(now(), "%Y%m"), date_format(signedDate, "%Y%m")) as months'.
        				' FROM secondary LEFT JOIN auction_payload ON auction_payload.auctionId=secondary.auctionId and auction_payload.user=secondary.user where secondary.user="'.$user.'" group by secondary.loanPartId order by secondary.auctionId');
        		
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('secondary', array('id' => $id));
        	return $query->row_array();
        }

        public function setMy() {
        	
        }
        
        public function getTime($time=NULL) {
        	if ($time==NULL || $time=='')
        		return '';
        	return str_replace("T"," ",substr($time,0,19));
        }
        
        public function get_filter_secondary($lfilter = FALSE, $rfilter = NULL)
        {   
        	$user=$this->session->userdata('username');
        	//$this->output->enable_profiler(TRUE);
        	//echo "id==".$filter;
        	//echo "**********<br>get_filter_secondary<br>************";
        	//var_dump($filter);
        	if ($lfilter === FALSE)
        	{
        		//$query = $this->db->get('secondary');
        		$query = $this->db->query('SELECT secondary.*, auction_payload.age,period_diff(date_format(now(), "%Y%m"), date_format(signedDate, "%Y%m")) as months'.
				' FROM secondary LEFT JOIN auction_payload ON auction_payload.auctionId=secondary.auctionId and auction_payload.user=secondary.user where user="'.$user.'" group by secondary.loanPartId order by secondary.auctionId');
        		return $query->result_array();
        	}
        
        	if ($lfilter == NULL || ($rfilter!=NULL && $rfilter['showMyItems']=='true')) {
        		$this->db->distinct();
//        		$query = $this->db->get('secondary');
        		$query = $this->db->query('SELECT secondary.*, auction_payload.age,period_diff(date_format(now(), "%Y%m"), date_format(signedDate, "%Y%m")) as months'.
        				' FROM secondary LEFT JOIN auction_payload ON auction_payload.auctionId=secondary.auctionId and auction_payload.user=secondary.user where user="'.$user.'" group by secondary.loanPartId order by secondary.auctionId');
        		
        		//$query = $this->db->
        	}
        	else {
        		if ($lfilter!=NULL) {
        			//       			if ($filter['ageMax']>0)   //DateOfBirth peaks arvutama
        			//       				$this->db->where('age >',$filter['ageMax']);
        			$this->db->select('secondary.*,auction_payload.age,period_diff(date_format(now(), "%Y%m"), date_format(signedDate, "%Y%m")) as months')->group_start();
						$this->db->where('secondary.user', $user);
        				if ($lfilter['countries']!='')
        					$this->db->where_in('secondary.country', explode(',',$lfilter['countries']));
        				if ($lfilter['principalMax']>0)
        					$this->db->where('secondary.amount <=',$lfilter['principalMax']);
        				if ($lfilter['creditScoreMin']>0)
        					$this->db->where('secondary.creditScore >=',$lfilter['creditScoreMin']);
        				if ($lfilter['hasDebt']==1) {
        					$this->db->where('secondary.debtOccuredOn !=', NULL);
        				} else {
        					$this->db->where('secondary.debtOccuredOn', NULL);
        				}
        				if ($lfilter['hasDebtSecondary']==1) {
        					$this->db->where('secondary.debtOccuredOnForSecondary !=', NULL);
        				} else {
        					$this->db->where('secondary.debtOccuredOnForSecondary', NULL);
        				}
        				
        				if ($lfilter['interestMin']>0)
        					$this->db->where('secondary.interest >=',$lfilter['interestMin']);
        				if ($lfilter['xirrMin']>0)
        					$this->db->where('secondary.xirr >=',$lfilter['xirrMin']);
        				if ($lfilter['desiredDiscountRateMax']!='')
        					$this->db->where('secondary.desiredDiscountRate <=',$lfilter['desiredDiscountRateMax']);
        				if ($lfilter['incomeVerificationStatus']>0)
        					$this->db->where('secondary.incomeVerificationStatus',$lfilter['incomeVerificationStatus']);
        				if ($lfilter['lengthMax']>0)
        					$this->db->where('secondary.nrOfScheduledPayments <=',$lfilter['lengthMax']);
        				if ($lfilter['ratings']>0)
        					$this->db->where_in('secondary.rating ',explode(',',$lfilter['ratings']));
        				if ($lfilter['nextPaymentNrMin']>0)
        					$this->db->where('secondary.nextPaymentNr >=',$lfilter['nextPaymentNrMin']);
        				if ($lfilter['loanStatusCode']>0)
        					$this->db->where_in('secondary.loanStatusCode ',$lfilter['loanStatusCode']);
        						 
        				$this->db->group_end();
        				//$this->db->group_start();
        				//$this->db->group_start()->or_where('secondary.isMy' , 1);
        				//$this->db->where('secondary.user' , $user);
        				//$this->db->group_end();
        				$this->db->or_where(' ( secondary.isMy=1 and secondary.user="'.$user.'") ');
        				$this->db->join('auction_payload','auction_payload.auctionId=secondary.auctionId and auction_payload.user=secondary.user', 'left');
        				//$this->fb->group_by('secondary.loanPartId');
        				$this->db->order_by('userName, signedDate DESC');
        				
        		}
        		$query = $this->db->get('secondary');
        		//echo "*********<br>";
        		//print_r($query);
        		//echo "*********<br>";
        		
        	}
       	    $tulemus = $this->filterArray($query->result_array());
       		return $tulemus;
        }
        
        public function filterArray($arr=NULL) {
        	//var_dump($arr);
        	return $arr;
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
        
        public function record_count() {
        	return $this->db->count_all("secondary");
        }
        
        public function record_count_filter($filter = NULL) {
        	$user=$this->session->userdata('username');
        	if ($filter!=NULL) {
//       			if ($filter['ageMax']>0)   //DateOfBirth peaks arvutama
//       				$this->db->where('age >',$filter['ageMax']);
       			if ($filter['countries']!='')
       				$this->db->where_in('country', explode(',',$filter['countries']));
       			if ($filter['principalMax']>0)
       				$this->db->where('amount <=',$filter['principalMax']);
       			if ($filter['creditScoreMin']>0)
       				$this->db->where('creditScore >=',$filter['creditScoreMin']);
       			if ($filter['hasDebt']==1) {
       				$this->db->where('debtOccuredOn !=', NULL);
       			} else {
       				$this->db->where('debtOccuredOn', NULL);
       			}
       			if ($filter['hasDebtSecondary']==1) {
       				$this->db->where('debtOccuredOnForSecondary !=', NULL);
       			} else {
       				$this->db->where('debtOccuredOnForSecondary', NULL);
       			}
       			
       			if ($filter['interestMin']>0)
       				$this->db->where('interest >=',$filter['interestMin']);
       			if ($filter['xirrMin']>0)
       				$this->db->where('xirr >=',$filter['xirrMin']);
       			if ($filter['desiredDiscountRateMax']>0)
       				$this->db->where('desiredDiscountRate <=',$filter['desiredDiscountRateMax']);
       			if ($filter['incomeVerificationStatus']>0)
       				$this->db->where('incomeVerificationStatus',$filter['incomeVerificationStatus']);
       			if ($filter['lengthMax']>0)
       				$this->db->where('nrOfScheduledPayments <=',$filter['lengthMax']);
       			if ($filter['ratings']>0)
       				$this->db->where_in('rating <=',explode(',',$filter['ratings']));
       			if ($filter['nextPaymentNrMin']>0)
       				$this->db->where('nextPaymentNr >=',$filter['nextPaymentNrMin']);
        	}
        	return $this->db->count_all("secondary");
        }
        
        public function truncate() {
        	$this->db->truncate('secondary');
        }
        
        
        public function load_secondary($provider = NULL, $token = NULL, $filter = NULL) {
        	$start = $this->time_float();
        	$this->del_secondary(0);
        	$down_start = $this->time_float();
        	$tulemus = $provider->get_secondary($token, $filter);
        	$down_elapsed=$this->elapsed_time($down_start);
        	$secondaries = $tulemus['secondary'];
        	$id=0;
        	$save_start=$this->time_float();
        	foreach ($secondaries as $secondary):
        		//var_dump($auction);
        		$id++;
        		if ($this->set_secondary(0, $secondary) == 1) {
        			//echo "<br>";
        			//echo $id.". auctionId=".$auction->AuctionId."    SALVESTATUD";
        			 
        		}
        	endforeach;
        	$save_elapsed=$this->elapsed_time($save_start);
        	$all_elapsed=$this->elapsed_time($start);
        	$data['sum']=$id;
        	$data['all_time']=$all_elapsed;
        	$data['down_time']=$down_elapsed;
        	$data['save_time']=$save_elapsed;
        	return $data;
        }

        public function load_secondary_batch($provider = NULL, $token = NULL, $filter = NULL) {
        	$start = $this->time_float();
        	if (isset($filter['ShowMyItems']))
        		$isMy=$filter['ShowMyItems']=='true'?1:0;
        	else 
        		$isMy=0;
        	//if (isset($filter['showMyItems'])) 
        	//	$isMy=$filter['showMyItems']=='true'?1:0;
        	$this->del_secondary(0, $isMy);  //kui laetakse minu asjad, sisi kusutab alt k�ik, vastasel juhul ena omi ei kustutata
        	$down_start = $this->time_float();
        	$tulemus = $provider->get_secondary($token, $filter);
        	//var_dump($tulemus);
        	//echo $ss;
        	//echo ($tulemus);
        	//$client = $this->oauth2->client("Client");
        	/*$api = $this->oauth2->api("Api",'');
        	//$api = $this->bondoraApi->api("Api");
        	$api->set_token($token);
        	
        	$tul=$api->secondaryMarket($filter);
        	echo "uus filter=<br>";
        	var_dump($filter);
        	echo "uus tulemus=<br>";
        	var_dump($tul);     
        	*/
        	//$ff=$jj;
        	$down_elapsed=$this->elapsed_time($down_start);
        	$secondaries = $tulemus['secondary'];
        	$id=0;
        	$save_start=$this->time_float();
        	//$data=NULL;
        	foreach ($secondaries as $secondary):
        	//var_dump($secondary);
        		$id++;
        	$dat=$this->set_secondary_batch($secondary, $isMy);
        	if ($dat!=NULL)
       			$data[]=$dat;
       // 		$data[]=$this->set_secondary_array_batch($secondary, $isMy);
        	//if ($this->set_secondary(0, $secondary) == 1) {
        		//echo "<br>";
        		//echo $id.". auctionId=".$auction->AuctionId."    SALVESTATUD";
        
        	//}
        	endforeach;
        	
        	//$ee=$hh;
        	if (isset($data) && $data!=NULL) {
        		//var_dump($data);
        		$this->db->insert_batch('secondary', $data);
        		//echo 'isMy='.$isMy.'<br>';
        		//var_dump($data);
        	}
        	else 
        		sleep(1);
        	$save_elapsed=$this->elapsed_time($save_start);
        	$all_elapsed=$this->elapsed_time($start);
        	//$ee=$hh;
        	$data['sum']=$id;
        	$data['all_time']=$all_elapsed;
        	$data['down_time']=$down_elapsed;
        	$data['save_time']=$save_elapsed;
        	return $data;
        }
        
        public function get_post($posts = NULL) {
        	$size=sizeof($posts);
        	$idx=0;
        	$arr=NULL;
        	foreach ($posts as $key => $post):
        	//while ($post = current($posts)) {
        	$idx++;
        	//echo "key=".$key."  num=".$post."   calc=".substr($key,2,strlen($key)-2)."<br>";
        	 
        	if (substr($key,0,2)=='id' && substr($key,0,3)!='idx') {
        		$arr[]=substr($key,2,strlen($key)-2);
        		//echo "key=".key($posts)."  num=".$post."   calc=".substr(key($posts),3,strlen(key($posts))-2)."<br>";
        		//echo "lisatud = ".substr($key,2,strlen($key)-2)."<b>";
        		//$current=$this->secondary_model->get_secondary((int)$post);
        		//$bid=array();
        		//  	      		$bid[]=$current['secondaryId'];
        		//$bid['Amount']=5;
        		//$bid['MinAmount']=5;
        		//$bids[]=$current['secondaryId'];
        	}
        	//next($posts);
        	//}
        	endforeach;
        	//echo "lopp<br>";
        	return $arr;
        }
        
        public function del_secondary($id = FALSE, $isMy = 0)
        {
        	$user=$this->session->userdata('username');
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		//$query = $this->db->get('auction_filter_adv');
        		//return $query->result_array();
        	}
        
        	if ($id == 0) {
        		//$this->db->distinct();
        		//$query = $this->db->get('auction_filter_adv');
        		//$query = $this->db->
        		if ($isMy==1) {
        			$this->db->delete('secondary', array('user' => $user, 'isMy' => $isMy));
        			//$this->db->truncate('secondary'); //kui minu omad, sisi kusutame k�ik
        			//echo "Kuna minu omad, sisi kustutan k�ik<br>";;
        		}
        		else {
        			$this->db->delete('secondary', array('isMy' => $isMy, 'user' => $user));  //kui pole minu omad, sisi minu omad j�tame alles
        			//echo "Kuna pole minu omad, sisi kustutan k�ik peale minu oamde, millel on is_my=0<br>";;
        		}
        		//$this->db->empty_table('auction_payload');
        		//$this->db->delete('auction_payload');
        	}
        	else
        		$this->db->delete('secondary', array('id' => $id, 'user' => $user));
        		//return $query->row_array();
        }

        public function set_secondary_batch($secondary = null, $isMy=0)
        {
        	$user=$this->session->userdata('username');
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	 
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	 //var_dump($secondary);
        	 
        	$data = array(
        			 
        			'secondaryId' => $secondary->Id,
        			'loanPartId' => $secondary->LoanPartId,
        			'amount' => $secondary->Amount,
        			'auctionId' => $secondary->AuctionId,
        			'user' => $user,
        			'auctionName' => $secondary->AuctionName,
        			'auctionNumber' => $secondary->AuctionNumber,
        			'auctionBidNumber' => $secondary->AuctionBidNumber,
        			'country' => $secondary->Country,
        			'creditScore' => $secondary->CreditScore,
        			'rating' => $secondary->Rating,
        			'interest' => $secondary->Interest,
        			'useOfLoan' => $secondary->UseOfLoan,
        			'incomeVerificationStatus' => $secondary->IncomeVerificationStatus,
        			'loanStatusCode' => $secondary->LoanStatusCode,
        			'userName' => $secondary->UserName,
        			'gender' => $secondary->Gender,
        			'dateOfBirth' => $secondary->DateOfBirth,
        			'signedDate' => $secondary->SignedDate,
        			'reScheduledOn' => $secondary->ReScheduledOn,
        			'debtOccuredOn' => $secondary->DebtOccuredOn==''?NULL:$secondary->DebtOccuredOn,
        			'debtOccuredOnForSecondary' => $secondary->DebtOccuredOnForSecondary==''?NULL:$secondary->DebtOccuredOnForSecondary,
        			'nextPaymentNr' => $secondary->NextPaymentNr,
        			'nextPaymentDate' => $secondary->NextPaymentDate,
        			'nextPaymentSum' => $secondary->NextPaymentSum,
        			'nrOfScheduledPayments' => $secondary->NrOfScheduledPayments,
        			'principalRepaid' => $secondary->PrincipalRepaid,
        			'interestRepaid' => $secondary->InterestRepaid,
        			'lateAmountPaid' => $secondary->LateAmountPaid,
        			'principalRemaining' => $secondary->PrincipalRemaining,
        			'principalLateAmount' => $secondary->PrincipalLateAmount,
        			'interestLateAmount' => $secondary->InterestLateAmount,
        			'penaltyLateAmount' => $secondary->PenaltyLateAmount,
        			'lateAmountTotal' => $secondary->LateAmountTotal,
        			'price' => $secondary->Price,
        			'fee' => $secondary->Fee,
        			'totalCost' => $secondary->TotalCost,
        			'outstandingPayments' => $secondary->OutstandingPayments,
        			'desiredDiscountRate' => $secondary->DesiredDiscountRate,
        			'xirr' => $secondary->Xirr,
        			'listedOnDate' => $secondary->ListedOnDate,
        			'isMy' => $isMy,
        			'lastPaymentDate' => $secondary->LastPaymentDate,
        			'loanStatusActiveFrom' => $secondary->LoanStatusActiveFrom,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
/*        	if ($id == 0)
        		return $this->db->insert('secondary', $data);
        		else {
        			$this->db->where('id', $this->input->post('id'));
        			return $this->db->update('secondary', $data);
        		}*/
			return $data;
        }
        
        public function set_secondary_array_batch($secondary = null, $isMy=0)
        {
        	$user=$this->session->userdata('username');
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	//var_dump($secondary);
        
        	$data = array(
        
        			'secondaryId' => $secondary['Id'],
        			'loanPartId' => $secondary['LoanPartId'],
        			'amount' => $secondary['Amount'],
        			'auctionId' => $secondary['AuctionId'],
        			'user' => $user,
        			'auctionName' => $secondary['AuctionName'],
        			'auctionNumber' => $secondary['AuctionNumber'],
        			'auctionBidNumber' => $secondary['AuctionBidNumber'],
        			'country' => $secondary['Country'],
        			'creditScore' => $secondary['CreditScore'],
        			'rating' => $secondary['Rating'],
        			'interest' => $secondary['Interest'],
        			'useOfLoan' => $secondary['UseOfLoan'],
        			'incomeVerificationStatus' => $secondary['IncomeVerificationStatus'],
        			'loanStatusCode' => $secondary['LoanStatusCode'],
        			'userName' => $secondary['UserName'],
        			'gender' => $secondary['Gender'],
        			'dateOfBirth' => $secondary['DateOfBirth'],
        			'signedDate' => $secondary['SignedDate'],
        			'reScheduledOn' => $secondary['ReScheduledOn'],
        			'debtOccuredOn' => $secondary['DebtOccuredOn']==''?NULL:$secondary['DebtOccuredOn'],
        			'debtOccuredOnForSecondary' => $secondary['DebtOccuredOnForSecondary']==''?NULL:$secondary['DebtOccuredOnForSecondary'],
        			'nextPaymentNr' => $secondary['NextPaymentNr'],
        			'nextPaymentDate' => $secondary['NextPaymentDate'],
        			'nextPaymentSum' => $secondary['NextPaymentSum'],
        			'nrOfScheduledPayments' => $secondary['NrOfScheduledPayments'],
        			'principalRepaid' => $secondary['PrincipalRepaid'],
        			'interestRepaid' => $secondary['InterestRepaid'],
        			'lateAmountPaid' => $secondary['LateAmountPaid'],
        			'principalRemaining' => $secondary['PrincipalRemaining'],
        			'principalLateAmount' => $secondary['PrincipalLateAmount'],
        			'interestLateAmount' => $secondary['InterestLateAmount'],
        			'penaltyLateAmount' => $secondary['PenaltyLateAmount'],
        			'lateAmountTotal' => $secondary['LateAmountTotal'],
        			'price' => $secondary['Price'],
        			'fee' => $secondary['Fee'],
        			'totalCost' => $secondary['TotalCost'],
        			'outstandingPayments' => $secondary['OutstandingPayments'],
        			'desiredDiscountRate' => $secondary['DesiredDiscountRate'],
        			'xirr' => $secondary['Xirr'],
        			'listedOnDate' => $secondary['ListedOnDate'],
        			'isMy' => $isMy,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        		/*        	if ($id == 0)
        		 return $this->db->insert('secondary', $data);
        		 else {
        		 $this->db->where('id', $this->input->post('id'));
        		 return $this->db->update('secondary', $data);
        		 }*/
        		return $data;
        }
        
        public function set_secondary($id = FALSE, $secondary = null)
        {
        	$user=$this->session->userdata('username');
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	
        	
        	$data = array(
        			
        			'secondaryId' => $secondary->Id,
        			'loanPartId' => $secondary->LoanPartId,
        			'amount' => $secondary->Amount,
        			'auctionId' => $secondary->AuctionId,
        			'user' => $user,
        			'auctionName' => $secondary->AuctionName,
        			'auctionNumber' => $secondary->AuctionNumber,
        			'auctionBidNumber' => $secondary->AuctionBidNumber,
        			'country' => $secondary->Country,
        			'creditScore' => $secondary->CreditScore,
        			'rating' => $secondary->Rating,
        			'interest' => $secondary->Interest,
        			'useOfLoan' => $secondary->UseOfLoan,
        			'incomeVerificationStatus' => $secondary->IncomeVerificationStatus,
        			'loanStatusCode' => $secondary->LoanStatusCode,
        			'userName' => $secondary->UserName,
        			'gender' => $secondary->Gender,
        			'dateOfBirth' => $secondary->DateOfBirth,
        			'signedDate' => $secondary->SignedDate,
        			'reScheduledOn' => $secondary->ReScheduledOn,
        			'debtOccuredOn' => $secondary->DebtOccuredOn==''?NULL:$secondary->DebtOccuredOn,
        			'debtOccuredOnForSecondary' => $secondary->DebtOccuredOnForSecondary==''?NULL:$secondary->DebtOccuredOnForSecondary,
        			'nextPaymentNr' => $secondary->NextPaymentNr,
        			'nextPaymentDate' => $secondary->NextPaymentDate,
        			'nextPaymentSum' => $secondary->NextPaymentSum,
        			'nrOfScheduledPayments' => $secondary->NrOfScheduledPayments,
        			'principalRepaid' => $secondary->PrincipalRepaid,
        			'interestRepaid' => $secondary->InterestRepaid,
        			'lateAmountPaid' => $secondary->LateAmountPaid,
        			'principalRemaining' => $secondary->PrincipalRemaining,
        			'principalLateAmount' => $secondary->PrincipalLateAmount,
        			'interestLateAmount' => $secondary->InterestLateAmount,
        			'penaltyLateAmount' => $secondary->PenaltyLateAmount,
        			'lateAmountTotal' => $secondary->LateAmountTotal,
        			'price' => $secondary->Price,
        			'fee' => $secondary->Fee,
        			'totalCost' => $secondary->TotalCost,
        			'outstandingPayments' => $secondary->OutstandingPayments,
        			'desiredDiscountRate' => $secondary->DesiredDiscountRate,
        			'xirr' => $secondary->Xirr,
        			'listedOnDate' => $secondary->ListedOnDate,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update 
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('secondary', $data);
        	else {
        		$this->db->where('id', $this->input->post('id'));
        		return $this->db->update('secondary', $data);
        	}
        }
        
}
