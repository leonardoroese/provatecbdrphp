
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PROVA TECNICA PHP - BDR (exercício 1)</title>
<link rel="stylesheet" type="text/css" href="My.css">

</head>
<body>
	<div class="voltar" onclick="window.location.href='index.html'">Voltar</div>
	<H1>Exercício 1</H1>
	<strong> QUESTÃO:</strong>
	<br style="clear: both;">
	<br style="clear: both;">

	<div class="questao">1. Escreva um programa que imprima números de 1 a
		100. Mas, para múltiplos de 3 imprima “Fizz” em vez do número e para
		múltiplos de 5 imprima “Buzz”. Para números múltiplos de ambos (3 e
		5), imprima “FizzBuzz”.</div>
	<br style="clear: both;">
	<br style="clear: both;">
	<strong> RESPOSTA:</strong>
	<br style="clear: both;">
	<br style="clear: both;">
	<div class="resposta">
		<pre>
<?php
for ($i = 1; $i <= 100; $i ++) {
    
    if ($i > 1)
        echo ",";
    if ($i % 3 == 0)
        echo "Fizz";
    if ($i % 5 == 0)
        echo "Buzz";
    if ($i % 3 != 0 && $i % 5 != 0)
        echo $i;
    echo "&#09;";
    if ($i % 10 == 0)
        echo "<br>";
}

?>
	</pre>
	</div>
	<br style="clear: both;">
	<p style="margin-left: 10px">
		<i>Para acessar a identação correta em padrão PSR-2 veja o código
			fonte da página PHP (topo).</i>
	</p>
</body>

</html>