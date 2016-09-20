<?php include("class/db_config.php");?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<title>Osterley Cricket Club | Colt Registration Form</title>

    <link rel="icon" type="image/png" href="favicon.ico">

    <link rel="stylesheet" media="screen" href="css/reset.css" >

	<link rel="stylesheet" media="screen" href="css/styles.css" >

    <script type='text/javascript'>

(function (d, t) {

  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];

  bh.type = 'text/javascript';

  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=bshfgpegfciiwavc7a2xgg';

  s.parentNode.insertBefore(bh, s);

  })(document, 'script');

</script>

    <script type="text/javascript" src="js/gen_validatorv4.js"></script>

    <script type="text/javascript" src="js/jquery-latest.js"></script>

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

<div class="floatLeft tab tabsactive">Colts Information</div>

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

 This Application is to be filled by the Parent/Guardian of the child that you wish to enrol at Osterley Cricket Club. Annual Subscription Payment will be required to complete the registration at the end of the Application. If you chose to pay by cash or cheque (Or if yu have already made a payment in person), you can chose the "Pay in Person" option that will be provided after completing the application.

</div>

<div style="line-height:25px; text-align:justify;">

Your information will be stored on our Database (for 1 year) and will not be passed onto any third parties with the exception of Law Enforcement Agencies, Affiliated Organisations, ECB, MCB and the Coaching Staff at Osterley CC. Your information will be used to allocate your child in his/her age groups and keep a knowledge-base of his/her medical conditions and emergency contact detials. All data will be treated as confidential and retained on a secure server.

</div>

<div class="bar">

<span style=" color:#039; font-weight:600; font-size:18px;">Colts Registration Form <span style="color:#2687d1; font-size:12px; font-weight:600;">(Section 1 - Details of the Child you wish to enrol at Osterley CC)</span></span>

</div>

</div>

</div>

<div class="contact_form">

<div style="width:100%;">

<form action="step1.php" id="colts_info" name="colts_info" method="post" style="width:100%; margin:0 auto;" >

<div>

    <ul>

     <div class="firstSec">

    <div class="secParttwo">

           <li>

            <label for="First Name" class="lableFor">Firstname : <span>*</span></label>

            <input type="text" name="fname" required id="fname" class="fieldsfor" value="<?php if($_SESSION['fname']) { echo $_SESSION['fname']; } ?>" placeholder="Your child's First Name"  />

        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

           <li>

            <label for="First Name" class="lableFor">Lastname : <span>*</span></label>

            <input type="text" name="lname" required id="lname" class="fieldsfor" value="<?php if($_SESSION['lname']) { echo $_SESSION['lname']; } ?>" placeholder="Your child's Last Name"  />

        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="Date of Birth" class="lableFor">Date of Birth : <span>*</span></label>

 <select name="birthday_day" id="birthday_day" aria-label="Day" required class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  padding: 3px; margin-left:5%;">

<option value="">Day:</option>

<?php for($i=1; $i<=31; $i++){ ?>

<option value="<?php echo $i; ?>" <?php if($_SESSION['dday'] == $i){ echo 'selected'; } ?>><?php echo $i; ?></option>

<?php } ?>

