
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

CREATE TABLE accountinfo ( 
    accountid VARCHAR(20) PRIMARY KEY,
    password VARCHAR(20),
    email VARCHAR(100),
    phone VARCHAR(100),
    authority INTEGER
)ENGINE = InnoDB,DEFAULT CHARSET=utf8;

INSERT INTO accountinfo (accountid,password,email,phone,authority) VALUES('0001','test','youriyoshiike@gmail.com','000-0000-0000',0);