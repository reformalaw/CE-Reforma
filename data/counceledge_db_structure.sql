-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2013 at 05:34 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `counceledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `AttorneyContact`
--

DROP TABLE IF EXISTS `AttorneyContact`;
CREATE TABLE IF NOT EXISTS `AttorneyContact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Label` varchar(50) NOT NULL,
  `FieldType` varchar(50) NOT NULL,
  `Options` text NOT NULL,
  `Required` enum('Yes','No') NOT NULL DEFAULT 'No',
  `Ordering` int(11) NOT NULL,
  `OptionsSlug` varchar(150) DEFAULT NULL,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Table structure for table `AttorneyStatistics`
--

DROP TABLE IF EXISTS `AttorneyStatistics`;
CREATE TABLE IF NOT EXISTS `AttorneyStatistics` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `IpAddress` varchar(150) NOT NULL,
  `VisitDate` date NOT NULL,
  `Type` enum('Profile','Contact') NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

-- --------------------------------------------------------

--
-- Table structure for table `CaseActivities`
--

DROP TABLE IF EXISTS `CaseActivities`;
CREATE TABLE IF NOT EXISTS `CaseActivities` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CaseId` int(11) NOT NULL,
  `ActivityType` enum('CustomerBillsSubmitted','CaseAccepted','3rdPartyBillsSubmitted','3rdPartyBillsRejected','CheckSent','PaymentReceived') DEFAULT NULL,
  `Description` text NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=527 ;

-- --------------------------------------------------------

--
-- Table structure for table `CaseDocuments`
--

DROP TABLE IF EXISTS `CaseDocuments`;
CREATE TABLE IF NOT EXISTS `CaseDocuments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CaseId` int(11) NOT NULL,
  `BillDocumentRealName` varchar(150) NOT NULL,
  `BillDocumentSystemName` varchar(50) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

-- --------------------------------------------------------

--
-- Table structure for table `Cases`
--

DROP TABLE IF EXISTS `Cases`;
CREATE TABLE IF NOT EXISTS `Cases` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `CaseNo` varchar(15) NOT NULL,
  `Description` text NOT NULL,
  `FirstTitle` varchar(50) NOT NULL,
  `LastTitle` varchar(50) DEFAULT NULL,
  `ThirdParty` int(11) NOT NULL,
  `BillDocumentRealName` varchar(150) NOT NULL,
  `BillDocumentSystemName` varchar(50) NOT NULL,
  `ActualAmount` double NOT NULL,
  `CommisionPercentage` float DEFAULT NULL,
  `CommisionActual` double DEFAULT NULL,
  `ProcessingFees` float DEFAULT NULL,
  `UnderpayAdjustment` double DEFAULT NULL,
  `PayableAmount` double DEFAULT NULL,
  `PaidAmount` double DEFAULT NULL,
  `RemainToPay` double DEFAULT NULL,
  `ReceivedAmount` double DEFAULT NULL,
  `RemainToReceive` double DEFAULT NULL,
  `DifferenceAmount` double DEFAULT NULL,
  `CustomerPaidDate` datetime DEFAULT NULL,
  `PaymentReceivedDate` datetime DEFAULT NULL,
  `AgreementDate` datetime NOT NULL,
  `Stage` enum('Submitted','Accepted','Paid','Close') DEFAULT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `CreatedBy` int(11) NOT NULL,
  `ThirdPartyBillsSubmitted` enum('Yes','No') NOT NULL DEFAULT 'No',
  `CheckNo` varchar(50) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Table structure for table `CMSPages`
--

