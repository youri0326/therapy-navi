
USE therapyNavi-db;

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

CREATE TABLE accountinfo ( 
    accountid INTEGER AUTO_INCREMENT PRIMARY KEY,
    loginid VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100),
    phone VARCHAR(100),
    authority INTEGER
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

INSERT INTO `accountinfo` (`accountid`, `loginid`,`password`, `email`, `phone`, `authority`) VALUES (0,'0001', 'test', ''youriyoshiike@gmail.com', '000-0000-0000', 0);