-- USE therapyNavi-db;

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

-- アカウントテーブル作成
CREATE TABLE accountinfo ( 
    accountid INTEGER AUTO_INCREMENT PRIMARY KEY,
    loginid VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100),
    phone VARCHAR(100),
    authority INTEGER
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

-- アカウントテーブルのデータ登録
--  顧客データ登録
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(1,'0001','test','youriyoshiike@gmail.com','000-0000-0000',0);

--  店舗データ登録
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(2,'0002','test2','youriyoshiike@gmail.com','000-0000-0000',1);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(3,'0003','test3','youriyoshiike@gmail.com','000-0000-0000',1);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(4,'0004','test4','youriyoshiike@gmail.com','000-0000-0000',1);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(5,'0005','test5','youriyoshiike@gmail.com','000-0000-0000',1);
INSERT INTO accountinfo (accountid,loginid,password,email,phone,authority) VALUES(6,'0006','test6','youriyoshiike@gmail.com','000-0000-0000',1);

/*  

店舗テーブル関連

*/

CREATE TABLE storeinfo ( 
    storeid INTEGER AUTO_INCREMENT PRIMARY KEY,
    accountid INTEGER,FOREIGN KEY (accountid) REFERENCES accountinfo (accountid),
    storename VARCHAR(20),
    address VARCHAR(100),
    budget VARCHAR(20),
    comment VARCHAR(100),
    payment VARCHAR(20)
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

-- 店舗テーブルのデータ登録
INSERT INTO storeinfo VALUES(1,2,'整体A','東京都 世田谷区 桜丘',8000,'','クレジットカード');
INSERT INTO storeinfo VALUES(2,3,'マッサージB','東京都 世田谷区 用賀',8000,'','クレジットカード');
INSERT INTO storeinfo VALUES(3,4,'整体C','東京都 目黒区',8000,'','クレジットカード');
INSERT INTO storeinfo VALUES(4,5,'マッサージD','東京都 目白',8000,'','クレジットカード');

/*  

店舗メニューテーブル関連

*/

-- 店舗メニューテーブル作成
CREATE TABLE storemenuinfo ( 
    storemenuid INTEGER AUTO_INCREMENT PRIMARY KEY,
    storeid INTEGER,FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
    servicename VARCHAR(20),
    description VARCHAR(100),
    amount INTEGER,
    servicetime INTEGER
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;


-- 店舗メニューテーブルのデータ登録
--   整体Aのメニュー情報
INSERT INTO storemenuinfo VALUES(1,1,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(2,1,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(3,1,'全体マッサージ','痛みの改善',5000,60);

--   マッサージBのメニュー情報
INSERT INTO storemenuinfo VALUES(4,2,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(5,2,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(6,2,'全体マッサージ','痛みの改善',5000,60);

--   整体Cのメニュー情報
INSERT INTO storemenuinfo VALUES(7,3,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(8,3,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(9,3,'全体マッサージ','痛みの改善',5000,60);

--   マッサージDのメニュー情報
INSERT INTO storemenuinfo VALUES(10,4,'骨盤矯正30分','痛みの改善',5000,30);
INSERT INTO storemenuinfo VALUES(11,4,'骨盤矯正60分','痛みの改善',5000,60);
INSERT INTO storemenuinfo VALUES(12,4,'全体マッサージ','痛みの改善',5000,60);

/*  

店舗写真テーブル関連

*/

-- 店舗写真テーブル作成
CREATE TABLE storephotoinfo ( 
    storephotoid INTEGER AUTO_INCREMENT PRIMARY KEY,
    storeid INTEGER,FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
    photopath VARCHAR(255)
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;


-- 店舗写真テーブルのデータ登録
--   整体Aの写真情報
INSERT INTO storephotoinfo VALUES(1,1,'storage/img/seitaiA_01.jpg');
INSERT INTO storephotoinfo VALUES(2,1,'storage/img/seitaiA_02.jpg');
INSERT INTO storephotoinfo VALUES(3,1,'storage/img/seitaiA_03.jpg');

--   マッサージBの写真情報
INSERT INTO storephotoinfo VALUES(4,2,'storage/img/seitaiB_01.jpg');
INSERT INTO storephotoinfo VALUES(5,2,'storage/img/seitaiB_02.jpg');
INSERT INTO storephotoinfo VALUES(6,2,'storage/img/seitaiB_03.jpg');

--   整体Cの写真情報
INSERT INTO storephotoinfo VALUES(7,3,'storage/img/seitaiC_01.jpg');
INSERT INTO storephotoinfo VALUES(8,3,'storage/img/seitaiC_02.jpg');
INSERT INTO storephotoinfo VALUES(9,3,'storage/img/seitaiC_03.jpg');

--   マッサージDの写真情報
INSERT INTO storephotoinfo VALUES(10,4,'storage/img/seitaiD_01.jpg');
INSERT INTO storephotoinfo VALUES(11,4,'storage/img/seitaiD_02.jpg');
INSERT INTO storephotoinfo VALUES(12,4,'storage/img/seitaiD_03.jpg');

/*  

店舗の最寄り駅テーブル関連

*/

-- 店舗の最寄り駅テーブル作成
CREATE TABLE stationinfo ( 
    stationid INTEGER AUTO_INCREMENT PRIMARY KEY,
    storeid INTEGER,FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
    stationname VARCHAR(20),
    stationline VARCHAR(20),
    distance VARCHAR(20)
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;


-- 店舗の最寄り駅テーブルのデータ登録
--   整体Aの最寄り駅情報
INSERT INTO stationinfo VALUES(1,1,'千歳船橋駅','小田急線','徒歩10分');
INSERT INTO stationinfo VALUES(2,1,'経堂駅','小田急線','徒歩10分');

--   マッサージBの最寄り駅情報
INSERT INTO stationinfo VALUES(3,2,'用賀駅','田園都市線','徒歩10分');
INSERT INTO stationinfo VALUES(4,2,'二子玉川駅','田園都市線','バスで10分');
--   整体Cの最寄り駅情報
INSERT INTO stationinfo VALUES(5,3,'中目黒駅','東急東横線','徒歩10分');
INSERT INTO stationinfo VALUES(6,3,'目黒駅','JR山手線','徒歩20分');

--   マッサージDの最寄り駅情報
INSERT INTO stationinfo VALUES(7,4,'目白駅','JR山手線','徒歩10分');

/*  

従業員情報 テーブル関連

*/

-- 従業員情報テーブル作成
CREATE TABLE staffinfo (
staffid INTEGER AUTO_INCREMENT PRIMARY KEY,
storeid INTEGER,FOREIGN KEY (storeid) REFERENCES storeinfo (storeid),
staffname VARCHAR(20),
stafffurigana VARCHAR(20),
gender INTEGER,
treathistory VARCHAR(20),
staffbirthday date,
photo VARCHAR(100)
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

-- 従業員情報テーブルのデータ登録
--  店舗Aのスタッフ情報
INSERT INTO staffinfo VALUES(1,1,'中村征宏','なかむらまさひろ',1,20090701,19870606,'storage/img/A_YuiichiNakamura_01.jpg');
INSERT INTO staffinfo VALUES(2,1,'吉田俊明','よしだとしあき',1,20150808,19811009,'storage/img/B_YoshidaToshiaki_01.jpg');

--  店舗Bのスタッフ情報
INSERT INTO staffinfo VALUES(3,2,'小山鋼太郎','こやまこうたろう',1,20130801,19880810, 'storage/img/B_KKoyama_01.jpg');
INSERT INTO staffinfo VALUES(4,2,'金長','かねなが',1,20100701,19740825, 'storage/img/B_Kanenaga_01.jpg');

--  店舗Cのスタッフ情報
INSERT INTO staffinfo VALUES(5,3,'諏訪響','すわひびき',1,20190401,19940430, 'storage/img/C_HSuwa_01.jpg');
INSERT INTO staffinfo VALUES(6,3,'水戸駿介','みとしゅんすけ',1,20160301,19950505, 'storage/img/C_ShunsukeMito_01.jpg');


/* 

勤怠情報 テーブル関連

*/

-- 勤怠情報 テーブル作成

CREATE TABLE attendinfo ( 
    attendid INTEGER AUTO_INCREMENT PRIMARY KEY,
    staffid INTEGER,FOREIGN KEY (staffid) REFERENCES staffinfo (staffid),
    attendance_status VARCHAR(20),
    workingdate DATE,
    starttime TIME,
    endtime TIME,
    breakstart TIME,
    breakend TIME
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

-- 勤怠情報情報テーブルのデータ登録
--  店舗Aの勤怠情報
--   中村征宏
INSERT INTO attendinfo VALUES(1,1,'〇','2023-12-15','10:00','19:00','12:00','13:00');
INSERT INTO attendinfo VALUES(2,1,'〇','2023-12-16','11:00','20:00','12:00','13:00');

--   吉田俊明
INSERT INTO attendinfo VALUES(3,2,'〇','2023-12-15','10:00','19:00','12:00','13:00');
INSERT INTO attendinfo VALUES(4,2,'〇','2023-12-16','11:00','20:00','12:00','13:00');

--  店舗Bの勤怠情報
--   小山鋼太郎
INSERT INTO attendinfo VALUES(5,3,'〇','2023-12-15','14:00','22:00','12:00','13:00');
INSERT INTO attendinfo VALUES(6,3,'〇','2023-12-16','8:00','22:00','12:00','13:00');

--   金長
INSERT INTO attendinfo VALUES(7,4,'〇','2023-12-15','10:00','19:00','13:00','14:00');
INSERT INTO attendinfo VALUES(8,4,'〇','2023-12-16','11:00','20:00','13:00','14:00');

--  店舗Cの勤怠情報
--   諏訪響
INSERT INTO attendinfo VALUES(9,5,'〇','2023-12-15','10:00','19:00','13:00','14:00');
INSERT INTO attendinfo VALUES(10,5,'〇','2023-12-16','11:00','20:00','13:00','14:00');

--   水戸駿介
INSERT INTO attendinfo VALUES(11,6,'〇','2023-12-15','10:00','19:00','12:00','13:00');
INSERT INTO attendinfo VALUES(12,6,'〇','2023-12-16','11:00','20:00','12:00','13:00');

/*

顧客情報テーブル

*/

CREATE TABLE customerinfo ( 
customerid INTEGER AUTO_INCREMENT PRIMARY KEY,
accountid INTEGER,FOREIGN KEY (accountid) REFERENCES accountinfo (accountid),
name VARCHAR(20),
furigana VARCHAR(20),
birthday date,
address VARCHAR(20),
point INTEGER
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

INSERT INTO customerinfo VALUES(1,1, '田中太郎', 'たなかたろう', '1990-05-20', '東京都', 100);
INSERT INTO customerinfo VALUES(2,2, '山田花子', 'やまだはなこ', '1985-12-10', '大阪府', 75);
INSERT INTO customerinfo VALUES(3,3, '佐藤次郎', 'さとうじろう', '1995-08-15', '京都府', 120);
INSERT INTO customerinfo VALUES(4,4, '伊藤美咲', 'いとうみさき', '1993-04-25', '神奈川県', 90);
INSERT INTO customerinfo VALUES(5,5, '鈴木健太', 'すずきけんた', '1988-10-18', '愛知県', 110);

/*

予約情報テーブル

*/

CREATE TABLE reserveinfo ( 
reserveid INTEGER AUTO_INCREMENT PRIMARY KEY,
customerid INTEGER,FOREIGN KEY (customerid) REFERENCES customerinfo (customerid),
storemenuid INTEGER,FOREIGN KEY (storemenuid) REFERENCES storemenuinfo (storemenuid),
reservedate VARCHAR(10),
reservetime VARCHAR(10),
payment VARCHAR(20),
status VARCHAR(20),
addcomment VARCHAR(20)
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

-- 予約情報テーブルのデータ登録
-- 顧客1の勤怠情報
INSERT INTO reserveinfo VALUES(1,1,1,'2023-12-23','10:00','クレジットカード','支払済み','');
INSERT INTO reserveinfo VALUES(2,1,2,'2023-12-23','11:00','クレジットカード','支払済み','');
INSERT INTO reserveinfo VALUES(3,1,3,'2023-12-23','12:00','クレジットカード','未納','');

-- 顧客2の勤怠情報
INSERT INTO reserveinfo VALUES(4,2,2,'2023-12-23','09:00','クレジットカード','支払済み','');
INSERT INTO reserveinfo VALUES(5,2,4,'2023-12-23','11:00','クレジットカード','支払済み','');

-- 顧客3の勤怠情報
INSERT INTO reserveinfo VALUES(6,3,1,'2023-12-23','15:00','クレジットカード','未納','');

-- 顧客4の勤怠情報
INSERT INTO reserveinfo VALUES(7,4,1,'2023-12-23','14:00','クレジットカード','支払済み','');
INSERT INTO reserveinfo VALUES(8,4,3,'2023-12-23','15:00','クレジットカード','支払済み','');

-- 顧客5の勤怠情報
INSERT INTO reserveinfo VALUES(9,5,1,'2023-12-23','16:00','クレジットカード','未納','');
INSERT INTO reserveinfo VALUES(10,5,2,'2023-12-23','17:00','クレジットカード','支払済み','');
INSERT INTO reserveinfo VALUES(11,5,4,'2023-12-23','18:00','クレジットカード','支払済み','');