</select>



              <select name="birthday_month" required id="birthday_month" aria-label="Month" class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  padding: 3px; margin-left:5%;">

                <option value="">Month:</option>

                <option value="Jan" <?php if($_SESSION['dmonth'] == 'Jan'){ echo 'selected'; } ?>>Jan</option>

                <option value="Feb" <?php if($_SESSION['dmonth'] == 'Feb'){ echo 'selected'; } ?>>Feb</option>

                <option value="Mar" <?php if($_SESSION['dmonth'] == 'Mar'){ echo 'selected'; } ?>>Mar</option>

                <option value="Apr" <?php if($_SESSION['dmonth'] == 'Apr'){ echo 'selected'; } ?>>Apr</option>

                <option value="May" <?php if($_SESSION['dmonth'] == 'May'){ echo 'selected'; } ?>>May</option>

                <option value="Jun" <?php if($_SESSION['dmonth'] == 'Jun'){ echo 'selected'; } ?>>Jun</option>

                <option value="Jul" <?php if($_SESSION['dmonth'] == 'Jul'){ echo 'selected'; } ?>>Jul</option>

                <option value="Aug" <?php if($_SESSION['dmonth'] == 'Aug'){ echo 'selected'; } ?>>Aug</option>

                <option value="Sep" <?php if($_SESSION['dmonth'] == 'Sep'){ echo 'selected'; } ?>>Sep</option>

                <option value="Oct" <?php if($_SESSION['dmonth'] == 'Oct'){ echo 'selected'; } ?>>Oct</option>

                <option value="Nov" <?php if($_SESSION['dmonth'] == 'Nov'){ echo 'selected'; } ?>>Nov</option>

                <option value="Dec" <?php if($_SESSION['dmonth'] == 'Dec'){ echo 'selected'; } ?>>Dec</option>

              </select>

              <select name="birthday_year" required id="birthday_year" aria-label="Year" class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  padding: 3px; margin-left:5%;">

                <option value="">Year:</option>

				<?php for($ye = 1994; $ye <= 2013; $ye++){ ?>

                <option value="<?php echo $ye ;?>" <?php if($_SESSION['dyear']){ echo 'selected'; } ?>><?php echo $ye; ?></option>

                <?php } ?>

              </select>



        </li>

                 </div>

        </div>



	<div class="firstSec">

    <div class="secParttwo">

        <li>

        <label for="countries" class="lableFor">Country of Birth: <span>*</span></label>

        

        <select name="countries" required id="countries" class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  width:320px; padding:4px;" onChange="ShowMigrate();">

        

        <option value="">Select Country:</option>

<?php $county = mysql_query("select * from `countries`");

while($cc = mysql_fetch_array($county)) { ?>

<option value="<?php echo $cc['C_ID'];?>" <?php if($_SESSION['countries'] == $cc['C_ID']){ echo 'selected'; } ?>><?php   echo $cc['C_NAME'];  ?></option>

<?php } ?>



</select>

        

        

        </li>

        </div>

        </div>



<div class="secParttwo migration" id="migration" style="<?php if(isset($_SESSION['occ_city']) && ($_SESSION['countries']!=232) ){echo "display:block;";}else{echo "display:none;";} ?>">

        <li>

            <label for="address" class="lableFor">City Of Birth : <span>*</span></label>

            <input type="text" name="occ_city"  class="fieldsfor" id="occ_city" value="<?php if(isset($_SESSION['occ_city'])){echo $_SESSION['occ_city'];} ?>"  placeholder="City Of Birth" />

        </li>

</div>

<div class="firstSec migration" id="migration" style="<?php if(isset($_SESSION['mday'])&& ($_SESSION['countries']!=232)){echo "display:block;";}else{echo "display:none;";} ?>">

    <div class="secParttwo">

        <li>

            <label for="Date of Birth" class="lableFor">Date moved to the UK : <span>*</span></label>

			 <select name="moved_day" required id="moved_day" class="fieldsfor">

			<option value="">Day:</option>

			<?php for($i=1; $i<=31; $i++){ ?>

			<option value="<?php echo $i; ?>" <?php if($_SESSION['mday'] == $i){ echo 'selected'; } ?>><?php echo $i; ?></option>

			<?php } ?>

			</select>



              <select name="moved_month" required id="moved_month" class="fieldsfor">

                <option value="">Month:</option>

                <option value="Jan" <?php if($_SESSION['mmonth'] == 'Jan'){ echo 'selected'; } ?>>Jan</option>

                <option value="Feb" <?php if($_SESSION['mmonth'] == 'Feb'){ echo 'selected'; } ?>>Feb</option>

                <option value="Mar" <?php if($_SESSION['mmonth'] == 'Mar'){ echo 'selected'; } ?>>Mar</option>

                <option value="Apr" <?php if($_SESSION['mmonth'] == 'Apr'){ echo 'selected'; } ?>>Apr</option>

                <option value="May" <?php if($_SESSION['mmonth'] == 'May'){ echo 'selected'; } ?>>May</option>

                <option value="Jun" <?php if($_SESSION['mmonth'] == 'Jun'){ echo 'selected'; } ?>>Jun</option>

                <option value="Jul" <?php if($_SESSION['mmonth'] == 'Jul'){ echo 'selected'; } ?>>Jul</option>

                <option value="Aug" <?php if($_SESSION['mmonth'] == 'Aug'){ echo 'selected'; } ?>>Aug</option>

                <option value="Sep" <?php if($_SESSION['mmonth'] == 'Sep'){ echo 'selected'; } ?>>Sep</option>

                <option value="Oct" <?php if($_SESSION['mmonth'] == 'Oct'){ echo 'selected'; } ?>>Oct</option>

                <option value="Nov" <?php if($_SESSION['mmonth'] == 'Nov'){ echo 'selected'; } ?>>Nov</option>

                <option value="Dec" <?php if($_SESSION['mmonth'] == 'Dec'){ echo 'selected'; } ?>>Dec</option>

              </select>

              <select name="moved_year" required id="moved_year" class="fieldsfor">

                <option value="">Year:</option>

				<?php for($ye = 1930; $ye <= 2013; $ye++){ ?>

                <option value="<?php echo $ye ;?>" <?php if($_SESSION['myear']){ echo 'selected'; } ?>><?php echo $ye; ?></option>

                <?php } ?>

              </select>



        </li>

                 </div>

        </div>



          <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="address" class="lableFor">Name of School/College : <span>*</span></label>

            <input type="text" name="sc_cl" required class="fieldsfor" id="sc_cl" value="<?php if($_SESSION['sc_cl']) { echo $_SESSION['sc_cl']; } ?>"  placeholder="Name of Institution" />

        </li>

