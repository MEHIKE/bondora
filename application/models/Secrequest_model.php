<?php
class Secrequest_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_requests($id = FALSE)
        {
        	$user=$this->session->userdata('username');
        	//echo "id==".$id;
        	if ($id === FALSE)
        	{
        		$query = $this->db->get_where('secondary_request', array('userName' => $user));
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		$query = $this->db->get_where('secondary_request', array('userName' => $user));
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('secondary_request', array('id' => $id, 'userName' => $user));
        	return $query->row_array();
        }

        public function get_last_filter($is_local = 1)
        {
        	$user=$this->session->userdata('username');
        	//echo "isLocal==".$is_local;
        		$this->db->distinct();
        		$this->db->order_by('lastUsedTime');
        		$query = $this->db->get_where('secondary_request', array('isLocalSearch' => $is_local, 'userName' => $user));
        		//$query = $this->db->get_where('secondary_request', array('id' => $id));
        		return $query->row_array();
        }
        
        public function get_remote_filter() {
        	$user=$this->session->userdata('username');
        	$query=$this->get_last_filter(0);
        	if (sizeof($query) > 0) {
				if ($query['showMyItems']=='false') {
	        		$arr=array(
        				'ShowMyItems' => 'false',
        				//'Countries' => $query['countries'],
        				'AgeMax' => $query['ageMax'],
        				'PrincipalMax' => $query['principalMax'],
        				'CreditScoreMin' => $query['creditScoreMin'],
        				'HasDebt' => $query['hasDebt']==1?'true':'false',
	        			'InterestMin' => $query['interestMin'],
        				'XirrMin' => $query['xirrMin'],
        				'DesiredDiscountRateMax' => $query['desiredDiscountRateMax'],
	        			'IncomeVerificationStatus' => $query['incomeVerificationStatus'],
	        			'LengthMax' => $query['lengthMax']
	       				);
		        		if ($query['ratings']!=NULL && $query['ratings']!='')  {
		        			$arr1=array('Ratings' => $query['ratings']);
	    	    			$arr=array_merge($arr, $arr1);
	        			}
	        			if ($query['countries']!=NULL && $query['countries']!='')  {
	        				$arr1=array('Countries' => $query['countries']);
	        				$arr=array_merge($arr, $arr1);
	        			}
	        			
					} else if ($query['showMyItems']=='true') { 
						$arr=array(
								'ShowMyItems' => 'true'
						);
					} else	if ($query['showMyItems']=='') 
					{
	        		$arr=array(
        				//'ShowMyItems' => '',
        				//'Countries' => $query['countries'],
        				'AgeMax' => $query['ageMax'],
        				'PrincipalMax' => $query['principalMax'],
        				'CreditScoreMin' => $query['creditScoreMin'],
        				'HasDebt' => $query['hasDebt']==1?'true':'false',
	        			'InterestMin' => $query['interestMin'],
        				'XirrMin' => $query['xirrMin'],
        				'DesiredDiscountRateMax' => $query['desiredDiscountRateMax'],
	        			'IncomeVerificationStatus' => $query['incomeVerificationStatus'],
	        			'LengthMax' => $query['lengthMax']
	       				);
		        		if ($query['ratings']!=NULL && $query['ratings']!='')  {
		        			$arr1=array('Ratings' => $query['ratings']);
	    	    			$arr=array_merge($arr, $arr1);
	        			}
	        			if ($query['countries']!=NULL && $query['countries']!='')  {
	        				$arr1=array('Countries' => $query['countries']);
	        				$arr=array_merge($arr, $arr1);
	        			}
	        			
					} else {
						$arr=array(
								'Countries' => $query['countries'],
								'AgeMax' => $query['ageMax'],
								'PrincipalMax' => $query['principalMax'],
								'CreditScoreMin' => $query['creditScoreMin'],
								'HasDebt' => $query['hasDebt']==1?'true':'false',
								'InterestMin' => $query['interestMin'],
								'XirrMin' => $query['xirrMin'],
								'DesiredDiscountRateMax' => $query['desiredDiscountRateMax'],
								'IncomeVerificationStatus' => $query['incomeVerificationStatus'],
								'LengthMax' => $query['lengthMax'],
								'Ratings' => $query['ratings']
						);
					}
	        		
        		
        		return $arr;
        	} 
        	return NULL;
        }
        public function del_requests($id = FALSE)
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
        	}
        	else
        		$this->db->delete('secondary_request', array('id' => $id, 'userName' => $user));
        		//return $query->row_array();
        }
        
        public function truncate() {
        	$this->db->truncate('secondary_request');
        }
        
        public function set_requests($id = FALSE)
        {
        	$user=$this->session->userdata('username');
        	$this->load->helper('url');
        
        	$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug;
        	
        	//siin teeb valmis vljad countries=countries1+,+2,+3
        	$countries = ($this->input->post('countriesEE')!=NULL?$this->input->post('countriesEE').",":"");
        	$countries=$countries.($this->input->post('countriesFI')!=NULL?$this->input->post('countriesFI').",":"");
        	$countries=$countries.($this->input->post('countriesES')!=NULL?$this->input->post('countriesES').";":"");
        	$countries=substr($countries, 0, strlen($countries)-1);

        	$ratings = ($this->input->post('ratingsAA')!=NULL?$this->input->post('ratingsAA').",":"");
        	$ratings=$ratings.($this->input->post('ratingsA')!=NULL?$this->input->post('ratingsA').",":"");
        	$ratings=$ratings.($this->input->post('ratingsB')!=NULL?$this->input->post('ratingsB').",":"");
        	$ratings=$ratings.($this->input->post('ratingsC')!=NULL?$this->input->post('ratingsC').",":"");
        	$ratings=$ratings.($this->input->post('ratingsE')!=NULL?$this->input->post('ratingsD').",":"");
        	$ratings=$ratings.($this->input->post('ratingsD')!=NULL?$this->input->post('ratingsE').",":"");
        	$ratings=$ratings.($this->input->post('ratingsF')!=NULL?$this->input->post('ratingsF').",":"");
        	$ratings=$ratings.($this->input->post('ratingsHR')!=NULL?$this->input->post('ratingsHR').",":"");
        	$ratings=substr($ratings, 0, strlen($ratings)-1);

        	$data = array(
        			
        			'user' => $this->input->post('user'),
        			'hasDebt' => $this->input->post('hasDebt')==1?1:0,
        			'hasNewSchedule' => $this->input->post('hasNewSchedule')==1?1:0,
        			'showMyItems' => $this->input->post('showMyItems')==''?'false':$this->input->post('showMyItems'), //1-NULL=ALL, 2-TRUE=only main, 3-FALSE other
        			'loanIssuedDateFrom' => $this->input->post('loanIssuedDateFrom'),
        			'loanIssuedDateTo' => $this->input->post('loanIssuedDateTo'),
        			'countries' => $this->input->post('countries'),//$countries,
        			'ratings' => $this->input->post('ratings'),//$ratings,
        			'principalMin' => $this->input->post('principalMin'),
        			'principalMax' => $this->input->post('principalMax')==''?9999:$this->input->post('principalMax'),
        			'interestMin' => $this->input->post('interestMin')==''?0:$this->input->post('interestMin'),
        			'interestMax' => $this->input->post('interestMax'),
        			'lengthMax' => $this->input->post('lengthMax')==''?120:$this->input->post('lengthMax'),
        			'lengthMin' => $this->input->post('lengthMin'),
        			'latePrincipalAmountMin' => $this->input->post('latePrincipalAmountMin'),
        			'userName' => $user,
        			'latePrincipalAmountMax' => $this->input->post('latePrincipalAmountMax'),
        			'useOfLoan' => $this->input->post('useOfLoan'),
        			'creditScoreMin' => $this->input->post('creditScoreMin')==''?0:$this->input->post('creditScoreMin'),
        			'creditScoreMax' => $this->input->post('creditScoreMax'),
        			'gender' => $this->input->post('gender'),
        			'ageMin' => $this->input->post('ageMin'),
        			'ageMax' => $this->input->post('ageMax')==''?200:$this->input->post('ageMax'),
        			'incomeVerificationStatus' => $this->input->post('incomeVerificationStatus')==''?0:$this->input->post('incomeVerificationStatus'),
        			'listedOnDateFrom' => $this->input->post('listedOnDateFrom'),
        			'listedOnDateTo' => $this->input->post('listedOnDateTo'),
        			'desiredDiscountRateMin' => $this->input->post('desiredDiscountRateMin'),
        			'desiredDiscountRateMax' => $this->input->post('desiredDiscountRateMax')==''?9999:$this->input->post('desiredDiscountRateMax'),
        			'xirrMin' => $this->input->post('xirrMin')==''?0:$this->input->post('xirrMin'),
        			'xirrMax' => $this->input->post('xirrMax'),
        			'pageSize' => $this->input->post('pageSize'),
        			'pageNr' => $this->input->post('pageNr'),
        			'nextPaymentNrMin' => $this->input->post('nextPaymentNrMin')==''?0:$this->input->post('nextPaymentNrMin'),
        			'isLocalSearch' => $this->input->post('isLocalSearch'),
					'lastUsedTime' => $this->input->post('lastUsedTime')
        			
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update 
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('secondary_request', $data);
        	else {
        		$this->db->where('id', $this->input->post('id'));
        		return $this->db->update('secondary_request', $data);
        	}
        }

        public function set_request($data = FALSE, $id = 0)
        {
        	$this->load->helper('url');
        
        	$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	//echo "SLUG=".$slug."    id=".$id;
        	 
        	//ui uus, id=0, siis pole olemas ja insert, muidu update
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('secondary_request', $data);
       		else {
       			$this->db->where('id', $id);
       			return $this->db->update('secondary_request', $data);
       		}
        }
        
}
