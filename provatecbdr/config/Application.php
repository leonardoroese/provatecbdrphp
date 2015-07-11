<?php
namespace Brdtest\Conf
{
    class ApplicationConf
    {
        private $confPath = "";

        function __construct()
        {
            
            $this->confPath = $_SERVER["DOCUMENT_ROOT"];
        }

        public function readConf()
        {
            $filename = $this->confPath . "/config/Application.config";
            $mtz = false;
            $mtz2 = false;
            try {
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                if ($contents) {
                    if (strpos($contents, "\n") > 0 && strpos($contents, "=") > 0) {
                        $mtz = explode("\n", $contents);
                        $myconf = new appConf();
                        foreach ($mtz as $k => $value) {
                            $mtz2 = false;
                            if (strpos($mtz[$k], "=") > 0)
                                $mtz2 = explode("=", $mtz[$k]);
                            if ($mtz2 && is_array($mtz2) && trim($mtz2[0]) == "db_type")
                                $myconf->db_type = $mtz2[1];
                            if ($mtz2 && is_array($mtz2) && trim($mtz2[0]) == "db_host")
                                $myconf->db_host = $mtz2[1];
                            if ($mtz2 && is_array($mtz2) && trim($mtz2[0]) == "db_port")
                                $myconf->db_port = $mtz2[1];
                            if ($mtz2 && is_array($mtz2) && trim($mtz2[0]) == "db_name")
                                $myconf->db_name = $mtz2[1];
                            if ($mtz2 && is_array($mtz2) && trim($mtz2[0]) == "db_user")
                                $myconf->db_user = $mtz2[1];
                            if ($mtz2 && is_array($mtz2) && trim($mtz2[0]) == "db_pass")
                                $myconf->db_pass = $mtz2[1];
                        }
                        fclose($handle);
                        return $myconf;
                    }
                }
            } catch (Exception $ex) {}
            if ($handle)
                fclose($handle);
            return false;
        }
    }

    class appConf
    {

        public $db_type = false;

        public $db_host = false;

        public $db_port = false;

        public $db_name = false;

        public $db_user = false;

        public $db_pass = false;
    }
}

?>