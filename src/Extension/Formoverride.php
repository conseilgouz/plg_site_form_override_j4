<?php
/**
 * @package		Site Form Override system plugin for J4.x/5.x/6.x
 * @author    ConseilGouz from Randy Carey  http://iCueProject.com
 * @copyright 2025 ConseilGouz
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv2 only
 */
namespace Conseilgouz\Plugin\System\SiteFormOverride\Extension;
// no direct access
defined('_JEXEC') or die('Restricted index access');
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Form\Form;
use Joomla\Event\SubscriberInterface;

class Formoverride extends CMSPlugin implements SubscriberInterface {

    /**
     * Returns an array of CMS events this plugin will listen to and the respective handlers.
     *
     * @return  array
     *
     * @since  5.1.0
     */
    public static function getSubscribedEvents(): array
    {
        /**
         * Note that onAfterInitialise must be the first handlers to run for this
         * plugin to operate as expected. These handlers load compatibility code which
         * might be needed by other plugins
         */
        return [
            'onAfterRoute'                      => 'onAfterRoute',
        ];
    }

    public function onAfterRoute() {
	   	$app = Factory::getApplication();
        if ($app->isClient('site')){
			$com_str = $this->params->get('site_com_name');
			if($com_str==''){return;}
			$com_array = explode(',',$com_str);
			$com =$app->getInput()->get('option');
			if(in_array($com,$com_array)){
				Form::addFormPath(JPATH_SITE.'/components/'.$com.'/forms');
				Form::addFormPath(JPATH_SITE.'/templates/'.$app->getTemplate().'/forms/'.$com);
			}
        }
   }
}