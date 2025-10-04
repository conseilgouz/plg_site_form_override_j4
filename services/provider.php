<?php
/**
 * @package		Site Form Override system plugin for J4.x/5.x/6.x
 * @author		ConseilGouz
 * @copyright	Copyright (C) 2025 ConseilGouz. All rights reserved.
 * license      https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * from https://joomla.stackexchange.com/questions/31922/change-the-default-articles-list-ordering-overriding-the-model/32099#32099 
 **/

defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Conseilgouz\Plugin\System\SiteFormOverride\Extension\Formoverride;

return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   4.2.0
     */
    public function register(Container $container)
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                $displatcher = $container->get(DispatcherInterface::class);
                $plugin = new Formoverride(
                    $displatcher,
                    (array) PluginHelper::getPlugin('system', 'site_form_override')
                );
                $plugin->setApplication(Factory::getApplication());
                return $plugin;
            }
        );
    }
};
