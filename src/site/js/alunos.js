
/**
 * Checks that data is ok
 * 
 * @param elementIdArray
 * @param errorMsg
 * @returns {Boolean} true if data is ok, flase otherwise
 */
function checkData(elementIdArray, errorMsg){
	for (var i=0; i<elementIdArray.length; i++) 
		if(document.getElementById(elementIdArray[i]).value=="") {
			alert(errorMsg);
			return false;
		}
	return true;

}

/**
 * checks data when registering a student
 * 
 * @param elementIdArray
 * @param errorMsg
 * @returns {Boolean}
 */
function checkData_registaraluno(elementIdArray, errorMsg){
	if(document.getElementById(elementIdArray[0]).value=="" || document.getElementById(elementIdArray[1]).value==""){
		alert(errorMsg);
		return false;
	}
	if(document.getElementById(elementIdArray[1]).value==1){
		if(document.getElementById(elementIdArray[2]).value=="" || document.getElementById(elementIdArray[3]).value=="") {
			alert(errorMsg);
			return false;
		}
	}
	else{
		if(document.getElementById(elementIdArray[4]).value=="") {
			alert(errorMsg);
			return false;
		}
	}
	return true;
}

/**
 * checks data when inserting a student
 * 
 * @param elementIdArray
 * @param errorMsg
 * @returns {Boolean}
 */
function checkData_inseriralunos(elementIdArray, errorMsg){
	if(document.getElementById(elementIdArray[0]).value=="" || document.getElementById(elementIdArray[3]).value==""){
		alert(errorMsg);
		return false;
	}
	if(document.getElementById(elementIdArray[0]).value==1){
		if(document.getElementById(elementIdArray[1]).value=="") {
			alert(errorMsg);
			return false;
		}
	}
	else{
		if(document.getElementById(elementIdArray[2]).value=="") {
			alert(errorMsg);
			return false;
		}
	}
	return true;
}


/**
 * cleans left side of a string
 * 
 * @param str
 * @param chars
 * @returns a clean string
 */
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}


/**
 * select all checkboxes
 * 
 * @param name
 * @param value
 * @param form_id
 * @param tagname
 */
function select_all(name, value, form_id, tagname) { 
	form_id = typeof(form_id) != 'undefined' ? form_id : 'adminForm';//default value for the form name
	tagname = typeof(tagname) != 'undefined' ? tagname : 'input';//default value for checkbox and others
	  
	var formblock= document.getElementById(form_id); 
	var forminputs = formblock.getElementsByTagName(tagname); 
	
	for (var i = 0; i < forminputs.length; i++) { 
		// regex here to check name attribute 
		var regex = new RegExp(name, "i"); 						
		if (regex.test(forminputs[i].getAttribute('name'))) { 
			if (value == '1') { 
				forminputs[i].checked = true; 
			} 
			else { 
				forminputs[i].checked = false; 
			} 
		} 
	} 
}

/**
 * Update student list using AJAX
 * 
 * @param id
 * @param updateContainer
 */
function actualiza_lista_alunos(id, updateContainer){
	
	var updateContainerElement = document.getElementById(updateContainer);
	
	if (id==0){
		updateContainerElement.set('html', '<table class="adminlist" width="100%"><thead><tr align="center">'+
			'<th width="30">ID</th>'+
			'<th width="30"><span class="hasTip" title="Eliminar">Elim.</span><br><input name="toggle" value="" type="checkbox"></th>'+
			'<th width="80">BI</th>'+
			'<th width="80">Curso</th>'+
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
		    	responseText=ltrim(responseText);
	
		    	updateContainerElement.set('html', responseText);
		    	document.getElementById("updating_nao_integrado").set('html', '&nbsp;');
		    	
		    },
		    onFailure: function(){
		    	document.getElementById("updating_nao_integrado").set('html', 'A actualização falhou! :(');
		    }
		});
		
		ajaxRequest.send('option=com_inscricaoexames&view=alunos&format=raw&act=getAlunos&cursos_id='+id);
	}
}

