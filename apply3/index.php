<?php include("class/db_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Osterley Cricket Club | Adults Registration Form</title>
    <link rel="icon" type="image/png" href="favicon.ico">
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type='text/javascript'>
/* (function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=bshfgpegfciiwavc7a2xgg';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script'); */
</script>
    <script type="text/javascript" src="js/gen_validatorv4.js"></script>
    <script type="text/javascript" src="js/jquery-latest.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function(e) {
       /* var year_select = $("#birthday_year").val();
		if(year_select > 1995)
		{
			window.location.assign("http://www.osterleycc.com/apply/");
		}*/
		
    });

</script>
<style>
.tip
{
	position:relative;
}
.tip p
{
	display: none;
	position:absolute;
	z-index: 1000;
	top: -8px;
	left: 365px;
	width: 185px;
	background: #333;
	border: 1px solid black;
	color: white;
	-moz-border-radius: 3px;
	-webkit-border-radius: 2px;
	box-shadow: 3px 3px 3px #CCC;
	padding:3px;
	box-sizing:border-box;
	-o-box-sizing:border-box;
	-moz-box-sizing:border-box;
	-webkit-box-sizing:border-box;
	text-align:center;
}
.tip:hover p {display: block;}
</style>
</head>
<body>
<div id="container">
<div id="wrapper">
<?php include("header.php"); ?>
</header>
<div id="tabs-container">
<div class="top-menus">
<div class="floatLeft tab tabsactive">Adults Information</div>
<div class="floatLeft tab spacing-tab">Sporting Information</div>
<div class="floatLeft tab spacing-tab">INFORMATION</div>
<div class="floatLeft tab spacing-tab">Submission &amp; Checklist</div>
<div class="floatLeft tab spacing-tab">APPLICATION COMPLETE</div>
<div class="clear"></div>
</div>
</div>
<div id="content">
<div id="headlineSection">
<div style="width:100%; margin:0 auto;">
<div style="line-height:25px; text-align:justify;">
This Application is to be filled by the individual that wishes to enrol at Osterley Cricket Club. As part of our ClubMark and new Administration we will now keep all Club Member Information in a secure database (started 2013 Season). Payment will be required for the registration at the end of the Application. Please make sure you are over 18 years of Age before completing this Application.
</div>
<div style="line-height:25px; text-align:justify;">
Your information will be stored on our Database and will not be passed onto any third parties with the exception of Law Enforcement Agencies. All data will be treated as confidential and retained on a secure server.
</div>
<div class="bar">
<span style=" color:#202020; font-weight:600; font-size:18px;" class = "indexheading">Adult Registration Form <span style="color:#333; font-size:12px; font-weight:600;">(Section 1 - Your Personal Details)</span></span>
</div>
</div>
</div>
<div class="contact_form">
<div style="width:100%;">
<form action="medical-info.php" id="adults_info" name="adults_info" method="post" style="width:100%; margin:0 auto;" >
<div>

     <div class="firstSec">
    <div class="secParttwo">
           
            <label for="First Name" class="lableFor">Firstname : <span>*</span></label>
            <input type="text" name="fname" id="fname" required class="fieldsfor" value="<?php if(isset($_SESSION['fname'])) { echo $_SESSION['fname']; } ?>" placeholder="Your First Name"  />
        
         </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
           
            <label for="First Name" class="lableFor">Lastname : <span>*</span></label>
            <input type="text" name="lname" id="lname" required class="fieldsfor" value="<?php if(isset($_SESSION['lname'])) { echo $_SESSION['lname']; } ?>" placeholder="Your Last Name"  />
        
         </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="Date of Birth" class="lableFor">Date of Birth : <span>*</span></label>
 <select name="birthday_day" id="birthday_day" class="fieldsfor" required>
