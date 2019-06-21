<h2></h2>

<?php //echo validation_errors(); ?>
<?php //echo "gender=".$filter['gender']; ?>
<?php //echo "countries=".($filter['countries'])?>
<?php //$countr[]=explode(",", $filter['countries']);?>
<?php //echo "SEIS riikidel=>".(strpos(" ".$filter['countries'],"EE")?"checked='true'":"pole");?>
<?php //echo "Koht=".strpos($filter['countries'],"EE")."  string ise: ".$filter['countries']?>
<?php //echo "Koht=".strpos($filter['countries'],"ES")."  string ise: ".$filter['countries']?>


<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?>
<?php echo validation_errors(); ?>

<?php echo form_open('filters/edit'); ?>

<?php //peab tabeli kujul tegema, erinevates nagu veergudes, et rohkem mahuks ?>

	testrida1 id=:
	<input type="text" name="id" value="<?php echo $filter['id']?>"/><br />
	testrida2 is_new=:
	<input type="text" name="is_new" value="<?php echo $is_new?>"/><br />
<fieldset style="width:80%">
<table style="width:100%">
   <tr>
<td>

    <label for="name">Nimetus:</label>
    <input type="text" name="name" size="45" maxlenght="45" value="<?php echo $filter['name']?>"/>
</td>
<td align="right">
    <label for="description" >Täpsem kirjeldus: </label>
    <textarea name="description" rows="3" cols="100" form="filters/edit" lenght="30"><?php echo ($filter['description']==null?"Sisesta kirjeldus siia":$filter['description'])?></textarea><br>
    </td>
    </tr>
    </table>
</fieldset>
<fieldset style="width:80%">
<table style="width:100%">
   <tr>
<td>
<fieldset>
    <label for="user">User</label>
    <input type="email" name="user" value="<?php echo $filter['user']?>"/><br />

	
    <label for="amount">Summa</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="amount" align="right" value="<?php echo $filter['amount']//echo set_value($filter['amount'])?>"></input><br />
    <?php echo form_error('amount'); ?>
    

    <?php //<label for="isOneTime">Kas Üks laen= üksmaksmine</label>?>
    <input type="checkbox" name="isOneTime" value="<?php echo $filter['isOneTime']?>"/>Kas ühekordne (1laen=1laenuandmine)<br />
    <input type="checkbox" name="isActive" value="<?php echo $filter['isActive']?>"/>Kas aktiivne filter<br />
    
    <label for="jrk">Käivitamise järjekord nr:</label>
    <input type="number" style="direction: rtl;"  pattern='9999' size="4" max="10000" min="0" maxlenght="5" name="jrk" align="right" value="<?php echo $filter['jrk']?>"></input><br />

    <label for="pageSize">Filtrite arv listis ühel lehel:</label>
    <input type="number" style="text-align:right;" pattern="[0-9].*" step="any" size="7" max="999999" min="0" maxlenght="7" name="pageSize" align="right" value="<?php echo $filter['pageSize']?>"></input><br />
    
        <label for="city">Linn:</label>
    <input type="text" name="city" value="<?php echo $filter['city']?>"/><br />

        <div class="container">
        <label for="education">Haridus:</label>
 <select name="education" id="education">
 <option value="0" <?php echo ($filter['education']==0?"selected='selected'":"");?>>Pole valitud</option>
 <option value="1" <?php echo ($filter['education']==1?"selected='selected'":"");?>>Algharidus</option>
 <option value="2" <?php echo ($filter['education']==2?"selected='selected'":"");?>>Põhikool</option>
 <option value="3" <?php echo ($filter['education']==3?"selected='selected'":"");?>>Vocational</option>
 <option value="4" <?php echo ($filter['education']==4?"selected='selected'":"");?>>Keskharidus</option>
 <option value="5" <?php echo ($filter['education']==5?"selected='selected'":"");?>>Kõrgharidus</option>
 </select>

