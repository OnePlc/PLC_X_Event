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

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Event\Model\CalendarTable;
use OnePlace\Event\Model\Event;
use OnePlace\Event\Model\EventTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class EventController extends CoreEntityController {
    /**
     * Event Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;
    protected $oCalendarTbl;


    /**
     * EventController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param EventTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,EventTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'event-single';
        $this->oCalendarTbl = $oServiceManager->get(CalendarTable::class);

        setlocale(LC_TIME, CoreEntityController::$oSession->oUser->lang);

        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Event Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {
        # You can just use the default function and customize it via hooks
        # or replace the entire function if you need more customization
        return $this->generateIndexView('event');
    }

    /**
     * Event Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * event-add-before (before show add form)
         * event-add-before-save (before save)
         * event-add-after-save (after save)
         */
        return $this->generateAddView('event');
    }

    /**
     * Event Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * event-edit-before (before show edit form)
         * event-edit-before-save (before save)
         * event-edit-after-save (after save)
         */
        return $this->generateEditView('event');
    }

    /**
     * Event View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * event-view-before
         */
        return $this->generateViewView('event');
    }

    public function modalAction() {
        $this->layout('layout/modal');

        $iEventID = $this->params()->fromRoute('id', '0');
        $oEvent = $this->oTableGateway->getSingle($iEventID);
        $oCalendar = $this->oCalendarTbl->getSingle($oEvent->calendar_idfs);

        $this->layout()->aModalButtons = [];
        $this->layout()->oItem = $oEvent;

        return new ViewModel([
            'oEvent' => $oEvent,
            'oCalendar' => $oCalendar,
            'sFormName' => $this->sSingleForm,
        ]);
    }

    public function rerunAction() {
        $this->layout('layout/json');

        $iEventID = $this->params()->fromRoute('id', '0');
        $oEvent = $this->oTableGateway->getSingle($iEventID);
        $oCalendar = $this->oCalendarTbl->getSingle($oEvent->calendar_idfs);

        return new ViewModel([
            'oEvent' => $oEvent,
            'oCalendar' => $oCalendar,
            'sFormName' => $this->sSingleForm,
        ]);
    }

    public function addrerunAction() {
        $this->layout('layout/json');

        $iEventID = $this->params()->fromRoute('id', '0');
        $oEvent = $this->oTableGateway->getSingle($iEventID);
        $oCalendar = $this->oCalendarTbl->getSingle($oEvent->calendar_idfs);

        return new ViewModel([
            'oEvent' => $oEvent,
            'oCalendar' => $oCalendar,
            'sFormName' => $this->sSingleForm,
        ]);
    }

    public function editrerunAction() {
        $this->layout('layout/json');

        $iEventID = $this->params()->fromRoute('id', '0');
        //$oEvent = $this->oTableGateway->getSingle($iEventID);
        //$oCalendar = $this->oCalendarTbl->getSingle($oEvent->calendar_idfs);

        return new ViewModel([
        ]);
    }
}
