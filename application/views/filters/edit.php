<h2></h2>

<?php 
$current_url=current_url();
get_instance()->session->set_userdata('current_url', $current_url);

//echo validation_errors(); ?>
<?php //echo "gender=".$filter['gender']; ?>
<?php //echo "countries=".($filter['countries'])?>
<?php //$countr[]=explode(",", $filter['countries']);?>
<?php //echo "SEIS riikidel=>".(strpos(" ".$filter['countries'],"EE")?"checked='true'":"pole");?>
<?php //echo "Koht=".strpos($filter['countries'],"EE")."  string ise: ".$filter['countries']?>
<?php //echo "Koht=".strpos($filter['countries'],"ES")."  string ise: ".$filter['countries']?>


<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?>
<?php echo validation_errors(); ?>

<?php $attributes = array("class" => "form-horizontal", "id" => "filterform", "name" => "filterform");?>

<?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success">
		<?php echo "Message=".$this->session->flashdata('msg'); ?>
	</div><?php } ?>

<?php echo form_open('filters/edit/'.$id, $attributes); ?>

<?php //peab tabeli kujul tegema, erinevates nagu veergudes, et rohkem mahuks 
echo "pagecount=".$pagecount."   tstamp=".$tstamp."   time=",$time;?>

	testrida1 id=:
	<input type="text" name="id" id="id" value="<?php echo set_value('id', $filter['id'], 0)?>"/><br />
	testrida2 is_new=:
	<input type="text" name="is_new" id="is_new" value="<?php echo set_value('is_new', $is_new)?>"/><br />
	
<fieldset style="width:90%">
<table style="width:100%">
   <tr>
<td>

    <label for="name">Nimetus:</label>
    <input type="text" name="name" id="name" placeholder="Nimetus" class="form-control" size="55" maxlenght="55" value="<?php echo set_value('name',$filter['name'])?>"/>
</td>
<td align="right">
    <label for="description" >Täpsem kirjeldus: </label>
    <textarea name="description" id="description" placeholder="Sisesta kirjeldus siia" rows="3" cols="100" lenght="30"><?php echo set_value('description',($filter['description']))?></textarea><br>
    </td>
    </tr>
    </table>
</fieldset>
<fieldset style="width:90%">
<table style="width:100%">
   <tr>
<td style="width:40%">
<fieldset >
    <label for="user">User</label>
    <input type="email" name="user" id="user" placeholder="Kasutaja" value="<?php echo set_value('user',$filter['user'])?>"/><br />

	
    <label for="amount">Summa</label>
    <input id="amount" placeholder="Makstav summa" type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="amount" align="right" value="<?php echo set_value('amount',$filter['amount'])//echo set_value($filter['amount'])?>"></input><br />
    <?php //echo form_error('amount'); ?>
    

    <?php //<label for="isOneTime">Kas Üks laen= üksmaksmine</label>?>
    <input type="checkbox" name="isOneTime" value="<?php echo set_value('isOneTime',$filter['isOneTime'])?>"/>Kas ühekordne (1laen=1laenuandmine)<br />
    <input type="checkbox" name="isActive" value="<?php echo set_value('isActive',$filter['isActive'])?>"/>Kas aktiivne filter<br />
    
    <label for="jrk">Käivitamise järjekord:</label>
    <input type="number" id="jrk" placeholder="Järjekord" style="direction: rtl;"  pattern='9999' size="4" max="10000" min="0" maxlenght="5" name="jrk" align="right" value="<?php echo set_value('jrk',$filter['jrk'])?>"></input><br />

<?php //    <label for="pageSize">Filtrite arv listis ühel lehel:</label> 
//    <input type="number" style="text-align:right;" pattern="[0-9].*" step="any" size="7" max="999999" min="0" maxlenght="7" name="pageSize" id="pageSize" align="right" value="<?php echo set_value('pageSize',$filter['pageSize'])  >"></input><br />
 ?>   
        <label for="city">Linn:</label>
    <input type="text" name="city" id="city" placeholder="Linn" value="<?php echo set_value('city',$filter['city'])?>"/><br />

        <div class="container">
        <?php
        	$education = array(
                  '0' => 'Pole valitud',
                  '1' => 'Algharidus',
                  '2' => 'Põhikool',
                  '3' => 'Vocational',
        		  '4' => 'Keskharidus',
        		  '5' => 'Kõrgharidus',
                );
        ?>
        <label for="education">Haridus:</label>

        <?php echo form_dropdown('education', $education, set_value('education',$filter['education'])); ?>
        
<?php // <select name="education1" id="education1">
// <option value="0" <?php echo ($filter['education']==0?"selected='selected'":""); >>Pole valitud</option>
// <option value="1" <?php echo ($filter['education']==1?"selected='selected'":""); >>Algharidus</option>
// <option value="2" <?php echo ($filter['education']==2?"selected='selected'":""); >>Põhikool</option>
// <option value="3" <?php echo ($filter['education']==3?"selected='selected'":""); >>Vocational</option>
// <option value="4" <?php echo ($filter['education']==4?"selected='selected'":""); >>Keskharidus</option>
// <option value="5" <?php echo ($filter['education']==5?"selected='selected'":""); >>Kõrgharidus</option>
// </select>
?>

