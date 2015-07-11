<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/api/TaskM.php";
use Brdtest\TaskM\TaskM;

$myTask = new TaskM();
$command = false;
$params = false;
$m = false;
$resexec = false;
$post_vars = false;
$lis = "";
if (isset($_SERVER['REQUEST_METHOD'])) {
    $command = $_SERVER['REQUEST_METHOD'];
}

if (trim($command) == "GET" )
    $m = $m = str_replace("/tarefa", "", $_SERVER["REQUEST_URI"]);
if (trim($command) == "POST" )
    $m = $m = str_replace("/tarefa", "", $_SERVER["REQUEST_URI"]);
if (trim($command) == "PUT")
    $m = $m = str_replace("/tarefa", "", $_SERVER["REQUEST_URI"]);
if (trim($command) == "DELETE"){
    $m = str_replace("/tarefa", "", $_SERVER["REQUEST_URI"]);
}

if (!$m) {
    echo "_er: Parâmetros incorretos";
    exit();
}
if (strpos($m, "/") >= 0) {
    $mtp = explode("/", $m);
    $c = 0;
    foreach ($mtp as $k => $value) {
        if ($c > 0) {
            $params[$c - 1] = $mtp[$k];
        }
        $c ++;
    }
}

switch (trim($command)) {
    case "GET":
        $intsk = false;
        if (count($params) > 0)
        {
            $intsk = $params[0];
        }
        $resexec = $myTask->lstTask($intsk);
        if($resexec && is_array($resexec) && count($resexec) > 0)
        {
            echo "_ar:";
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
                echo "_er: " . $myTask->getMessage() . $lis;
            }
?>