DELIMITER $$
DROP PROCEDURE IF EXISTS occ_registrant$$
CREATE PROCEDURE occ_registrant
(
IN `Id_p` INT(11),
IN `occ_firstname_p` VARCHAR(50),
IN `occ_lastname_p` VARCHAR(50),
IN `occ_birthday_p` VARCHAR(11),
IN `occ_age_p` VARCHAR(11),
IN `occ_gender_p` VARCHAR(22),
IN `occ_mobnumber_p` VARCHAR(55),
IN `occ_schoolname_p` VARCHAR(55),
IN `occ_job_title_p` VARCHAR(55),
IN `occ_sec2_guardian_name_p` VARCHAR(50),
IN `occ_sec2_relationship_p` VARCHAR(33),
IN `occ_sec2_address_p` VARCHAR(44),
IN `occ_sec2_city_p` VARCHAR(50),
IN `occ_sec2_county_p` VARCHAR(50),
IN `occ_sec2_postcode_p` VARCHAR(50),
IN `occ_sec2_daytimetel_p` VARCHAR(55),
IN `occ_sec2_eventimetel_p` VARCHAR(55),
IN `occ_sec2_emailaddress_p` VARCHAR(44),
IN `occ_sec3_emerg_name_p` VARCHAR(50),
IN `occ_sec3_emerg_lname_p` VARCHAR(55),
IN `occ_sec3_emerg_relationship_p` VARCHAR(33),
IN `occ_sec3_emerg_address_p` VARCHAR(44),
IN `occ_sec3_emerg_city_p` VARCHAR(44),
IN `occ_sec3_emerg_county_p` VARCHAR(50),
IN `occ_sec3_emerg_postcode_p` VARCHAR(55),
IN `occ_sec3_emerg_daytel_p` VARCHAR(55),
IN `occ_sec3_emerg_eventel_p` VARCHAR(55),
IN `occ_sec3_emerg_email_p` VARCHAR(44),
IN `occ_child_played_p` VARCHAR(11),
IN `occ_played_cricket_p` TEXT,
IN `occ_other_state_p` MEDIUMTEXT,
IN `occ_care_impairment_p` VARCHAR(11),
IN `occ_impairment_p` TEXT,
IN `occ_imp_state_p` MEDIUMTEXT,
IN `occ_imp_additional_p` MEDIUMTEXT,
IN `occ_doctorname_p` VARCHAR(50),
IN `occ_doctortel_p` VARCHAR(55),
IN `occ_medical_consent_p` VARCHAR(22),
IN `occ_appropriate_ans_p` TEXT,
IN `occ_date_p` VARCHAR(44),
IN `occ_club_constitution_p` VARCHAR(22),
IN `occ_terms_p` INT(11),
IN `occ_total_price_p` VARCHAR(22),
IN `sid_p` VARCHAR(20),
IN `date_registration_p` VARCHAR(55),
IN `source_type_p` VARCHAR(11),
IN `status_p` VARCHAR(11)
)

BEGIN

declare LId INTEGER;

SELECT `id` INTO LId
 FROM `occ_registrant` 
 WHERE `sid` = sid_p;

IF LId IS NULL THEN

INSERT INTO `occ_registrant`(
`Id`, 
`occ_firstname`, 
`occ_lastname`, 
`occ_birthday`, 
`occ_age`,
`occ_gender`, 
`occ_mobnumber`, 
`occ_schoolname`, 
`occ_job_title`,
`occ_sec2_guardian_name`, 
`occ_sec2_relationship`, 
`occ_sec2_address`, 
`occ_sec2_city`,
`occ_sec2_county`,
`occ_sec2_postcode`,
`occ_sec2_daytimetel`, 
`occ_sec2_eventimetel`, 
`occ_sec2_emailaddress`, 
`occ_sec3_emerg_name`, 
`occ_sec3_emerg_lname`, 
`occ_sec3_emerg_relationship`, 
`occ_sec3_emerg_address`, 
`occ_sec3_emerg_city`, 
`occ_sec3_emerg_county`, 
`occ_sec3_emerg_postcode`,
`occ_sec3_emerg_daytel`, 
`occ_sec3_emerg_eventel`, 
`occ_sec3_emerg_email`, 
`occ_child_played`, 
`occ_played_cricket`, 
`occ_other_state`, 
`occ_care_impairment`, 
`occ_impairment`, 
`occ_imp_state`, 
`occ_imp_additional`, 
`occ_doctorname`, 
`occ_doctortel`, 
`occ_medical_consent`, 
`occ_appropriate_ans`, 
`occ_date`, 
`occ_club_constitution`, 
`occ_terms`,
`occ_total_price`,
`sid`,
`date_registration`,
`source_type`,
`status`
) VALUES(
Id_p, 
occ_firstname_p, 
occ_lastname_p, 
occ_birthday_p, 
occ_age_p, 
occ_gender_p,
occ_mobnumber_p, 
occ_schoolname_p,
occ_job_title_p, 
occ_sec2_guardian_name_p, 
occ_sec2_relationship_p, 
occ_sec2_address_p,
occ_sec2_city_p,
occ_sec2_county_p,
occ_sec2_postcode_p, 
occ_sec2_daytimetel_p, 
occ_sec2_eventimetel_p, 
occ_sec2_emailaddress_p, 
occ_sec3_emerg_name_p, 
occ_sec3_emerg_lname_p, 
occ_sec3_emerg_relationship_p, 
occ_sec3_emerg_address_p, 
occ_sec3_emerg_city_p,
occ_sec3_emerg_county_p,
occ_sec3_emerg_postcode_p,
occ_sec3_emerg_daytel_p, 
occ_sec3_emerg_eventel_p, 
occ_sec3_emerg_email_p, 
occ_child_played_p, 
occ_played_cricket_p, 
occ_other_state_p, 
occ_care_impairment_p, 
occ_impairment_p, 
occ_imp_state_p, 
occ_imp_additional_p, 
occ_doctorname_p, 
occ_doctortel_p, 
occ_medical_consent_p, 
occ_appropriate_ans_p, 
occ_date_p, 
occ_club_constitution_p, 
occ_terms_p,
occ_total_price_p,
sid_p,
date_registration_p,
source_type_p,
status_p
);

END IF;
END