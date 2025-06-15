SET SQL_MODE='no_auto_value_on_zero';

set check_constraint_checks=off;

-- special record for deleted user
insert into user(id, name, email, password, role, created_at) values (0, 'N/A', 'N/A', '*', 'REMOVED', timestamp('0000-00-00 00:00.000'));

-- special record for deleted campaign
insert into campaign(id, title, description, target_donasi, min_donasi, max_donasi, status, created_at) values (0, 'N/A', 'N/A', 2, 1, 1, 'REMOVED', timestamp('000-00-00 00:00.000'));

set check_constraint_checks=on;

insert into user (name, email, password, role) values ('opal', 'opal@bantu.yuk', 'opalgg', 'ADMIN');
insert into user (name, email, password, role) values ('abyan', 'abyan@bantu.yuk', 'abygeje', 'ADMIN');
insert into user (name, email, password) values ('User Nombor Satu', 'some@users.com', 'user1');
insert into user (name, email, password) values ('User Yahoo', 'user@yahoo.com', 'yahoo');
insert into user (name, email, password) values ('Orang Kaya', 'tajir@gmail.com', 'tajir');

insert into campaign(title, description, target_donasi)         values ('Banjir di Jakarta Tengah', 'Banjir besar terjadi di beberapa wilayah Jakarta.', 10000000);
insert into campaign(title, description, target_donasi, status) values ('Sulawesi Timur dilanda Gempa 6.5 SR', 'Gempa berkekuatan 6.5 SR mengguncang Sulawesi Timur, ribuan keluarga terpaksa mengungsi!', 75000000, 'ONGOING');
insert into campaign(title, description, target_donasi, status) values ('Kekeringan di NTT', 'Kekeringan panjang mengakibatkan krisis air bersih di sebagian besar wilayah NTT', 150000000, 'REJECTED');
insert into campaign(title, description, target_donasi, status) values ('Tanah Longsor di Kalimantan Tenggara', 'Hujan deras selama tujuh hari menyebabkan tanah longsor Kabupaten Kucai Kalimantan Tenggara', 375000000, 'COMPLETED');
insert into campaign(title, description, target_donasi)         values ('Banjir di Jakarta Utara', 'Banjir besar terjadi di beberapa wilayah Jakarta.', 70000000);
insert into campaign(title, description, target_donasi, status) values ('Sulawesi Barat dilanda Gempa 7.1 SR', 'Gempa berkekuatan 7.1 SR mengguncang Sulawesi Barat, ribuan keluarga terpaksa mengungsi!', 175000000, 'ONGOING');
insert into campaign(title, description, target_donasi, status) values ('Kekeringan di Papua', 'Kekeringan panjang mengakibatkan krisis air bersih di sebagian besar wilayah Papua Selatan', 1450000000, 'REJECTED');
insert into campaign(title, description, target_donasi, status) values ('Tanah Longsor di Kalimantan Tengah', 'Hujan deras selama tujuh hari menyebabkan tanah longsor Kabupaten Pasar Kalimantan Tengah', 75000000, 'COMPLETED');
insert into campaign(title, description, target_donasi)         values ('Banjir di Jakarta Tengah', 'Banjir besar terjadi di beberapa wilayah Jakarta.', 10000000);
insert into campaign(title, description, target_donasi, status) values ('Sulawesi Timur dilanda Gempa 6.5 SR', 'Gempa berkekuatan 6.5 SR mengguncang Sulawesi Timur, ribuan keluarga terpaksa mengungsi!', 75000000, 'ONGOING');
insert into campaign(title, description, target_donasi, status) values ('Kekeringan di NTT', 'Kekeringan panjang mengakibatkan krisis air bersih di sebagian besar wilayah NTT', 150000000, 'REJECTED');
insert into campaign(title, description, target_donasi, status) values ('Tanah Longsor di Kalimantan Tenggara', 'Hujan deras selama tujuh hari menyebabkan tanah longsor Kabupaten Kucai Kalimantan Tenggara', 375000000, 'COMPLETED');
insert into campaign(title, description, target_donasi)         values ('Banjir di Jakarta Utara', 'Banjir besar terjadi di beberapa wilayah Jakarta.', 70000000);
insert into campaign(title, description, target_donasi, status) values ('Sulawesi Barat dilanda Gempa 7.1 SR', 'Gempa berkekuatan 7.1 SR mengguncang Sulawesi Barat, ribuan keluarga terpaksa mengungsi!', 175000000, 'ONGOING');
insert into campaign(title, description, target_donasi, status) values ('Kekeringan di Papua', 'Kekeringan panjang mengakibatkan krisis air bersih di sebagian besar wilayah Papua Selatan', 1450000000, 'REJECTED');
insert into campaign(title, description, target_donasi, status) values ('Tanah Longsor di Kalimantan Tengah', 'Hujan deras selama tujuh hari menyebabkan tanah longsor Kabupaten Pasar Kalimantan Tengah', 75000000, 'COMPLETED');

