<?php
/**
 * CalendarController.php - Main Controller
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

class CalendarController extends CoreEntityController {
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
        $this->sSingleForm = 'calendar-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        $this->oCalendarTbl = $oServiceManager->get(CalendarTable::class);
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
        $this->setThemeBasedLayout('calendar');

        $iEventShowID = $this->params()->fromRoute('id', 0);

        $aEventSources = [];
        $aCalendars = [];
        $aCalendarsDB = $this->oCalendarTbl->fetchAll(false,[]);
        foreach($aCalendarsDB as $oCal) {
            $aEventSources[] = (object)[
                'url' => '/calendar/load/' . $oCal->getID(),
                'color' => $oCal->getColor('background'),
                'textColor' => $oCal->getColor('text'),
            ];
            $aCalendars[] = $oCal;
        }

        return new ViewModel([
            'aEventSources' => $aEventSources,
            'dJump' => '',
            'aCalendars' => $aCalendars,
            'iEventSelID' => $iEventShowID,
        ]);
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
         * calendar-add-before (before show add form)
         * calendar-add-before-save (before save)
         * calendar-add-after-save (after save)
         */
        return $this->generateAddView('calendar');
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
         * calendar-edit-before (before show edit form)
         * calendar-edit-before-save (before save)
         * calendar-edit-after-save (after save)
         */
        return $this->generateEditView('calendar');
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
         * calendar-view-before
         */
        return $this->generateViewView('calendar');
    }

    public function loadAction() {
        $this->layout('layout/json');

        $iCalendarID = $this->params('id', 0);
        $oEventsDB = $this->oTableGateway->fetchAll(false,['calendar_idfs' => $iCalendarID]);

        $aEvents = [];
        foreach($oEventsDB as $oEvent) {
            $aNewEv = [];
            $aNewEv['id'] = $oEvent->getID();

            $sStart = date('Y-m-d',strtotime($oEvent->date_start));
            if(date('H:i:s',strtotime($oEvent->date_start)) != '00:00:00') {
                $sStart .= 'T'.date('H:i:s',strtotime($oEvent->date_start));
            }
            $sEnd = date('Y-m-d',strtotime($oEvent->date_end));
            if(date('H:i:s',strtotime($oEvent->date_end)) != '00:00:00') {
                $sEnd .= 'T'.date('H:i:s',strtotime($oEvent->date_end));
            }

            if($oEvent->root_event_idfs != 0) {
                $oRoot = $this->oTableGateway->getSingle($oEvent->root_event_idfs);
                if($oRoot) {
                    $aNewEv['title'] = $oRoot->getLabel();
                    $aNewEv['start'] = $sStart;
                    $aNewEv['excerpt'] = $oRoot->getTextField('excerpt');
                    $aNewEv['description'] = $oRoot->getTextField('description');
                    $aNewEv['end'] = $sEnd;
                    //$aNewEv['is_allday_event'] = $oEvent->is_daily_event;
                    $aEvents[] = $aNewEv;
                }
            } else {
                $aNewEv['title'] = $oEvent->getLabel();
                $aNewEv['start'] = $sStart;
                $aNewEv['excerpt'] = $oEvent->getTextField('excerpt');
                $aNewEv['description'] = $oEvent->getTextField('description');
                $aNewEv['end'] = $sEnd;
                //$aNewEv['is_allday_event'] = $oEvent->is_daily_event;
                $aEvents[] = $aNewEv;
            }
        }

        echo json_encode($aEvents);

        return false;
    }
}
