<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/api/TaskM.php";
use Brdtest\TaskM\TaskM;

$myTask = new TaskM();
$command = false;
$params = false;
$m = false;
$resexec = false;

if (isset($_SERVER['REQUEST_METHOD'])) {
    $command = $_SERVER['REQUEST_METHOD'];
}

if (trim($command) == "GET" && isset($_GET["m"]))
    $m = $_GET["m"];
if (trim($command) == "POST" && isset($_POST["m"]))
    $m = $_POST["m"];
if (trim($command) == "PUT" && isset($_PUT["m"]))
    $m = $_PUT["m"];
if (trim($command) == "DELETE" && isset($_DELETE["m"]))
    $m = $_DELETE["m"];

if (! $m) {
    echo "_err: Parâmetros incorretos";
    exit();
}

if (strpos($m, "/")) {
    $mtp = explode("/", $m);
    $c = 0;
    foreach ($mtp as $k => $value) {
        if ($c > 0) {
            $params[$c - 1] = $mtp[$k];
        } else {
            $command = $mtp[$k];
        }
        $c ++;
    }
}

switch (trim($command)) {
    case "GET":
        $intsk = false;
        if (count($params) > 1)
        {
            $intsk = $params[0];
        }
        $resexec = $myTask->lstTask($intsk);
        if($resexec && isarray($resexec) && count($resexec) > 0)
        {
            echo "arr:";
            $cntr = 0;
            foreach($resexec as $k => $value)
            {
                if($cntr > 0){
                    echo "\n||";
                }
                echo urlencode($resexec[$k]->id) . ",";
                echo urlencode($resexec[$k]->title) . ",";
                echo urlencode($resexec[$k]->descr) . ",";
                echo urlencode($resexec[$k]->ord) . ",";
                echo urlencode($resexec[$k]->dtreg);
                $cntr++;
            }
        }
        break;
    case "POST":
        if (count($params) > 1) 
        {
           $resexec = $myTask->insTask($params[0], $params[1]);
        }
        break;
    case "PUT":
        if (count($params) > 1)
        {
            $resexec = $myTask->chngTask($params[0], $params[1], $params[2]);
        }
        break;
    case "DELETE":
        if (count($params) > 0)
        {
            $resexec = $myTask->delTask($params[0]);
        }
        break;
    
    default:
        
        break;
}
        if($resexec)
            {
                echo "_ok: " . $myTask->getMessage();
            
            }else
            {
                echo "_err: " . $myTask->getMessage();
            }
?>