<option value="">Day:</option>
<?php for($i=1; $i<=31; $i++){ ?>
<option value="<?php echo $i; ?>" <?php if(isset($_SESSION['dday']) && ($_SESSION['dday'] == $i)){ echo 'selected'; } ?>><?php echo $i; ?></option>
<?php } ?>
</select>

              <select name="birthday_month" id="birthday_month" class="fieldsfor" required>
                <option value="">Month:</option>
                <option value="Jan" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Jan')){ echo 'selected'; } ?>>Jan</option>
                <option value="Feb" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Feb')){ echo 'selected'; } ?>>Feb</option>
                <option value="Mar" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Mar')){ echo 'selected'; } ?>>Mar</option>
                <option value="Apr" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Apr')){ echo 'selected'; } ?>>Apr</option>
                <option value="May" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'May')){ echo 'selected'; } ?>>May</option>
                <option value="Jun" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Jun')){ echo 'selected'; } ?>>Jun</option>
                <option value="Jul" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Jul')){ echo 'selected'; } ?>>Jul</option>
                <option value="Aug" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Aug')){ echo 'selected'; } ?>>Aug</option>
                <option value="Sep" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Sep')){ echo 'selected'; } ?>>Sep</option>
                <option value="Oct" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Oct')){ echo 'selected'; } ?>>Oct</option>
                <option value="Nov" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Nov')){ echo 'selected'; } ?>>Nov</option>
                <option value="Dec" <?php if(isset($_SESSION['dmonth']) && ($_SESSION['dmonth'] == 'Dec')){ echo 'selected'; } ?>>Dec</option>
              </select>
              <select name="birthday_year" id="birthday_year" class="fieldsfor" required>
                <option value="">Year:</option>
				<?php for($ye = 1930; $ye <= 2013; $ye++){ ?>
                <option value="<?php echo $ye ;?>" <?php if(isset($_SESSION['dyear'])){ echo 'selected'; } ?>><?php echo $ye; ?></option>
                <?php } ?>
              </select>

        
                 </div>
        </div>

         
           
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="Gender" class="lableFor">Job Title : <span>*</span></label>
                <input type="text" name="job_title" required class="fieldsfor" id="job_title" value="<?php if(isset($_SESSION['job_title'])) { echo $_SESSION['job_title']; } ?>"  placeholder="Your Job Title" />
        
         </div>
        </div>
        
                <div class="firstSec">
    <div class="secParttwo">
        
            <label for="Gender" class="lableFor">Gender : <span>*</span></label>
            <select name="gender" id="gender"  class="fieldsfor ukcc changewidth" style="background:#f9f9f9;" required>
            <option value=""> -- Select Gender -- </option>
           <option value="male" <?php if(isset($_SESSION['gender']) && ($_SESSION['gender'] == 'male')) echo 'selected'; ?>>Male</option>
           <option value="female" <?php if(isset($_SESSION['gender']) && ($_SESSION['gender'] == 'Female')) echo 'selected'; ?>>Female</option>
           </select>
        
         </div>
        </div>
        
<div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Address line 1 : <span>*</span></label>
            <input type="text" name="addr" required id="addr" class="fieldsfor" value="<?php if(isset($_SESSION['addr'])) { echo $_SESSION['addr']; } ?>" placeholder="Address line 1"  />
           
        
         </div>
        </div>
        
        <div class="firstSec">
    <div class="secParttwo">
         
        <label for="addr2" class="lableFor">Address line 2 : </label>
         <input type="text" name="addr2"  id="addr2" class="fieldsfor" value="<?php if(isset($_SESSION['addr2'])) { echo $_SESSION['addr2']; } ?>" placeholder="Address line 2"  />
        
        </div>
        </div>
        
          <div class="firstSec">
    <div class="secParttwo">
         
        
          <label for="cityofuk" class="lableFor">City : <span>*</span></label>
        <select name="cityofuk" id="cityofuk" class="fieldsfor ukcc changewidth" required>
         <option value="">Select City:</option>
<?php $cities = mysql_query("select * from `uk_city`");
while($city = mysql_fetch_array($cities)) { ?>
<option value="<?php echo $city['Id'];?>" <?php if(isset($_SESSION['cityofuk']) && ($_SESSION['cityofuk'] == $city['Id'])){ echo 'selected'; } ?>><?php echo $city['cities_name'];  ?></option>
<?php } ?>
   </select>     
     
        
         </div>
        </div> 
        
        <div class="firstSec">
    <div class="secParttwo">
        
        <label for="counties" class="lableFor">County : <span>*</span></label>
        
        <select name="counties" id="counties" class="fieldsfor ukcc changewidth" required>
        
        <option value="">Select County:</option>
