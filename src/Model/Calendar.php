<?php
/**
 * Calendar.php - Calendar Entity
 *
 * Entity Model for Calendar
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

class Calendar extends CoreEntityModel {
    /**
     * Name of Calendar
     *
     * @var $label
     * @since 1.0.0
     */
    public $label;

    /**
     * Background Color of Calendar
     *
     * @var string $color_background css
     * @since 1.0.0
     */
    public $color_background;

    /**
     * Text Color of Calendar
     *
     * @var string $color_text css
     * @since 1.0.0
     */
    public $color_text;

    /**
     * Event constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @since 1.0.0
     */
    public function __construct($oDbAdapter) {
        parent::__construct($oDbAdapter);

        # Set Single Form Name
        $this->sSingleForm = 'calendar-single';

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
        $this->id = !empty($aData['Calendar_ID']) ? $aData['Calendar_ID'] : 0;
        $this->label = !empty($aData['label']) ? $aData['label'] : '';
        $this->color_background = !empty($aData['color_background']) ? $aData['color_background'] : '';
        $this->color_text = !empty($aData['color_text']) ? $aData['color_text'] : '';

        $this->updateDynamicFields($aData);
    }

    /**
     * Get Calendar Colors
     *
     * @param $sColor
     * @return string css
     * @since 1.0.0
     */
    public function getColor($sColor) {
        if(property_exists($this,'color_'.$sColor)) {
            $sName = 'color_'.$sColor;
            return $this->$sName;
        } else {
            return '';
        }
    }
}