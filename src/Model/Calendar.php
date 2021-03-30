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
     * Defines if Calendar has a remote source
     *
     * @var boolean $is_remote
     * @since 1.0.5
     */
    public $is_remote;

    /**
     * URL for Calendar Remote source
     *
     * @var string $remote_url
     * @since 1.0.5
     */
    public $remote_url;

    /**
     * Type of Calendar
     *
     * @var string $type
     * @since 1.0.5
     */
    public $type;

    /**
     * Owner of the calendar
     *
     * @var int $user_idfs
     * @since 1.0.5
     */
    public $user_idfs;

    /**
     * Share a calendar across oneplace
     *
     * @var boolean $is_public
     * @since 1.0.5
     */
    public $is_public;

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
        $this->type = !empty($aData['type']) ? $aData['type'] : 'default';
        $this->user_idfs = !empty($aData['user_idfs']) ? $aData['user_idfs'] : 0;
        $this->color_background = !empty($aData['color_background']) ? $aData['color_background'] : '';
        $this->color_text = !empty($aData['color_text']) ? $aData['color_text'] : '';
        $this->is_remote = !empty($aData['is_remote']) ? $aData['is_remote'] : 0;
        $this->remote_url = !empty($aData['remote_url']) ? $aData['remote_url'] : '';
        $this->is_public = !empty($aData['is_public']) ? $aData['is_public'] : 0;

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