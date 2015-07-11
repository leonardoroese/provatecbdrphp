<?php

class MyUserClass
{

    public function getUserList()
    {
        try {
            $dbconn = new DatabaseConnection();
            $results = $dbconn->query('select name from user');
            sort($results);
        } catch (PDOException $e) {
            echo "Error: " . $e;
        }
        return $results;
    }
}

class DatabaseConnection extends PDO
{

    function __construct()
    {
        parent::__construct('localhost', 'user', 'password');
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PROVA TECNICA PHP - BDR (exercício 3)</title>
<link rel="stylesheet" type="text/css" href="My.css">

</head>
<body>
	<div class="voltar" onclick="window.location.href='index.html'">Voltar</div>
	<H1>Exercício 3</H1>
	<strong> QUESTÃO:</strong>
	<br style="clear: both;">
	<br style="clear: both;">

	<div class="questao">
		<pre>
3. Refatore o código abaixo, fazendo as alterações que julgar necessário.

 class MyUserClass
 {
 	public function getUserList()
 	{
 		$dbconn = new DatabaseConnection('localhost','user','password');
 		$results = $dbconn->query('select name from user');
 		sort($results);
 		return $results;
 	}
 }</pre>
	</div>
	<br style="clear: both;">
	<br style="clear: both;">
	<strong> RESPOSTA:</strong>
	<br style="clear: both;">
	<br style="clear: both;">
	<div class="resposta">
		<pre>
class MyUserClass
{

    public function getUserList()
    {
        try {
            $dbconn = new DatabaseConnection();
            $results = $dbconn->query('select name from user');
            sort($results);
        } catch (PDOException $e) {
            echo "Error: " . $e;
        }
        return $results;
    }
}

class DatabaseConnection extends PDO
{

    function __construct()
    {
        parent::__construct('localhost', 'user', 'password');
    }
}
	</pre>
	</div>
	<br style="clear: both;">
	<p style="margin-left: 10px">
		<i>Para acessar a identação correta em padrão PSR-2 veja o código
			fonte da página PHP (topo).</i> <br> A solução para o exercício
		proposto implica na criação da classe DatabaseConnection extendendo a
		classe PDO que possúi os métodos indicados para execução da consulta
		no Banco.<br> * Inserido tratamento de exceções.<br>
		* O contrutor com os dados de conexão
		 <br>Poderia também ser
		criado um arquivo de configuração com os dados de acesso do banco para
		o projeto. <br>
	</p>
</body>

</html>