<?php
/**
 * EventController.php - Main Controller
 *
 * Main Controller Event Module
 *
 * @category Controller
 * @package Event
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Event\Controller;

use Application\Controller\CoreUpdateController;
use Application\Model\CoreEntityModel;
use OnePlace\Event\Model\EventTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;

class InstallController extends CoreUpdateController {
    /**
     * EventController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param EventTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter, EventTable $oTableGateway, $oServiceManager)
    {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'event-single';
        parent::__construct($oDbAdapter, $oTableGateway, $oServiceManager);

        if ($oTableGateway) {
            # Attach TableGateway to Entity Models
            if (! isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    public function checkdbAction()
    {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('event');

        $oRequest = $this->getRequest();

        if(! $oRequest->isPost()) {

            $bTableExists = false;

            try {
                $this->oTableGateway->fetchAll(false);
                $bTableExists = true;
            } catch (\RuntimeException $e) {

            }

            return new ViewModel([
                'bTableExists' => $bTableExists,
                'sVendor' => 'oneplace',
                'sModule' => 'oneplace-event',
            ]);
        } else {
            $sSetupConfig = $oRequest->getPost('plc_module_setup_config');

            $sSetupFile = 'vendor/oneplace/oneplace-event/data/install.sql';
            if(file_exists($sSetupFile)) {
                echo 'got install file..';
                $this->parseSQLInstallFile($sSetupFile,CoreUpdateController::$oDbAdapter);
            }

            if($sSetupConfig != '') {
                $sConfigStruct = 'vendor/oneplace/oneplace-event/data/structure_'.$sSetupConfig.'.sql';
                if(file_exists($sConfigStruct)) {
                    echo 'got struct file for config '.$sSetupConfig;
                    $this->parseSQLInstallFile($sConfigStruct,CoreUpdateController::$oDbAdapter);
                }
                $sConfigData = 'vendor/oneplace/oneplace-event/data/data_'.$sSetupConfig.'.sql';
                if(file_exists($sConfigData)) {
                    echo 'got data file for config '.$sSetupConfig;
                    $this->parseSQLInstallFile($sConfigData,CoreUpdateController::$oDbAdapter);
                }
            }

            $oModTbl = new TableGateway('core_module', CoreUpdateController::$oDbAdapter);
            $oModTbl->insert([
                'module_key'=>'oneplace-event',
                'type'=>'module',
                'version'=>\OnePlace\Event\Module::VERSION,
                'label'=>'onePlace Event',
                'vendor'=>'oneplace',
            ]);

            try {
                $this->oTableGateway->fetchAll(false);
                $bTableExists = true;
            } catch (\RuntimeException $e) {

            }
            $bTableExists = false;

            $this->flashMessenger()->addSuccessMessage('Event DB Update successful');
            $this->redirect()->toRoute('application', ['action' => 'checkforupdates']);
        }
    }

    /**
     * Update Module to the latest version
     *
     * @return ViewModel
     * @since 1.0.6
     */
    public function updateAction()
    {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('event');

        $oModTbl = new TableGateway('core_module', CoreUpdateController::$oDbAdapter);
        $oCurrentMod = $oModTbl->select([
            'module_key'=>'oneplace-event',
        ])->current();

        $oRequest = $this->getRequest();
        if(! $oRequest->isPost()) {


            return new ViewModel([
                'oCurrentModule' => $oCurrentMod,
            ]);
        }

        $sNewVer = \OnePlace\Event\Module::VERSION;

        $sUpdateSQL = \OnePlace\Event\Module::getModuleDir().'data/update_'.$oCurrentMod->version.'-'.$sNewVer.'.sql';
        if(file_exists($sUpdateSQL)) {
            $this->parseSQLInstallFile($sUpdateSQL,CoreUpdateController::$oDbAdapter);
        }
        $oModTbl->update([
            'version' => $sNewVer,
        ],[
            'module_key'=>'oneplace-event',
        ]);

        $this->flashMessenger()->addSuccessMessage('Event Module successfully updated to version '.$sNewVer);

        return $this->redirect()->toRoute('application', ['action' => 'checkforupdates']);
    }
}
