<?php
namespace Brdtest\TaskM
{
    require_once $_SERVER["DOCUMENT_ROOT"] . "/api/conBase.php";
    use Bdrtest\Connc\conBase;

    class TaskM extends conBase
    {
        
        // ###################################################################
        // NEW TASK
        // ###################################################################
        public function insTask($tit, $descr)
        {
            $ord = "1";
            
            if (! $tit || strlen(trim($tit)) <= 0) {
                $this->setMsgType("E");
                $this->setMessage("Informe um título para a tarefa");
                return false;
            }
            if (! $descr || strlen(trim($descr)) <= 0) {
                $this->setMsgType("E");
                $this->setMessage("Informe a descrição da tarefa");
                return false;
            }
            $res = $this->readDB("SELECT MAX(ord) as o FROM Task");
            if ($res && is_array($res) && count($res) > 0) {
                $ord = $res[0]["o"];
                if(!$ord) 
                {
                    $ord = "1";
                }else{
                    $ord++;
                }
               
            }
            
            if ($this->updateDB("INSERT INTO Task (title, descr, ord, dtreg)
                 VALUES ('" . $this->prenInject($tit) . "',
                '" . $this->prenInject($descr) . "', " . $ord . ", NOW())")) {
                $this->setMsgType("S");
                $this->setMessage("Tarefa inserida". $c) ;
                return true;
            } else {
                $this->setMsgType("E");
                $this->setMessage("Não foi possível inserir tarefa");
                return false;
            }
        }
        
        // ###################################################################
        // CHANGE TASK
        // ###################################################################
        public function chngTask($id, $tit, $descr)
        {
            if (! $id || strlen(trim($id)) <= 0) {
                $this->setMsgType("E");
                $this->setMessage("Informe o ID da tarefa");
                return false;
            }
            if (! $tit || strlen(trim($tit)) <= 0) {
                $this->setMsgType("E");
                $this->setMessage("Informe um título para a tarefa");
                return false;
            }
            if (! $descr || strlen(trim($descr)) <= 0) {
                $this->setMsgType("E");
                $this->setMessage("Informe a descrição da tarefa");
                return false;
            }
            if ($this->updateDB("UPDATE Task SET title = 
                 '" . $this->prenInject($tit) . "', descr = 
                '" . $this->prenInject($descr) . "' WHERE id = " . $id)) {
                $this->setMsgType("S");
                $this->setMessage("Tarefa Alterada");
                return true;
            } else {
                $this->setMsgType("E");
                $this->setMessage("Não foi possível alterar tarefa");
                return false;
            }
        }
        
        // ###################################################################
        // DEL TASK
        // ###################################################################
        public function delTask($id)
        {
            if (! $id || strlen(trim($id)) <= 0) {
                $this->setMsgType("E");
                $this->setMessage("Informe o ID da tarefa");
                return false;
            }
            
            if ($this->updateDB("DELETE FROM Task WHERE id = " . trim($id))) {
                $this->setMsgType("S");
                $this->setMessage("Tarefa Excluída");
                return true;
            } else {
                $this->setMsgType("E");
                $this->setMessage("Não foi possível excluir tarefa");
                return false;
            }
        }
        
        // ###################################################################
        // GET TASKS
        // ###################################################################
        public function lstTask($id = false)
        {
            $strsql = "";
            $list = false;
            $res = false;
            $strsql = "SELECT * FROM Task";
            if ($id && trim($id) != "ALL") {
                $strsql = $strsql . " WHERE id = " . $id;
            }
            $res = $this->readDB($strsql);
            
            if ($res && is_array($res) && count($res) > 0) {
                $cnres = 0;
                foreach($res as $k => $value){
                    $list[$cnres] = new TaskLine();
                    $list[$cnres]->id = $res[$k]["id"];
                    $list[$cnres]->title = urldecode($res[$k]["title"]);
                    $list[$cnres]->descr = urldecode($res[$k]["descr"]);
                    $list[$cnres]->ord = $res[$k]["ord"];
                    $list[$cnres]->dtreg = $res[$k]["dtreg"];
                    $cnres++;
                }
                $this->setMsgType("S");
                $this->setMessage("Tarefa(s) Encontrada(s)");
                return $list;
            } else {
                $this->setMsgType("E");
                $this->setMessage("Tarefas não enconstradas");
                return false;
            }
        }
        
        // ###################################################################
        // ORDER TASK
        // ###################################################################
        public function orderTask($id, $newpos)
        {}
    }
    
    class TaskLine{
        public $id = false;
        public $title = false;
        public $descr = false;
        public $ord = false;
        public $dtreg = false;
    }
}
?>