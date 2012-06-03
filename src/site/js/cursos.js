/**
 * Checks that data is ok
 * 
 * @param errorMsg
 * @returns {Boolean} true if data is ok, flase otherwise
 */
function checkData(errorMsg){
	items=document.getElementById("adminForm").getElementsByTagName("input");
	for (var i=0; i<items.length; i++){
		if (items[i].type=="checkbox" && items[i].checked && items[i].name!="toggle"){
			return true;
		}
	}
	alert(errorMsg);
	return false;
}

/**
 * checks data when editing courses
 * 
 * @param task
 * @param errorMsg
 * @returns {Boolean}
 */
function checkData_editarcursos(task, errorMsg){
	if (task=="eliminar_cursos"){
		items=document.getElementById("adminForm").getElementsByTagName("input");
		for (var i=0; i<items.length; i++) if (items[i].type=="checkbox" && items[i].checked && items[i].name!="toggle") return true;
		alert(errorMsg);
		return false;
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
 * unselect all checkboxes
 * 
 * @param field
 */
function uncheckAll(field){
	for (var i = 0; i < field.length; i++)
		field[i].checked = false ;
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
 * selects subjects using AJAX
 * 
 * @param name
 * @param disciplinas
 * @param form_id
 * @param tagname
 */
function select_disciplinas(name, disciplinas, form_id, tagname) { 
	form_id = typeof(form_id) != 'undefined' ? form_id : 'adminForm';//default value for the form name
	tagname = typeof(tagname) != 'undefined' ? tagname : 'input';//default value for checkbox and others
	  
	var formblock= document.getElementById(form_id); 
	var forminputs = formblock.getElementsByTagName(tagname); 
	
	for (var i = 0; i < forminputs.length; i++) { 
		var regex = new RegExp(name, "i"); 		
		if (regex.test(forminputs[i].getAttribute('name'))) { 
			for (var j=0;  j<disciplinas.length; j++) { 
				if (forminputs[i].value==disciplinas[j]){
					forminputs[i].checked = true; 
					break;
				}
			} 
		} 
	} 
}

/**
 * Updates subjects using AJAX
 * 
 * @param curso
 * @param updateContainer
 */
function actualiza_disciplinas(curso, updateContainer){
	
	var ajaxRequest = new Request({
	    url: 'index.php',
	    method: 'get',
	    onRequest: function(){
	    	document.getElementById("updating").set('html', 'A actualizar...');
	    	select_all('cid', false);
	    },
	    onSuccess: function(responseText){
	    	responseText=ltrim(responseText);
	    	var disciplinas=responseText.split("|");
	    	
	    	select_disciplinas('cid', disciplinas);
	    	
	    	document.getElementById("updating").set('html', '&nbsp;');
	    	
	    },
	    onFailure: function(){
	    	document.getElementById("updating").set('html', 'A actualização falhou! :(');
	    }
	});

	ajaxRequest.send('option=com_inscricaoexames&view=cursos&format=raw&act=getDisciplinas&curso='+curso);
}