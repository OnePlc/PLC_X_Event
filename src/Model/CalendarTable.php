<?php
/**
 * CalendarTable.php - Event Table
 *
 * Table Model for Event
 *
 * @category Model
 * @package Event
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Event\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class CalendarTable extends CoreEntityTable {

    /**
     * EventTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'calendar-single';
    }

    /**
     * Get Event Entity
     *
     * @param int $id
     * @param string $sKey
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id,$sKey = 'Calendar_ID') {
        # Use core function
        return $this->getSingleEntity($id,$sKey);
    }

    /**
     * Save Calendar Entity
     *
     * @param Calendar $oCalendar
     * @return int Event ID
     * @since 1.0.0
     */
    public function saveSingle(Calendar $oCalendar) {
        $aDefaultData = [
            'label' => $oCalendar->label,
            'is_remote' => $oCalendar->is_remote,
            'type' => $oCalendar->type,
            'user_idfs' => $oCalendar->user_idfs,
            'color_background' => $oCalendar->color_background,
            'color_text' => $oCalendar->color_text,
            'remote_url' => $oCalendar->remote_url,
        ];

        return $this->saveSingleEntity($oCalendar,'Calendar_ID',$aDefaultData);
    }

    /**
     * Generate new single Entity
     *
     * @return Event
     * @since 1.0.0
     */
    public function generateNew() {
        return new Calendar($this->oTableGateway->getAdapter());
    }

    /**
     * Delete Calendar
     * @param $iCalendarID
     * @return bool
     * @since 1.0.6
     */
    public function deleteSingle($iCalendarID) {
        if($this->oTableGateway->delete(['Calendar_ID' => $iCalendarID])) {
            $oEvTbl = new TableGateway('event', CoreController::$oDbAdapter);
            $oEvTbl->delete(['calendar_idfs' => $iCalendarID]);
            return true;
        } else {
            return false;
        }
    }
}