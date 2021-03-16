<?php
/**
 * Event.php - Event Entity
 *
 * Entity Model for Event
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

use Application\Model\CoreEntityModel;

class Event extends CoreEntityModel {
    public $label;
    public $is_confirmed;
    public $root_event_idfs;

    /**
     * Event constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @since 1.0.0
     */
    public function __construct($oDbAdapter) {
        parent::__construct($oDbAdapter);

        # Set Single Form Name
        $this->sSingleForm = 'event-single';

        # Attach Dynamic Fields to Entity Model
        $this->attachDynamicFields();
    }

    /**
     * Set Entity Data based on Data given
     *
     * @param array $aData
     * @since 1.0.0
     */
    public function exchangeArray(array $aData) {
        $this->id = !empty($aData['Event_ID']) ? $aData['Event_ID'] : 0;
        $this->label = !empty($aData['label']) ? $aData['label'] : '';
        $this->is_confirmed = !empty($aData['is_confirmed']) ? $aData['is_confirmed'] : 1;
        $this->root_event_idfs = !empty($aData['root_event_idfs']) ? $aData['root_event_idfs'] : 0;

        $this->updateDynamicFields($aData);
    }
}