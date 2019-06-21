<?php
class Bids_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_bids($id = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//$start = $this->time_float();
        	 
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		$query = $this->db->get_where('bid_payload', array('userName' => $user));
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		$query = $this->db->get_where('bid_payload', array('userName' => $user));
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('bid_payload', array('id' => $id, 'userName' => $user));
        	return $query->row_array();
        }
        
        public function get_bidsByBidId($bidid = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//$start = $this->time_float();
        
        	//echo "bidId==".$bidid;
        	if ($bidid === FALSE)
        	{
        		$query = $this->db->get_where('bid_payload', array('userName' => $user));
        		return $query->result_array();
        	}
        
        	if ($bidid == 0) {
        		$this->db->distinct();
        		$query = $this->db->get_where('bid_payload', array('userName', $user));
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('bid_payload', array('bidId' => $bidid, 'userName' => $user));
        		return $query->row_array();
        }

        public function get_count($id = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//$start = $this->time_float();
        
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		$query = $this->db->get('bid_payload');
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		$count = $this->db->count_all('bid_payload');
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('bid_payload', array('id' => $id));
        		return $count;
        }
        
        public function truncate() {
        	$this->db->truncate('bid_payload');
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
        
        public function load_bids($provider = NULL, $token = NULL) {
        	$start = $this->time_float();
        	$this->del_bids(0);
        	$down_start = $this->time_float();
        	$tulemus = $provider->get_bids($token);
        	$down_elapsed=$this->elapsed_time($down_start);
        	$bids = $tulemus['bids'];
        	//var_dump($bids);
        	$id=0;
        	$amount=0;
        	$save_start=$this->time_float();
        	foreach ($bids as $bid):
        		//var_dump($investment);
        		//if ($bid->LoanStatusCode!=8 AND $bid->LoanStatusCode!=3) {
        			$id++;
        	
        			//echo "x	<br>".$investment->LoanStatusCode;
        			if ($this->set_bid(0, $bid) == 1) {
        				//var_dump($investment);
        				//echo "<br>am=".$amount;;
        				$amount=$amount+$bid->ActualBidAmount;
        				//echo "ammmmm=".$amount;
        				//echo "<br>";
        				//echo $id.". auctionId=".$investment->AuctionId."    SALVESTATUD";
        			}
        		//}
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
        
        public function del_bids($id = FALSE)
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
        		//$this->db->truncate('bid_payload');
        		//$this->db->empty_table('auction_payload');
        		$this->db->delete('bid_payload', array('userName' => $user));
        	}
        	else
        		$this->db->delete('bid_payload', array('id' => $id, 'userName' => $user));
        		//return $query->row_array();
        }
        
        public function del_bidByBidId($bidid = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//echo "bidid==".$bidid;
        	if ($bidid === FALSE)
        	{
        		//$query = $this->db->get('auction_filter_adv');
        		//return $query->result_array();
        	}
        
        	if ($bidid == 0) {
        		//$this->db->distinct();
        		//$query = $this->db->get('auction_filter_adv');
        		//$query = $this->db->
        		//$this->db->truncate('bid_payload');
        		//$this->db->empty_table('auction_payload');
        		$this->db->delete('bid_payload', array('userName' => $user));
        	}
        	else
        		$this->db->delete('bid_payload', array('bidId' => $bidid, 'userName' => $user));
        		//return $query->row_array();
        }
        
        
        public function set_bid($id = FALSE, $bid = null)
        {
        	$user=$this->session->userdata('username');
        	//$this->load->helper('url');
        
        	//$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	//$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	
        	
        	$data = array(
        			
        			'bidId' => $bid->Id,
        			'auctionId' => $bid->AuctionId,
        			'requestedBidAmount' => $bid->RequestedBidAmount,
        			'actualBidAmount' => $bid->ActualBidAmount,
        			'requestedBidMinimumLimit' => $bid->RequestedBidMinimumLimit,
        			'bidRequestedDate' => $bid->BidRequestedDate,
        			'bidProcessedDate' => $bid->BidProcessedDate,
        			'isRequestBeingProcessed' => $bid->IsRequestBeingProcessed,
        			'statusCode' => $bid->StatusCode,
        			'failureReason' => $bid->FailureReason,
        			'userName' => $user,
        			//'isActive' => $this->input->post('isActive')==1?1:0,
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update 
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('bid_payload', $data);
        	else {
        		$this->db->where('id', $this->input->post('id'));
        		return $this->db->update('bid_payload', $data);
        	}
        }
        
}
