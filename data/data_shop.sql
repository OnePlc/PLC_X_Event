--
-- Event Base Form Fields
--

INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `tag_key`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'datetime', 'start Date', 'date_start', 'event-base', 'event-single', 'col-md-2', '/event/view/##ID##', '', '', 0, 1, 0, '', '', ''),
(NULL, 'datetime', 'end Date', 'date_end', 'event-base', 'event-single', 'col-md-2', '/event/view/##ID##', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'daily Event', 'is_daily_event_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', '', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'text', 'Excerpt', 'excerpt', 'event-base', 'event-single', 'col-md-3', '/event/view/##ID##', '', '', 0, 1, 0, '', '', ''),
(NULL, 'textarea', 'Description', 'description', 'event-base', 'event-single', 'col-md-12', '', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'Calendar', 'calendar_idfs', 'event-base', 'event-single', 'col-md-3', '', '/calendar/api/list/0', '', 0, 1, 0, 'calendar-single', 'OnePlace\\Event\\Model\\CalendarTable', 'add-OnePlace\\Calendar\\Controller\\CalendarController'),
(NULL, 'select', 'web show', 'show_on_web_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', '', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'select', 'web spotlight', 'web_spotlight_idfs', 'event-base', 'event-single', 'col-md-2', '', '/application/selectbool', '', 0, 1, 0, '', 'OnePlace\\BoolSelect', ''),
(NULL, 'featuredimage', 'Featured Image', 'featured_image', 'event-base', 'event-single', 'col-md-3', '', '', '', 0, 1, 0, '', '', ''),
(NULL, 'gallery', 'Gallery', 'gallery', 'event-gallery', 'event-single', 'col-md-12', '', '', '', 0, 1, 0, '', '', ''),
(NULL, 'partial', 'Gallery Sort', 'webgallery', 'event-gallerysort', 'event-single', 'col-md-12', '', '', '', 0, 1, 0, '', '', ''),
(NULL, 'multiselect', 'Categories', 'category', 'event-base', 'event-single', 'col-md-2', '', '/tag/api/list/event-single/category', 'category', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Event\\Controller\\CategoryController');

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

--
-- Base Calendar
--
INSERT INTO `event_calendar` (`Calendar_ID`, `label`, `color_background`, `color_text`, `type`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'Events', 'green', 'white', 'event', '1', CURRENT_TIME(), '1', CURRENT_TIME());

