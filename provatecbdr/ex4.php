<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PROVA TECNICA PHP - BDR (exercício 1)</title>
<link rel="stylesheet" type="text/css" href="My.css">
<script>
function showMsgBox(text){ 
	$('#innermsgbox').html(text);
	$('#msgbox').show();
}
</script>
</head>
<body>
<div id='msgbox' class='msgbox' onclick=\"this.style.display='none'; event.stopPropagation();\"><div id='innermsgbox' class='innermsgbox'></div></div>
<div class="voltar" onclick="window.location.href='index.html'">Voltar</div>
<H1>LISTA DE TAREFAS</H1>
<br style="clear: both;">
<div class="tasknav">
	<div class="tasknavitem">Nova</div>
</div>
<div class="taskcontainer">
	<div class="taskitem">
		<strong>TITLE</strong>
		<p>Descrição da tarefa limitada a uma quantidade de caracteres</p>
	</div>
</div>

</body>

</html>