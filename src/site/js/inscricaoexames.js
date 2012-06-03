
/**
 * disable form items
 * 
 * @param name
 * @param value
 * @param form_id
 * @param tagname
 */
function disable_all(name, value, form_id, tagname) { 
	form_id = typeof(form_id) != 'undefined' ? form_id : 'adminForm';//default value for the form name
	tagname = typeof(tagname) != 'undefined' ? tagname : 'input';//default value for checkbox and others
	  
	var formblock= document.getElementById(form_id); 
	var forminputs = formblock.getElementsByTagName(tagname); 
	
	for (var i = 0; i < forminputs.length; i++) { 
		// regex here to check name attribute 
		var regex = new RegExp(name, "i"); 						
		if (regex.test(forminputs[i].getAttribute('name'))) { 
			if (value == '1') { 
				forminputs[i].disabled = true; 
			} 
			else { 
				forminputs[i].disabled = false; 
			} 
		} 
	} 
}

/**
 * Enroll students in subject themes
 * 
 * @param checked
 * @param modulos_id 	array
 * @param alunos_id 	array
 */
function inscrever(checked, modulos_id, alunos_bi){

	var act="setInscricao";
	
	if (!checked){
		act="resetInscricao";
	}

	var ajaxRequest = new Request({
	    url: 'index.php',
	    method: 'get',
	    onRequest: function(){
	    	disable_all('modulos_id', 1);
	    	document.getElementById("updating").set('html', 'A actualizar...');
	    },
	    onSuccess: function(responseText){
	    	var resposta=responseText.split("|");
	    	document.getElementById("updating").set('html', resposta[1]);
	    	disable_all('modulos_id', 0);
	    	if (resposta[0]>0) document.getElementById("cb"+modulos_id).checked = false;
	    },
	    onFailure: function(){
	    	document.getElementById("updating").set('html', 'A actualização falhou! :(');//.innerHTML="A actualização falhou! :(";
	    }
	});

	ajaxRequest.send('option=com_inscricaoexames&view=inscricaoexames&format=raw&act='+act+'&modulos_id='+modulos_id+'&alunos_bi='+alunos_bi);
	
}

/**
 * Ajax connection to authorize enrollment
 * 
 * @param checked
 * @param alunos_bi
 */
function autorizarInscricao(checked, alunos_bi){
	var act="setAutorizacao";
	var value=1;
	if (!checked) value=0;
	
	var ajaxRequest = new Request({
	    url: 'index.php',
	    method: 'get',
	    onRequest: function(){
	    	document.getElementById("updating").set('html', 'A actualizar...');
	    },
	    onSuccess: function(responseText){
	    	var resposta=responseText.split("|");
	    	document.getElementById("updating").set('html', resposta[1]);
	    	if (resposta[0]>0) document.getElementById("autorizacao").checked = false;
	    },
	    onFailure: function(){
	    	document.getElementById("updating").set('html', 'A actualização falhou! :(');
	    }
	});
	
	ajaxRequest.send('option=com_inscricaoexames&view=inscricaoexames&format=raw&act='+act+'&value='+value+'&alunos_bi='+alunos_bi);
}

/**
 * update themes using ajax
 * 
 * @param disciplinas_id
 * @param updateContainer
 */
function actualiza_modulos(disciplinas_id, updateContainer){
	
	var updateContainerElement = document.getElementById(updateContainer);
	
	var ajaxRequest = new Request({
	    url: 'index.php',
	    method: 'get',
	    onRequest: function(){
	    	document.getElementById("updating").set('html', 'A actualizar...');
	    },
	    onSuccess: function(responseText){

	    	updateContainerElement.set('html', responseText);
	    	document.getElementById("updating").set('html', '&nbsp;');
	    	
	    },
	    onFailure: function(){
	    	document.getElementById("updating").set('html', 'A actualização falhou! :(');
	    }
	});

	ajaxRequest.send('option=com_inscricaoexames&view=inscricaoexames&format=raw&act=getModulos&disciplinas_id='+disciplinas_id);
}

/**
 * Update students list using ajax
 * 
 * @param id
 * @param updateContainer
 */
function actualiza_lista_alunos(id, updateContainer){
	
	var updateContainerElement = document.getElementById(updateContainer);
	
	if (id==0){
		updateContainerElement.set('html', '<table class="adminlist" width="100%"><thead><tr align="center">'+
			'<th width="30">ID</th>'+
			'<th width="80">BI</th>'+
			'<th>Nome</th>'+
		'</tr></thead></table>');
	}
	else{
		var ajaxRequest = new Request({
		    url: 'index.php',
		    method: 'get',
		    onRequest: function(){
		    	document.getElementById("updating_nao_integrado").set('html', 'A actualizar...');
		    },
		    onSuccess: function(responseText){
	
		    	updateContainerElement.set('html', responseText);
		    	document.getElementById("updating_nao_integrado").set('html', '&nbsp;');
		    	
		    },
		    onFailure: function(){
		    	document.getElementById("updating_nao_integrado").set('html', 'A actualização falhou! :(');
		    }
		});
		
		ajaxRequest.send('option=com_inscricaoexames&view=inscricaoexames&format=raw&act=getAlunos&cursos_id='+id);
	}
}


