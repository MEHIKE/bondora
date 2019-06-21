<div id="show_table">

<?php
$current_url=current_url();
get_instance()->session->set_userdata('current_url', $current_url);

echo "Rahaline seis: ".$balance."\n\n \r\n";
//$this->table->set_heading(array('Name', 'Color', 'Size'));
$template = array(
'table_open' => '<table border="2" cellpadding="1" cellspacing="1" class="mytable" id="ex">',

		'thead_open'            => '<thead>',
		'thead_close'           => '</thead>',

		'heading_row_start'     => '<tr>',
		'heading_row_end'       => '</tr>',
		'heading_cell_start'    => '<th>',
		'heading_cell_end'      => '</th>',

		'tbody_open'            => '<tbody>',
		'tbody_close'           => '</tbody>',

		'row_start'             => '<tr>',
		'row_end'               => '</tr>',
		'cell_start'            => '<td>',
		'cell_end'              => '</td>',

		'row_alt_start'         => '<tr>',
		'row_alt_end'           => '</tr>',
		'cell_alt_start'        => '<td>',
		'cell_alt_end'          => '</td>',

		'table_close'           => '</table>'
		
);
$tmpl = array (
		'table_open'          => '<table border="0" cellpadding="0" cellspacing="0">',
		'heading_row_start'   => '<tr class="heading">',
		'heading_row_end'     => '</tr>',
		'heading_cell_start'  => '<th>',
		'heading_cell_end'    => '</th>',
		'row_start'           => '<tr>',
		'row_end'             => '</tr>',
		'cell_start'          => '<td>',
		'cell_end'            => '</td>',
		'row_alt_start'       => '<tr class="alt">',
		'row_alt_end'         => '</tr>',
		'cell_alt_start'      => '<td>',
		'cell_alt_end'        => '</td>',
		'table_close'         => '</table>'
);

//$this->table->set_empty("&nbsp;");
$this->table->set_empty("Pole määratud");
$caption = array( 'data' => 'Ajutised ja määratud otsingud', 'align' => 'left');
//$this->table->set_caption("Ajutised ja m��ratud otsingud");
$this->table->set_template($template);
//$this->table->set_template($tmpl);

$colspan3 = array('data' => 'Tegevused', 'class' => 'highlight', 'colspan' => 3);
$this->table->set_heading($colspan3,'Id', 'Kasutaja', 'Kas 1x', 'Summa', 'Aktiivne?', 'Jrk', 'Riigid', 'Ratingud', 'Sugu'
		, 'Laenu summa min', 'Laenu summa max', 'Vanus min', 'Vanus max', 'Laenuvõtja',
		'Krediidi skoor min', 'Krediidi skoor max', 'Krediidigrupid', 'Intress min', 'Intress max', 'Sissetulek min', 'Sissetulek max',
		'Oodatud kaotus min', 'Oodatud kaotus max', 'Linn', 'Kinnitustüüp', 'Laenukasutus', 'Haridus', 'Perekonnaseis',
		'Sõltuvaid min', 'Sõltuvaid max', 'Tööl/töötu', 'Töötanud praeguse juures','Töökogemus', 'Eriala', 'Koduomanik', 'Palk praegu',
		'Sissetulek pensionist', 'Sissetulek sotsiaal', 'Sissetulek lastetoetus', 'Halvaks minemise võimalus min',
		'Halvaks minemise võimalus max', 'Pankroti võimalus min', 'Pankroti võimalus max', 'Loodetud kasu min', 'Loodetud kasu max',
		'Kas ainult lokaalne otsing');
//$this->table->set_heading("test",'test2');
//'Id', 'Kasutaja', isDone, 'Kas 1x', 'Summa', sumAmounts, sumAll, 'Aktiivne?', 'Jrk', Lk suruus, pageNr, 'Riigid', 'Ratingud', 'Sugu',
//,''Laenu summa min', 'Laenu summa max', terms, 'Vanus min', 'Vanus max', loanNumber,'Laenuv�tja', applicationDateFrom,applicationDateTo, 
//'Krediidi skoormin', 'Krediidiskoor max', 'Krediidigrupid', 'Intress min', 'Intress max', 'Sissetulek min', 'Sissetulek max',
//'Oodatud kaotus min, 'Oodatud kaotus max', 'Linn', 'Kinnitust��p', 'Laenu kasutus', 'Haridus', 'Perekonnaseis',
//'S�ltuvaid min', 'S�ltuvaid max', 'T��l/t��tu', 'T��tanud praeguse juures', 'T��kogemus', 'Eriala', 'Koduomanik', 'Palk praegu',
//'Sisetulek pensionist', 'Sissetulek sotsiaal', 'Sissetulek lastetoetus',lossGivenDefaultmin,lossGivenDefaultmax,'Halvaks minemise v�imalus min',
//'Halvaks minemise v�imalus max, 'Pankritiv�imalus min, 'Pankrito v�imalus max','Loodetud kasu min', 'Loodetud kasu max'
//interestRateAlphaMin, interestRateAlphaMax,isLocalSearch
foreach ($filters as $filter):