<br>

       <?php
        	$maritalStatus = array(
                  '0' => 'Pole valitud',
                  '1' => 'Abielu',
                  '2' => 'Kooselu',
                  '3' => 'Üksik',
        		  '4' => 'Lahutatud',
        		  '5' => 'Lesk',
                );
        ?>
        <label for="maritalStatus">Abielus?:</label>
        <?php echo form_dropdown('maritalStatus', $maritalStatus, set_value('maritalStatus',$filter['maritalStatus'])); ?>

<?php 
//        <label for="maritalStatus">Abielus?:</label>
// <select name="maritalStatus" id="maritalStatus">
// <option value="0" <?php echo ($filter['maritalStatus']==0?"selected='selected'":""); >>Pole valitud</option>
// <option value="1" <?php echo ($filter['maritalStatus']==1?"selected='selected'":""); >>Abielu</option>
// <option value="2" <?php echo ($filter['maritalStatus']==2?"selected='selected'":""); >>Kooselu</option>
// <option value="3" <?php echo ($filter['maritalStatus']==3?"selected='selected'":""); >>Üksik</option>
// <option value="4" <?php echo ($filter['maritalStatus']==4?"selected='selected'":""); >>Lahutatud</option>
// <option value="5" <?php echo ($filter['maritalStatus']==5?"selected='selected'":""); >>Lesk</option>
// </select>    
?>

<br>    
       <?php
        	$verifycationType = array(
                  '0' => 'Pole valitud',
                  '1' => 'Pole kontrollitud',
                  '2' => 'Kontrollitud telefoni teel',
                  '3' => 'Kontrollitud dokumendiga',
        		  '4' => 'Kontrollitud pangaväljavõttega',
                );
        ?>
        <label for="verifycationType">Kontrolli tüüp:</label>
        <?php echo form_dropdown('verifycationType', $verifycationType, set_value('verifycationType',$filter['verifycationType'])); ?>
<?php 
// <label for="verifycationType">Kontrolli tüüp: </label>
// <select name="verifycationType" id="verifycationType">
// <option value="0" <?php echo ($filter['verifycationType']==0?"selected='selected'":""); >>Pole valitud</option>
// <option value="1" <?php echo ($filter['verifycationType']==1?"selected='selected'":""); >>Pole kontrollitud</option>
// <option value="2" <?php echo ($filter['verifycationType']==2?"selected='selected'":""); >>Kontrollitud telefoni teel</option>
// <option value="3" <?php echo ($filter['verifycationType']==3?"selected='selected'":""); >>Kontrollitud dokumendiga</option>
// <option value="4" <?php echo ($filter['verifycationType']==4?"selected='selected'":""); >>Kontrollitud pangaväljavõttega</option>
// </select>
?>
 <br>
    
	</div>
    
    </fieldset>
</td>
   <td style="width:20%">
   
<fieldset >

<legend>Filtreeritud riigid:</legend>
(tühi=kõik)<br>
    <div class="container">
    <input type="hidden" name="countries" value="<?php echo $filter['countries']?>"></input><br />
<?php 
//    $countriesEE = array(
//    'name'        => 'countriesEE',
//    'value'       => 'EE',
//    'checked'     => set_checkbox('countriesEE', 'EE', strpos(" ".$filter['countries'],"EE")>0?true:'')
//);
//echo form_checkbox($countriesEE).'Eesti';
?>

<?php 
//    $countriesFI = array(
//    'name'        => 'countriesFI',
//    'value'       => 'FI',
//    'checked'     => set_checkbox('countriesFI', 'FI', strpos(" ".$filter['countries'],"FI")>0?true:'')
//);
//echo form_checkbox($countriesFI).'Soome';
?>

<?php 
//    $countriesES = array(
//    'name'        => 'countriesES',
//    'value'       => 'ES',
//    'checked'     => set_checkbox('countriesES', 'ES', strpos(" ".$filter['countries'],"ES")>0?true:'')
//);
//echo form_checkbox($countriesES).'Hispaania';
?>

<?php 
echo form_checkbox('countriesEE', 'EE', set_checkbox('countriesEE', 'EE', strpos(" ".$filter['countries'],"EE")>0?true:'')).'Eesti';
?>
<br>
<?php 
echo form_checkbox('countriesFI', 'FI', set_checkbox('countriesFI', 'FI', strpos(" ".$filter['countries'],"FI")>0?true:'')).'Soome';
?>
<br>
<?php 
echo form_checkbox('countriesES', 'ES', set_checkbox('countriesES', 'ES', strpos(" ".$filter['countries'],"ES")>0?true:'')).'Hispaania';
?>
<?php 
//	<input type="checkbox" name="countriesEE" <?php echo (strpos(" ".$filter['countries'],"EE")>0?"checked='true'":""); > value="EE"/>Eesti<br />
//	<input type="checkbox" name="countriesFI" <?php echo (strpos(" ".$filter['countries'],"FI")>0?"checked='true'":""); > value="FI"/>Soome<br />
//	<input type="checkbox" name="countriesES" <?php echo (strpos(" ".$filter['countries'],"ES")>0?"checked='true'":""); > value="ES"/>Hispaania<br />
	?>
	</div>
</fieldset>


