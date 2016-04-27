<?php
date_default_timezone_set('America/Los_Angeles');

/*                  Hello! And welcome to the wonderful world of DBC!
 *              For new applications, please make a new entry in the 
 *              setAppParams() function
 *              If you plan on enabling logging, please copy the editLog table 
 *              structure from an existing application and paste it into your
 *              new database.
 *      
 *              This class is what we call a Singleton. Every class will have access to 
 *              the exact same instance of this class. Think of it as a global variable.
 *              We share the one instance because it keeps the number of actual connections
 *              to the database server down to 1. Without this structure, every class would have it's
 *              own connection to the mysql server, which is a limited resource.
 * 
 *              We do not invoke this class in the normal way
 *              Bad:       $dbc = new dbc();
 *              Good:    $dbc = dbc::getInstance();
 * 
 */
class dbc {
    private static $Instance;
    
    // php my admin:
    // https://box470.bluehost.com:2083/3rdparty/phpMyAdmin/index.php?input_username=sourcec1_office

    // application database and params 
    public $db; // database connection (users / application data)
    public $dbname  = 'website_content';
    public $dbuser  = 'webcontent_admin';
    private $error_email = 'mike@mike-wright.com';
    private $dbhost = 'localhost';
    private $dbip   = 'localhost';
    private $dbpassword = 'Playdek12';
    
    // DEV:::  
//    public $dbname  = 'orangfc1_playdek';
//    public $dbuser  = 'orangfc1_playdek';
//    private $error_email = 'mike@mike-wright.com';
//    private $dbhost = 'localhost';
//    private $dbip   = 'box809.bluehost.com';
//    private $dbpassword = 'PlayDEK1';
    public $app_name = 'Playdek Games';
    public $app_signup_url = false;
    public $login_url   = '../';
    public $landing_url = '../games.php';// after a successful login
    public $mobile_url  = false;  // Mobile App
    public $log_queries = false; // ONLY TURN ON FOR DEBUGGING
    public $log_edits   = false;
    public $google_api_key = 'AIzaSyCln_oIlmDfMzMyMkuwMUIVMWovPri-c6E';
    
    // Query Stuff
    public $result;
    public $numRows;
    public $users;
    public $rows;
    private $pass_hashed; //company id
    private $salt = '{ j3 v$N';    // !!!!! if your going to change this, be prepaired to change every users password in the database. - I also double check this value in $this->login
    
    // Things I use
    public $month_list= array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June',7=> 'July', 8=>'August', 9=>'September',10=> 'October',11=> 'November',12=> 'December');


