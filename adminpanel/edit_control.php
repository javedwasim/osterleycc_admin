<?php 
include("include/db_config.php");
if($_REQUEST['id']) { 
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `app_form` WHERE id = '$id'");
$r = mysql_fetch_array($query);
?>
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="functions.js"></script>
<div class="cont-progess">
<img src="http://web-whiz.co.uk/bms-admin/images/del-cross.png" width="24" height="24" onClick='$("#progress").hide();' class="progress-img">
<form name="edit-app-details" id="edit-app-details" method="post">
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Title : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_title']; ?>" name="title" id="title" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Firstname : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_fname']; ?>" name="fname" id="fname" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Lastname : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_sname']; ?>" name="sname" id="sname" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Date of Birth : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_birth']; ?>" name="birth" id="birth" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Gender : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_gender']; ?>" name="gender" id="gender" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Nationality : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_nationality']; ?>" name="nationality" id="nationality" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Local Jamatkhana : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_jamatkhana']; ?>" name="jamatkhana" id="jamatkhana" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Address 1 : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_addr']; ?>" name="addr" id="addr" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Address 2 : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_sec_addr']; ?>" name="addr_2" id="addr_2" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Country : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_country']; ?>" name="country_2" id="country_2" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> City : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_city']; ?>" name="city" id="city" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Zip / Postal Code : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_zip_code']; ?>" name="zip_code" id="zip_code" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Home Tel : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_htel']; ?>" name="home_tel" id="home_tel" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Mobile Tel : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_mtel']; ?>" name="mobile_tel" id="mobile_tel" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Email : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_email']; ?>" name="email" id="email" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Employement/ Course of Study : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_employment']; ?>" name="employment" id="employment" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> languages Spoken : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['cs_lang_spoke']; ?>" name="language" id="language" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Applicant Status : </div>
<div class="edit-details-control floatLeft">
<select name="ap_status" id="ap_status" class="pro-fields">
<option><?php echo $r['cs_status']; ?></option>
<option>Short-listed</option>
<option>Selected</option>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div align="center" style="margin:5px 0 5px 0;"><a onClick="update_app('<?php echo $r['id']; ?>');" class="edit-control-btn"> Update </a></div>
</div>
</form>
</div>

<?php } ?>