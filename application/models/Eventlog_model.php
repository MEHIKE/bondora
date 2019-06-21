<?php
class Eventlog_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
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
        
        public function get_eventlogs($id = FALSE)
        {
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		//$this->db->query('select a.*,b.statusCode from auction_payload a, bid_payload b'+
        		//		' where a.auctionId=b.auctionId');
        		$sql = $this->db->get_compiled_select('select a.*,b.statusCode from auction_payload a LEFT JOIN bid_payload b ON a.auctionId=b.auctionId');
        		//echo $sql;
        		$this->log->write_log('debug', $sql);
        		
        		$query=$this->db->query('select a.*,b.statusCode from auction_payload a '.
        				'LEFT JOIN bid_payload b ON a.auctionId=b.auctionId group by a.auctionId');
        		
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		$query=$this->db->query('select a.*,b.statusCode from auction_payload a '.
        				'LEFT JOIN bid_payload b ON a.auctionId=b.auctionId  group by a.auctionId');
        		
        		//$query = $this->db->get('auction_payload');
        		//$query = $this->db->
        	}
        	else
        		$query=$this->db->query('select a.*,b.statusCode from auction_payload a '.
        				'LEFT JOIN bid_payload b ON a.auctionId=b.auctionId where a.id='.$id.'  group by a.auctionId');
        		
        		//$query = $this->db->get_where('auction_payload', array('id' => $id));
        	return $query->row_array();
        }

        public function get_filter_eventlogs($id = FALSE)
        {
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
//        		$query = $this->db->get('auction_payload');
        		$query=$this->db->query('select a.*,b.statusCode from auction_payload a '.
        				'LEFT JOIN bid_payload b ON a.auctionId=b.auctionId  group by a.auctionId');
        		
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		//$query = $this->db->get('auction_payload');
        		$this->db->distinct();
        		$query=$this->db->query('select a.*,b.statusCode from auction_payload a '.
        				'LEFT JOIN bid_payload b ON a.auctionId=b.auctionId  group by a.auctionId');
        	}
        	else
//        		$query = $this->db->get('auction_payload');
//        	    $tulemus = $this->filterArray($query->result_array());
        		$query=$this->db->query('select a.*,b.statusCode from auction_payload a '.
        				'LEFT JOIN bid_payload b ON a.auctionId=b.auctionId  group by a.auctionId');// where a.id='.$id);
        		return $query->result_array();
        		//return $tulemus;
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
        
        public function load_eventlogs($provider = NULL, $token = NULL, $filter = NULL) {
        	$start = $this->time_float();
        	//$this->del_auctions(0);
        	$down_start = $this->time_float();
        	$tulemus = $provider->get_eventlog($token, $filter);
        	$down_elapsed=$this->elapsed_time($down_start);
        	$eventlogs = $tulemus['events'];
        	$id=0;
        	$save_start=$this->time_float();
        	/*foreach ($auctions as $auction):
        		//var_dump($auction);
        		$id++;
        		if ($this->set_auctions(0, $auction) == 1) {
        			//echo "<br>";
        			//echo $id.". auctionId=".$auction->AuctionId."    SALVESTATUD";
        			 
        		}
        	endforeach;*/
        	//echo "<br><br><br><br><br><br><br><br><br>";
        	//var_dump($eventlogs);
        	$save_elapsed=$this->elapsed_time($save_start);
        	$all_elapsed=$this->elapsed_time($start);
        	$data['eventlogs']=$eventlogs;
        	$data['sum']=$id;
        	$data['all_time']=$all_elapsed;
        	$data['down_time']=$down_elapsed;
        	$data['save_time']=$save_elapsed;
        	return $data;
        }
        
        public function del_auctions($id = FALSE)
        {
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
        		$this->db->truncate('auction_payload');
        		//$this->db->empty_table('auction_payload');
        		//$this->db->delete('auction_payload');
        	}
        	else
        		$this->db->delete('auction_payload', array('id' => $id));
        		//return $query->row_array();
        }
        
        public function set_auctions($id = FALSE, $auction = null)
        {
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	
        	
        	$data = array(
        			
        			'loanId' => $auction->LoanId,
        			'auctionId' => $auction->AuctionId,
        			'loanNumber' => $auction->LoanNumber,
        			'userName' => $auction->UserName,
        			'user' => 'rynno.ruul@emt.ee',
        			'newCreditCustomer' => $auction->NewCreditCustomer,
        			'loanApplicationStartedDate' => $auction->LoanApplicationStartedDate,
        			'applicationSignedHour' => $auction->ApplicationSignedHour,
        			'applicationSignedWeekday' => $auction->ApplicationSignedWeekday,
        			'VerificationType' => $auction->VerificationType,
        			'languageCode' => $auction->LanguageCode,
        			'age' => $auction->Age,
        			'gender' => $auction->Gender,
        			'country' => $auction->Country,
        			'creditScore' => $auction->CreditScore,
        			'appliedAmount' => $auction->AppliedAmount,
        			'interest' => $auction->Interest,
        			'loanDuration' => $auction->LoanDuration,
        			'county' => $auction->County,
        			'city' => $auction->City,
        			'useOfLoan' => $auction->UseOfLoan,
        			'education' => $auction->Education,
        			'maritalStatus' => $auction->MaritalStatus,
        			'nrOfDependants' => $auction->NrOfDependants,
        			'employmentStatus' => $auction->EmploymentStatus,
        			'employmentDurationCurrentEmployer' => $auction->EmploymentDurationCurrentEmployer,
        			'workExperience' => $auction->WorkExperience,
        			'occupationArea' => $auction->OccupationArea,
        			'homeOwnershipType' => $auction->HomeOwnershipType,
        			'incomeFromPrincipalEmployer' => $auction->IncomeFromPrincipalEmployer,
        			'incomeFromPension' => $auction->IncomeFromPension,
        			'incomeFromFamilyAllowance' => $auction->IncomeFromFamilyAllowance,
        			'incomeFromSocialWelfare' => $auction->IncomeFromSocialWelfare,
        			'incomeFromLeavePay' => $auction->IncomeFromLeavePay,
        			'incomeFromChildSupport' => $auction->IncomeFromChildSupport,
        			'incomeOther' => $auction->IncomeOther,
        			'incomeTotal' => $auction->IncomeTotal,
        			'monthlyPaymentDay' => $auction->MonthlyPaymentDay,
        			'scoringDate' => $auction->ScoringDate,
        			'modelVersion' => $auction->ModelVersion,
        			'expectedLoss' => $auction->ExpectedLoss,
        			'rating' => $auction->Rating,
        			'EADRate' => $auction->EADRate,
        			'lossGivenDefault' => $auction->LossGivenDefault,
        			'maturityFactor' => $auction->MaturityFactor,
        			'probabilityOfDefault' => $auction->ProbabilityOfDefault,
        			'expectedReturnAlpha' => $auction->ExpectedReturnAlpha,
        			'interestRateAlpha' => $auction->InterestRateAlpha,
        			'liabilitiesTotal' => $auction->LiabilitiesTotal,
        			'listedOnUTC' => $auction->ListedOnUTC,
        			
        			//'isActive' => $this->input->post('isActive')==1?1:0,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update 
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('auction_payload', $data);
        	else {
        		$this->db->where('id', $this->input->post('id'));
        		return $this->db->update('auction_payload', $data);
        	}
        }
        
}