//$this->table->add_row($cell, 'Red', 'Green');
//print("*".$filter['id']."*");
//$id=anchor("filters/$filter[id]", $filter['id']);
//print($id);
//print anchor(site_url('filters/'.$filter['id']));

	//$this->table->add_row($filter);
//$this->table->add_row($id, $filter['user'], $filter['isOneTime'], $filter['amount'], $filter['isActive']);
$cellLaenuSum = array('data' => ($filter['incomeTotalMin']==0?" .. ":$filter['incomeTotalMin'])." - ".
		($filter['incomeTotalMax']==0?" .. ":$filter['incomeTotalMax'])." ", 
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellVanus = array('data' => ($filter['ageMin']==0?" .. ":$filter['ageMin'])." - ".
		($filter['ageMax']==0?" .. ":$filter['ageMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellCreditScore = array('data' => ($filter['creditScoreMin']==0?" .. ":$filter['creditScoreMin'])." - ".
		($filter['creditScoreMax']==0?" .. ":$filter['creditScoreMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');
		
$cellInterest = array('data' => ($filter['interestMin']==0?" .. ":$filter['interestScoreMin'])." - ".
		($filter['interestMax']==0?" .. ":$filter['interestMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellIncome = array('data' => ($filter['incomeTotalMin']==0?" .. ":$filter['incomeTotalMin'])." - ".
		($filter['incomeTotalMax']==0?" .. ":$filter['incomeTotalMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellLoss = array('data' => ($filter['expectedLossMin']==0?" .. ":$filter['expectedLossTotalMin'])." - ".
		($filter['expectedLossMax']==0?" .. ":$filter['expectedLossMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');
$cellDepent = array('data' => ($filter['nrOfDependantsMin']==0?" .. ":$filter['nrOfDependantsMin'])." - ".
		($filter['nrOfDependantsMax']==0?" .. ":$filter['nrOfDependantsMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');		

$cellBad = array('data' => ($filter['probabilityOfBadMin']==0?" .. ":$filter['probabilityOfBadMin'])." - ".
		($filter['probabilityOfBadMax']==0?" .. ":$filter['probabilityOfBadMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellDefault = array('data' => ($filter['probabilityOfDefaultMin']==0?" .. ":$filter['probabilityOfDefaultMin'])." - ".
		($filter['probabilityOfDefaultMax']==0?" .. ":$filter['probabilityOfDefaultMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellReturn = array('data' => ($filter['expectedReturnMin']==0?" .. ":$filter['expectedReturnMin'])." - ".
		($filter['expectedReturnMax']==0?" .. ":$filter['expectedReturnMax'])." ",
		'class' => 'highlight', 'colspan' => 2, 'align' => 'center');

$cellLocal = array('data' => ($filter['isLocalSearch']==0?" JAH ":" EI "),
		'class' => 'highlight', 'colspan' => 1, 'align' => 'center');

$cellActive = array('data' => ($filter['isActive']==0?" JAH ":" EI "),
		'class' => 'highlight', 'colspan' => 1, 'align' => 'center');

$cellOneTime = array('data' => ($filter['isOneTime']==0?" JAH ":" EI "),
		'class' => 'highlight', 'colspan' => 1, 'align' => 'center');

$cellUserName = array('data' => ($filter['userName']=="rynno.ruul@emt.ee"?" Pole m��ratud ":$filter['userName']),
		'class' => 'highlight', 'colspan' => 1, 'align' => 'center');


$dat1 = array('data' => anchor("filters/edit/".$filter['id'],'Muuda'), 'rowspan' => 3);
$dat2 = array('data' => anchor("filters/delete/".$filter['id']."/1",'Kustuta'), 'rowspan' => 3);
$dat3 = array('data' => anchor("auctions/index/".$filter['id'],'P�ring	'), 'rowspan' => 3);

$this->table->add_row(
		//anchor("filters/edit/".$filter['id'],'Muuda'),
		$dat1,
		//anchor("filters/delete/".$filter['id'],'Kustuta'),
		$dat2,
		//anchor("filters/query/".$filter['id'],'P�ring'),
		$dat3,
		
		//anchor('filters/view/'.$filter['id'], $filter['id']),
		$filter['id'],
		//anchor('filters/view/'.$filter['id'], $filter['user']),
		$filter['user'],
		//anchor("filters/view/$filter[id]", $filter['isOneTime']),
		$cellOneTime,
		$filter['amount'],
		$cellActive,
		$filter['jrk'],
//		$filter['pageSize'],
		$filter['countries'],
		$filter['ratings'],
		$filter['gender'],
		$cellLaenuSum, 
		$cellVanus,
		$cellUserName,
		$cellCreditScore,
		$filter['creditGroups'],
		$cellInterest,
		$cellIncome,
		$cellLoss,
		$filter['city'],
		$filter['verifycationType'],
		$filter['useOfLoan'],
		$filter['education'],
		$filter['maritalStatus'],
		$cellDepent,
		$filter['employmentStatus'],
		$filter['employmentDurationCurrentEmployer'],
		$filter['workExperience'],
		$filter['occupationArea'],
		$filter['homeOwnershipType'],
		$filter['incomeFromPrincipalEmpoyerMin'],
		$filter['isIncomeFromPension'],
		$filter['isIncomeFromSocialWelfare'],
		$filter['isIncomeFromChildSupport'],
		$cellBad,
		$cellDefault,
		$cellReturn,
		$cellLocal
		);


$row1_col1 = array('data' => 'NIMETUS', 'colspan' => 11, 'class' => 'row1_col1');
$row1_col2 = array('data' => 'TÄPSEM SELETUS', 'colspan' => 35, 'class' => 'row1_col1');
$this->table->add_row(
	$row1_col1,
	$row1_col2
);

$row2_col1 = array('data' => ($filter['name']==''?"Sisesta filtri nimetus":$filter['name']), 'colspan' => 11, 'class' => 'row2_col1');
$row2_col2 = array('data' => ($filter['description']==''?"Sisesta filtri pikem selgitus":$filter['description']), 'colspan' => 35, 'class' => 'row2_col2');
$this->table->add_row(
		$row2_col1,
		$row2_col2
		);

$row = array('data' => ' ', 'colspan' => 49, 'class' => 'vahe');
$this->table->add_row(
		$row
		);
$this->table->add_row(
		$row
		);

//$this->table->function = 'htmlspecialchars';
endforeach;

//echo $this->table->generate($filters);
//$this->table->function = 'htmlspecialchars';
echo $this->table->generate();
$this->table->clear();

//echo "\n\n";

echo "*".anchor('filters/edit/0',"Lisa uus filter siin");
?>*
<br>
*<?php 
echo anchor('filters/balance', "Leia Bondoora rahaline seis");
?>*
<br>
*<?php 
echo anchor('filters/download', "Lae uued andmed Bondoorast");
?>*
<br><br>
 *<?php echo anchor('bids/download',"Lae Bondoorast minu pakkumised");?>* 
<br>
 *<?php echo anchor('auctions/index',"Investeeringu küsimised");?>* 
<br>
 *<?php echo anchor('investments/index', "Minu investeeringud");?>* 
<br>
 *<?php echo anchor('secondary/index', "Secondary Market");?>* 

<?php 
//$this->load->library('table');

//$this->table->set_heading(array('Name', 'Color', 'Size'));

//$this->table->add_row(array('Fred', 'Blue', 'Small'));
//$this->table->add_row(array('Mary', 'Red', 'Large'));
//$this->table->add_row(array('John', 'Green', 'Medium'));

//echo $this->table->generate();
?>

<h2><?php //echo $title; ?></h2>

<?php //foreach ($filters as $filters_item): ?>

        <h3><?php //echo $filters_item['id']; ?></h3>
        <div class="main">
                <?php //echo $filters_item['user']; ?>
        </div>
        <p><a href="<?php //echo site_url('filters/'.$filters_item['id']); ?>"></a></p>

<?php //endforeach; ?>


</div>