</td>

<td style="width:20%">
<fieldset>

    <legend for="ratings">Filtreeritud ratingud:</legend>
     <div class="container">
  (tühi=kõik)<br>
    <input type="hidden" name="ratings" value="<?php echo $filter['ratings']?>"></input><br />
<?php 
echo form_checkbox('ratingsAA', 'AA', set_checkbox('ratingsAA', 'AA', strpos(" ".$filter['ratings'],"AA")>0?true:'')).'AA';
?>
<br>
<?php 
echo form_checkbox('ratingsA', 'A', set_checkbox('ratingsA', 'A', strpos(" ".$filter['ratings'],"A")>0?true:'')).'A';
?>
<br>
<?php 
echo form_checkbox('ratingsB', 'B', set_checkbox('ratingsB', 'B', strpos(" ".$filter['ratings'],"B")>0?true:'')).'B';
?>
<br>
<?php 
echo form_checkbox('ratingsC', 'C', set_checkbox('ratingsC', 'C', strpos(" ".$filter['ratings'],"C")>0?true:'')).'C';
?>
<br>
<?php 
echo form_checkbox('ratingsD', 'D', set_checkbox('ratingsD', 'D', strpos(" ".$filter['ratings'],"D")>0?true:'')).'D';
?>
<br>
<?php 
echo form_checkbox('ratingsE', 'E', set_checkbox('ratingsE', 'E', strpos(" ".$filter['ratings'],"E")>0?true:'')).'E';
?>
<br>
<?php 
echo form_checkbox('ratingsF', 'F', set_checkbox('ratingsF', 'F', strpos(" ".$filter['ratings'],"F")>0?true:'')).'F';
?>
<br>
<?php 
echo form_checkbox('ratingsHR', 'HR', set_checkbox('ratingsHR', 'HR', strpos(" ".$filter['ratings'],"HR")>0?true:'')).'HR';
?>
<?php 
//	<input type="checkbox" name="ratingsAA" <?php echo (strpos(" ".$filter['ratings'],"AA")>0?"checked='true'":""); > value="AA"/>AA<br />
//	<input type="checkbox" name="ratingsA" <?php echo (strpos(" ".$filter['ratings'],"A")>0?"checked='true'":""); > value="A""/>A<br />
//	<input type="checkbox" name="ratingsB" <?php echo (strpos(" ".$filter['ratings'],"B")>0?"checked='true'":""); > value="B"/>B<br />
//	<input type="checkbox" name="ratingsC" <?php echo (strpos(" ".$filter['ratings'],"C")>0?"checked='true'":""); > value="C"/>C<br />
//	<input type="checkbox" name="ratingsD" <?php echo (strpos(" ".$filter['ratings'],"D")>0?"checked='true'":""); > value="D"/>D<br />
//	<input type="checkbox" name="ratingsE" <?php echo (strpos(" ".$filter['ratings'],"E")>0?"checked='true'":""); > value="E"/>E<br />
//	<input type="checkbox" name="ratingsF" <?php echo (strpos(" ".$filter['ratings'],"F")>0?"checked='true'":""); > value="F"/>F<br />
//	<input type="checkbox" name="ratingsHR" <?php echo (strpos(" ".$filter['ratings'],"HR")>0?"checked='true'":""); > value="HR"/>HR<br />
	?>
	</div>
</fieldset>
	
</td>
<td style="width:20%">
<fieldset>        			
    
	
	

    <legend for="terms">Laenu pikkus:</legend>
    <div class="container">
    (tühi=kõik)<br>
    <input type="hidden" name="terms" placeholder="Laenu pikkus" value="<?php echo ($filter['terms']==NULL?$filter['terms']:'')?>"></input><br />
<?php 
echo form_checkbox('terms3', '3', set_checkbox('terms3', '3', strpos(" ".$filter['terms'],"3")>0?true:'')).'3kuud';
?>
<br>
<?php 
echo form_checkbox('terms9', '9', set_checkbox('terms9', '9', strpos(" ".$filter['terms'],"9")>0?true:'')).'9kuud';
?>
<br>
<?php 
echo form_checkbox('terms12', '12', set_checkbox('terms12', '12', strpos(" ".$filter['terms'],"12")>0?true:'')).'12kuud';
?>
<br>
<?php 
echo form_checkbox('terms18', '18', set_checkbox('terms18', '18', strpos(" ".$filter['terms'],"18")>0?true:'')).'18kuud';
?>
<br>
<?php 
echo form_checkbox('terms24', '24', set_checkbox('terms24', '24', strpos(" ".$filter['terms'],"24")>0?true:'')).'24kuud';
?>
<br>
<?php 
echo form_checkbox('terms36', '36', set_checkbox('terms36', '36', strpos(" ".$filter['terms'],"36")>0?true:'')).'36kuud';
?>
<br>
<?php 
echo form_checkbox('terms48', '48', set_checkbox('terms48', '48', strpos(" ".$filter['terms'],"48")>0?true:'')).'48kuud';
?>
<br>
<?php 
echo form_checkbox('terms60', '60', set_checkbox('terms60', '60', strpos(" ".$filter['terms'],"60")>0?true:'')).'60kuud';
?>
<?php 