</div>

        </div>



        

         

                     

        <div class="firstSec">

    <div style="width:800px; margin:0 auto; position:relative;">

        <li>

            <label for="Gender" class="lableFor">Gender : <span>*</span></label>

            <select name="gender" required id="gender"  class="fieldsfor" style="border:1px solid #aaa; padding:4px;">

            <option value=""> -- Select Gender -- </option>

           <option value="male" <?php if($_SESSION['gender'] == 'male') echo 'selected'; ?>>Male</option>

           <option value="female" <?php if($_SESSION['gender'] == 'Female') echo 'selected'; ?>>Female</option>

           </select>

        </li>

         </div>

        </div>



        

                             <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="Nationality" class="lableFor">Mobile No. : <span>*</span></label>

            <input type="number" required name="mtel" id="mtel" class="fieldsfor" value="<?php if($_SESSION['mtel']) { echo $_SESSION['mtel']; } ?>"  placeholder="Mobile number"  />

        </li>

              </div>

        </div>



<div class="firstSec" style="border-top:2px solid #333; background:#f7f8fc;position:relative;">

    <div class="secParttwo" style="height:45px;">

        <li style="position:none;">

        <div style="position:absolute; top:10px; left:10px; color:#039; font-weight:600; font-size:18px;">Parent/Guardian Information<span style="color:#2687d1; font-size:12px; margin-left:10px; font-weight:bold;">(Section 2 – Contact Details of Parent / Legal Guardian)</span> </div>

        </li>

        </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Parent/Guardian Name : <span>*</span></label>

            <input type="text" required name="guardian_name" id="guardian_name" class="fieldsfor" value="<?php if($_SESSION['guardian_name']) { echo $_SESSION['guardian_name']; } ?>" placeholder="Your Fullname"  />

            

        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Relationship to child : <span>*</span></label>

            <input type="text" name="rel_child" required id="rel_child" class="fieldsfor" value="<?php if($_SESSION['rel_child']) { echo $_SESSION['rel_child']; } ?>" placeholder="Your relationship to the child

"  />



        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Address line 1 : <span>*</span></label>

            <input type="text" name="addr" required id="addr" class="fieldsfor" value="<?php if($_SESSION['addr']) { echo $_SESSION['addr']; } ?>" placeholder="Address line 1"  />

           

        </li>

         </div>

        </div>

        

        <div class="firstSec">

    <div class="secParttwo">

        <li> 

        <label for="addr2" class="lableFor">Address line 2 : </label>

         <input type="text" name="addr2" id="addr2" class="fieldsfor" value="<?php if($_SESSION['addr2']) { echo $_SESSION['addr2']; } ?>" placeholder="Address line 2"  />

        </li>

        </div>

        </div>

        

          <div class="firstSec">

    <div class="secParttwo">

        <li> 

        

          <label for="cityofuk" class="lableFor">City : <span>*</span></label>

        <select name="cityofuk" required id="cityofuk" class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  width:320px; padding:4px;">

         <option value="">Select City:</option>

<?php $cities = mysql_query("select * from `uk_city`");