<br>

        <label for="maritalStatus">Abielus?:</label>
 <select name="maritalStatus" id="maritalStatus">
 <option value="0" <?php echo ($filter['maritalStatus']==0?"selected='selected'":"");?>>Pole valitud</option>
 <option value="1" <?php echo ($filter['maritalStatus']==1?"selected='selected'":"");?>>Abielu</option>
 <option value="2" <?php echo ($filter['maritalStatus']==2?"selected='selected'":"");?>>Kooselu</option>
 <option value="3" <?php echo ($filter['maritalStatus']==3?"selected='selected'":"");?>>Üksik</option>
 <option value="4" <?php echo ($filter['maritalStatus']==4?"selected='selected'":"");?>>Lahutatud</option>
 <option value="5" <?php echo ($filter['maritalStatus']==5?"selected='selected'":"");?>>Lesk</option>
 </select>    

<br>    
 <label for="verifycationType">Kontrolli tüüp: </label>
 <select name="verifycationType" id="verifycationType">
 <option value="0" <?php echo ($filter['verifycationType']==0?"selected='selected'":"");?>>Pole valitud</option>
 <option value="1" <?php echo ($filter['verifycationType']==1?"selected='selected'":"");?>>Pole kontrollitud</option>
 <option value="2" <?php echo ($filter['verifycationType']==2?"selected='selected'":"");?>>Kontrollitud telefoni teel</option>
 <option value="3" <?php echo ($filter['verifycationType']==3?"selected='selected'":"");?>>Kontrollitud dokumendiga</option>
 <option value="4" <?php echo ($filter['verifycationType']==4?"selected='selected'":"");?>>Kontrollitud pangaväljavõttega</option>
 </select>
 <br>
    
	</div>
    
    </fieldset>
</td>
   <td>
   
<fieldset>
<legend>Filtreeritud riigid (tühi=kõik):</legend>
    <div class="container">
    <input type="text" name="countries" value="<?php echo $filter['countries']?>"></input><br />
	<input type="checkbox" name="countriesEE" <?php echo (strpos(" ".$filter['countries'],"EE")>0?"checked='true'":"");?> value="EE"/>Eesti<br />
	<input type="checkbox" name="countriesFI" <?php echo (strpos(" ".$filter['countries'],"FI")>0?"checked='true'":"");?> value="FI"/>Soome<br />
	<input type="checkbox" name="countriesES" <?php echo (strpos(" ".$filter['countries'],"ES")>0?"checked='true'":"");?> value="ES"/>Hispaania<br />
	</div>
</fieldset>


</td>

<td>
<fieldset>

    <label for="ratings">Filtreeritud ratingud (tühi=kõik):</label>
    <div class="container">
    <input type="text" name="ratings" value="<?php echo $filter['ratings']?>"></input><br />
	<input type="checkbox" name="ratingsAA" <?php echo (strpos(" ".$filter['ratings'],"AA")>0?"checked='true'":"");?> value="AA"/>AA<br />
	<input type="checkbox" name="ratingsA" <?php echo (strpos(" ".$filter['ratings'],"A")>0?"checked='true'":"");?> value="A""/>A<br />
	<input type="checkbox" name="ratingsB" <?php echo (strpos(" ".$filter['ratings'],"B")>0?"checked='true'":"");?> value="B"/>B<br />
	<input type="checkbox" name="ratingsC" <?php echo (strpos(" ".$filter['ratings'],"C")>0?"checked='true'":"");?> value="C"/>C<br />
	<input type="checkbox" name="ratingsD" <?php echo (strpos(" ".$filter['ratings'],"D")>0?"checked='true'":"");?> value="D"/>D<br />
	<input type="checkbox" name="ratingsE" <?php echo (strpos(" ".$filter['ratings'],"E")>0?"checked='true'":"");?> value="E"/>E<br />
	<input type="checkbox" name="ratingsF" <?php echo (strpos(" ".$filter['ratings'],"F")>0?"checked='true'":"");?> value="F"/>F<br />
	<input type="checkbox" name="ratingsHR" <?php echo (strpos(" ".$filter['ratings'],"HR")>0?"checked='true'":"");?> value="HR"/>HR<br />
	</div>
</fieldset>
	
