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