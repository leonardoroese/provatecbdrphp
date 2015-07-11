<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PROVA TECNICA PHP - BDR (exercício 1)</title>
<link rel="stylesheet" type="text/css" href="My.css">
<script src="js/jquery-1.11.3.min.js" language="Javascript" ></script>
<script>
function urldecode(url) {
	  return decodeURIComponent(url.replace(/\+/g, ' '));
	}
	
function showMsgBox(text, w, h){ 
	if(w != undefined)
		document.getElementById('innermsgbox').style.width=w+'px';
	if(h != undefined)
		document.getElementById('innermsgbox').style.height=h+'px';
	$('#innermsgbox').html(text);
	$('#msgbox').show();
}

function newTask(tit, descr){
	$.ajax({url: "/tarefa/"+tit+"/"+descr, 
		method: "POST",
		error: function (xhr, ajaxOptions, thrownError) {
			alert("Problemas na requisição");
	       },
		success: function(result){
			if(result != undefined && result.length > 1){
				var restat = result.substring(0,3);
				if(restat == "_ok"){
					document.getElementById('msgbox').style.display='none';
					document.getElementById('msgbox').style.innerHTML=' ';
					getTasks();
				}
				alert(result.substring(4,result.length));
			}else{
				alert("Problemas na requisição");
			}
    }});
	return false;
}

function delTask(id){
	$.ajax({url: "/tarefa/"+id, 
		method: "DELETE",
		error: function (xhr, ajaxOptions, thrownError) {
			alert("Problemas na requisição");
	       },
		success: function(result){
			if(result != undefined && result.length > 1){
				var restat = result.substring(0,3);
				if(result.indexOf("_ok") >= 0){
					document.getElementById('msgbox').style.display='none';
					document.getElementById('msgbox').style.innerHTML=' ';
					getTasks();
				}
				alert(result.substring(4,result.length));
			}else{
				alert("Problemas na requisição");
			}
    }});
	return false;
}

function getTasks(){
	var restat = false;
	var arrres = false;
	var outdivs = "";
	$.ajax({url: "/tarefa/ALL", 
		method: "GET",
		error: function (xhr, ajaxOptions, thrownError) {
			alert("Problemas na requisição");
	       },
		success: function(result){
			if(result != undefined && result.length > 1){
				if(result.indexOf("_ok:") > 0)
					restat = true;
				if(result.indexOf("_ar:") >= 0){
					arrres = result.substring(result.indexOf("_ar:")+4, result.indexOf("_ok:"));
					if(arrres.indexOf("||") > 0){
						var mtlin = arrres.split("||");
						for(x=0; x < mtlin.length; x++){
							if(arrres.indexOf(",")>=0){
								var mtcol = mtlin[x].split(",");
								outdivs = outdivs + "<div class='taskitem'>";
								outdivs = outdivs + "<strong>" + urldecode(mtcol[1]) + " <span onclick=\"if(confirm('Remover Tarefa?')){delTask('"+mtcol[0]+"')}\">|x|</span></strong>";
								outdivs = outdivs + "<p>" + urldecode(mtcol[2]) + "</p>";
								outdivs = outdivs + "</div>";
							}
						}
					}
					
				}
				if(restat){
					var container = document.getElementById('taskcontainer');
					container.innerHTML = outdivs;
				}
				if(result.indexOf("_er:") >= 0) alert(result.substring(result.indexOf("_er:"),result.length));
			}else{
				alert("Problemas na requisição");
			}
    }});
	return false;
}

function nTask(){
	var text;
	text = "<div style='color: Black;'><h3>NOVA TAREFA</h3><label>Título</label>";
	text = text + "<br> <input type='text' size='20' name='mytit' id='mytit' />";
	text = text + "<br><label>Descrição</label><br>";
	text = text + "<textarea name='mydescr' id='mydescr' rows='4' cols='20'></textarea>";
	text = text + "<br><br><div style='cursor: pointer; padding: 4px; display:inline-block; background-color: #EDEDED;' onclick=\"newTask(document.getElementById('mytit').value, document.getElementById('mydescr').value)\">Criar</div>";
	text = text + "</div>";
	showMsgBox(text, '400', '240');
}
</script>
</head>
<body onload="getTasks();">
<div id='msgbox' class='msgbox' onclick="this.style.display='none'; event.stopPropagation();"><div id='innermsgbox' class='innermsgbox' onclick='event.stopPropagation();'></div></div>
<div class="voltar" onclick="window.location.href='index.html'">Voltar</div>
<H1>LISTA DE TAREFAS</H1>
<br style="clear: both;">
<div class="tasknav">
	<div class="tasknavitem" onclick="nTask()">Nova</div>
</div>
<div class="taskcontainer"  id="taskcontainer">
</div>

</body>

</html>