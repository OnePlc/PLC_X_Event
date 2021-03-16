--
-- Base Table
--
CREATE TABLE `event` (
  `Event_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `event`
  ADD PRIMARY KEY (`Event_ID`);

ALTER TABLE `event`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`, `needs_globaladmin`) VALUES
('add', 'OnePlace\\Event\\Controller\\EventController', 'Add', '', '', 0, 0),
('edit', 'OnePlace\\Event\\Controller\\EventController', 'Edit', '', '', 0, 0),
('index', 'OnePlace\\Event\\Controller\\EventController', 'Index', 'Events', '/event', 1, 0),
('list', 'OnePlace\\Event\\Controller\\ApiController', 'List', '', '', 1, 0),
('view', 'OnePlace\\Event\\Controller\\EventController', 'View', '', '', 0, 0),
('dump', 'OnePlace\\Event\\Controller\\ExportController', 'Excel Dump', '', '', 0, 0),
('index', 'OnePlace\\Event\\Controller\\SearchController', 'Search', '', '', 0, 0),
('index', 'OnePlace\\Event\\Controller\\CalendarController', 'Calendar', '', '', 0, 0),
('load', 'OnePlace\\Event\\Controller\\CalendarController', 'Load Calendar Data', '', '', 0, 0),
('modal', 'OnePlace\\Event\\Controller\\EventController', 'View Modal', '', '', 0, 0),
('rerun', 'OnePlace\\Event\\Controller\\EventController', 'Manage Reruns', '', '', 0, 0),
('addrerun', 'OnePlace\\Event\\Controller\\EventController', 'Manage Reruns', '', '', 0, 0),
('editrerun', 'OnePlace\\Event\\Controller\\EventController', 'Manage Reruns', '', '', 0, 0),
('listcalendars', 'OnePlace\\Event\\Controller\\ApiController', 'List Calendars', '', '', 0, 0),
('importical', 'OnePlace\\Event\\Controller\\CalendarController', 'Import iCal Calendar', '', '', 0, 0);

--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`, `entity_class`, `entity_tbl_class`) VALUES
('event-single', 'Event', 'OnePlace\\Event\\Model\\Event', 'OnePlace\\Event\\Model\\EventTable');

--
-- Index List
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES
('event-index', 'event-single', 'Event Index');

--
-- Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES ('event-base', 'event-single', 'Event', 'Base', 'fas fa-cogs', '', '0', '', '');

--
-- Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Event', 'fas fa-save', 'Save Event', '#', 'primary saveForm', '', 'event-single', 'link', '', ''),
(NULL, 'Edit Event', 'fas fa-edit', 'Edit Event', '/event/edit/##ID##', 'primary', '', 'event-view', 'link', '', ''),
(NULL, 'Add Event', 'fas fa-plus', 'Add Event', '/event/add', 'primary', '', 'event-index', 'link', '', ''),
(NULL, 'Export Events', 'fas fa-file-excel', 'Export Events', '/event/export', 'primary', '', 'event-index', 'link', '', ''),
(NULL, 'Find Events', 'fas fa-search', 'Find Events', '/event/search', 'primary', '', 'event-index', 'link', '', ''),
(NULL, 'Export Events', 'fas fa-file-excel', 'Export Events', '#', 'primary initExcelDump', '', 'event-search', 'link', '', ''),
(NULL, 'New Search', 'fas fa-search', 'New Search', '/event/search', 'primary', '', 'event-search', 'link', '', ''),
(NULL, 'Calendar', 'fas fa-calendar-alt', 'Calendar', '/calendar', 'primary', '', 'event-index', 'link', '', '');

--
-- Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Name', 'label', 'event-base', 'event-single', 'col-md-3', '/event/view/##ID##', '', 0, 1, 0, '', '', '');

--
-- User XP Activity
--
INSERT INTO `user_xp_activity` (`Activity_ID`, `xp_key`, `label`, `xp_base`) VALUES
(NULL, 'event-add', 'Add New Event', '50'),
(NULL, 'event-edit', 'Edit Event', '5'),
(NULL, 'event-export', 'Edit Event', '5');

INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES ('event-icon', 'fas fa-calendar-alt');

COMMIT;