while($city = mysql_fetch_array($cities)) { ?>

<option value="<?php echo $city['Id'];?>" <?php if($_SESSION['cityofuk'] == $city['Id']){ echo 'selected'; } ?>><?php echo $city['cities_name'];  ?></option>

<?php } ?>

   </select>     

     

        </li>

         </div>

        </div> 

        

        <div class="firstSec">

    <div class="secParttwo">

        <li>

        <label for="counties" class="lableFor">County : <span>*</span></label>

        

        <select name="counties" id="counties" required class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  width:320px; padding:4px;">

        

        <option value="">Select County:</option>

<?php $county = mysql_query("select * from `uk_county`");

while($cc = mysql_fetch_array($county)) { ?>

<option value="<?php echo $cc['Id'];?>" <?php if($_SESSION['counties'] == $cc['Id']){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>

<?php } ?>



</select>

        

        

        </li>

        </div>

        </div>        

        

            <div class="firstSec">

    <div class="secParttwo">

        <li> 

        <label for="postcode" class="lableFor">Postal code : <span>*</span></label>

         <span class="tip"><input type="text" name="postcode" required id="postcode" class="fieldsfor" value="<?php if($_SESSION['postcode']) { echo $_SESSION['postcode']; } ?>" placeholder="Postal code"  /><p>Format e.g DN3 6GB</p></span>

        </li>

        </div>

        </div>

        

        

        

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Daytime telephone number : <span>*</span></label>

            <input type="number" name="dtimetel" id="dtimetel" required class="fieldsfor" value="<?php if($_SESSION['dtimetel']) { echo $_SESSION['dtimetel']; } ?>" placeholder="Daytime telephone number"  />



        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Evening telephone number : <span>*</span></label>

            <input type="number" name="etimetel" id="etimetel" required class="fieldsfor" value="<?php if($_SESSION['etimetel']) { echo $_SESSION['etimetel']; } ?>" placeholder="Evening telephone number"  />

        </li>

         </div>

        </div>

  <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="email" class="lableFor">Email : <span>*</span></label>

            <input type="email" name="email" id="email" required class="fieldsfor" value="<?php if($_SESSION['email']) { echo $_SESSION['email']; } ?>" placeholder="Your Email address"  />

        </li>

         </div>

        </div>

        <div class="firstSec" style="border-top:2px solid #333; background:#f7f8fc; position:relative;">

    <div class="secParttwo" style="height:45px;">

        <li style="position:none;">

        <div style="position:absolute; top:10px; left:10px; color:#039; font-weight:600; font-size:18px;">Emergency Contact Details<span style="color:#2687d1; font-size:12px; margin-left:10px; font-weight:bold;">(Section 3 –Emergency Contact Details | Alternative Contact)</span> </div>

        </li>

        </div>

        </div>

        <div class="firstSec" style="background:-webkit-linear-gradient(top, #fff, #f9f9f9); border-top:1px solid #dcdcdc; border-bottom:1px solid #dcdcdc;">

    <div class="secParttwo">

        <li>

        In the event of an incident or emergency situation where a parent, or legal guardian named above cannot be contacted, please provide details of an alternative adult who can be contacted by the club.  Please make this person aware that his or her details have been provided as a contact for the club:

        </li>

        </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Name : <span>*</span></label>

            <input type="text" name="emerg_name" required id="emerg_name" class="fieldsfor" value="<?php if($_SESSION['emerg_name']) { echo $_SESSION['emerg_name']; } ?>" placeholder="Contact's full name"  />

            

        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Relationship to child : <span>*</span></label>

            <input type="text" name="rel_child_emg" required id="rel_child_emg" class="fieldsfor" value="<?php if($_SESSION['rel_child_emg']) { echo $_SESSION['rel_child_emg']; } ?>" placeholder="Contact's relationship to your child"  />



        </li>

         </div>

        </div>

       

        

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Address line 1 : <span>*</span></label>

            <input type="text" name="addr_emg" required id="addr_emg" class="fieldsfor" value="<?php if($_SESSION['addr_emg']) { echo $_SESSION['addr_emg']; } ?>" placeholder="Address line 1"  />

           

        </li>

         </div>

        </div>

        

        <div class="firstSec">

    <div class="secParttwo">

        <li> 

        <label for="addr2" class="lableFor">Address line 2 : </label>

         <input type="text" name="addr2_emg"  id="addr2_emg" class="fieldsfor" value="<?php if($_SESSION['addr2_emg']) { echo $_SESSION['addr2_emg']; } ?>" placeholder="Address line 2"  />

        </li>

        </div>

        </div>

        

          <div class="firstSec">

    <div class="secParttwo">

        <li> 

        

          <label for="cityofuk" class="lableFor">City : <span>*</span></label>

        <select name="cityofuk_emg" required id="cityofuk_emg" class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  width:320px; padding:4px;">

         <option value="">Select City:</option>

<?php $cities = mysql_query("select * from `uk_city`");

while($city = mysql_fetch_array($cities)) { ?>

<option value="<?php echo $city['cities_name'];?>" <?php if($_SESSION['cityofuk_emg'] == $city['cities_name']){ echo 'selected'; } ?>><?php echo $city['cities_name'];  ?></option>

<?php } ?>

   </select>     

     

        </li>

         </div>

        </div> 

        

        <div class="firstSec">

    <div class="secParttwo">

        <li>

        <label for="counties" class="lableFor">County : <span>*</span></label>

        

        <select name="counties_emg" required id="counties_emg" class="fieldsfor" style="border: 1px solid #ccc; border-radius:5px;  width:320px; padding:4px;">

        

        <option value="">Select County:</option>

<?php $county = mysql_query("select * from `uk_county`");

while($cc = mysql_fetch_array($county)) { ?>

<option value="<?php echo $cc['counties_name'];?>" <?php if($_SESSION['counties_emg'] == $cc['counties_name']){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>

<?php } ?>



</select>

        

        

        </li>

        </div>

        </div>        

        

            <div class="firstSec">

    <div class="secParttwo">

        <li> 

        <label for="postcode" class="lableFor">Postal code : <span>*</span></label>

         <span class="tip"><input type="text" required name="postcode_emg" id="postcode_emg" class="fieldsfor" value="<?php if($_SESSION['postcode_emg']) { echo $_SESSION['postcode_emg']; } ?>" placeholder="Postal code"  /><p>Format e.g DN3 6GB</p></span>

        </li>

        </div>

        </div>
        

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Daytime telephone number : <span>*</span></label>

            <input type="number" name="dtimetel_emg" required id="dtimetel_emg" class="fieldsfor" value="<?php if($_SESSION['dtimetel_emg']) { echo $_SESSION['dtimetel_emg']; } ?>" placeholder="Daytime telephone number"  />



        </li>

         </div>

        </div>

        <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Evening telephone number : <span>*</span></label>

            <input type="number" name="etimetel_emg" required id="etimetel_emg" class="fieldsfor" value="<?php if($_SESSION['etimetel_emg']) { echo $_SESSION['etimetel_emg']; } ?>" placeholder="Evening telephone number"  />

        </li>

         </div>

        </div>

  <div class="firstSec">

    <div class="secParttwo">

        <li>

            <label for="text" class="lableFor">Email: <span>*</span></label>

            <input type="email" name="email_emg" required id="email_emg" class="fieldsfor" value="<?php if($_SESSION['email_emg']) { echo $_SESSION['email_emg']; } ?>" placeholder="Email"  />

            <span class="form_hint">Proper format "name@something.com"</span>

        </li>

         </div>

        </div>

                    <div class="firstSec">

    <div class="secParttwo" align="center">

        <li>



       <input type="hidden" value="<?php echo substr(md5(uniqid(rand())), 0, 10); ?>" name="sid" id="sid">

       <input type="hidden" value="1" required name="source_type" id="source_type">

            <button class="submit" type="submit">Continue to next Step </button>

            

        </li>

                 </div>

        </div>

    </ul>

    </div>

</form>

<script type="text/javascript">



var frmvalidator = new Validator("colts_info");		

function ShowMigrate() { 

var country = $("#countries").val();

if(country != 232)
{
	$(".migration").fadeIn(300);
document.getElementById("occ_city").required = true;
frmvalidator.addValidation("moved_day","dontselect=0","Please enter the date you moved to UK");    
frmvalidator.addValidation("moved_month","dontselect=0","Please enter the date you moved to UK");  
frmvalidator.addValidation("moved_year","dontselect=0","Please enter the date you moved to UK");  
}

else
{
	document.getElementById("occ_city").required = false;
	document.getElementById("moved_day").required = false;
	document.getElementById("moved_month").required = false;
	document.getElementById("moved_year").required = false;

	$(".migration").fadeOut(300);

}


}

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