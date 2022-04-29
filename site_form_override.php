<?php
/**
 * @version   2.0.1 for Joomla 4.0
 * @author    ConseilGouz from Randy Carey  http://iCueProject.com
 * @copyright 2021 ConseilGouz
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Form\Form;

class plgSystemSite_form_override extends CMSPlugin {

    public function onAfterRoute() {
	   	$app = Factory::getApplication();

        if ($app->isClient('site')){
			$com_str = $this->params->get('site_com_name');
			if($com_str==''){return;}
			$com_array = explode(',',$com_str);
			$com =$app->input->get('option');
			if(in_array($com,$com_array)){
				Form::addFormPath(JPATH_SITE.'/components/'.$com.'/forms');
				Form::addFormPath(JPATH_SITE.'/templates/'.$app->getTemplate().'/forms/'.$com);
			}
        }
   }



}