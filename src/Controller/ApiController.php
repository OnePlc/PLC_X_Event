<?php
/**
 * ApiController.php - Event Api Controller
 *
 * Main Controller for Event Api
 *
 * @category Controller
 * @package Application
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Event\Controller;

use Application\Controller\CoreApiController;
use OnePlace\Event\Model\CalendarTable;
use OnePlace\Event\Model\EventTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class ApiController extends CoreApiController {
    protected $sApiName;

    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param EventTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,EventTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
        $this->oTableGateway = $oTableGateway;
        $this->oCalendarTbl = $oServiceManager->get(CalendarTable::class);
        $this->sSingleForm = 'event-single';
        $this->sApiName = 'Event';
    }

    public function listcalendarsAction() {
        $this->layout('layout/json');

        $oItemsDB = $this->oCalendarTbl->fetchAll(false, []);
        $aItems = [];
        if(count($oItemsDB) > 0) {
            foreach($oItemsDB as $oRow) {
                $aItems[] = ['text' => $oRow->getLabel(),'id' => $oRow->getID()];
            }
        }

        /**
         * Build Select2 JSON Response
         */
        $aReturn = [
            'state'=>'success',
            'results' => $aItems,
            'pagination' => (object)['more'=>false],
        ];

        # Print List with all Entities
        echo json_encode($aReturn);

        return false;
    }
}
