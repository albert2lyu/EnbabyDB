DROP TABLE IF EXISTS `Books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Books` (
  `ISBN`        char(13) COLLATE utf8_unicode_ci NOT NULL,
  `DisplayName` text COLLATE utf8_unicode_ci,
  `Description` text COLLATE utf8_unicode_ci,
  `LinkToBuy`   text COLLATE utf8_unicode_ci,
  `Snapshot`    text COLLATE utf8_unicode_ci,
  `Author`      varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AudioFiles`       text COLLATE utf8_unicode_ci,
  `AudioFiles_cn`    text COLLATE utf8_unicode_ci,
  `Rank`        INT DEFAULT 100,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



DROP TABLE IF EXISTS `Links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Links` (
  `ISBN` char(13) COLLATE utf8_unicode_ci NOT NULL,
  `Series` char(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Series` (
  `Id` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `DisplayName` text COLLATE utf8_unicode_ci,
  `Description` text COLLATE utf8_unicode_ci,
  `LinkToBuy`   text COLLATE utf8_unicode_ci,
  `Snapshot`    text COLLATE utf8_unicode_ci,
  `Rank`        INT DEFAULT 100,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


