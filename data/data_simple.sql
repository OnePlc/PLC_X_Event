--
-- Event Base Form Fields
--

INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'datetime', 'start Date', 'date_start', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'datetime', 'end Date', 'date_end', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'daily Event', 'is_daily_event_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'text', 'Excerpt', 'excerpt', 'event-base', 'event-single', 'col-md-3', '/event/view/##ID##', '', 0, 1, 0, '', '', ''),
(NULL, 'textarea', 'Description', 'description', 'event-base', 'event-single', 'col-md-12', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'Root Event', 'root_event_idfs', 'event-base', 'event-single', 'col-md-3', '', '/event/api/list/0', 0, 1, 0, 'event-single', 'OnePlace\\Event\\Model\\EventTable', 'add-OnePlace\\Event\\Controller\\EventController'),
(NULL, 'select', 'Calendar', 'calendar_idfs', 'event-base', 'event-single', 'col-md-3', '', '/calendar/api/list/0', 0, 1, 0, 'calendar-single', 'OnePlace\\Calendar\\Model\\CalendarTable', 'add-OnePlace\\Calendar\\Controller\\CalendarController'),
(NULL, 'select', 'web show', 'web_show_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'select', 'web spotlight', 'web_spotlight_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'select', 'confirm', 'event_confirm_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', '');