DROP TABLE IF EXISTS `CMSPages`;
CREATE TABLE IF NOT EXISTS `CMSPages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `WebsiteId` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `SubTitle` varchar(150) NOT NULL,
  `MetaTitle` varchar(150) NOT NULL,
  `MetaKeywords` varchar(250) NOT NULL,
  `MetaDescription` text NOT NULL,
  `Content` text NOT NULL,
  `Template` enum('column1','column2L','column2R','home','default') NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL,
  `Type` enum('Static','Dynamic') NOT NULL DEFAULT 'Dynamic',
  `UniqueKey` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=778 ;

-- --------------------------------------------------------

--
-- Table structure for table `Counties`
--

DROP TABLE IF EXISTS `Counties`;
CREATE TABLE IF NOT EXISTS `Counties` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `StateId` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Counties_stateid_States_id` (`StateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `CustomerContact`
--

DROP TABLE IF EXISTS `CustomerContact`;
CREATE TABLE IF NOT EXISTS `CustomerContact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Label` varchar(50) NOT NULL,
  `FieldType` varchar(50) NOT NULL,
  `Options` text NOT NULL,
  `Required` enum('Yes','No') NOT NULL DEFAULT 'No',
  `Ordering` int(11) NOT NULL,
  `OptionsSlug` varchar(150) DEFAULT NULL,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=739 ;

-- --------------------------------------------------------

--
-- Table structure for table `CustomerPaymentSent`
--

DROP TABLE IF EXISTS `CustomerPaymentSent`;
CREATE TABLE IF NOT EXISTS `CustomerPaymentSent` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `CaseNo` varchar(15) NOT NULL,
  `CaseId` int(11) NOT NULL,
  `ActualAmount` double NOT NULL,
  `CommisionPercentage` float NOT NULL,
  `CommisionActual` double NOT NULL,
  `ProcessingFees` float NOT NULL,
  `UnderpayAdjustment` double NOT NULL,
  `PayableAmount` double NOT NULL,
  `CustomerPaidDate` datetime NOT NULL,
  `CheckNo` varchar(50) NOT NULL,
  `Description` text,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `caseid_idx` (`CaseId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=248 ;

-- --------------------------------------------------------

--
-- Table structure for table `FAQs`
--

DROP TABLE IF EXISTS `FAQs`;
CREATE TABLE IF NOT EXISTS `FAQs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  `Answer` text NOT NULL,
  `Globle` enum('Yes','No') DEFAULT NULL,
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=606 ;

-- --------------------------------------------------------

--
-- Table structure for table `ForumCategories`
--

DROP TABLE IF EXISTS `ForumCategories`;
CREATE TABLE IF NOT EXISTS `ForumCategories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(150) NOT NULL,
  `Description` text NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Title` (`Title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `ForumReply`
--

DROP TABLE IF EXISTS `ForumReply`;
CREATE TABLE IF NOT EXISTS `ForumReply` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ForumId` int(11) NOT NULL,
  `TopicId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Reply` text NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `TopicId_idx` (`TopicId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Table structure for table `Forums`
--

DROP TABLE IF EXISTS `Forums`;
CREATE TABLE IF NOT EXISTS `Forums` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ForumCategoriesId` int(11) NOT NULL,
  `LastTopicId` int(11) NOT NULL,
  `LastTopicBy` int(11) NOT NULL,
  `LastRepliedId` int(11) NOT NULL,
  `LastRepliedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `TotalTopic` int(11) NOT NULL,
  `TotalReplies` int(11) NOT NULL,
  `Ordering` smallint(6) NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `LastTopicBy_idx` (`LastTopicBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `ForumTopics`
--

DROP TABLE IF EXISTS `ForumTopics`;
CREATE TABLE IF NOT EXISTS `ForumTopics` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `ForumId` int(11) NOT NULL,
  `LastRepliedId` int(11) NOT NULL,
  `LastRepliedBy` int(11) NOT NULL,
  `TotalViews` int(11) NOT NULL,
  `Topic` text NOT NULL,
  `Description` text NOT NULL,
  `TotalReplies` int(11) NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `LastRepliedDateTime` datetime DEFAULT NULL,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Table structure for table `Media`
--

DROP TABLE IF EXISTS `Media`;
CREATE TABLE IF NOT EXISTS `Media` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(150) NOT NULL,
  `ImageName` varchar(150) NOT NULL,
  `OrgName` varchar(150) NOT NULL,
  `Type` enum('BannerBackground','BannerForeground','Unsorted','Logo') NOT NULL DEFAULT 'BannerBackground',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

-- --------------------------------------------------------

--
-- Table structure for table `PermissionCategory`
--

DROP TABLE IF EXISTS `PermissionCategory`;
CREATE TABLE IF NOT EXISTS `PermissionCategory` (
  `Id` int(4) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `Permissions`
--

DROP TABLE IF EXISTS `Permissions`;
CREATE TABLE IF NOT EXISTS `Permissions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PermissionCategoryId` int(4) NOT NULL,
  `UniqueKey` varchar(50) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

-- --------------------------------------------------------

--
-- Table structure for table `PracticeAreas`
--

DROP TABLE IF EXISTS `PracticeAreas`;
CREATE TABLE IF NOT EXISTS `PracticeAreas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `ParentId` int(11) DEFAULT '0',
  `Description` text,
  `slug` varchar(200) NOT NULL,
  `Status` enum('Active','Inactive','Deleted') DEFAULT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `ReviewRating`
--

DROP TABLE IF EXISTS `ReviewRating`;
CREATE TABLE IF NOT EXISTS `ReviewRating` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `Rate` int(11) NOT NULL,
  `Review` text NOT NULL,
  `Spam` enum('0','1') NOT NULL DEFAULT '0',
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
CREATE TABLE IF NOT EXISTS `Roles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Status` enum('Active','Inactive','Deleted') DEFAULT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `RolesXPermission`
--

DROP TABLE IF EXISTS `RolesXPermission`;
CREATE TABLE IF NOT EXISTS `RolesXPermission` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `RoleId` int(11) NOT NULL,
  `PermissionId` int(11) NOT NULL,
  `PermissionCategoryId` int(4) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=274 ;

-- --------------------------------------------------------

--
-- Table structure for table `SiteConfig`
--

DROP TABLE IF EXISTS `SiteConfig`;
CREATE TABLE IF NOT EXISTS `SiteConfig` (
  `ConfigKey` varchar(45) DEFAULT NULL,
  `ConfigValue` text NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SiteEmails`
--

DROP TABLE IF EXISTS `SiteEmails`;
CREATE TABLE IF NOT EXISTS `SiteEmails` (
  `Id` varchar(150) DEFAULT NULL,
  `Subject` varchar(255) NOT NULL,
  `MessageBody` text NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `States`
--

DROP TABLE IF EXISTS `States`;
CREATE TABLE IF NOT EXISTS `States` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CountryId` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Status` enum('Active','Inactive') DEFAULT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=721 ;

-- --------------------------------------------------------

--
-- Table structure for table `Statistics`
--

DROP TABLE IF EXISTS `Statistics`;
CREATE TABLE IF NOT EXISTS `Statistics` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `WebsiteId` int(11) NOT NULL,
  `IpAddress` varchar(150) NOT NULL,
  `VisitDate` date NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=389 ;

-- --------------------------------------------------------

--
-- Table structure for table `Testimonial`
--

DROP TABLE IF EXISTS `Testimonial`;
CREATE TABLE IF NOT EXISTS `Testimonial` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(150) NOT NULL,
  `CompanyName` varchar(150) NOT NULL,
  `Description` text NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `Theme`
--

DROP TABLE IF EXISTS `Theme`;
CREATE TABLE IF NOT EXISTS `Theme` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) NOT NULL,
  `UniqueName` varchar(150) NOT NULL,
  `Screenshot` varchar(150) NOT NULL,
  `Features` text NOT NULL,
  `Options` text NOT NULL,
  `ManageTopMenu` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ManageFooterMenu` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ManageBanner` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ManageColorAndBackground` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ManageSocialMedia` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ChangeLogo` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ManageFAQs` enum('Yes','No') NOT NULL DEFAULT 'No',
  `TextWidgets` enum('Yes','No') NOT NULL DEFAULT 'No',
  `BodyBackground` enum('Yes','No') NOT NULL DEFAULT 'No',
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `IsDefault` enum('Yes','No') NOT NULL DEFAULT 'No',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `ThemeBanner`
--

DROP TABLE IF EXISTS `ThemeBanner`;
CREATE TABLE IF NOT EXISTS `ThemeBanner` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ThemeId` int(11) NOT NULL,
  `WebsiteId` int(11) NOT NULL,
  `Image` varchar(150) NOT NULL,
  `BannerName` varchar(150) NOT NULL,
  `Title1` varchar(150) NOT NULL,
  `Title2` varchar(150) NOT NULL,
  `Title3` varchar(150) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=365 ;

-- --------------------------------------------------------

--
-- Table structure for table `ThemeOptions`
--

DROP TABLE IF EXISTS `ThemeOptions`;
CREATE TABLE IF NOT EXISTS `ThemeOptions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ThemeId` int(11) NOT NULL,
  `WebsiteId` int(11) NOT NULL,
  `OptionKey` varchar(150) NOT NULL,
  `OptionValue` text NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2157 ;

-- --------------------------------------------------------

--
-- Table structure for table `ThirdParties`
--

DROP TABLE IF EXISTS `ThirdParties`;
CREATE TABLE IF NOT EXISTS `ThirdParties` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) NOT NULL,
  `Address1` varchar(150) NOT NULL,
  `Address2` varchar(150) NOT NULL,
  `City` varchar(150) NOT NULL,
  `CountyId` int(11) NOT NULL,
  `StateId` int(11) NOT NULL,
  `CountryId` int(11) NOT NULL DEFAULT '1',
  `Zip` varchar(5) NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ThirdParties_stateid_States_id` (`StateId`),
  KEY `ThirdParties_countyid_Counties_id` (`CountyId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `ThirdPartyPaymentReceived`
--

DROP TABLE IF EXISTS `ThirdPartyPaymentReceived`;
CREATE TABLE IF NOT EXISTS `ThirdPartyPaymentReceived` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ThirdParty` int(11) NOT NULL,
  `CaseId` int(11) NOT NULL,
  `CaseNo` varchar(15) NOT NULL,
  `ReceivedAmount` double NOT NULL,
  `PaymentReceivedDate` datetime NOT NULL,
  `DifferenceAmount` double NOT NULL,
  `Description` text,
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `caseid_idx` (`CaseId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserPracticeArea`
--

DROP TABLE IF EXISTS `UserPracticeArea`;
CREATE TABLE IF NOT EXISTS `UserPracticeArea` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `PracticeAreaId` int(11) NOT NULL,
  `CatId` int(11) DEFAULT NULL,
  `SubCatId` int(11) DEFAULT NULL,
  `ChildId` int(11) NOT NULL,
  `Level` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `UserPracticeArea_practiceareaid_PracticeAreas_id` (`PracticeAreaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4802 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserPracticeAreaLocation`
--

DROP TABLE IF EXISTS `UserPracticeAreaLocation`;
CREATE TABLE IF NOT EXISTS `UserPracticeAreaLocation` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `StateId` int(11) NOT NULL,
  `CountyId` int(11) DEFAULT '0',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=477 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserProfile`
--

DROP TABLE IF EXISTS `UserProfile`;
CREATE TABLE IF NOT EXISTS `UserProfile` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `FirmName` varchar(100) NOT NULL,
  `Address1` varchar(150) NOT NULL,
  `Address2` varchar(150) NOT NULL,
  `City` varchar(50) DEFAULT NULL,
  `StateId` int(11) DEFAULT NULL,
  `Zip` varchar(10) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Summary` text,
  `FeesInformation` text,
  `FreeConsultation` enum('Yes','No') NOT NULL DEFAULT 'No',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserRoles`
--

DROP TABLE IF EXISTS `UserRoles`;
CREATE TABLE IF NOT EXISTS `UserRoles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Password` varchar(150) NOT NULL,
  `ProfilePic` varchar(50) DEFAULT NULL,
  `Address1` varchar(150) DEFAULT NULL,
  `Address2` varchar(150) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `CountyId` int(11) DEFAULT NULL,
  `StateId` int(11) DEFAULT NULL,
  `Zip` varchar(10) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `ActivationCode` varchar(50) NOT NULL,
  `BillingSubscription` enum('Yes','No') DEFAULT NULL,
  `WebsiteSubscriotion` enum('Yes','No') DEFAULT NULL,
  `NetworkProfileSubscription` enum('Yes','No') DEFAULT NULL,
  `DefaultState` int(11) DEFAULT NULL,
  `UnderpayAmount` float DEFAULT '0',
  `UserType` enum('Admin','Staff','Customer','User') DEFAULT NULL,
  `Status` enum('Active','Inactive','Pending','Deleted') DEFAULT NULL,
  `IsFeatured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `NoOfRating` int(11) NOT NULL DEFAULT '0',
  `AvgRating` float NOT NULL DEFAULT '0',
  `PriorityListing` enum('Yes','No') NOT NULL DEFAULT 'No',
  `LastLoginDateTime` datetime DEFAULT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=281 ;

-- --------------------------------------------------------

--
-- Table structure for table `UsersWebsite`
--

DROP TABLE IF EXISTS `UsersWebsite`;
CREATE TABLE IF NOT EXISTS `UsersWebsite` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `ThemeId` int(11) NOT NULL,
  `WebsiteURL` varchar(150) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `WebsiteURL_UNIQUE` (`WebsiteURL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=175 ;

-- --------------------------------------------------------

--
-- Table structure for table `WebsiteMenu`
--

DROP TABLE IF EXISTS `WebsiteMenu`;
CREATE TABLE IF NOT EXISTS `WebsiteMenu` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `WebsiteId` int(11) NOT NULL,
  `CmsPageId` int(11) NOT NULL,
  `WebsitePracticeAreaId` int(11) NOT NULL,
  `ParentId` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Type` enum('1','2','3') NOT NULL DEFAULT '1',
  `MenuType` enum('Header','Footer') NOT NULL DEFAULT 'Header',
  `Ordering` int(6) NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1155 ;

-- --------------------------------------------------------

--
-- Table structure for table `WebsitePracticeArea`
--

DROP TABLE IF EXISTS `WebsitePracticeArea`;
CREATE TABLE IF NOT EXISTS `WebsitePracticeArea` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `WebsiteId` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `SubTitle` varchar(150) NOT NULL,
  `MetaTitle` varchar(150) NOT NULL,
  `MetaKeywords` varchar(250) NOT NULL,
  `MetaDescription` text NOT NULL,
  `Content` text NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Template` enum('column1','column2L','column2R') NOT NULL,
  `Status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `CreateDateTime` datetime NOT NULL,
  `UpdateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=383 ;

-- --------------------------------------------------------

--
-- Table structure for table `WebsiteXFAQs`
--

DROP TABLE IF EXISTS `WebsiteXFAQs`;
CREATE TABLE IF NOT EXISTS `WebsiteXFAQs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FAQId` int(11) NOT NULL,
  `WebsiteId` int(11) NOT NULL,
  `Ordering` int(6) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `UpdateDateTime` datetime NOT NULL,
  `CreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `WebsiteXFAQs_faqid_FAQs_id` (`FAQId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=834 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Counties`
--
ALTER TABLE `Counties`
  ADD CONSTRAINT `Counties_stateid_States_id` FOREIGN KEY (`StateId`) REFERENCES `States` (`Id`);

--
-- Constraints for table `CustomerPaymentSent`
--
ALTER TABLE `CustomerPaymentSent`
  ADD CONSTRAINT `CustomerPaymentSent_caseid_Cases_id` FOREIGN KEY (`caseid`) REFERENCES `Cases` (`Id`);

--
-- Constraints for table `ForumReply`
--
ALTER TABLE `ForumReply`
  ADD CONSTRAINT `ForumReply_TopicId_ForumTopics_id` FOREIGN KEY (`TopicId`) REFERENCES `ForumTopics` (`Id`);

--
-- Constraints for table `Forums`
--
ALTER TABLE `Forums`
  ADD CONSTRAINT `Forums_LastTopicBy_Users_id` FOREIGN KEY (`LastTopicBy`) REFERENCES `Users` (`Id`);

--
-- Constraints for table `ThirdParties`
--
ALTER TABLE `ThirdParties`
  ADD CONSTRAINT `ThirdParties_countyid_Counties_id` FOREIGN KEY (`CountyId`) REFERENCES `Counties` (`Id`),
  ADD CONSTRAINT `ThirdParties_stateid_States_id` FOREIGN KEY (`StateId`) REFERENCES `States` (`Id`);

--
-- Constraints for table `ThirdPartyPaymentReceived`
--
ALTER TABLE `ThirdPartyPaymentReceived`
  ADD CONSTRAINT `ThirdPartyPaymentReceived_caseid_Cases_id` FOREIGN KEY (`caseid`) REFERENCES `Cases` (`Id`);

--
-- Constraints for table `UserPracticeArea`
--
ALTER TABLE `UserPracticeArea`
  ADD CONSTRAINT `UserPracticeArea_practiceareaid_PracticeAreas_id` FOREIGN KEY (`PracticeAreaId`) REFERENCES `PracticeAreas` (`Id`);

--
-- Constraints for table `WebsiteXFAQs`
--
ALTER TABLE `WebsiteXFAQs`
  ADD CONSTRAINT `WebsiteXFAQs_faqid_FAQs_id` FOREIGN KEY (`FAQId`) REFERENCES `FAQs` (`Id`);
