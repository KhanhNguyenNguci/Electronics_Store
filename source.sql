SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

#config DB
/* CREATE DATABASE DBMS_231 WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';

ALTER DATABASE DBMS_231 OWNER TO postgres; */

CREATE TABLE tbl_admin (
  adminId SERIAL NOT NULL PRIMARY KEY,
  adminName varchar(255) NOT NULL,
  adminEmail varchar(150) NOT NULL,
  adminUser varchar(255) NOT NULL,
  adminPass varchar(255) NOT NULL,
  level int NOT NULL
);

INSERT INTO tbl_admin (adminName, adminEmail, adminUser, adminPass, level) VALUES ('Lê Khanh', 'khanh.nguyennlk41@hcmut.edu.vn', 'khanhadmin', '1234567', 0);
INSERT INTO tbl_admin (adminName, adminEmail, adminUser, adminPass, level) VALUES ('Khanh Nguyễn', 'khanhnguyennlk4198@gmail.com', 'khanhAD', '12345', 0);

CREATE TABLE tbl_category (
  catId SERIAL NOT NULL PRIMARY KEY,
  catName varchar(255) NOT NULL
);

CREATE TABLE tbl_brand (
  brandId SERIAL NOT NULL PRIMARY KEY,
  brandName varchar(255) NOT NULL
);

CREATE TABLE tbl_product (
  productId SERIAL NOT NULL PRIMARY KEY,
  productName varchar(50) NOT NULL,
  catId int,
  brandId int,
  product_desc TEXT,
  type int,
  price varchar(255) NOT NULL,
  image varchar(255) NOT NULL
);

CREATE TABLE tbl_thongke (
  id_thongke SERIAL NOT NULL PRIMARY KEY,
  doanhthu varchar(50),
  donhang int,
  soluong int,
  date_thongke varchar(50)
);
INSERT INTO tbl_thongke (doanhthu, donhang, soluong, date_thongke) 
VALUES 
  ('45000', 5000, 2000, '2023-09-20'),
  ('47000', 560, 1200, '2023-10-21'),
  ('58000', 470, 1000, '2023-04-19'),
  ('48000', 250, 1200, '2023-04-18'),
  ('37000', 500, 800, '2023-07-12'),
  ('47000', 560, 1500, '2023-07-01'),
  ('58000', 470, 1800, '2023-02-17'),
  ('48000', 250, 1200, '2023-05-29'),
  ('35000', 3500, 1250, '2023-11-10'),
  ('42000', 3800, 2250, '2023-10-27');