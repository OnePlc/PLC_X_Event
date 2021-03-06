ALTER TABLE `event` ADD  `date_start` datetime  NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `label`,
ADD `date_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `date_start`,
ADD `is_daily_event_idfs`int(11) NOT NULL DEFAULT '0' AFTER `date_end`,
ADD `excerpt`  VARCHAR (255) NOT NULL DEFAULT '' AFTER `is_daily_event_idfs`,
ADD `is_confirmed` BOOLEAN NOT NULL DEFAULT TRUE AFTER `Event_ID`,
ADD `description` TEXT NOT NULL DEFAULT '' AFTER `excerpt`,
ADD `root_event_idfs` int(11) NOT NULL DEFAULT 0 AFTER `description`,
ADD `calendar_idfs` int(11)  NOT NULL DEFAULT '0' AFTER `root_event_idfs`,
ADD `web_show_idfs` tinyint(1) NOT NULL DEFAULT 0 AFTER `calendar_idfs`,
ADD `web_spotlight_idfs` tinyint(1) NOT NULL DEFAULT 0 AFTER `web_show_idfs`,
ADD `event_confirm_idfs` tinyint(1) NOT NULL DEFAULT 0 AFTER `web_spotlight_idfs`,
ADD `featured_image` VARCHAR (255) NOT NULL DEFAULT '' AFTER `label`;

CREATE TABLE `event_calendar` (
  `Calendar_ID` int(11) NOT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_background` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_text` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_remote` BOOLEAN NOT NULL DEFAULT FALSE,
  `is_public` BOOLEAN NOT NULL DEFAULT FALSE,
  `user_idfs` int(11) NOT NULL,
  `remote_url` VARCHAR(255) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `event_calendar_user` (
    `user_idfs` int(11) NOT NULL,
    `calendar_idfs` int(11) NOT NULL,
    `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `event_calendar_user`
    ADD PRIMARY KEY (`user_idfs`,`calendar_idfs`);

ALTER TABLE `event_calendar`
    ADD PRIMARY KEY (`Calendar_ID`);

ALTER TABLE `event_calendar`
    MODIFY `Calendar_ID` int(11) NOT NULL AUTO_INCREMENT;