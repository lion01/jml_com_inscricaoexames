
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
	return false;
}