create table if not exists comments
(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    username char(100) NOT NULL,
    email char(100) default '',
    body text default '',
    changed_by_admin bool default false,
    accepted bool default false,
    image text default '',
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    primary key (id)
);
ALTER TABLE `comments` ADD INDEX `c_username` (`username`);
ALTER TABLE `comments` ADD INDEX `c_emain` (`email`);
ALTER TABLE `comments` ADD INDEX `c_created_at` (`created_at`);
ALTER TABLE `comments` ADD INDEX `c_changed_by_admin` (`changed_by_admin`);
ALTER TABLE `comments` ADD INDEX `c_accepted` (`accepted`);