    public static function getInstance($public = true) {
        if (!self::$Instance) {
            self::$Instance = new dbc($public);
        }
        return self::$Instance;
    }
    private function __construct($public) {
        if (self::$Instance) {
            return self::$Instance;
        }        
        $this->dbconnect();
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!$public){
            $this->logIn();
        }
    }
    function dbconnect() {
        if (!$this->db) {
            if($_SERVER['HTTP_HOST'] == 'localhost'){
                $host = $this->dbip;
            }else{
                $host = $this->dbhost;
            }
//            if(substr_count($_SERVER['HTTP_HOST'], 'dev.')){
//                $this->dbname .= '_dev';
//            }
            
            $this->db = new mysqli(
                $host, 
                $this->dbuser, 
                $this->dbpassword, 
                $this->dbname,
                3306) 
                    or 
                die(
                    // can not connect, do this and exit script
                    mysqli_error() . 
                    var_dump($_SESSION) .
                    mail(
                            $this->error_email, 
                            'mysql_error',
                            mysql_error() . ' SESSION: ' . http_build_query($_SESSION)
                    )
                );
        }
        return $this->db;
    }
    public function clean($var){
        return $this->db->real_escape_string($var);
    }
    function cleanArray($array) {
        if (is_array($array)) {
            foreach ($array as $key => $var) {
                if (is_array($var)) {
                    $array[$key] = $this->cleanArray($var);
                } else {
                    $array[$key] = $this->clean($var);
                }
            }
        }
        return $array;
    }
    function cleanHTMLArray($array) {
        // Feed your $_POST or $_GET variables to this function before touching them for any reason:
        // Example:    $post = $myObject->dbc->cleanArray($_POST);
        if (is_array($array)) {
            foreach ($array as $key => $var) {
                if (is_array($var)) {
                    $array[$key] = $this->cleanHTMLArray($var);
                } else {
                    $array[$key] = $this->cleanHTML($var);
                }
            }
        }
        return $array;
    }
    public function cleanHTML($var) {
        $var = htmlentities($var);
        $var = trim($this->db->real_escape_string($var));
        return $var;
    }
    public function unclean($var){
        return html_entity_decode(stripcslashes($var));
    }
    public function uncleanArray($array) {
        if (is_array($array)) {
            foreach ($array as $key => $var) {
                if (is_array($var)) {
                    $array[$key] = $this->uncleanArray($var);
                } else {
                    $array[$key] = $this->unclean($var);
                }
            }
        }
        return $array;
    }
    function login(){
        $forward = false;
        $success = false;
        switch(true){
            case(isset($_POST['username'], $_POST['password'])):
                $user = $this->clean($_POST['username']);
                $pass = $this->password($_POST['password']);
                $forward = true;
                break;
            case(isset($_SESSION['username'], $_SESSION['password'])):
                $user = $this->clean($_SESSION['username']);
                $pass = $_SESSION['password'];
                break;
            default:
                header('location: /'.$this->login_url.'?f=2'); //catchall
                break;
        }
        
        if($user && $pass){
           $success = $this->checkCredentials($user, $pass, true); 
        }
        if($success && $forward){
            header('location: '. $this->landing_url);
            exit();
        }
        if($success && !$forward){
            return true;
        }
        
        header('location: '.$this->login_url.'?f=1'); //catchall
        exit();
    }
    function getUsers(){
        $query = "SELECT username FROM users ORDER BY username;";
        $result= $this->query($query);
        return $result;
    }
    
    function getAccess($user_id){
        $query = "SELECT * FROM access WHERE access_userID = '$user_id';";
        $result= $this->query($query);
        $access= array();
        if(is_array($result)){
            foreach($result as $r){
                $access[$r['access_name']] = $r['access_value'];
            }
        }
        return $access;
    }
    
    function password($pass) {
        if ($this->salt != '{ j3 v$N') {
            $this->salt = '{ j3 v$N';
        }
        return sha1($pass . $this->salt);
    }

    function checkCredentials($username, $password, $pass_hashed = false) {
        $pass_hashed ? $pass = $password : $pass = $this->password($password);
//        $this->pass_hashed = $pass;
        $query = "SELECT * FROM users " .
                    "WHERE username = '$username' AND password = '$pass' " .
                    "LIMIT 1;";
        $result = $this->query($query);
        $result = $result[0];
        if ($this->numRows != 1) {
            return false;
        }
        foreach ($result as $key => $val) {
            $_SESSION[$key] = $val;
        }
        $_SESSION['user'] = $username;
        $_SESSION['pass'] = $password;
        $_SESSION['access'] = $this->getAccess($result['user_id']);
        return true;
    }
    
    function setCookies($username, $pass){
            $aceapp = sha1(time() . 'aceapp');
            $aceapp2 = sha1('aebrdbaaer' . $pass);
            $aceapp3 = sha1('aetjaert32$' . $pass);
            $getget = 'username=' . $username . '&aceapp=' . $aceapp . '&aceapp1=' . $pass . '&aceapp2=' . $aceapp2 . '&aceapp3=' . $aceapp3;
            if (!headers_sent()) {
                setcookie('user', $username, time() + 60 * 60 * 24 * 60, '/');
                setcookie('aceapp', $aceapp, time() + 60 * 60 * 24 * 60, '/'); //garbage
                setcookie('aceapp1', $pass, time() + 60 * 60 * 24 * 60, '/');
                setcookie('aceapp2', $aceapp2, time() + 60 * 60 * 24 * 60, '/'); //garbage
                setcookie('aceapp3', $aceapp3, time() + 60 * 60 * 24 * 60, '/'); //garbage
            }
            return $getget;
    }
    function connection() {
        return $this->dbc;
    }
    function query($query) {
        $this->rawQuery($query);
        while ($row[] = $this->result->fetch_assoc());
        array_pop($row);
        $this->numRows = $this->result->num_rows;
        $this->rows = $row;
        if (strpos($query, 'SELECT') === 0) {
            if ($this->numRows == 0) {
                $this->rows = false;
            }
        }
        $this->result->free();
        $row = $this->unescapeArray($row);  // while it's tempting to use html_entity_decode() 
                                            // at this point, this opens you up to all kinds of 
                                            // script injection on db info that gets kicked out on the client side
        return $row;
    }
    function unescape($string) {
        $string = stripslashes($string);
        return $string;
    }
    function unescapeArray($array) {
        if (is_array($array)) {
            foreach ($array as $key => $row) {
                if (is_array($row)) {
                    $array[$key] = $this->unescapeArray($row);
                } else {
                    $array[$key] = $this->unescape($row);
                }
            }
        }
        return $array;
    }
    function numRows() {
        return $this->numRows;
    }
    function update($query) {
        $result = $this->db->query($query) or die($query . '<br/>' . $this->db->error . '<br/><br/><b>Session:</b>' . '<br/>' . var_dump($_SESSION));
        $this->editLog($query, 2);
        return $result;
    }
    function editLog($query, $type, $id = false) {
        if(!$this->log_edits){
            return false;
        }
        $time = time();
        $var = explode(' ', $query);
        $i = 0;
        if ($type == 2) {
            //find info from UPDATE query
            $table = false;
            $id = false;
            $where = false;
            if (stripos($query, 'where')) {
                while ($var[$i] !== false) {
                    if ($var[$i] == '.' && !$table) {
                        $table = $var[$i + 1];
                    }
                    if (strtolower($var[$i]) == 'where') {
                        $where = 1;
                        $key = $var[$i + 1];
                        $id = $var[$i + 3];
                        $var[$i + 1] = false;
                    }
                    $i++;
                }
            }
            $id = $this->number($id);
            $id = $this->clean($id);
        }
        if ($type == 1) {
            $replace = "INSERT INTO {$this->dbname} . ";
            $table = str_replace($replace, '', $query);
            $table = explode(' ', $query);
            $table = $table[0];
            $key = '';
        }
        $query = $this->clean($query);    
        $log = "INSERT INTO {$this->dbname} . editLog " .
                "(edit_table, edit_recordID, edit_userID, edit_date, edit_key, edit_query, edit_type) VALUES " .
                "('$table', '$id', '{$_SESSION['user_id']}', '$time', '$key', '$query', '$type');";
        
        $this->insert($log, true);
    }

    function insert($query, $fromEditLog = false) {
        $result = $this->db->query($query) or die($this->db->error . '<br/><br/><b>Session:</b>' . '<br/>' . var_dump($_SESSION)); 
        $return_id = $this->lastID();
        if (!$fromEditLog) {
            $this->editLog($query, 1, $return_id);
        }
        return $return_id;
    }

    function lastID() {
        $id = $this->db->insert_id;
        return $id;
    }
    function stmt_bind_assoc(&$stmt, &$out) {
        // lol, you don't want to edit this
        $data = mysqli_stmt_result_metadata($stmt);
        $fields = array();
        $out = array();
        $fields[0] = $stmt;
        $count = 1;
        while ($field = mysqli_fetch_field($data)) {
            $fields[$count] = &$out[$field->name];
            $count++;
        }
        call_user_func_array(mysqli_stmt_bind_result, $fields);
    }
    function count($query) {
        $this->db->query($query) or die($query . '<br/>' . mysql_error($this->db) . '<br/><br/><b>Session:</b>' . '<br/>' . var_dump($_SESSION));
        //echo mysql_num_rows($result);
        return $this->numRows;
    }
    function getTables() {
        $query = "SHOW TABLES";
        $result = $this->query($query);
        $tables = array();
        foreach ($result as $row) {
            $tables[] = $row['Tables_in_' . $this->dbname];
        }
        return $tables;
    }
    function programName() {
        echo $this->app_name;
    }
    function logRequest($start, $end, $doc) {
        if($this->log_queries == false){
            return true;
        }
        $post = 'POST:';
        foreach ($_POST as $key => $val) {
            $post .= $key . ':=>:' . $val;
        }
        $get = 'GET:';
        foreach ($_GET as $key => $val) {
            $get .= $key . ':=>:' . $val;
        }
        $post = $this->clean($post);
        $get = $this->clean($get);
        //kept seperate from $this->log so it can be turned on or off as desired
        $time = time();
        $doc = $this->clean($doc);
        $query = "INSERT INTO {$this->aceappDBname} . log " .
                "(log_name, log_value, log_floatval, log_time, log_data) VALUES " .
                "('time', '$start', '$end', '$time', '$doc - $post - $get');";
        $this->aceInsert($query);
    }
    
    private function rawQuery($query) {
        //executes the query at the lowest level then returns the array result.
        $this->result = $this->db->query($query, MYSQLI_USE_RESULT) or die($this->db->error . '1<br/>' . $query);
    }
    
    function getUpdateTable($query) {
        // logging stuff
        $start = strpos($query, '.');
        $string = substr($query, $start + 1);

        $end = stripos($string, 'SET');
        $table = substr($string, 0, $end - 1);
        return $table;
    }
    
    function getPreference($name){
        $query = "SELECT * FROM preferences WHERE preference_name = '$name' LIMIT 1;";
        $result= $this->query($query);
        return $result[0]['preference_value'];
    }
    function savePreference($name, $value){
        $query = "DELETE FROM preferences WHERE preference_name = '$name';";        
        $result= $this->update($query);

        $query = "INSERT INTO preferences (preference_name, preference_value) VALUES ('$name', '$value');";
        $result= $this->insert($query);
    }
    function checked($var){
        $var == 1 ? $c = 'checked="checked" ' : $c = '';
        return $c;
    }
    function date($time){
        if($time){
            $date = date('m/d/Y', $time);
        }else{
            $date = '';
        }
        return $date;
    }
}

function mdy($time){
    if($time){
        $date = date('m/d/Y', $time);
    }else{
        $date = '';
    }
    return $date;
}
function dump($array, $die = false){
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
        if($die){
            die();
        }
}
function cash($var){
    $var != 0 ? $cash = '$'.number_format($var, 2) : $cash = '';
    return $cash;
}
function json($array){
    return json_encode($array, JSON_PRETTY_PRINT);
}

define('NL_NIX', "\n");
define('NL_WIN', "\r\n");
define('NL_MAC', "\r");
function newline_type($string){
    if (strpos($string, NL_WIN) !== false) {
        return NL_WIN;
    } elseif(strpos($string, NL_MAC) !== false) {
        return NL_MAC;
    } elseif(strpos($string, NL_NIX) !== false) {
        return NL_NIX;
    }
}
function back(){
    $page = $_SERVER['HTTP_REFERER'];
    header("location: $page");
}
function uploadFile($inputName, $folder, $name){
    if($_FILES[$inputName]){
        if(!is_dir($folder)){
            mkdir($folder);
        }
        $tmp_name = $_FILES[$inputName]['tmp_name'];
        $new_name = "$folder/$name";
        move_uploaded_file($tmp_name, $new_name);
    }
}