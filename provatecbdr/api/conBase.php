<?php
namespace Bdrtest\Connc
{

    require_once $_SERVER["DOCUMENT_ROOT"] . '/config/Application.php';
    use Brdtest\Conf\ApplicationConf;
    use mysqli;

    class conBase
    {

        private $errtype = false;

        private $errmsg = false;

        private $query = false;

        private $configApp = false;

        public function getMsgType()
        {
            return $this->errtype;
        }

        public function getMessage()
        {
            return $this->errmsg;
        }

        public function setMsgType($err)
        {
            $this->errtype = $err;
        }

        public function setMessage($msg)
        {
            $this->errmsg = $msg;
        }
        // ####################################################################
        // CONSTRUCTOR
        // ####################################################################
        function __construct()
        {
            // Load config (Application)
            $objAppConf = new 
            ApplicationConf();
            $this->configApp = $objAppConf->readConf();
            if ($this->configApp == null) {
                echo "ERROR: Application Config (not loaded)";
                exit();
            }
        }
        
        // ####################################################################
        // PRINT HEAD PAGEBASE
        // ####################################################################
        public function getBaseUrl()
        {
            if ($this->configApp)
                return $this->configApp->base_url;
        }
        
        // ####################################################################
        // PRINT HEAD PAGEBASE
        // ####################################################################
        public function getConfig()
        {
            if ($this->configApp)
                return $this->configApp;
        }
        // ####################################################################
        // GET DATABASE DATA WITH MODEL AS ARRAY
        // ####################################################################
        public function readDB($query)
        {
            $res = false;
            $cnres = 0;
            if ($this->configApp->db_type == "MYSQL") {
                try {
                    $conn = new mysqli($this->configApp->db_host, 
                        $this->configApp->db_user, $this->configApp->db_pass, 
                        $this->configApp->db_name, $this->configApp->db_port);
                    if ($conn && ! $conn->connect_error) {
                        $result = $conn->query($query);
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                foreach ($row as $k => $value) {
                                    $res[$cnres][$k] = $row[$k];
                                }
                                $cnres ++;
                            }
                            $conn->close();
                            return $res;
                        } else {
                            $conn->close();
                        }
                    } else {
                        echo "ERROR: No database connection.";
                        exit();
                    }
                } catch (Exception $ex) {
                    if ($conn)
                        $conn->close();
                    echo "ERROR: Internal database error";
                    exit();
                }
            }
            return false;
        }
        
        // ####################################################################
        // UPDATE ON DATABASE
        // ####################################################################
        public function updateDB($query)
        {
            if ($this->configApp->db_type == "MYSQL") {
                try {
                    $conn = new mysqli($this->configApp->db_host, 
                        $this->configApp->db_user, $this->configApp->db_pass, 
                        $this->configApp->db_name, $this->configApp->db_port);
                    if ($conn && ! $conn->connect_error) {
                        $result = $conn->query($query);
                        if ($result) {
                            $conn->close();
                            return true;
                        } else {
                            $conn->close();
                            return false;
                        }
                    } else {
                        echo "ERROR: No database connection.";
                        exit();
                    }
                } catch (Exception $ex) {
                    if ($conn)
                        $conn->close();
                    echo "ERROR: Internal database error";
                    exit();
                }
            }
            return false;
        }
        
        // ####################################################################
        // PREVENT INJECTION
        // ####################################################################
        // Instead of use prepend statements
        public function prenInject($str, $nohtml = false, $noschars = false)
        {
            if ($nohtml)
                $str = strip_tags($str);
            if ($noschars)
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
            $str = addslashes($str);
            $str = mysql_escape_string($str);
            return $str;
        }
    }
}