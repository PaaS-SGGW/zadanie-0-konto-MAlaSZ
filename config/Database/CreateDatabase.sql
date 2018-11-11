CREATE TABLE `Users` (
  `id` INT NOT NULL ,
  `Name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Login` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Password` VARCHAR(4097) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Salt` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Language` CHAR(5) NOT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `Posts` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `Title` TINYTEXT NOT NULL ,
  `Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `UserId` INT NOT NULL ,
  `Content` LONGTEXT NOT NULL ,
  `Summary` TEXT NOT NULL ,
  `Language` CHAR(5) NOT NULL,
  `ImageId` INT NOT NULL ,
  PRIMARY KEY (`Id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `constantposts` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `Language` TINYTEXT NOT NULL ,
  `Type` TINYTEXT NOT NULL,
  `Title` TINYTEXT NOT NULL ,
  `Content` LONGTEXT NOT NULL ,
  `ImageId` INT NOT NULL ,
  PRIMARY KEY (`Id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `images` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `Name` LONGTEXT NOT NULL ,
  `Path` LONGTEXT NOT NULL ,
  PRIMARY KEY (`Id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

INSERT INTO constantposts values(1,'pl-PL','1','Testowy wpis','Treść testowego wpisu','1');
INSERT INTO images VALUES(1,'forest','forest.jpg');
INSERT INTO Users VALUES(1,'Administrator','admin','740df87d92ef250275508e72b335a2760bf42704d33933bba08183622522a09c14558ea17e2cc9a7874a9524a20f0b5ad878feb37debfb8f616013d31b7c95f8','ujfR1mTsFpSyULnCL8CXIh2TdQe0451O','pl-PL');  