--
-- Event Base Form Fields
--

INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `default_value`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'datetime', 'start Date', '', 'date_start', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'datetime', 'end Date', '', 'date_end', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'boolselect', 'is daily Event', '', 'is_daily_event_idfs', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'text', 'Excerpt', '', 'excerpt', 'event-base', 'event-single', 'col-md-3', '/event/view/##ID##', '', 0, 1, 0, '', '', ''),
(NULL, 'textarea', 'Description', '', 'description', 'event-base', 'event-single', 'col-md-12', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'Root Event', '', 'root_event_idfs', 'event-base', 'event-single', 'col-md-3', '', '/event/api/list/0', 0, 1, 0, 'event-single', 'OnePlace\\Event\\Model\\EventTable', 'add-OnePlace\\Event\\Controller\\EventController'),
(NULL, 'select', 'Calendar', '##first##', 'calendar_idfs', 'event-base', 'event-single', 'col-md-3', '', '/event/api/listcalendars/0', 0, 1, 0, 'calendar-single', 'OnePlace\\Event\\Model\\CalendarTable', 'add-OnePlace\\Calendar\\Controller\\CalendarController'),
(NULL, 'boolselect', 'show on website', '', 'web_show_idfs', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'boolselect', 'web spotlight', '', 'web_spotlight_idfs', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'boolselect', 'confirm', '', 'event_confirm_idfs', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'featuredimage', 'Featured Image','',  'featured_image', 'event-base', 'event-single', 'col-md-3', '', '', '0', '1', '0', '', '', '');

--
-- quick search result display
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES
('quicksearch-event-customresultattribute', '{\"fields\":[\"date_start\"],\"seperator\":\" - \",\"format\":\"datetime\"}');

--
-- default calendar
--
INSERT INTO `event_calendar` (`Calendar_ID`, `label`, `color_background`, `color_text`, `type`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'Private', 'blue', 'white', 'default', '1', CURRENT_TIME(), '1', CURRENT_TIME());

--
-- default event duration ( global value )
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES ('calendar-default-event-duration', '90');