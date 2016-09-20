<?php
include("include/db_config.php");
include("DateMathClassA.php");

$sql = "SELECT id,occ_date  FROM `occ_registrant` WHERE 1 ORDER BY occ_date DESC";
$result = mysql_query($sql);

$dt = new date_math_class();
while($row = mysql_fetch_array($result)){
    $currentMonth =  date("m",strtotime($row['occ_date']));

    //Get  season id current seassion.
    $reg_date = $row['occ_date'];
    $reg_id = $row['id'];

    if ($currentMonth<10) {
        $isAfter30September = true;
        $season_id = $dt->RegistrantSeasonq($isAfter30September,$row['occ_date']);
        update_SeasonId($season_id,$reg_id);
    }
    //CASE 2 - For Registrations after 30th septemebr
    elseif($currentMonth>9){

        $isAfter30September = false;
        $season_id = $dt->RegistrantSeasonq($isAfter30September,$row['occ_date']);
        update_SeasonId($season_id,$reg_id);
    }
}

function update_SeasonId($season_id,$reg_id){
    echo "<br/>";
    echo $q = "UPDATE `occ_registrant` SET `season_id`= $season_id WHERE  `id` =  $reg_id";
    $result = mysql_query($q);
}

?>