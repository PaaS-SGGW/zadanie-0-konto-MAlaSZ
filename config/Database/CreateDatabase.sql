CREATE TABLE `Vagabond`.`Users` (
  `id` INT NOT NULL ,
  `FirstName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `LastName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Login` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Password` VARCHAR(4097) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  `Salt` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `Vagabond`.`Posts` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `Title` TINYTEXT NOT NULL ,
  `Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `UserId` INT NOT NULL ,
  `Content` LONGTEXT NOT NULL ,
  `Summary` TEXT NOT NULL ,
  PRIMARY KEY (`Id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

  CREATE TABLE `Vagabond`.`constantposts` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `Language` TINYTEXT NOT NULL ,
  `Type` TINYTEXT NOT NULL,
  `Title` TINYTEXT NOT NULL ,
  `Content` LONGTEXT NOT NULL ,
  `ImageId` INT NOT NULL ,
  PRIMARY KEY (`Id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

    CREATE TABLE `Vagabond`.`images` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `Name` LONGTEXT NOT NULL ,
  `Path` LONGTEXT NOT NULL ,
  PRIMARY KEY (`Id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

  Insert INTO constantposts values(1,'pl-PL','1','Testowy wpis','Treść testowego wpisu','1')
  UPDATE images Set Path='forest.jpg'