<?php $county = mysql_query("select * from `uk_county`");
while($cc = mysql_fetch_array($county)) { ?>
<option value="<?php echo $cc['Id'];?>" <?php if(isset($_SESSION['counties']) && ($_SESSION['counties'] == $cc['Id'])){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>
<?php } ?>

</select>
        
        
        
        </div>
        </div>        
        
            <div class="firstSec">
    <div class="secParttwo">
         
        <label for="postcode" class="lableFor">Postal code : <span>*</span></label>
        <span class="tip"> <input type="text" name="postcode" required id="postcode" class="fieldsfor" value="<?php if(isset($_SESSION['postcode'])) { echo $_SESSION['postcode']; } ?>" placeholder="Postal code"  /><p>Format e.g DN3 6GB</p></span>
        
        </div>
        </div>
        
        
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Daytime telephone number : <span>*</span></label>
            <input type="number" name="dtimetel" required id="dtimetel" class="fieldsfor" value="<?php if(isset($_SESSION['dtimetel'])) { echo $_SESSION['dtimetel']; } ?>" placeholder="Daytime telephone number"  />

        
         </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Evening telephone number : <span>*</span></label>
            <input type="number" name="etimetel" required id="etimetel" class="fieldsfor" value="<?php if(isset($_SESSION['etimetel'])) { echo $_SESSION['etimetel']; } ?>" placeholder="Evening telephone number"  />
        
         </div>
        </div>
  <div class="firstSec">
    <div class="secParttwo">
        
            <label for="email" class="lableFor">Email : <span>*</span></label>
            <input type="email" name="email" id="email" required class="fieldsfor" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>" placeholder="Your Email address"  />
        
         </div>
        </div>

        <div class="firstSec" style="padding:0;">
        <div class="barTopBanner">
    <div>
      
        <div><span id="text" class = "indexheading">Emergency Contact Details</span> <span>(Section 2 – Emergency Contact Details (Next of Kin)</span></div>
        
        </div>
        </div>
        </div>
        <div class="firstSec paragraphOfmain">
    <div class="secParttwo">
        
In the event of an incident or emergency situation where a parent, next of kin or legal guardian needs to be contacted, please provide details of an adult who can be contacted by the club. Please make this person aware that his or her details have been provided as your next of kin for the club:
        
        </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">First Name : <span>*</span></label>
            <input type="text" name="emerg_name" id="emerg_name" required class="fieldsfor" value="<?php if(isset($_SESSION['emerg_name'])) { echo $_SESSION['emerg_name']; } ?>" placeholder="Contact's First name"  />
            
        
         </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Last Name : <span>*</span></label>
            <input type="text" name="emerg_lname" id="emerg_lname" required class="fieldsfor" value="<?php if(isset($_SESSION['emerg_lname'])) { echo $_SESSION['emerg_lname']; } ?>" placeholder="Contact's Last name"  />
            
        
         </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Relationship to applicant : <span>*</span></label>
            <input type="text" name="rel_child_emg" id="rel_child_emg" required class="fieldsfor" value="<?php if(isset($_SESSION['rel_child_emg'])) { echo $_SESSION['rel_child_emg']; } ?>" placeholder="Contact's relationship to your child"  />

        
         </div>
        </div>
       
        
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Address line 1 : <span>*</span></label>
            <input type="text" name="addr_emg" id="addr_emg" required class="fieldsfor" value="<?php if(isset($_SESSION['addr_emg'])) { echo $_SESSION['addr_emg']; } ?>" placeholder="Address line 1"  />
           
        
         </div>
        </div>
        
        <div class="firstSec">
    <div class="secParttwo">
         
        <label for="addr2" class="lableFor">Address line 2 : </label>
         <input type="text" name="addr2_emg" id="addr2_emg" class="fieldsfor" value="<?php if(isset($_SESSION['addr2_emg'])) { echo $_SESSION['addr2_emg']; } ?>" placeholder="Address line 2"  />
        
        </div>
        </div>
        
        <div class="firstSec">
    <div class="secParttwo">
         
        
          <label for="cityofuk" class="lableFor">City : <span>*</span></label>
        <select name="cityofuk_emg" id="cityofuk_emg" class="fieldsfor ukcc changewidth" required>
         <option value="">Select City:</option>
<?php $cities = mysql_query("select * from `uk_city`");
while($city = mysql_fetch_array($cities)) { ?>
<option value="<?php echo $city['cities_name'];?>" <?php if(isset($_SESSION['cityofuk_emg']) && ($_SESSION['cityofuk_emg'] == $city['cities_name'])){ echo 'selected'; } ?>><?php echo $city['cities_name'];  ?></option>
<?php } ?>
   </select>     
     
        
         </div>
        </div> 
        
        <div class="firstSec">
    <div class="secParttwo">
        
        <label for="counties" class="lableFor">County : <span>*</span></label>
        
        <select name="counties_emg" id="counties_emg" class="fieldsfor ukcc changewidth" required>
        
        <option value="">Select County:</option>
<?php $county = mysql_query("select * from `uk_county`");
while($cc = mysql_fetch_array($county)) { ?>
<option value="<?php echo $cc['counties_name'];?>" <?php if(isset($_SESSION['counties_emg']) && ($_SESSION['counties_emg'] == $cc['counties_name'])){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>
<?php } ?>

</select>
        
        
        
        </div>
        </div>        
        
            <div class="firstSec">
    <div class="secParttwo">
         
        <label for="postcode" class="lableFor">Postal code : <span>*</span></label>
        <span class="tip"> <input type="text" name="postcode_emg" required id="postcode_emg" class="fieldsfor" value="<?php if(isset($_SESSION['postcode_emg'])) { echo $_SESSION['postcode_emg']; } ?>" placeholder="Postal code"  /><p>Format e.g DN3 6GB</p></span>
        
        </div>
        </div>
           
           
        
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Daytime telephone number : <span>*</span></label>
            <input type="number" name="dtimetel_emg" id="dtimetel_emg" required class="fieldsfor" value="<?php if(isset($_SESSION['dtimetel_emg'])) { echo $_SESSION['dtimetel_emg']; } ?>" placeholder="Daytime telephone number"  />

        
         </div>
        </div>
        <div class="firstSec">
    <div class="secParttwo">
        
            <label for="text" class="lableFor">Evening telephone number : <span>*</span></label>
            <input type="number" name="etimetel_emg" id="etimetel_emg" required class="fieldsfor" value="<?php if(isset($_SESSION['etimetel_emg'])) { echo $_SESSION['etimetel_emg']; } ?>" placeholder="Evening telephone number"  />
        
         </div>
        </div>

                    <div class="firstSec">
    <div class="secParttwo" align="center">
        

       <input type="hidden" value="<?php echo substr(md5(uniqid(rand())), 0, 10); ?>" name="sid" id="sid">
       <input type="hidden" value="3" name="source_type" id="source_type">
            <button class="submit" type="submit">Continue to next Step </button>
            
        
                 </div>
        </div>
   
    </div>
</form>
<script type="text/javascript">
	  
var frmvalidator = new Validator("adults_info");		
frmvalidator.addValidation("postcode","req","Please enter postal code");
frmvalidator.addValidation("postcode_emg","req","Please enter postal code");
frmvalidator.addValidation("dtimetel_emg","minlen=10","Number should not be less than 10 digits");
frmvalidator.addValidation("etimetel_emg","minlen=10","Number should not be less than 10 digits");

frmvalidator.addValidation("dtimetel","minlen=10","Number should not be less than 10 digits");
frmvalidator.addValidation("etimetel","minlen=10","Number should not be less than 10 digits");

frmvalidator.addValidation("postcode","regexp=^([A-PR-UWYZ0-9][A-HK-Y0-9][AEHMNPRTVXY0-9]?[ABEHMNPRVWXY0-9]? {1,2}[0-9][ABD-HJLN-UW-Z]{2}|GIR 0AA)$","Please enter valid postal code");
frmvalidator.addValidation("postcode_emg","regexp=^([A-PR-UWYZ0-9][A-HK-Y0-9][AEHMNPRTVXY0-9]?[ABEHMNPRVWXY0-9]? {1,2}[0-9][ABD-HJLN-UW-Z]{2}|GIR 0AA)$","Please enter valid postal code");


</script> 
</div>
</div>
</div>
<!-- ContentDiv ends  -->		
</div>
<!-- WrapperDiv ends  -->	
</div>
<!-- ContainerDiv ends  -->	
</body>
</html>