<?php
class Investments_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function record_count() {
        	return $this->db->count_all("investment_payload");
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
        
        public function get_investments($id = FALSE)
        {
        	//$start = $this->time_float();
        	$user=$this->session->userdata('username');
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		//$query = $this->db->get('investment_payload');
        		$sql = $this->db->get_compiled_select('select a.*,b.listedOnDate,b.xirr,b.secondaryId,b.desiredDiscountRate from bondora.investment_payload a'.
        		' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId and a.user=b.user where a.user="'.$user.'" order by a.signedDate, a.auctionId');
        		//echo $sql;
        		$this->log->write_log('debug', $sql);
        		
//        		$query = $this->db->query('select a.*,b.listedOnDate,b.xirr from bondora.investment_payload a'.
//        		' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId group by a.loanPartId order by a.signedDate, a.auctionId');
        		$query = $this->db->query('select a.*,b.listedOnDate,b.xirr,b.secondaryId,b.desiredDiscountRate from bondora.investment_payload a'.
        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId  and a.user=b.user where a.user="'.$user.'" order by a.signedDate, a.auctionId');
        		
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		//$query = $this->db->get('investment_payload');
        		$sql = $this->db->get_compiled_select('select a.*,b.listedOnDate,b.xirr,b.secondaryId,b.desiredDiscountRate from bondora.investment_payload a'.
        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId and a.user=b.user where user="'.$user.'" order by a.signedDate, a.auctionId');
        		//echo $sql;
        		$this->log->write_log('debug', $sql);
        		
//        		$query = $this->db->query('select a.*,b.listedOnDate,b.xirr from bondora.investment_payload a'.
//        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId group by a.loanPartId order by a.signedDate, a.auctionId');
        		$query = $this->db->query('select a.*,b.listedOnDate,b.xirr,b.secondaryId,b.desiredDiscountRate from bondora.investment_payload a'.
        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId and a.user=b.user where user="'.$user.'" order by a.signedDate, a.auctionId');
        		
        		//$query = $this->db->
        	}
        	else {
//        		$sql = $this->db->get_compiled_select('select a.*,b.listedOnDate,b.xirr from bondora.investment_payload a '.
//        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId WHERE a.id='.$id.' group by a.loanPartId order by a.signedDate, a.auctionId');
        		$sql = $this->db->get_compiled_select('select a.*,b.listedOnDate,b.xirr,b.secondaryId,b.desiredDiscountRate from bondora.investment_payload a '.
        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId WHERE a.id='.$id.' and user="'.$user.'" order by a.signedDate, a.auctionId');
        		
        		//echo $sql;
        		$this->log->write_log('debug', $sql);
        		
        		//$query = $this->db->get_where('investment_payload', array('id' => $id));
        		$query = $this->db->query('select a.*,b.listedOnDate,b.xirr,b.secondaryId,b.desiredDiscountRate from bondora.investment_payload a '.
        				' LEFT JOIN bondora.secondary b ON a.loanPartId=b.loanPartId WHERE a.id='.$id);
        		
        	}
        	return $query->row_array();
        }

        public function get_count($id = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//$start = $this->time_float();
        
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		$query = $this->db->get('investment_payload');
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		$count = $this->db->count_all('investment_payload');
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('investment_payload', array('id' => $id));
        		return $count;
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
        
        public function load_investments($provider = NULL, $token = NULL) {
        	$start = $this->time_float();
        	$this->del_investments(0);
        	$down_start = $this->time_float();
        	$tulemus = $provider->get_investments($token);
        	$down_elapsed=$this->elapsed_time($down_start);
        	$investments = $tulemus['investments'];
        	$id=0;
        	$amount=0;
        	$save_start=$this->time_float();
        	foreach ($investments as $investment):
        		//var_dump($investment);
        		if ($investment->LoanStatusCode!=8 AND $investment->LoanStatusCode!=3) {
        			$id++;
        			//echo "x	<br>".$investment->LoanStatusCode;
        			if ($this->set_investments(0, $investment) == 1) {
        				//var_dump($investment);
        				//echo "<br>am=".$amount;;
        				$amount=$amount+$investment->Amount;
        				//echo "ammmmm=".$amount;
        				//echo "<br>";
        				//echo $id.". auctionId=".$investment->AuctionId."    SALVESTATUD";
        			}
        		}
        	endforeach;
        	$save_elapsed=$this->elapsed_time($save_start);
        	$all_elapsed=$this->elapsed_time($start);
        	$data['sum']=$id;
        	$data['all_time']=$all_elapsed;
        	$data['down_time']=$down_elapsed;
        	$data['save_time']=$save_elapsed;
        	$data['amount'] = $amount;
        	return $data;
        }

        public function load_investments_batch($provider = NULL, $token = NULL) {
        	//if ($provider==NULL)

        		$start = $this->time_float();
        	$this->del_investments(0);
        	$down_start = $this->time_float();
        	//var_dump( $provider);
        	$tulemus = $provider->get_investments($token);
        	$down_elapsed=$this->elapsed_time($down_start);
        	$investments = $tulemus['investments'];
        	$id=0;
        	$amount=0;
        	$save_start=$this->time_float();
        	foreach ($investments as $investment):
        	//var_dump($investment);
        	if ($investment->LoanStatusCode!=8 AND $investment->LoanStatusCode!=3) {
        		$id++;
        		//echo "x	<br>".$investment->LoanStatusCode;
        		//if ($this->set_investments(0, $investment) == 1) {
        			//var_dump($investment);
        			//echo "<br>am=".$amount;;
        			$amount=$amount+$investment->Amount;
        			$data[] = $this->set_investments_batch($investment);
        			//echo "ammmmm=".$amount;
        			//echo "<br>";
        			//echo $id.". auctionId=".$investment->AuctionId."    SALVESTATUD";
        		//}
        	}
        	endforeach;
        	$this->db->insert_batch('investment_payload', $data);
        	$save_elapsed=$this->elapsed_time($save_start);
        	$all_elapsed=$this->elapsed_time($start);
        	$data['sum']=$id;
        	$data['all_time']=$all_elapsed;
        	$data['down_time']=$down_elapsed;
        	$data['save_time']=$save_elapsed;
        	$data['amount'] = $amount;
        	return $data;
        }
        
        public function del_investments($id = FALSE)
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
        		//$this->db->truncate('investment_payload');
        		//$this->db->empty_table('auction_payload');
        		$this->db->delete('investment_payload', array('user' => $user));
        	}
        	else
        		$this->db->delete('investment_payload', array('id' => $id, 'user' => $user));
        		//return $query->row_array();
        }
        
        public function truncate() {
        	$this->db->truncate('investment_payload');
        }
        
     
        public function set_investments_batch($investment = null)
        {
        	$user=$this->session->userdata('username');
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	 
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	 
        	 
        	$data = array(
        			 
        			'loanPartId' => $investment->LoanPartId,
        			'amount' => $investment->Amount,
        			'auctionId' => $investment->AuctionId,
        			'auctionName' => $investment->AuctionName,
        			'auctionNumber' => $investment->AuctionNumber,
        			'auctionBidNumber' => $investment->AuctionBidNumber,
        			'country' => $investment->Country,
        			'creditScore' => $investment->CreditScore,
        			'rating' => $investment->Rating,
        			'interest' => $investment->Interest,
        			'useOfLoan' => $investment->UseOfLoan,
        			'incomeVerificationStatus' => $investment->IncomeVerificationStatus,
        			'loanId' => $investment->LoanId,
        			'loanStatusCode' => $investment->LoanStatusCode,
        			'UserName' => $investment->UserName,
        			'user' => $user,
        			'gender' => $investment->Gender,
        			'dateOfBirth' => $investment->DateOfBirth,
        			'signedDate' => $investment->SignedDate,
        			'reScheduledOn' => $investment->ReScheduledOn,
        			'debtOccuredOn' => $investment->DebtOccuredOn,
        			'debtOccuredOnForSecondary' => $investment->DebtOccuredOnForSecondary,
        			'loanDuration' => $investment->LoanDuration,
        			'nextPaymentNr' => $investment->NextPaymentNr,
        			'nextPaymentDate' => $investment->NextPaymentDate,
        			'nextPaymentSum' => $investment->NextPaymentSum,
        			'nrOfScheduledPayments' => $investment->NrOfScheduledPayments,
        			'principalRepaid' => $investment->PrincipalRepaid,
        			'interestRepaid' => $investment->InterestRepaid,
        			'lateAmountPaid' => $investment->LateAmountPaid,
        			'principalRemaining' => $investment->PrincipalRemaining,
        			'principalLateAmount' => $investment->PrincipalLateAmount,
        			'interestLateAmount' => $investment->InterestLateAmount,
        			'penaltyLateAmount' => $investment->PenaltyLateAmount,
        			'lateAmountTotal' => $investment->LateAmountTotal,
        			'purchaseDate' => $investment->PurchaseDate,
        			'soldDate' => $investment->SoldDate,
        			'purchasePrice' => $investment->PurchasePrice,
        			'salePrice' => $investment->SalePrice,
        			'listedInSecondMarketOn' => $investment->ListedInSecondMarketOn,
        			'latestDebtManagementStage' => $investment->LatestDebtManagementStage,
        			'latestDebtManagementDate' => $investment->LatestDebtManagementDate,
        			'noteLoanTransfersMainAmount' => $investment->NoteLoanTransfersMainAmount,
        			'noteLoanTransfersInterestAmount' => $investment->NoteLoanTransfersInterestAmount,
        			'noteLoanLateChargesPaid' => $investment->NoteLoanLateChargesPaid,
        			'noteLoanTransfersEarningsAmount' => $investment->NoteLoanTransfersEarningsAmount,
        			'noteLoanTransfersTotalRepaimentsAmount' => $investment->NoteLoanTransfersTotalRepaimentsAmount,
        			'lastPaymentDate' => $investment->LastPaymentDate,
        			'loanStatusActiveFrom' => $investment->LoanStatusActiveFrom,
        			 
        			//'isActive' => $this->input->post('isActive')==1?1:0,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	/*if ($id == 0)
        		return $this->db->insert('investment_payload', $data);
        		else {
        			$this->db->where('id', $this->input->post('id'));
        			return $this->db->update('investment_payload', $data);
        		}*/
        	return $data;
        }
        
        public function set_investments($id = FALSE, $investment = null)
        {
        	$user=$this->session->userdata('username');
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	
        	
        	$data = array(
        			
        			'loanPartId' => $investment->LoanPartId,
        			'amount' => $investment->Amount,
        			'auctionId' => $investment->AuctionId,
        			'auctionName' => $investment->AuctionName,
        			'auctionNumber' => $investment->AuctionNumber,
        			'auctionBidNumber' => $investment->AuctionBidNumber,
        			'country' => $investment->Country,
        			'creditScore' => $investment->CreditScore,
        			'rating' => $investment->Rating,
        			'interest' => $investment->Interest,
        			'useOfLoan' => $investment->UseOfLoan,
        			'incomeVerificationStatus' => $investment->IncomeVerificationStatus,
        			'loanId' => $investment->LoanId,
        			'loanStatusCode' => $investment->LoanStatusCode,
        			'UserName' => $investment->UserName,
        			'user' => $user,
        			'gender' => $investment->Gender,
        			'dateOfBirth' => $investment->DateOfBirth,
        			'signedDate' => $investment->SignedDate,
        			'reScheduledOn' => $investment->ReScheduledOn,
        			'debtOccuredOn' => $investment->DebtOccuredOn,
        			'debtOccuredOnForSecondary' => $investment->DebtOccuredOnForSecondary,
        			'loanDuration' => $investment->LoanDuration,
        			'nextPaymentNr' => $investment->NextPaymentNr,
        			'nextPaymentDate' => $investment->NextPaymentDate,
        			'nextPaymentSum' => $investment->NextPaymentSum,
        			'nrOfScheduledPayments' => $investment->NrOfScheduledPayments,
        			'principalRepaid' => $investment->PrincipalRepaid,
        			'interestRepaid' => $investment->InterestRepaid,
        			'lateAmountPaid' => $investment->LateAmountPaid,
        			'principalRemaining' => $investment->PrincipalRemaining,
        			'principalLateAmount' => $investment->PrincipalLateAmount,
        			'interestLateAmount' => $investment->InterestLateAmount,
        			'penaltyLateAmount' => $investment->PenaltyLateAmount,
        			'lateAmountTotal' => $investment->LateAmountTotal,
        			'purchaseDate' => $investment->PurchaseDate,
        			'soldDate' => $investment->SoldDate,
        			'purchasePrice' => $investment->PurchasePrice,
        			'salePrice' => $investment->SalePrice,
        			'listedInSecondMarketOn' => $investment->ListedInSecondMarketOn,
        			'latestDebtManagementStage' => $investment->LatestDebtManagementStage,
        			'latestDebtManagementDate' => $investment->LatestDebtManagementDate,
        			'noteLoanTransfersMainAmount' => $investment->NoteLoanTransfersMainAmount,
        			'noteLoanTransfersInterestAmount' => $investment->NoteLoanTransfersInterestAmount,
        			'noteLoanLateChargesPaid' => $investment->NoteLoanLateChargesPaid,
        			'noteLoanTransfersEarningsAmount' => $investment->NoteLoanTransfersEarningsAmount,
        			'noteLoanTransfersTotalRepaimentsAmount' => $investment->NoteLoanTransfersTotalRepaimentsAmount,
        			'lastPaymentDate' => $investment->LastPaymentDate,
        			'loanStatusActiveFrom' => $investment->LoanStatusActiveFrom,
        			 
        			//'isActive' => $this->input->post('isActive')==1?1:0,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update 
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('investment_payload', $data);
        	else {
        		$this->db->where('id', $this->input->post('id'));
        		return $this->db->update('investment_payload', $data);
        	}
        }
        
}
