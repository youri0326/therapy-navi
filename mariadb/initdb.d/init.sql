
USE therapyNavi-db;
CREATE TABLE test(
    id INT NOT NULL,
    name VARCHAR(15),
    price INT,
    PRIMARY KEY (id)
);

INSERT INTO test(id,name,price) VALUES('0','田中','4000');
INSERT INTO test(id,name,price) VALUES('1','佐藤','3000');
INSERT INTO test(id,name,price) VALUES('2','鈴木','2000');

CREATE TABLE bookinfo (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(100),
    price INTEGER
)ENGINE=InnoDB,DEFAULT CHARSET=utf8;

INSERT INTO bookinfo VALUES('0001','java',1001);
INSERT INTO bookinfo VALUES('0002','c++',1002);
INSERT INTO bookinfo VALUES('0003','ruby',1003);
INSERT INTO bookinfo VALUES('0004','perl',1004);
INSERT INTO bookinfo VALUES('0005','database',1005);

/*  

アカウントテーブル関連

*/

--アカウントテーブル作成
CREATE TABLE accountinfo ( 
    accountid INTEGER AUTO_INCREMENT PRIMARY KEY,
    loginid VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100),
    phone VARCHAR(100),
    authority INTEGER
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

--アカウントテーブルのデータ登録
-- 顧客データ登録
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(1,'0001','test','youriyoshiike@gmail.com','000-0000-0000',0);

-- 店舗データ登録
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(2,'0002','test','youriyoshiike@gmail.com','000-0000-0000',1);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(3,'0003','test','youriyoshiike@gmail.com','000-0000-0000',2);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(4,'0004','test','youriyoshiike@gmail.com','000-0000-0000',1);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(5,'0005','test','youriyoshiike@gmail.com','000-0000-0000',2);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(6,'0006','test','youriyoshiike@gmail.com','000-0000-0000',1);

/*  

店舗テーブル関連

*/

--店舗テーブル作成
CREATE TABLE storeinfo ( 
    storeid INTEGER AUTO_INCREMENT PRIMARY KEY,
    accountid INTEGER,FOREIGN KEY (accountid) REFERENCES customerinfo (accountid),
    storename VARCHAR(20),
    address VARCHAR(100),
    budget VARCHAR(20),
    comment VARCHAR(100),
    payment VARCHAR(20)
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

--店舗テーブルのデータ登録
INSERT INTO storeinfo VALUES(1,2,'整体A','東京都 世田谷区 桜丘',8000,'','クレジットカード');
INSERT INTO storeinfo VALUES(2,3,'マッサージB','東京都 世田谷区 用賀',8000,'','クレジットカード');
INSERT INTO storeinfo VALUES(3,4,'整体C','東京都 目黒区',8000,'','クレジットカード');
INSERT INTO storeinfo VALUES(4,5,'マッサージD','東京都 目白',8000,'','クレジットカード');

/*  

店舗メニューテーブル関連

*/

--店舗メニューテーブル作成
CREATE TABLE storemenuinfo ( 
    storemenuid INTEGER AUTO_INCREMENT PRIMARY KEY,
    storeid VARCHAR(20),FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
    servicename VARCHAR(20),
    description VARCHAR(100),
    amount INTEGER,
    servicetime INTEGER,
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;


--店舗メニューテーブルのデータ登録
---整体Aのメニュー情報
INSERT INTO storemenuinfo VALUES(1,2,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(2,2,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(3,2,'全体マッサージ','痛みの改善',5000,60);

---マッサージBのメニュー情報
INSERT INTO storemenuinfo VALUES(4,3,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(5,3,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(6,3,'全体マッサージ','痛みの改善',5000,60);

---整体Cのメニュー情報
INSERT INTO storemenuinfo VALUES(7,4,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(8,4,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(9,4,'全体マッサージ','痛みの改善',5000,60);

---マッサージDのメニュー情報
INSERT INTO storemenuinfo VALUES(10,5,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(11,5,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(12,5,'全体マッサージ','痛みの改善',5000,60);

/*  

店舗写真テーブル関連

*/

--店舗写真テーブル作成
CREATE TABLE storephotoinfo ( 
    storephotoid INTEGER AUTO_INCREMENT PRIMARY KEY,
    storeid INTEGER,FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
    photopath VARCHAR(255),
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;


--店舗写真テーブルのデータ登録
---整体Aの写真情報
INSERT INTO storephotoinfo VALUES(1,2,'storage/img/seitaiA_01.jpg');
INSERT INTO storephotoinfo VALUES(2,2,'storage/img/seitaiA_02.jpg');
INSERT INTO storephotoinfo VALUES(3,2,'storage/img/seitaiA_03.jpg');

---マッサージBの写真情報
INSERT INTO storephotoinfo VALUES(4,3,'storage/img/seitaiB_01.jpg');
INSERT INTO storephotoinfo VALUES(5,3,'storage/img/seitaiB_02.jpg');
INSERT INTO storephotoinfo VALUES(6,3,'storage/img/seitaiB_03.jpg');

---整体Cの写真情報
INSERT INTO storephotoinfo VALUES(7,4,'storage/img/seitaiC_01.jpg');
INSERT INTO storephotoinfo VALUES(8,4,'storage/img/seitaiC_02.jpg');
INSERT INTO storephotoinfo VALUES(9,4,'storage/img/seitaiC_03.jpg');

---マッサージDの写真情報
INSERT INTO storephotoinfo VALUES(10,5,'storage/img/seitaiD_01.jpg');
INSERT INTO storephotoinfo VALUES(11,5,'storage/img/seitaiD_02.jpg');
INSERT INTO storephotoinfo VALUES(12,5,'storage/img/seitaiD_03.jpg');

/*  

店舗の最寄り駅テーブル関連

*/

--店舗の最寄り駅テーブル作成
CREATE TABLE stationinfo ( 
    stationid INTEGER AUTO_INCREMENT PRIMARY KEY,
    storeid INTEGER,FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
    stationname VARCHAR(20),
    stationline VARCHAR(20),
    distance VARCHAR(20),
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;


--店舗の最寄り駅テーブルのデータ登録
---整体Aの最寄り駅情報
INSERT INTO stationinfo VALUES(1,2,'千歳船橋駅','小田急線','徒歩10分');
INSERT INTO stationinfo VALUES(2,2,'経堂駅','小田急線','徒歩10分');

---マッサージBの最寄り駅情報
INSERT INTO stationinfo VALUES(3,3,'用賀駅','田園都市線','徒歩10分');
INSERT INTO stationinfo VALUES(4,3,'二子玉川駅','田園都市線','バスで10分');

---整体Cの最寄り駅情報
INSERT INTO stationinfo VALUES(5,4,'中目黒駅','東急東横線','徒歩10分');
INSERT INTO stationinfo VALUES(6,4,'目黒駅','JR山手線','徒歩20分');

---マッサージDの最寄り駅情報
INSERT INTO stationinfo VALUES(7,5,'目白駅','JR山手線','徒歩10分');