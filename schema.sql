create table customer (cid varchar(20) UNIQUE, pass varchar(20));
create table staff ( sid varchar(20) UNIQUE, pass varchar(20), isMgr char(1));
create table merch (mid varchar(20) UNIQUE, quantity int, price double, discount double);
create table orders (oid varchar(20) UNIQUE, cid varchar(20), mid varchar(20), status varchar(8), dateMade datetime, totalPrice double);