//	<input type="checkbox" name="terms3" <?php echo (strpos(" ".$filter['terms'],"3")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"3")>0?"value='3'":""); >/>3kuud<br />
//	<input type="checkbox" name="terms9" <?php echo (strpos(" ".$filter['terms'],"9")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"9")>0?"value='9'":""); >"/>9kuud<br />
//	<input type="checkbox" name="terms12" <?php echo (strpos(" ".$filter['terms'],"12")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"12")>0?"value='12'":""); >"/>12kuud<br />
//	<input type="checkbox" name="terms18" <?php echo (strpos(" ".$filter['terms'],"18")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"18")>0?"value='18'":""); >"/>18kuud<br />
//	<input type="checkbox" name="terms24" <?php echo (strpos(" ".$filter['terms'],"24")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"24")>0?"value='24'":""); >"/>24kuud<br />
//	<input type="checkbox" name="terms36" <?php echo (strpos(" ".$filter['terms'],"36")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"36")>0?"value='36'":""); >"/>36kuud<br />
//	<input type="checkbox" name="terms48" <?php echo (strpos(" ".$filter['terms'],"48")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"48")>0?"value='48'":""); >"/>48kuud<br />
//	<input type="checkbox" name="terms60" <?php echo (strpos(" ".$filter['terms'],"60")>0?"checked='true'":""); > <?php echo (strpos(" ".$filter['terms'],"60")>0?"value='60'":""); >"/>60kuud<br />
?>
	</div>

	
	</fieldset>
    <?php //    			'maritalStatus' => $this->input->post('maritalStatus'), ?>
</td>
  </tr>
</table> 
</fieldset>
<fieldset style="width:90%">
<table style="width:100%">
   <tr>
<td>

<fieldset>
<?php //   <label for="gender">Vali sugu:</label><br>
    //<div class="container">
    //<input type="radio" name="gender" ?><?php //echo ($filter['gender']==0?"checked='true'":"");?><?php // value="0">Kõik</input><br />
    //<input type="radio" name="gender" <?php echo ($filter['gender']==1?"checked='true'":"");?><?php // value="1">Mehed</input><br />
    //<input type="radio" name="gender" <?php echo ($filter['gender']==2?"checked='true'":"");?><?php // value="2">Naised</input><br />
	//</div>?>

       <?php
        	$gender = array(
                  '2' => 'Pole teada',
                  '0' => 'Mehed',
                  '1' => 'Naised',
                );
        ?>
        <label for="gender">Vali sugu:</label>
        <?php echo form_dropdown('gender', $gender, set_value('gender',$filter['gender'])); ?>
<?php 
//<label for="gender">Vali sugu: </label>
// <select name="gender" id="gender">
// <option value="2" <?php echo ($filter['gender']==2?"selected='selected'":""); >>Pole teada</option>
// <option value="0" <?php echo ($filter['gender']==0?"selected='selected'":""); >>Mehed</option>
// <option value="1" <?php echo ($filter['gender']==1?"selected='selected'":""); >>Naised </option>
// </select>
?>
<br>

    <label for="incomeTotalMin">Sissetulek:</label><br>
    <input type="number" style="text-align:right;" placeholder="alates 0.00" pattern="[0-9]+([\.|][0-9]+)?" step="0.01" size="9" max="100000" min="0" maxlenght="9" name="incomeTotalMin" id="incomeTotalMin" align="right" value="<?php echo set_value('incomeTotalMin',($filter['incomeTotalMin']>0.00?$filter['incomeTotalMin']:'0.00'))?>"></input> - 
    <input type="number" style="text-align:right;" placeholder="kuni 0.00" pattern="[0-9]+([\.|][0-9]+)?" step="0.01" size="9" max="100000" min="0" maxlenght="9" name="incomeTotalMax" id="incomeTotalMax" align="right" value="<?php echo set_value('incomeTotalMax',($filter['incomeTotalMax']>0.00?$filter['incomeTotalMax']:'0.00'))?>"></input><br />

    <label for="ageMin">Vanus:</label>
    <input type="number" style="text-align:right;"  placeholder="alates 0" pattern="[0-9]+([\.|,][0-9]+)?" step="1" size="3" max="200" min="1" maxlenght="3" name="ageMin" id="ageMin" align="right" value="<?php echo set_value('ageMin',$filter['ageMin'])?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 200" pattern="[0-9]+([\.|,][0-9]+)?" step="1" size="3" max="200" min="1" maxlenght="3" name="ageMax" id="ageMax" align="right" value="<?php echo set_value('ageMax',$filter['ageMax'])?>"></input><br />

<?php
//CreditScore
//1000 No previous payments problems
//900 Payments problems finished 24-36 months ago
//800 Payments problems finished 12-24 months ago
//700 Payments problems finished 6-12 months ago
//600 Payment problems finished <6 months ago
//500 Active payment problems
?>

       <?php
