--
-- Event Base Form Fields
--

INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'datetime', 'start Date', 'date_start', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'datetime', 'end Date', 'date_end', 'event-base', 'event-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'daily Event', 'is_daily_event_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'text', 'Excerpt', 'excerpt', 'event-base', 'event-single', 'col-md-3', '/event/view/##ID##', '', 0, 1, 0, '', '', ''),
(NULL, 'textarea', 'Description', 'description', 'event-base', 'event-single', 'col-md-12', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'Calendar', 'calendar_idfs', 'event-base', 'event-single', 'col-md-3', '', '/calendar/api/list/0', 0, 1, 0, 'calendar-single', 'OnePlace\\Event\\Model\\CalendarTable', 'add-OnePlace\\Calendar\\Controller\\CalendarController'),
(NULL, 'select', 'web show', 'web_show_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'select', 'web spotlight', 'web_spotlight_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'featuredimage', 'Featured Image', 'featured_image', 'event-base', 'event-single', 'col-md-3', '', '', '0', '1', '0', '', '', ''),
(NULL, 'gallery', 'Gallery', 'gallery', 'event-gallery', 'event-single', 'col-md-12', '', '', '0', '1', '0', '', '', ''),
(NULL, 'partial', 'Gallery Sort', 'webgallery', 'event-gallerysort', 'event-single', 'col-md-12', '', '', '0', '1', '0', '', '', '');
--
-- quick search result display
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES
('quicksearch-event-customresultattribute', '{\"fields\":[\"date_start\"],\"seperator\":\" - \",\"format\":\"datetime\"}');


--
-- Event Base Tabs
--
INSERT INTO core_form_tab (Tab_ID, form, title, subtitle, icon, counter, sort_id, filter_check, filter_value) VALUES
('event-gallery', 'event-single', 'Gallery', 'Images', 'fas fa-images', '', '4', '', ''),
('event-gallerysort', 'event-single', 'Gallery Sort', 'sorted', 'fas fa-images', '', '4', '', '');