</td>
<td>
<fieldset>        			
    
	
	

    <label for="terms">Laenu pikkus:</label>
    <div class="container">
    <input type="text" name="terms" value="<?php echo $filter['terms']?>"></input><br />
	<input type="checkbox" name="terms3" <?php echo (strpos(" ".$filter['terms'],"3")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"3")>0?"value='3'":"");?>/>3kuud<br />
	<input type="checkbox" name="terms9" <?php echo (strpos(" ".$filter['terms'],"9")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"9")>0?"value='9'":"");?>"/>9kuud<br />
	<input type="checkbox" name="terms12" <?php echo (strpos(" ".$filter['terms'],"12")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"12")>0?"value='12'":"");?>"/>12kuud<br />
	<input type="checkbox" name="terms18" <?php echo (strpos(" ".$filter['terms'],"18")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"18")>0?"value='18'":"");?>"/>18kuud<br />
	<input type="checkbox" name="terms24" <?php echo (strpos(" ".$filter['terms'],"24")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"24")>0?"value='24'":"");?>"/>24kuud<br />
	<input type="checkbox" name="terms36" <?php echo (strpos(" ".$filter['terms'],"36")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"36")>0?"value='36'":"");?>"/>36kuud<br />
	<input type="checkbox" name="terms48" <?php echo (strpos(" ".$filter['terms'],"48")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"48")>0?"value='48'":"");?>"/>48kuud<br />
	<input type="checkbox" name="terms60" <?php echo (strpos(" ".$filter['terms'],"60")>0?"checked='true'":"");?> <?php echo (strpos(" ".$filter['terms'],"60")>0?"value='60'":"");?>"/>60kuud<br />
	</div>

	
	</fieldset>
    <?php //    			'maritalStatus' => $this->input->post('maritalStatus'), ?>
</td>
  </tr>
</table> 
</fieldset>
<fieldset style="width:80%">
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
<label for="gender">Vali sugu: </label>
 <select name="gender" id="gender">
 <option value="2" <?php echo ($filter['gender']==2?"selected='selected'":"");?>>Pole teada</option>
 <option value="0" <?php echo ($filter['gender']==0?"selected='selected'":"");?>>Mehed</option>
 <option value="1" <?php echo ($filter['gender']==1?"selected='selected'":"");?>>Naised </option>
 </select>
<br>

    <label for="incomeTotalMin">Sissetulek:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="incomeTotalMin" align="right" value="<?php echo ($filter['incomeTotalMin']>0?$filter['incomeTotalMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="incomeTotalMax" align="right" value="<?php echo ($filter['incomeTotalMax']>0?$filter['incomeTotalMax']:'0.00')?>"></input><br />

    <label for="ageMin">Vanus:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="ageMin" align="right" value="<?php echo $filter['ageMin']?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="ageMax" align="right" value="<?php echo $filter['ageMax']?>"></input><br />