//       if ($filter['creditScoreMin'] == 0)
// 	      $filter['creditScoreMin'] = 1000;
        	$creditScoreMin = array(
                  '0' => '0 Pole valitud = 1000, Pole probleeme',
                  '500' => '500 Aktiivsed makseprobleemid',
                  '600' => '600 Makseprobleemid kuni 6kuud tagasi',
        		  '700' => '700 Makseprobleemid 6-12kuud tagasi',
        		  '800' => '800 Makseprobleemid 12-24kuud tagasi',
        		  '900' => '900 Makseprobleemid 24-36kuud tagasi',
        		  '1000' => '1000 Pole varasemaid makseprobleeme',
                );
        ?>
        <label for="creditScoreMin">Krediidiskoor alates:</label>
        <?php echo form_dropdown('creditScoreMin', $creditScoreMin, set_value('creditScoreMin',$filter['creditScoreMin'])); 

    //<input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="1" size="7" max="10000" min="0" maxlenght="7" name="creditScoreMax" align="right" value="<?php echo $filter['creditScoreMax'] >"></input>
   ?> kuni-><br>
          <?php
//       if ($filter['creditScoreMax'] == 0)
// 	      $filter['creditScoreMax'] = 1000;
        	$creditScoreMax = array(
                  '0' => '0 Pole valitud = 1000, Pole probleeme',
                  '500' => '500 Aktiivsed makseprobleemid',
                  '600' => '600 Makseprobleemid kuni 6kuud tagasi',
        		  '700' => '700 Makseprobleemid 6-12kuud tagasi',
        		  '800' => '800 Makseprobleemid 12-24kuud tagasi',
        		  '900' => '900 Makseprobleemid 24-36kuud tagasi',
        		  '1000' => '1000 Pole varasemaid makseprobleeme',
                );
        ?>
        <?php echo form_dropdown('creditScoreMax', $creditScoreMax, set_value('creditScoreMax',$filter['creditScoreMax'])); ?>
    		
    		<br />

    <label for="userName">Konkreetsele kasutajale:</label>
    <input type="text" name="userName" id="userName" placeholder="Kasutajanimi" value="<?php echo set_value('userName',$filter['userName'])?>"/><br />

    <?php //<label for="creditGroups">Krediidigrupid:</label>
    //<div class="container">
    //<input type="text" name="creditGroups" value="<php echo $filter['creditGroups']>"></input><br />
	//</div>
    //<>     			'creditGroups' => $this->input->post('creditGroups'), ?>

    <label for="interestMin">Intress:</label><br>
    <input type="number" style="text-align:right;"  placeholder="alates 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="interestMin" id="interestMax" align="right" value="<?php echo set_value('interestMin',$filter['interestMin']>0?$filter['interestMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="interestMax" id="interestMax" align="right" value="<?php echo set_value('interestMax',$filter['interestMax']>0?$filter['interestMax']:'0.00')?>"></input><br />


    <?php //     			'incomeTotalMin' => $this->input->post('incomeTotalMin'), ?>
    <?php //    			'incomeTotalMax' => $this->input->post('incomeTotalMax'), ?>
        			
    <label for="expectedLossMin">Oodatud kaotus:</label><br>
    <input type="number" style="text-align:right;"  placeholder="alates 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedLossMin" id="expectedLossMin" align="right" value="<?php echo set_value('expectedLossMin',$filter['expectedLossMin']>0?$filter['expectedLossMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedLossMax" id="expectedLossMax" align="right" value="<?php echo set_value('expectedLossMax',$filter['expectedLossMax']>0?$filter['expectedLossMax']:'0.00')?>"></input><br />

</fieldset>
</td>


<td>
<fieldset>

       <?php
        	$useOfLoan = array(
                  '-1' => 'Pole valitud',
                  '0' => 'Laenude konsolideerimine',
                  '1' => 'Kinnisvara ost',
        		  '2' => 'Kodu renoveerimine',
        		  '3' => 'Äri',
        		  '4' => 'Õppimiseks',
        		  '5' => 'Reisimiseks',
        		  '6' => 'Liiklusvahend',
        		  '7' => 'Muu eesmärk',
        		  '8' => 'Tervis',
                );
        ?>
        <label for="useOfLoan">Laenu eesmärk:</label>
        <?php echo form_dropdown('useOfLoan', $useOfLoan, set_value('useOfLoan',$filter['useOfLoan'])); ?>
<?php 
// <label for="useOfLoan">Laenu eesmärk: </label>
// <select name="useOfLoan" id="useOfLoan">
// <option value="-1" <?php echo ($filter['useOfLoan']==-1?"selected='selected'":""); >>Pole valitud</option>
// <option value="0" <?php echo ($filter['useOfLoan']==0?"selected='selected'":""); >>Laenude konsolideerimine</option>
// <option value="1" <?php echo ($filter['useOfLoan']==1?"selected='selected'":""); >>Kinnisvara ost</option>
// <option value="2" <?php echo ($filter['useOfLoan']==2?"selected='selected'":""); >>Kodu renoveerimine</option>
// <option value="3" <?php echo ($filter['useOfLoan']==3?"selected='selected'":""); >>Äri</option>
// <option value="4" <?php echo ($filter['useOfLoan']==4?"selected='selected'":""); >>Õppimiseks</option>
// <option value="5" <?php echo ($filter['useOfLoan']==5?"selected='selected'":""); >>Reisimiseks</option>
// <option value="6" <?php echo ($filter['useOfLoan']==6?"selected='selected'":""); >>Liiklusvahend</option>
// <option value="7" <?php echo ($filter['useOfLoan']==7?"selected='selected'":""); >>Muu eesmärk</option>
// <option value="8" <?php echo ($filter['useOfLoan']==8?"selected='selected'":""); >>Tervis</option>
// </select>
?>
 <br>	


    <label for="nrOfDependantsMin">Ülalpeetavate arv:</label>
    <input type="number" style="text-align:right;"  placeholder="alates 0" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="nrOfDependantsMin" id="nrOfDependantsMin" align="right" value="<?php echo set_value('nrOfDependantsMin',$filter['nrOfDependantsMin'])?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 0" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="nrOfDependantsMax" id="nrOfDependantsMax" align="right" value="<?php echo set_value('nrOfDependantsMax',$filter['nrOfDependantsMax'])?>"></input><br />

<div class="container">
       <?php
        	$employmentStatus = array(
                  '0' => 'Pole valitud',
                  '1' => 'Töötu',
        		  '2' => 'Osalise tööajaga',
        		  '3' => 'Täistööaeg',
        		  '4' => 'Iseenda tööandja',
        		  '5' => 'Entrepreneur',
        		  '6' => 'Pensionil',
                );
        ?>
        <label for="employmentStatus">Kas tööl/töötu/muu?:</label>
        <?php echo form_dropdown('employmentStatus', $employmentStatus, set_value('employmentStatus',$filter['employmentStatus'])); ?>
<?php 
//        <label for="employmentStatus">Kas tööl/töötu/muu?:</label>
//     <select name="employmentStatus" id="employmentStatus">
// <option value="0" <?php echo ($filter['employmentStatus']==0?"selected='selected'":""); >>Pole valitud</option>
// <option value="1" <?php echo ($filter['employmentStatus']==1?"selected='selected'":""); >>Töötu</option>
// <option value="2" <?php echo ($filter['employmentStatus']==2?"selected='selected'":""); >>Osalise tööajaga</option>
// <option value="3" <?php echo ($filter['employmentStatus']==3?"selected='selected'":""); >>Täistööaeg</option>
// <option value="4" <?php echo ($filter['employmentStatus']==4?"selected='selected'":""); >>Iseenda tööandja</option>
// <option value="5" <?php echo ($filter['employmentStatus']==5?"selected='selected'":""); >>Entrepreneur </option>
// <option value="6" <?php echo ($filter['employmentStatus']==6?"selected='selected'":""); >>Pensionil </option>
// </select>
  ?>  
    
	</div>
    <?php //    			'employmentStatus' => $this->input->post('employmentStatus'), ?>

    <label for="employmentDurationCurrentEmployer">Kaua töötanud praeguse tööandja juures vähemalt:</label>
    <input type="number" style="text-align:right;"  placeholder="0 aastat" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="employmentDurationCurrentEmployer" id="employmentDurationCurrentEmployer" align="right" value="<?php echo set_value('employmentDurationCurrentEmployer',$filter['employmentDurationCurrentEmployer'])?>"></input><br /> 

    <label for="workExperience">Töökogemus:</label>
    <input type="number" style="text-align:right;"  placeholder="0 aastat" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="workExperience" id="workExperience" align="right" value="<?php echo set_value('workExperience',$filter['workExperience'])?>"></input><br /> 

<div class="container">

       <?php
        	$occupationArea = array(
                  '0' => 'Pole valitud',
                  '1' => 'Muu',
        		  '2' => 'Mining',
        		  '3' => 'Processing',
        		  '4' => 'Energia',
        		  '5' => 'Utilities',
        		  '6' => 'Construction',
        			'7' => 'Retail',
        			'8' => 'Transport',
        			'9' => 'Hospitality',
        			'10' => 'Telecom',
        			'11' => 'Finance',
        			'12' => 'Kinnisvara',
        			'13' => 'Teadus',
        			'14' => 'Administrative',
        			'15' => 'CivilService',
        			'16' => 'Education',
        			'17' => 'Healthcare',
        			'18' => 'Kunst',
        			'19' => 'Agriculture',
                );
        ?>
        <label for="occupationArea">Tööala:</label>
        <?php echo form_dropdown('occupationArea', $occupationArea, set_value('occupationArea',$filter['occupationArea'])); ?>
<?php 
//        <label for="occupationArea">Tööala:</label>
//    <select name="occupationArea" id="occupationArea">
// <option value="0" <?php echo ($filter['occupationArea']==0?"selected='selected'":""); >>Pole valitud</option>
// <option value="1" <?php echo ($filter['occupationArea']==1?"selected='selected'":""); >>Muu</option>
// <option value="2" <?php echo ($filter['occupationArea']==2?"selected='selected'":""); >>Mining</option>
// <option value="3" <?php echo ($filter['occupationArea']==3?"selected='selected'":""); >>Processing </option>
// <option value="4" <?php echo ($filter['occupationArea']==4?"selected='selected'":""); >>Energia</option>
// <option value="5" <?php echo ($filter['occupationArea']==5?"selected='selected'":""); >>Utilities</option>
// <option value="6" <?php echo ($filter['occupationArea']==6?"selected='selected'":""); >>Construction</option>
// <option value="7" <?php echo ($filter['occupationArea']==7?"selected='selected'":""); >>Retail</option>
// <option value="8" <?php echo ($filter['occupationArea']==8?"selected='selected'":""); >>Transport</option>
// <option value="9" <?php echo ($filter['occupationArea']==9?"selected='selected'":""); >>Hospitality</option>
// <option value="10" <?php echo ($filter['occupationArea']==10?"selected='selected'":""); >>Telecom</option>
// <option value="11" <?php echo ($filter['occupationArea']==11?"selected='selected'":""); >>Finance</option>
// <option value="12" <?php echo ($filter['occupationArea']==12?"selected='selected'":""); >>Kinnisvara</option>
// <option value="13" <?php echo ($filter['occupationArea']==13?"selected='selected'":""); >>Teadus</option>
// <option value="14" <?php echo ($filter['occupationArea']==14?"selected='selected'":""); >>Administrative</option>
// <option value="15" <?php echo ($filter['occupationArea']==15?"selected='selected'":""); >>CivilService</option>
// <option value="16" <?php echo ($filter['occupationArea']==16?"selected='selected'":""); >>Education</option>
// <option value="17" <?php echo ($filter['occupationArea']==17?"selected='selected'":""); >>Healthcare</option>
// <option value="18" <?php echo ($filter['occupationArea']==18?"selected='selected'":""); >>Kunst</option>
// <option value="19" <?php echo ($filter['occupationArea']==19?"selected='selected'":""); >>Agriculture</option>
// </select> 
 ?>   
    
	</div>
    <?php //    			'occupationArea' => $this->input->post('occupationArea'), ?>
    <div class="container">
       <?php
        	$homeOwnershipType = array(
        		  '-1' => 'Pole valitud',
                  '0' => 'Kodutu',
                  '1' => 'Omanik',
        		  '2' => 'Elab koos vanematega',
        		  '3' => 'TenantFurnished',
        		  '4' => 'TenantUnfurnished',
        		  '5' => 'CouncilTenant',
        		  '6' => 'JointTenant',
        			'7' => 'JointOwner',
        			'8' => 'OwnerMortgage',
        			'9' => 'OwnerEncumbrance',
                );
        ?>
        <label for="homeOwnershipType">Kodu omaniku staatus:</label>
        <?php echo form_dropdown('homeOwnershipType', $homeOwnershipType, set_value('homeOwnershipType',$filter['homeOwnershipType'])); ?>
<?php 
// <label for="homeOwnershipType">Kodu omaniku staatus:</label>
// <select name="homeOwnershipType" id="homeOwnershipType">
// <option value="-1" <?php echo ($filter['homeOwnershipType']==-1?"selected='selected'":""); >>Pole valitud</option>
// <option value="0" <?php echo ($filter['homeOwnershipType']==0?"selected='selected'":""); >>Kodutu</option>
// <option value="1" <?php echo ($filter['homeOwnershipType']==1?"selected='selected'":""); >>Omanik</option>
// <option value="2" <?php echo ($filter['homeOwnershipType']==2?"selected='selected'":""); >>Elab koos vanematega</option>
// <option value="3" <?php echo ($filter['homeOwnershipType']==3?"selected='selected'":""); >>TenantFurnished</option>
// <option value="4" <?php echo ($filter['homeOwnershipType']==4?"selected='selected'":""); >>TenantUnfurnished</option>
// <option value="5" <?php echo ($filter['homeOwnershipType']==5?"selected='selected'":""); >>CouncilTenant</option>
// <option value="6" <?php echo ($filter['homeOwnershipType']==6?"selected='selected'":""); >>JointTenant</option>
// <option value="7" <?php echo ($filter['homeOwnershipType']==7?"selected='selected'":""); >>JointOwner</option>
// <option value="8" <?php echo ($filter['homeOwnershipType']==8?"selected='selected'":""); >>OwnerMortgage</option>
// <option value="9" <?php echo ($filter['homeOwnershipType']==9?"selected='selected'":""); >>OwnerEncumbrance</option>
// </select>
  ?>   
	</div>
    <?php //    			'homeOwnershipType' => $this->input->post('homeOwnershipType'), ?>
</fieldset>
</td>


<td>
<fieldset>
    <label for="incomeFromPrincipalEmpoyerMin">Sissetulek põhitöökohast:</label>
    <input type="number" style="text-align:right;"  placeholder="0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="incomeFromPrincipalEmpoyerMin" id="incomeFromPrincipalEmpoyerMin" align="right" value="<?php echo set_value('incomeFromPrincipalEmpoyerMin',$filter['incomeFromPrincipalEmpoyerMin']>0?$filter['incomeFromPrincipalEmpoyerMin']:'0.00')?>"></input>
    <br /> 

       <?php
        	$isIncomeFromPension = array(
        		  '-1' => 'Pole teada',
                  '0' => 'Jah',
                  '1' => 'Ei',
                );
        ?>
        <div class="container">
        
        <br>Kas sissetulek-><br>
        <label for="isIncomeFromPension">Pensionist:</label>
        <?php echo form_dropdown('isIncomeFromPension', $isIncomeFromPension, set_value('isIncomeFromPension',$filter['isIncomeFromPension'])); ?>
<?php 
//<label for="isIncomeFromPension">Kas sissetulek pensionist: </label>
// <select name="isIncomeFromPension" id="isIncomeFromPension">
// <option value="-1" <?php echo ($filter['isIncomeFromPension']==-1?"selected='selected'":""); >>Pole teada</option>
// <option value="0" <?php echo ($filter['isIncomeFromPension']==0?"selected='selected'":""); >>Jah</option>
// <option value="1" <?php echo ($filter['isIncomeFromPension']==1?"selected='selected'":""); >>Ei </option>
// </select>
  ?>
    <br /> 


       <?php
        	$isIncomeFromSocialWelfare = array(
        		  '-1' => 'Pole teada',
                  '0' => 'Jah',
                  '1' => 'Ei',
                );
        ?>
        <label for="isIncomeFromSocialWelfare">Sotsiaaltoetustest:</label>
        <?php echo form_dropdown('isIncomeFromSocialWelfare', $isIncomeFromSocialWelfare, set_value('isIncomeFromSocialWelfare',$filter['isIncomeFromSocialWelfare'])); ?>
<?php 
//<label for="isIncomeFromSocialWelfare">Kas sissetulek sotsiaaltoetustest: </label>
// <select name="isIncomeFromSocialWelfare" id="isIncomeFromSocialWelfare">
// <option value="-1" <?php echo ($filter['isIncomeFromSocialWelfare']==-1?"selected='selected'":""); >>Pole teada</option>
// <option value="0" <?php echo ($filter['isIncomeFromSocialWelfare']==0?"selected='selected'":""); >>Jah</option>
// <option value="1" <?php echo ($filter['isIncomeFromSocialWelfare']==1?"selected='selected'":""); >>Ei </option>
// </select>
  ?>
    <br /> 


       <?php
        	$isIncomeFromChildSupport = array(
        		  '-1' => 'Pole teada',
                  '0' => 'Jah',
                  '1' => 'Ei',
                );
        ?>
        <label for="isIncomeFromChildSupport">Lastetoetusest:</label>
        <?php echo form_dropdown('isIncomeFromChildSupport', $isIncomeFromChildSupport, set_value('isIncomeFromChildSupport',$filter['isIncomeFromChildSupport'])); ?>
</div>
<?php 
//<label for="isIncomeFromChildSupport">Kas sissetulek lastetoetusest: </label>
// <select name="isIncomeFromChildSupport" id="isIncomeFromChildSupport">
// <option value="-1" <?php echo ($filter['isIncomeFromChildSupport']==-1?"selected='selected'":""); >>Pole teada</option>
// <option value="0" <?php echo ($filter['isIncomeFromChildSupport']==0?"selected='selected'":""); >>Jah</option>
// <option value="1" <?php echo ($filter['isIncomeFromChildSupport']==1?"selected='selected'":""); >>Ei </option>
// </select>
  ?>
    <br /> 

    
    <label for="probabilityOfBadMin">Halvaks minemise võimalus:</label><br>
    <input type="number" style="text-align:right;"  placeholder="alates 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfBadMin" id="probabilityOfBadMin" align="right" value="<?php echo set_value('probabilityOfBadMin',$filter['probabilityOfBadMin']>0?$filter['probabilityOfBadMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfBadMax" id="probabilityOfBadMax" align="right" value="<?php echo set_value('probabilityOfBadMax',$filter['probabilityOfBadMax']>0?$filter['probabilityOfBadMax']:'0.00')?>"></input><br />

    <label for="probabilityOfDefaultMin">Pankrotti minemise võimalus:</label><br>
    <input type="number" style="text-align:right;"  placeholder="alates 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfDefaultMin" id="probabilityOfDefaultMin" align="right" value="<?php echo set_value('probabilityOfDefaultMin',$filter['probabilityOfDefaultMin']>0?$filter['probabilityOfDefaultMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfDefaultMax" id="probabilityOfDefaultMax" align="right" value="<?php echo set_value('probabilityOfDefaultMax',$filter['probabilityOfDefaultMax']>0?$filter['probabilityOfDefaultMax']:'0.00')?>"></input><br />
    
    <label for="expectedReturnMin">Oodatav tulusus:</label><br>
    <input type="number" style="text-align:right;"  placeholder="alates 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedReturnMin" id="expectedReturnMin" align="right" value="<?php echo set_value('expectedReturnMin',$filter['expectedReturnMin']>0?$filter['expectedReturnMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  placeholder="kuni 0.00" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedReturnMax" id="expectedReturnMax" align="right" value="<?php echo set_value('expectedReturnMax',$filter['expectedReturnMax']>0?$filter['expectedReturnMax']:'0.00')?>"></input><br />
</fieldset>
</td>
</tr>
</table>
</fieldset>

    <?php //<label for="isOneTime">Kas Üks laen= üksmaksmine</label>?>
    <input type="checkbox" name="isLocalSearch" value="<?php echo $filter['isLocalSearch']?>"/>Kas ühekordne (ühekordne käsitsi otsing, mitte automaatne panustamine)<br />

    <button type="submit" name="submit" value="formSave">Filtri salvestamine</button>
    <button type="submit" name="submit" value="formBack"><?php echo anchor('filters/index',"Tagasi");?></button>
	<input type="reset" name="reset" value="Algseis" />

</form>
