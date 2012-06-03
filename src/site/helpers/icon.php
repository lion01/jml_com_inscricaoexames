<?php

// no direct access
defined('_JEXEC') or die;

/**
 * Content Component HTML Helper
 *
 * @static
 */
class JHtmlIcon{
	
	/**
	 * Creates a button to popup a window ready for printing
	 * 
	 * @param string 	$option
	 * @param string 	$view
	 * @param string 	$layout
	 * @param int 		$user_id
	 */
	static function print_popup($option, $view, $layout, $user_id=false){
		if($user_id) $user='&user_id='.$user_id;
		$url="index?option=$option&view=$view&layout=$layout&tmpl=component&print=1".$user;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		$text = JHtml::_('image','system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		

		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';

		return '<div style="text-align: right;">'.JHtml::_('link',JRoute::_($url), $text, $attribs).'</div>';
	}
	
	/**
	 * Creates a button to print data in window
	 * 
	 */
	static function print_screen(){
		$text = JHtml::_('image','system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		return '<div style="text-align: right;"><a href="#" onclick="window.print();return false;">'.$text.'</a></div>';
	}

}
