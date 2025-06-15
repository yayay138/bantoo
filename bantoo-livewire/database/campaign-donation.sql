-- SET SQL_MODE='no_auto_value_on_zero';

-- set check_constraint_checks=off;

-- delete from user where id=0;
-- delete from campaign where id=0;

-- insert into user(id, name, email, password, role, created_at) values (0, 'N/A', 'N/A', '*', 'REMOVED', timestamp('0000-00-00 00:00.000'));
-- insert into campaign(id, title, description, target_donasi, min_donasi, max_donasi, status, created_at) values (0, 'N/A', 'N/A', 0, 0, 0, 'REMOVED', timestamp('000-00-00 00:00.000'));

-- alter table campaign_donation modify column donatur_id int(11) not null default 0;
-- alter table campaign_donation modify column campaign_id int(11) not null default 0;

alter table campaign_donation drop FOREIGN KEY fk_donation_user;
alter table campaign_donation drop FOREIGN KEY fk_donation_campaign;

alter table campaign_donation add CONSTRAINT fk_donation_user FOREIGN KEY (donatur_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE RESTRICT;
alter table campaign_donation add CONSTRAINT fk_donation_campaign FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE ON UPDATE RESTRICT;

-- set check_constraint_checks=on;

-- select * from campaign_donation where campaign_id=15;

-- select * from campaign where id=0;
