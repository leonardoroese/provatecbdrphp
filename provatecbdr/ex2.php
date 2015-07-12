<?php
session_start();
if (isset($_SESSION['loggedin']) || isset($_COOKIE['Loggedin'])) 
{
    header("Location: http://www.google.com");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PROVA TECNICA PHP - BDR (exercício 2)</title>
<link rel="stylesheet" type="text/css" href="My.css">

</head>
<body>
	<div class="voltar" onclick="window.location.href='index.html'">Voltar</div>
	<H1>Exercício 2</H1>
	<strong> QUESTÃO:</strong>
	<br style="clear: both;">
	<br style="clear: both;">

	<div class="questao">
		<pre>
2. Refatore o código abaixo, fazendo as alterações que julgar
		necessário.
if (isset($_SESSION['loggedin']) &&	$_SESSION['loggedin'] == true){
	header("Location: http://www.google.com"); 
    exit();
    }elseif(isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true) {
		header("Location: http://www.google.com");
		exit();
}
	</pre>
	</div>
	<br style="clear: both;">
	<br style="clear: both;">
	<strong> RESPOSTA:</strong>
	<br style="clear: both;">
	<br style="clear: both;">
	<div class="resposta">
		<pre>
session_start();
if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) || 
    (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'])) 
{
    header("Location: http://www.google.com");
    exit();
}
	</pre>
	</div>
	<br style="clear: both;">
	<p style="margin-left: 10px">
		<i>Para acessar a identação correta em padrão PSR-2 veja o código
			fonte da página PHP (topo).</i> <br> O código acima apenas foi
		otimizado, porém fiquei com dúvida se sua função seria o contrário, se
		não houver sessão saia para o google, caso seja isso basta adicionar o
		operador ! na comparação lógica.
	</p>
</body>

</html>