insert into photo(photo) values (load_file('/var/lib/mysql/upload/Anggota_1.jpg'));
insert into photo(photo) values (load_file('/var/lib/mysql/upload/Anggota_2.jpg'));
insert into photo(photo) values (load_file('/var/lib/mysql/upload/Anggota_4.jpg'));
insert into photo(photo, content_type) values (load_file('/var/lib/mysql/upload/Anggota_3.png'), 'image/png');
insert into photo(photo, content_type) values (load_file('/var/lib/mysql/upload/berita1.png'),   'image/png');
insert into photo(photo, content_type) values (load_file('/var/lib/mysql/upload/berita2.png'),   'image/png');
insert into photo(photo, content_type) values (load_file('/var/lib/mysql/upload/berita3.png'),   'image/png');
insert into photo(photo, content_type) values (load_file('/var/lib/mysql/upload/berita4.png'),   'image/png');

-- insert into campaign_photos(campaign_id, photo_id) values ( 1, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 2, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 3, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 4, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 5, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 6, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 7, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 8, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values ( 9, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (10, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (11, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (12, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (13, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (14, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (15, floor(rand()*8)+1);
-- insert into campaign_photos(campaign_id, photo_id) values (16, floor(rand()*8)+1);

insert into campaign_photos(campaign_id, photo_id) values ( 1,8);
insert into campaign_photos(campaign_id, photo_id) values ( 2,5);
insert into campaign_photos(campaign_id, photo_id) values ( 3,1);
insert into campaign_photos(campaign_id, photo_id) values ( 4,6);
insert into campaign_photos(campaign_id, photo_id) values ( 5,2);
insert into campaign_photos(campaign_id, photo_id) values ( 6,4);
insert into campaign_photos(campaign_id, photo_id) values ( 7,7);
insert into campaign_photos(campaign_id, photo_id) values ( 8,4);
insert into campaign_photos(campaign_id, photo_id) values ( 9,6);
insert into campaign_photos(campaign_id, photo_id) values (10,3);
insert into campaign_photos(campaign_id, photo_id) values (11,7);
insert into campaign_photos(campaign_id, photo_id) values (12,5);
insert into campaign_photos(campaign_id, photo_id) values (13,1);
insert into campaign_photos(campaign_id, photo_id) values (14,8);
insert into campaign_photos(campaign_id, photo_id) values (15,3);
insert into campaign_photos(campaign_id, photo_id) values (16,2);

insert into campaign_maintainer(campaign_id, maintainer_id) values ( 1,3);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 2,3);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 3,5);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 4,4);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 5,5);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 6,3);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 7,3);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 8,5);
insert into campaign_maintainer(campaign_id, maintainer_id) values ( 9,5);
insert into campaign_maintainer(campaign_id, maintainer_id) values (10,4);
insert into campaign_maintainer(campaign_id, maintainer_id) values (11,5);
insert into campaign_maintainer(campaign_id, maintainer_id) values (12,3);
insert into campaign_maintainer(campaign_id, maintainer_id) values (13,5);
insert into campaign_maintainer(campaign_id, maintainer_id) values (14,4);
insert into campaign_maintainer(campaign_id, maintainer_id) values (15,4);
insert into campaign_maintainer(campaign_id, maintainer_id) values (16,4);

insert into campaign_impression(campaign_id) values (16);
insert into campaign_impression(campaign_id) values (16);
insert into campaign_impression(campaign_id) values (15);
insert into campaign_impression(campaign_id) values (14);
insert into campaign_impression(campaign_id) values (14);
insert into campaign_impression(campaign_id) values (14);
insert into campaign_impression(campaign_id) values (13);
insert into campaign_impression(campaign_id) values (13);

insert into campaign_donation(campaign_id, donatur_id, amount) values (16, 3, 10000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (15, 4, 5000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (14, 5, 10000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (13, 5, 10000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (15, 5, 300000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (15, 5, 30000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (16, 5, 50000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (14, 3, 100000000);
insert into campaign_donation(campaign_id, donatur_id, amount) values (13, 5, 30000000);

update campaign set status='ONGOING';
