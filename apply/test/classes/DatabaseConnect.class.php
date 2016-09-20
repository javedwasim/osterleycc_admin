<?php


/**
 * My database class extends the PDO class.
 *
 * @package PDO / Database
 * @author  Asif Iqbal <me@webwizo.com>
 * @link    http://www.webwizo.com
 * @version 1.0.0
 */
class DatabaseConnect extends PDO {

    /**
     * Database Engine constant
     */
    const DB_ENGINE = 'mysql';

    /**
     * Database Host constant
     */
    const DB_HOST = "localhost";

    /**
     * Database Name constant
     */
    const DB_NAME = "dblfhagz_colts";

    /**
     * Database Username constant
     */
    const DB_USER = "dblfhagz_colt";

    /**
     * Database Password constant
     */
    const DB_PASS = "test123";

    /**
     * Last Query
     *
     * @var string
     */
    var $_last_query;

    /**
     * Debug Mode
     *
     * @var boolean
     */
    var $_debug = TRUE;

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        $dns = self::DB_ENGINE . ':dbname=' . self::DB_NAME . ';host=' . self::DB_HOST;
        try {
			$options = array(
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE
			);
            parent::__construct($dns, self::DB_USER, self::DB_PASS, $options);
        } catch(PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * Database Query Function
     *
     * @access  public
     * @param   string  Any Database Query or Stored Procedure
     * @param   array   An array of query parameters
     * @param   boolean Set to FALSE to stop result_set
     * @return  array   If $fetchResult TRUE, returns num_rows and result_set, otherwise returns num_rows
     */
    public function query($query, $args = NULL, $fetchResult = TRUE) {
		try {
            $this->_last_query = $query;
            $stmt = parent::prepare($query);
            if ($args) {
                foreach ($args as $key => $value)
                    $stmt->bindValue($key, $value);
            }
            
			$stmt->execute();
			
			$rowCount = $stmt->rowCount();
			$data = array('num_rows' => $rowCount);
			
            if ($fetchResult) {
				if($rowCount > 1)
                	$data['rows'] = $stmt->fetchAll(PDO::FETCH_OBJ);
				else
					$data['rows'] = $stmt->fetch(PDO::FETCH_OBJ);
			}

			return $data;
			
        } catch(PDOException $ex) {
            $output = "<hr>";
            $output .= $ex->getMessage();
            if ($this->_debug)
                $output .= "<br><br>Last Query: " . $this->_last_query;

            $output .= "<hr>";
            //die($output);

        }
    }

} // END

$db = new DatabaseConnect();
// 	stored procedure
//	$result = $db->query("CALL sp_Patterns(:id)", array(":id" => 1));

//	$result = $db->query("SELECT * FROM ly0_sms_patterns");
//	$result = $db->query("SELECT * FROM ly0_sms_patterns WHERE id = :id", array(":id" => 2));
//	$result = $db->query("INSERT INTO ly0_sms_patterns (pattern_format, status) VALUES(:pattern, :status)", array(":pattern" => 'dd', ":status" => 'Active'), FALSE);
//	$result = $db->query("DELETE FROM ly0_sms_patterns WHERE id = :id", array(":id" => 7), FALSE);
//	print_r($result);

// bookingwhizz xml connecting details
$bwuser = 999;
$bwpass = "6UQbVjCw";
$bwXMLPath = "http://bwtest.bookingwhizz.com/Service1.svc/xml/bookings";
$credentails = "&userid=$bwuser&password=$bwpass";
// booking.com xml connecting details
$bookinguser = "karimmawani";
$bookingpass = "wani20";
$bookingXMLPath = "http://$bookinguser:$bookingpass@distribution-xml.booking.com/xml/bookings.";	

// bookingwhizz xml path with credentails
define("_bwXMLPath", $bwXMLPath);
define("_bwcredentails", $credentails);

// booking.com xml path with credentails
define("_bookingXMLPath", $bookingXMLPath);




?>