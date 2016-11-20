create table customer (cid varchar(20), pass varchar(20));
create table staff ( sid varchar(20), pass varchar(20), isMgr char(1));
create table merch (mid varchar(20), quantity int, price double, discount double);
create table orders (oid varchar(20), cid varchar(20), mid varchar(20), status varchar(8), dateMade datetime, totalPrice double);
