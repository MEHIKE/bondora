<?php
class Filters_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_filters($id = FALSE)
        {
        	echo "id==".$id;
        	if ($id === FALSE)
        	{
        		$query = $this->db->get('auction_filter_adv');
        		return $query->result_array();
        	}
        
        	if ($id == 0) {
        		$this->db->distinct();
        		$query = $this->db->get('auction_filter_adv');
        		//$query = $this->db->
        	}
        	else
        		$query = $this->db->get_where('auction_filter_adv', array('id' => $id));
        	return $query->row_array();
        }

        public function del_filters($id = FALSE)
        {
        	echo "id==".$id;
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
        		$this->db->delete('auction_filter_adv', array('id' => $id));
        		//return $query->row_array();
        }
        
        public function set_filters($id = FALSE)
        {
        	$this->load->helper('url');
        
        	$slug = url_title($this->input->post('user'), 'dash', TRUE);
        	echo "SLUG=".$slug;
        	
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

        	//'ratings' => $this->input->post('ratings'),
        	//'ratingsAA' => $this->input->post('ratingsAA'),
        	//'ratingsA' => $this->input->post('ratingsA'),
        	//'ratingsB' => $this->input->post('ratingsB'),
        	//'ratingsC' => $this->input->post('ratingsC'),
        	//'ratingsD' => $this->input->post('ratingsD'),
        	//'ratingsE' => $this->input->post('ratingsE'),
        	//'ratingsF' => $this->input->post('ratingsF'),
        	//'ratingsHR' => $this->input->post('ratingsHR'),
        	 
        	
        	//'countriesEE' => $this->input->post('countriesEE'),
        	//'countriesFI' => $this->input->post('countriesFI'),
        	//'countriesES' => $this->input->post('countriesES'),

        	$terms = ($this->input->post('terms3')!=NULL?$this->input->post('terms3').",":"");
        	$terms=$terms.($this->input->post('terms9')!=NULL?$this->input->post('terms9').",":"");
        	$terms=$terms.($this->input->post('terms12')!=NULL?$this->input->post('terms12').",":"");
        	$terms=$terms.($this->input->post('terms18')!=NULL?$this->input->post('terms18').",":"");
        	$terms=$terms.($this->input->post('terms24')!=NULL?$this->input->post('terms24').",":"");
        	$terms=$terms.($this->input->post('terms36')!=NULL?$this->input->post('terms36').",":"");
        	$terms=$terms.($this->input->post('terms48')!=NULL?$this->input->post('terms48').",":"");
        	$terms=$terms.($this->input->post('terms60')!=NULL?$this->input->post('terms60').",":"");
        	$terms=substr($terms, 0, strlen($terms)-1);
        	 
        	//$isActive = $this->input->post('isActive')==1?1:0;
        	//sama rating
        	
        	//'terms' => $this->input->post('terms'),
        	//'terms3' => $this->input->post('terms3'),
        	//'terms9' => $this->input->post('terms9'),
        	//'terms12' => $this->input->post('terms12'),
        	//'terms18' => $this->input->post('terms18'),
        	//'terms24' => $this->input->post('terms24'),
        	//'terms36' => $this->input->post('terms36'),
        	//'terms48' => $this->input->post('terms48'),
        	//'terms60' => $this->input->post('terms60'),
        	 
        	//gender leida
        	
        	
        	$data = array(
        			
        			'user' => $this->input->post('user'),
        			'isOneTime' => $this->input->post('isOneTime'),
        			'amount' => $this->input->post('amount'),
        			'isActive' => $this->input->post('isActive')==1?1:0,
        			'jrk' => $this->input->post('jrk'),
        			'pageSize' => $this->input->post('pageSize')==1?1:0,
        			'countries' => $countries,
        			'ratings' => $ratings,
        			'terms' => $terms,
        			'gender' => $this->input->post('gender'),
        			'incomeTotalMin' => $this->input->post('incomeTotalMin'),
        			'incomeTotalMax' => $this->input->post('incomeTotalMax'),
        			'ageMin' => $this->input->post('ageMin'),
        			'ageMax' => $this->input->post('ageMax'),
        			'creditScoreMin' => $this->input->post('creditScoreMin'),
        			'creditScoreMax' => $this->input->post('creditScoreMax'),
        			'userName' => $this->input->post('userName'),
        			'creditGroups' => $this->input->post('creditGroups'),
        			'interestMin' => $this->input->post('interestMin'),
        			'interestMax' => $this->input->post('interestMax'),
        			'incomeTotalMin' => $this->input->post('incomeTotalMin'),
        			'incomeTotalMax' => $this->input->post('incomeTotalMax'),
        			'expectedLossMin' => $this->input->post('expectedLossMin'),
        			'expectedLossMax' => $this->input->post('expectedLossMax'),
        			'city' => $this->input->post('city'),
        			'verifycationType' => $this->input->post('verifycationType'),
        			'useOfLoan' => $this->input->post('useOfLoan'),
        			'education' => $this->input->post('education'),
        			'maritalStatus' => $this->input->post('maritalStatus'),
        			'nrOfDependantsMin' => $this->input->post('nrOfDependantsMin'),
        			'nrOfDependantsMax' => $this->input->post('nrOfDependantsMax'),
        			'employmentStatus' => $this->input->post('employmentStatus'),
        			'employmentDurationCurrentEmployer' => $this->input->post('employmentDurationCurrentEmployer'),
        			'workExperience' => $this->input->post('workExperience'),
        			'occupationArea' => $this->input->post('occupationArea'),
        			'homeOwnershipType' => $this->input->post('homeOwnershipType'),
        			'incomeFromPrincipalEmpoyerMin' => $this->input->post('incomeFromPrincipalEmpoyerMin'),
        			'isIncomeFromPension' => $this->input->post('isIncomeFromPension'),
        			'isIncomeFromSocialWelfare' => $this->input->post('isIncomeFromSocialWelfare'),
        			'isIncomeFromChildSupport' => $this->input->post('isIncomeFromChildSupport'),
        			'probabilityOfBadMin' => $this->input->post('probabilityOfBadMin'),
        			'probabilityOfBadMax' => $this->input->post('probabilityOfBadMax'),
        			'probabilityOfDefaultMin' => $this->input->post('probabilityOfDefaultMin'),
        			'probabilityOfDefaultMax' => $this->input->post('probabilityOfDefaultMax'),
        			'expectedReturnMin' => $this->input->post('expectedReturnMin'),
        			'expectedReturnMax' => $this->input->post('expectedReturnMax'),
        			'isLocalSearch' => $this->input->post('isLocalSearch')==1?1:0,
        			'name' => $this->input->post('name'),
        			'description' => $this->input->post('description')
        	);
        	//ui uus, id=0, siis pole olemas ja insert, muidu update 
        	//if ($this->input->post('is_new') == 0)
        	//if ($this->input->post('id') == 0)
        	if ($id == 0)
        		return $this->db->insert('auction_filter_adv', $data);
        	else {
        		$this->db->where('id', $this->input->post('id'));
        		return $this->db->update('auction_filter_adv', $data);
        	}
        }
        
}
