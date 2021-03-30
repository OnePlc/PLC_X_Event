<?php
/**
 * Module.php - Module Class
 *
 * Module Class File for Event Module
 *
 * @category Config
 * @package Event
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Event;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Mvc\MvcEvent;
use Laminas\ModuleManager\ModuleManager;
use Laminas\Session\Config\StandardConfig;
use Laminas\Session\SessionManager;
use Laminas\Session\Container;
use Laminas\EventManager\EventInterface as Event;
use Application\Controller\CoreEntityController;
use OnePlace\Event\Controller\EventController;
use OnePlace\Event\Model\CalendarTable;
use OnePlace\Event\Model\EventTable;

class Module {
    /**
     * Module Version
     *
     * @since 1.0.0
     */
    const VERSION = '1.0.6';

    /**
     * Load module config file
     *
     * @since 1.0.0
     * @return array
     */
    public function getConfig() : array {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(Event $e)
    {
        // This method is called once the MVC bootstrapping is complete
        $application = $e->getApplication();
        $container    = $application->getServiceManager();
        $oDbAdapter = $container->get(AdapterInterface::class);
        $tableGateway = $container->get(EventTable::class);

        # Register Filter Plugin Hook
        CoreEntityController::addHook('event-edit-after-save',(object)['sFunction'=>'writeSettingsToChildren','oItem'=>new EventController($oDbAdapter,$tableGateway,$container)]);
    }

    /**
     * Load Models
     */
    public function getServiceConfig() : array {
        return [
            'factories' => [
                # Event Module - Base Model
                Model\EventTable::class => function($container) {
                    $tableGateway = $container->get(Model\EventTableGateway::class);
                    return new Model\EventTable($tableGateway,$container);
                },
                Model\EventTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Event($dbAdapter));
                    return new TableGateway('event', $dbAdapter, null, $resultSetPrototype);
                },
                Model\CalendarTable::class => function($container) {
                    $tableGateway = $container->get(Model\CalendarTableGateway::class);
                    return new Model\CalendarTable($tableGateway,$container);
                },
                Model\CalendarTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Calendar($dbAdapter));
                    return new TableGateway('event_calendar', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    /**
     * Load Controllers
     */
    public function getControllerConfig() : array {
        return [
            'factories' => [
                # Event Main Controller
                Controller\EventController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    $tableGateway = $container->get(Model\EventTable::class);
                    return new Controller\EventController(
                        $oDbAdapter,
                        $container->get(Model\EventTable::class),
                        $container
                    );
                },
                # Api Plugin
                Controller\ApiController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\ApiController(
                        $oDbAdapter,
                        $container->get(Model\EventTable::class),
                        $container
                    );
                },
                # Export Plugin
                Controller\ExportController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\ExportController(
                        $oDbAdapter,
                        $container->get(Model\EventTable::class),
                        $container
                    );
                },
                # Search Plugin
                Controller\SearchController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\SearchController(
                        $oDbAdapter,
                        $container->get(Model\EventTable::class),
                        $container
                    );
                },
                # Calendar Controller
                Controller\CalendarController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    $aPluginTbls = [];
                    $aPluginTbls['calendar'] = $container->get(CalendarTable::class);
                    $aPluginTbls['user'] = $container->get(\OnePlace\User\Model\UserTable::class);

                    return new Controller\CalendarController(
                        $oDbAdapter,
                        $container->get(Model\EventTable::class),
                        $container,
                        $aPluginTbls
                    );
                },
                # Installer
                Controller\InstallController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\InstallController(
                        $oDbAdapter,
                        $container->get(Model\EventTable::class),
                        $container
                    );
                },
            ],
        ];
    }
}
