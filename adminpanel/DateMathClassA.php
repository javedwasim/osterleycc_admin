<?php
### declare the date_math_class
require_once("include/db_config.php");

class date_math_class
{

    # the public variables below can be changed for different languages
    # array of month abbreviations all upper case
    public $monthArray = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN",
        "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");

    # The base date below assumes the week begins on a Sunday and needs to agree with the
    # first element in the day-of-week array below.  Feb 1, 1942 was a Sunday.
    public $baseDate = '1942-02-01';

    # array of day-of-week abbreviations all upper case
    public $dayArray = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');

    # the public variables below can be changed for different preferences for defaults.
    # default output date format
    public $defaultFormat = "y-m-d";

    # initialize PUBLIC variables
    public $exceptions = false;
    public $useTime = false;
    public $lastError = "no error :-) ";

    # declare PRIVATE variables
    private $julianBase;
    private $minJulian;

    # initialize PRIVATE variables
    private $validDate = array();
    private $depth = 0;



    function is_leap_year($year)
    {
        return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)));
    }

    public function RegistrantSeason($isAfter30September)
    {

        //get current date
        $currentdate = date('Y-m-d');
        $currentmonth = date('m');
        $currentyear = date('Y');

        //STEP1- check existance of Season record in database & get current seasonid

        if ($isAfter30September) {

            $seasonyear = $currentyear - 1;
            $seasonname = $seasonyear . "-" . $currentyear;
        } else {

            $seasonyear = $currentyear;
            $seasonname = $seasonyear . "-" . ($currentyear + 1);
        }

        $squery = "SELECT `id`, `seasonyear`, `seasonname`, `startdate`, `enddate` FROM `season` WHERE `enddate` >= '$currentdate' and
             `seasonyear`= '$seasonyear'";
        $sresult = mysql_query($squery);
        $srow = mysql_fetch_array($sresult);
        //print_r($srow['seasonyear']); die();

        if (empty($srow)) {

            //no record in database, so insert new record
            $seasonstartdate = $seasonyear . '-11-01';
            $seasonendyear = $seasonyear + 1;
            $seasonenddate = $seasonendyear . '-09-30';

            $query = "INSERT INTO `dblfhagz_colts`.`season` (`id`, `seasonyear`, `seasonname`, `startdate`, `enddate`)
                      VALUES (NULL, '$seasonyear', '$seasonname', '$seasonstartdate', '$seasonenddate')";
            $result = mysql_query("$query");
            return $currentSeasonId = $season_id = mysql_insert_id();
        } else {
            //record already exist so use existing season id
            return $currentSeasonId = $srow['id'];
        }

    }

    public function GetSeasonId(){
        $currentyear = date('Y');
        $currentmonth = date('m');
        //$currentmonth=10;

        //find season end date of current season
        if($currentmonth<10) {

            if ($this->is_leap_year($currentyear)) {
                $season_end_date = $this->DayOfTheYearToDate('274', null, 'y-m-d');
            } else {
                $season_end_date = $this->DayOfTheYearToDate('273', null, 'y-m-d');
            }

        }elseif($currentmonth>9){
            $season_year = $currentyear + 1;
            if ($this->is_leap_year($season_year)) {
                $season_end_date = $this->DayOfTheYearToDate('274', $season_year, 'y-m-d');
            } else {
                $season_end_date = $this->DayOfTheYearToDate('273', $season_year, 'y-m-d');
            }
        }
        //get season id from table
        $squery ="SELECT id FROM `season` WHERE `enddate` = '$season_end_date'";
        $sresult = mysql_query($squery);
        $srow = mysql_fetch_array($sresult);
        return $srow['id'];
    }

    public function RegistrantSeasonq($isAfter30September,$cdate)
    {

        //get current date
        $currentdate = $cdate;
        $currentyear = date('Y',strtotime($cdate));

        //STEP1- check existance of Season record in database & get current seasonid

        if ($isAfter30September) {

            $seasonyear = $currentyear - 1;
            $seasonname = $seasonyear . "-" . $currentyear;

        } else {

            $seasonyear = $currentyear;
            $seasonname = $seasonyear . "-" . ($currentyear + 1);
        }

        $squery = "SELECT `id`, `seasonyear`, `seasonname`, `startdate`, `enddate` FROM `season` WHERE `enddate` >= '$currentdate' and
             `seasonyear`= '$seasonyear'";
        $sresult = mysql_query($squery);
        $srow = mysql_fetch_array($sresult);
        //print_r($srow['seasonyear']); die();

        if (empty($srow)) {

            //no record in database, so insert new record
            $seasonstartdate = $seasonyear . '-11-01';
            $seasonendyear = $seasonyear + 1;
            $seasonenddate = $seasonendyear . '-09-30';

            $query = "INSERT INTO `dblfhagz_colts`.`season` (`id`, `seasonyear`, `seasonname`, `startdate`, `enddate`)
                      VALUES (NULL, '$seasonyear', '$seasonname', '$seasonstartdate', '$seasonenddate')";
            $result = mysql_query("$query");
            return $currentSeasonId = $season_id = mysql_insert_id();
        } else {
            //record already exist so use existing season id
            return $currentSeasonId = $srow['id'];
        }

    }
# end class
}

?>