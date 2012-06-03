
/**
 * Checks that data is ok
 * 
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
 * Update theme list list using AJAX
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

	ajaxRequest.send('option=com_inscricaoexames&view=modulos&format=raw&act=getModulos&disciplinas_id='+disciplinas_id);
}



