SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

-- -----------------------------------------------------
-- Table `States`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `States` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(150) NOT NULL ,
  `Status` ENUM('Active','Inactive') NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Country`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `County` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `StateId` INT NOT NULL ,
  `Name` VARCHAR(150) NOT NULL ,
  `Status` ENUM('Active','Inactive') NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_State` (`StateId` ASC) ,
  CONSTRAINT `County_State`
    FOREIGN KEY (`StateId` )
    REFERENCES `States` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Email` VARCHAR(100) NOT NULL ,
  `Username` VARCHAR(100) NOT NULL ,
  `FirstName` VARCHAR(50) NOT NULL ,
  `LastName` VARCHAR(50) NULL ,
  `Password` VARCHAR(150) NOT NULL ,
  `ProfilePic` VARCHAR(50) NULL ,
  `Address1` VARCHAR(150) NULL ,
  `Address2` VARCHAR(150) NULL ,
  `City` VARCHAR(50) NULL ,
  `CountryId` INT NULL ,
  `StateId` INT NULL ,
  `Zip` VARCHAR(10) NULL ,
  `ActivationCode` VARCHAR(50) NOT NULL ,
  `BillingSubscription` ENUM('Yes','No') NULL ,
  `WebsiteSubscriotion` ENUM('Yes','No') NULL ,
  `NetworkProfileSubscription` ENUM('Yes','No') NULL ,
  `DefaultState` INT NULL ,
  `UnderpayAmount` FLOAT NULL DEFAULT 0 ,
  `UserType` ENUM('Admin', 'Staff', 'Customer','User') NULL ,
  `Status` ENUM('Active','Inactive','Deleted') NULL ,
  `LastLoginDateTime` DATETIME NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC) ,
  UNIQUE INDEX `Username_UNIQUE` (`Username` ASC) ,
  INDEX `FK_Country` (`CountryId` ASC) ,
  INDEX `FK_State` (`StateId` ASC) ,
  CONSTRAINT `Users_Country`
    FOREIGN KEY (`CountryId` )
    REFERENCES `Country` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Users_State`
    FOREIGN KEY (`StateId` )
    REFERENCES `States` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Cases`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Cases` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `UserId` INT NOT NULL ,
  `CaseNo` VARCHAR(15) NOT NULL ,
  `FirstTitle` VARCHAR(50) NOT NULL ,
  `LastTitle` VARCHAR(50) NULL ,
  `ThirdParty` INT NOT NULL ,
  `BillDocumentRealName` VARCHAR(150) NOT NULL ,
  `BillDocumentSystemName` VARCHAR(50) NOT NULL ,
  `ActualAmount` FLOAT NOT NULL ,
  `CommisionPercentage` FLOAT NULL ,
  `CommisionActual` FLOAT NULL ,
  `ProcessingFees` FLOAT NULL ,
  `UnderPayAdjustment` FLOAT NULL ,
  `PayableAmount` FLOAT NULL ,
  `ReceivedAmount` FLOAT NULL ,
  `DifferenceAmount` FLOAT NULL ,
  `CustomerPaidDate` DATETIME NULL ,
  `PaymentReceivedDate` DATETIME NULL ,
  `Status` ENUM('Submitted','Accepted','Paid','Close') NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Users` (`UserId` ASC) ,
  CONSTRAINT `Cases_Users`
    FOREIGN KEY (`UserId` )
    REFERENCES `Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PracticeAreas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PracticeAreas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(50) NOT NULL ,
  `ParentId` INT NULL DEFAULT 0 ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Parent` (`ParentId` ASC) ,
  CONSTRAINT `PracticeAreas_Parent`
    FOREIGN KEY (`ParentId` )
    REFERENCES `PracticeAreas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UserPracticeArea`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `UserPracticeArea` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `UserId` INT NOT NULL ,
  `PracticeAreaId` INT NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `UserPracticeAreacol` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_User` (`UserId` ASC) ,
  INDEX `FK_PracticeArea` (`PracticeAreaId` ASC) ,
  CONSTRAINT `UserPracticeArea_User`
    FOREIGN KEY (`UserId` )
    REFERENCES `Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `UserPracticeArea_PracticeArea`
    FOREIGN KEY (`PracticeAreaId` )
    REFERENCES `PracticeAreas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UserProfile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `UserProfile` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `UserId` INT NOT NULL ,
  `Summary` TEXT NULL ,
  `FeesInformation` VARCHAR(50) NULL ,
  `FreeConsultation` ENUM('Yes','No') NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_User` (`UserId` ASC) ,
  CONSTRAINT `UserProfile_User`
    FOREIGN KEY (`UserId` )
    REFERENCES `Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FAQs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `FAQs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Question` TEXT NOT NULL ,
  `Answer` TEXT NOT NULL ,
  `Globle` ENUM('Yes','No') NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UsersWebsite`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `UsersWebsite` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `UserId` INT NOT NULL ,
  `ThemeId` INT NOT NULL ,
  `WebsiteURL` VARCHAR(150) NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `WebsiteURL_UNIQUE` (`WebsiteURL` ASC) ,
  INDEX `FK_User` (`UserId` ASC) ,
  CONSTRAINT `UsersWebsite_User`
    FOREIGN KEY (`UserId` )
    REFERENCES `Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebsiteXFAQs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `WebsiteXFAQs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `FAQId` INT NOT NULL ,
  `WebsiteId` INT NOT NULL ,
  `Order` SMALLINT NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_FAQ` (`FAQId` ASC) ,
  INDEX `FK_Website` (`WebsiteId` ASC) ,
  CONSTRAINT `WebsiteXFAQs_FAQ`
    FOREIGN KEY (`FAQId` )
    REFERENCES `FAQs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `WebsiteXFAQs_Website`
    FOREIGN KEY (`WebsiteId` )
    REFERENCES `UsersWebsite` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CaseActivities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CaseActivities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `CaseId` INT NOT NULL ,
  `ActivityType` ENUM('CustomerBillsSubmitted','3rdPartyBillsSubmitted','CheckSent','PaymentReceived') NULL ,
  `Description` TEXT NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Case` (`CaseId` ASC) ,
  CONSTRAINT `CaseActivities_Case`
    FOREIGN KEY (`CaseId` )
    REFERENCES `Cases` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Permissions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Permissions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `UniqueKey` VARCHAR(50) NOT NULL ,
  `Name` VARCHAR(150) NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Roles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(50) NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `RolesXPermission`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `RolesXPermission` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `RoleId` INT NOT NULL ,
  `PermissionId` INT NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Role` (`RoleId` ASC) ,
  CONSTRAINT `RolesXPermission_Role`
    FOREIGN KEY (`RoleId` )
    REFERENCES `Roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UserRoles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `UserRoles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `UserId` INT NOT NULL ,
  `RoleId` INT NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_User` (`UserId` ASC) ,
  INDEX `FK_Role` (`RoleId` ASC) ,
  CONSTRAINT `UserRoles_User`
    FOREIGN KEY (`UserId` )
    REFERENCES `Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `UserRoles_Role`
    FOREIGN KEY (`RoleId` )
    REFERENCES `Roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ThiredParties`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ThiredParties` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(150) NOT NULL ,
  `Address1` VARCHAR(150) NOT NULL ,
  `Address2` VARCHAR(150) NOT NULL ,
  `City` VARCHAR(150) NOT NULL ,
  `StateId` INT NOT NULL ,
  `CountryId` INT NOT NULL ,
  `Zip` VARCHAR(5) NOT NULL ,
  `Status` ENUM('Active','Inactive') NULL ,
  `UpdateDateTime` DATETIME NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_State` (`StateId` ASC) ,
  INDEX `FK_Country` (`CountryId` ASC) ,
  CONSTRAINT `ThiredParties_State`
    FOREIGN KEY (`StateId` )
    REFERENCES `States` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ThiredParties_Country`
    FOREIGN KEY (`CountryId` )
    REFERENCES `Country` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SiteConfig`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `SiteConfig` (
  `ConfigKey` VARCHAR(45) NULL ,
  `ConfigValue` TEXT NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SiteEmails`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `SiteEmails` (
  `id` VARCHAR(150) NULL ,
  `Subject` VARCHAR(255) NOT NULL ,
  `MessageBody` TEXT NOT NULL ,
  `CreateDateTime` DATETIME NOT NULL ,
  `UpdateDateTime` DATETIME NOT NULL )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