<?php
//CreditScore
//1000 No previous payments problems
//900 Payments problems finished 24-36 months ago
//800 Payments problems finished 12-24 months ago
//700 Payments problems finished 6-12 months ago
//600 Payment problems finished <6 months ago
//500 Active payment problems
?>

    <label for="creditScoreMin">Krediidiskoor:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="creditScoreMin" align="right" value="<?php echo $filter['creditScoreMin']?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="creditScoreMax" align="right" value="<?php echo $filter['creditScoreMax']?>"></input><br />

    <label for="userName">Konkreetsele kasutajale:</label>
    <input type="text" name="userName" value="<?php echo $filter['userName']?>"/><br />

    <?php //<label for="creditGroups">Krediidigrupid:</label>
    //<div class="container">
    //<input type="text" name="creditGroups" value="<php echo $filter['creditGroups']>"></input><br />
	//</div>
    //<>     			'creditGroups' => $this->input->post('creditGroups'), ?>

    <label for="interestMin">Intress:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="interestMin" align="right" value="<?php echo ($filter['interestMin']>0?$filter['interestMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="interestMax" align="right" value="<?php echo ($filter['interestMax']>0?$filter['interestMax']:'0.00')?>"></input><br />


    <?php //     			'incomeTotalMin' => $this->input->post('incomeTotalMin'), ?>
    <?php //    			'incomeTotalMax' => $this->input->post('incomeTotalMax'), ?>
        			
    <label for="expectedLossMin">Oodatud kaotus:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedLossMin" align="right" value="<?php echo ($filter['expectedLossMin']>0?$filter['expectedLossMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedLossMax" align="right" value="<?php echo ($filter['expectedLossMax']>0?$filter['expectedLossMax']:'0.00')?>"></input><br />

</fieldset>
</td>


<td>
<fieldset>

 <label for="useOfLoan">Laenu eesmärk: </label>
 <select name="useOfLoan" id="useOfLoan">
 <option value="-1" <?php echo ($filter['useOfLoan']==-1?"selected='selected'":"");?>>Pole valitud</option>
 <option value="0" <?php echo ($filter['useOfLoan']==0?"selected='selected'":"");?>>Laenude konsolideerimine</option>
 <option value="1" <?php echo ($filter['useOfLoan']==1?"selected='selected'":"");?>>Kinnisvara ost</option>
 <option value="2" <?php echo ($filter['useOfLoan']==2?"selected='selected'":"");?>>Kodu renoveerimine</option>
 <option value="3" <?php echo ($filter['useOfLoan']==3?"selected='selected'":"");?>>Äri</option>
 <option value="4" <?php echo ($filter['useOfLoan']==4?"selected='selected'":"");?>>Õppimiseks</option>
 <option value="5" <?php echo ($filter['useOfLoan']==5?"selected='selected'":"");?>>Reisimiseks</option>
 <option value="6" <?php echo ($filter['useOfLoan']==6?"selected='selected'":"");?>>Liiklusvahend</option>
 <option value="7" <?php echo ($filter['useOfLoan']==7?"selected='selected'":"");?>>Muu eesmärk</option>
 <option value="8" <?php echo ($filter['useOfLoan']==8?"selected='selected'":"");?>>Tervis</option>
 </select>
 <br>	


    <label for="nrOfDependantsMin">Ülalpeetavate arv:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="nrOfDependantsMin" align="right" value="<?php echo $filter['nrOfDependantsMin']?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="nrOfDependantsMax" align="right" value="<?php echo $filter['nrOfDependantsMax']?>"></input><br />

<div class="container">
        <label for="employmentStatus">Kas tööl/töötu/muu?:</label>
     <select name="employmentStatus" id="employmentStatus">
 <option value="0" <?php echo ($filter['employmentStatus']==0?"selected='selected'":"");?>>Pole valitud</option>
 <option value="1" <?php echo ($filter['employmentStatus']==1?"selected='selected'":"");?>>Töötu</option>
 <option value="2" <?php echo ($filter['employmentStatus']==2?"selected='selected'":"");?>>Osalise tööajaga</option>
 <option value="3" <?php echo ($filter['employmentStatus']==3?"selected='selected'":"");?>>Täistööaeg</option>
 <option value="4" <?php echo ($filter['employmentStatus']==4?"selected='selected'":"");?>>Iseenda tööandja</option>
 <option value="5" <?php echo ($filter['employmentStatus']==5?"selected='selected'":"");?>>Entrepreneur </option>
 <option value="6" <?php echo ($filter['employmentStatus']==6?"selected='selected'":"");?>>Pensionil </option>
 </select>
    
    
	</div>
    <?php //    			'employmentStatus' => $this->input->post('employmentStatus'), ?>

    <label for="employmentDurationCurrentEmployer">Kaua töötanud praeguse tööandja juures vähemalt:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="employmentDurationCurrentEmployer" align="right" value="<?php echo $filter['employmentDurationCurrentEmployer']?>"></input><br /> 

    <label for="workExperience">Töökogemus:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="workExperience" align="right" value="<?php echo $filter['workExperience']?>"></input><br /> 

<div class="container">
        <label for="occupationArea">Tööala:</label>
    <select name="occupationArea" id="occupationArea">
 <option value="0" <?php echo ($filter['occupationArea']==0?"selected='selected'":"");?>>Pole valitud</option>
 <option value="1" <?php echo ($filter['occupationArea']==1?"selected='selected'":"");?>>Muu</option>
 <option value="2" <?php echo ($filter['occupationArea']==2?"selected='selected'":"");?>>Mining</option>
 <option value="3" <?php echo ($filter['occupationArea']==3?"selected='selected'":"");?>>Processing </option>
 <option value="4" <?php echo ($filter['occupationArea']==4?"selected='selected'":"");?>>Energia</option>
 <option value="5" <?php echo ($filter['occupationArea']==5?"selected='selected'":"");?>>Utilities</option>
 <option value="6" <?php echo ($filter['occupationArea']==6?"selected='selected'":"");?>>Construction</option>
 <option value="7" <?php echo ($filter['occupationArea']==7?"selected='selected'":"");?>>Retail</option>
 <option value="8" <?php echo ($filter['occupationArea']==8?"selected='selected'":"");?>>Transport</option>
 <option value="9" <?php echo ($filter['occupationArea']==9?"selected='selected'":"");?>>Hospitality</option>
 <option value="10" <?php echo ($filter['occupationArea']==10?"selected='selected'":"");?>>Telecom</option>
 <option value="11" <?php echo ($filter['occupationArea']==11?"selected='selected'":"");?>>Finance</option>
 <option value="12" <?php echo ($filter['occupationArea']==12?"selected='selected'":"");?>>Kinnisvara</option>
 <option value="13" <?php echo ($filter['occupationArea']==13?"selected='selected'":"");?>>Teadus</option>
 <option value="14" <?php echo ($filter['occupationArea']==14?"selected='selected'":"");?>>Administrative</option>
 <option value="15" <?php echo ($filter['occupationArea']==15?"selected='selected'":"");?>>CivilService</option>
 <option value="16" <?php echo ($filter['occupationArea']==16?"selected='selected'":"");?>>Education</option>
 <option value="17" <?php echo ($filter['occupationArea']==17?"selected='selected'":"");?>>Healthcare</option>
 <option value="18" <?php echo ($filter['occupationArea']==18?"selected='selected'":"");?>>Kunst</option>
 <option value="19" <?php echo ($filter['occupationArea']==19?"selected='selected'":"");?>>Agriculture</option>
 </select> 
    
    
	</div>
    <?php //    			'occupationArea' => $this->input->post('occupationArea'), ?>
    <div class="container">
            <label for="homeOwnershipType">Kodu omaniku staatus:</label>
    

 <select name="homeOwnershipType" id="homeOwnershipType">
 <option value="-1" <?php echo ($filter['homeOwnershipType']==-1?"selected='selected'":"");?>>Pole valitud</option>
 <option value="0" <?php echo ($filter['homeOwnershipType']==0?"selected='selected'":"");?>>Kodutu</option>
 <option value="1" <?php echo ($filter['homeOwnershipType']==1?"selected='selected'":"");?>>Omanik</option>
 <option value="2" <?php echo ($filter['homeOwnershipType']==2?"selected='selected'":"");?>>Elab koos vanematega</option>
 <option value="3" <?php echo ($filter['homeOwnershipType']==3?"selected='selected'":"");?>>TenantFurnished</option>
 <option value="4" <?php echo ($filter['homeOwnershipType']==4?"selected='selected'":"");?>>TenantUnfurnished</option>
 <option value="5" <?php echo ($filter['homeOwnershipType']==5?"selected='selected'":"");?>>CouncilTenant</option>
 <option value="6" <?php echo ($filter['homeOwnershipType']==6?"selected='selected'":"");?>>JointTenant</option>
 <option value="7" <?php echo ($filter['homeOwnershipType']==7?"selected='selected'":"");?>>JointOwner</option>
 <option value="8" <?php echo ($filter['homeOwnershipType']==8?"selected='selected'":"");?>>OwnerMortgage</option>
 <option value="9" <?php echo ($filter['homeOwnershipType']==9?"selected='selected'":"");?>>OwnerEncumbrance</option>
 </select>
     
	</div>
    <?php //    			'homeOwnershipType' => $this->input->post('homeOwnershipType'), ?>
</fieldset>
</td>


<td>
<fieldset>
    <label for="incomeFromPrincipalEmpoyerMin">Sissetulek põhitöökohast:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="incomeFromPrincipalEmpoyerMin" align="right" value="<?php echo ($filter['incomeFromPrincipalEmpoyerMin']>0?$filter['incomeFromPrincipalEmpoyerMin']:'0.00')?>"></input>
    <br /> 


<label for="isIncomeFromPension">Kas sissetulek pensionist: </label>
 <select name="isIncomeFromPension" id="isIncomeFromPension">
 <option value="-1" <?php echo ($filter['isIncomeFromPension']==-1?"selected='selected'":"");?>>Pole teada</option>
 <option value="0" <?php echo ($filter['isIncomeFromPension']==0?"selected='selected'":"");?>>Jah</option>
 <option value="1" <?php echo ($filter['isIncomeFromPension']==1?"selected='selected'":"");?>>Ei </option>
 </select>
    <br /> 



<label for="isIncomeFromSocialWelfare">Kas sissetulek sotsiaaltoetustest: </label>
 <select name="isIncomeFromSocialWelfare" id="isIncomeFromSocialWelfare">
 <option value="-1" <?php echo ($filter['isIncomeFromSocialWelfare']==-1?"selected='selected'":"");?>>Pole teada</option>
 <option value="0" <?php echo ($filter['isIncomeFromSocialWelfare']==0?"selected='selected'":"");?>>Jah</option>
 <option value="1" <?php echo ($filter['isIncomeFromSocialWelfare']==1?"selected='selected'":"");?>>Ei </option>
 </select>
    <br /> 



<label for="isIncomeFromChildSupport">Kas sissetulek lastetoetusest: </label>
 <select name="isIncomeFromChildSupport" id="isIncomeFromChildSupport">
 <option value="-1" <?php echo ($filter['isIncomeFromChildSupport']==-1?"selected='selected'":"");?>>Pole teada</option>
 <option value="0" <?php echo ($filter['isIncomeFromChildSupport']==0?"selected='selected'":"");?>>Jah</option>
 <option value="1" <?php echo ($filter['isIncomeFromChildSupport']==1?"selected='selected'":"");?>>Ei </option>
 </select>
    <br /> 

    
    <label for="probabilityOfBadMin">Halvaks minemise võimalus:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfBadMin" align="right" value="<?php echo ($filter['probabilityOfBadMin']>0?$filter['probabilityOfBadMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfBadMax" align="right" value="<?php echo ($filter['probabilityOfBadMax']>0?$filter['probabilityOfBadMax']:'0.00')?>"></input><br />

    <label for="probabilityOfDefaultMin">Pankrotti minemise võimalus:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfDefaultMin" align="right" value="<?php echo ($filter['probabilityOfDefaultMin']>0?$filter['probabilityOfDefaultMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="probabilityOfDefaultMax" align="right" value="<?php echo ($filter['probabilityOfDefaultMax']>0?$filter['probabilityOfDefaultMax']:'0.00')?>"></input><br />
    
    <label for="expectedReturnMin">Oodatav tulusus:</label>
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedReturnMin" align="right" value="<?php echo ($filter['expectedReturnMin']>0?$filter['expectedReturnMin']:'0.00')?>"></input> - 
    <input type="number" style="text-align:right;"  pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" size="10" max="100000" min="0" maxlenght="10" name="expectedReturnMax" align="right" value="<?php echo ($filter['expectedReturnMax']>0?$filter['expectedReturnMax']:'0.00')?>"></input><br />
</fieldset>
</td>
</tr>
</table>
</fieldset>

    <?php //<label for="isOneTime">Kas Üks laen= üksmaksmine</label>?>
    <input type="checkbox" name="isLocalSearch" value="<?php echo $filter['isLocalSearch']?>"/>Kas ühekordne (ühekordne käsitsi otsing, mitte automaatne panustamine)<br />

    <input type="submit" name="submit" value="Filtri salvestamine" />

</form>
