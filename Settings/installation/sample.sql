-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: sample
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acl_app`
--

DROP TABLE IF EXISTS `acl_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_app` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcAlias` varchar(64) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_app`
--

LOCK TABLES `acl_app` WRITE;
/*!40000 ALTER TABLE `acl_app` DISABLE KEYS */;
INSERT INTO `acl_app` VALUES (1,'acl',NULL),(2,'acls','2017-05-16 15:32:29'),(3,'app','2017-05-16 15:32:29'),(4,'aclas','2017-05-16 15:32:29'),(5,'pms',NULL),(6,'cms',NULL),(7,'cns',NULL);
/*!40000 ALTER TABLE `acl_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_category`
--

DROP TABLE IF EXISTS `acl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcLabel` varchar(256) NOT NULL,
  `vrcIcon` varchar(32) NOT NULL,
  `tnyPriority` tinyint(3) unsigned NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_category`
--

LOCK TABLES `acl_category` WRITE;
/*!40000 ALTER TABLE `acl_category` DISABLE KEYS */;
INSERT INTO `acl_category` VALUES (1,'settings','fa fa-cog',255,NULL),(2,'register','fa fa-pencil-square-o',10,NULL),(3,'system','fa fa-window-maximize ',254,NULL),(4,'cms','fa fa-newspaper-o',11,NULL),(5,'notifications','fa fa-comment',12,NULL),(6,'payment','fa fa-dollar',1,NULL),(7,'dashboard','fa fa-pie-chart',1,NULL);
/*!40000 ALTER TABLE `acl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_group`
--

DROP TABLE IF EXISTS `acl_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcName` varchar(256) NOT NULL,
  `vrcAlias` varchar(128) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_group`
--

LOCK TABLES `acl_group` WRITE;
/*!40000 ALTER TABLE `acl_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_module`
--

DROP TABLE IF EXISTS `acl_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkApp` int(11) unsigned NOT NULL,
  `fkCategory` int(11) unsigned NOT NULL,
  `vrcAlias` varchar(128) NOT NULL,
  `tnyPriority` tinyint(3) unsigned NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_portal_acl_module_fk_app` (`fkApp`),
  CONSTRAINT `fk_portal_acl_module_fk_app` FOREIGN KEY (`fkApp`) REFERENCES `acl_app` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_module`
--

LOCK TABLES `acl_module` WRITE;
/*!40000 ALTER TABLE `acl_module` DISABLE KEYS */;
INSERT INTO `acl_module` VALUES (1,1,3,'app',0,NULL),(2,1,3,'module',1,NULL),(3,1,1,'profile',0,NULL),(4,1,2,'user',0,NULL),(5,5,2,'project',1,NULL),(6,5,1,'project-settings',0,NULL),(7,6,4,'article',1,NULL),(8,1,3,'category',3,NULL),(9,6,4,'article-category',2,NULL),(10,7,5,'info',1,NULL);
/*!40000 ALTER TABLE `acl_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_profile`
--

DROP TABLE IF EXISTS `acl_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcName` varchar(256) NOT NULL,
  `vrcAlias` varchar(128) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_profile`
--

LOCK TABLES `acl_profile` WRITE;
/*!40000 ALTER TABLE `acl_profile` DISABLE KEYS */;
INSERT INTO `acl_profile` VALUES (1,'Admin','admin',NULL);
/*!40000 ALTER TABLE `acl_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_profile_module`
--

DROP TABLE IF EXISTS `acl_profile_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_profile_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkProfile` int(11) unsigned NOT NULL,
  `fkModule` int(11) unsigned NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_profile_module_to_profile_idx` (`fkProfile`),
  KEY `fk_acl_profile_module_to_module_idx` (`fkModule`),
  CONSTRAINT `fk_acl_profile_module_to_module` FOREIGN KEY (`fkModule`) REFERENCES `acl_module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acl_profile_module_to_profile` FOREIGN KEY (`fkProfile`) REFERENCES `acl_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_profile_module`
--

LOCK TABLES `acl_profile_module` WRITE;
/*!40000 ALTER TABLE `acl_profile_module` DISABLE KEYS */;
INSERT INTO `acl_profile_module` VALUES (1,1,4,NULL),(2,1,5,NULL),(3,1,7,NULL),(4,1,9,NULL),(5,1,10,NULL),(6,1,3,NULL),(7,1,6,NULL);
/*!40000 ALTER TABLE `acl_profile_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_user`
--

DROP TABLE IF EXISTS `acl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcName` varchar(256) NOT NULL,
  `vrcEmail` varchar(256) NOT NULL,
  `vrbPass` varbinary(32) NOT NULL,
  `vrcToken` varchar(64) NOT NULL,
  `chrType` char(32) NOT NULL DEFAULT 'default',
  `vrcImage` varchar(1024) DEFAULT NULL,
  `dttAdded` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_user`
--

LOCK TABLES `acl_user` WRITE;
/*!40000 ALTER TABLE `acl_user` DISABLE KEYS */;
INSERT INTO `acl_user` VALUES (1,'Moysés Oliveira','contato@moysesoliveira.com.br','f2bccec3b49d688271a1350a3ef35e3d','a23b316f3618dca273bfec2b9edd5e8502aa0dae8c9e28520724cb37490cf578','dev','/Public/upload/acl/user/image/987eb3588baf752094415c8c989fe725.png','2017-05-10 15:12:10',NULL),(2,'Gentleman','user@admin.io','a39d98b06291cffd20417b69d1121f92','1495db110f55fd736f2217c4019900d587944251c691a611158c5678a0004e8c','default','/Public/upload/acl/user/image/ea11bfc14e41c2d30e2f6cc915dfa9f6.png','2017-08-09 13:15:29',NULL);
/*!40000 ALTER TABLE `acl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_user_contact`
--

DROP TABLE IF EXISTS `acl_user_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_user_contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkContactMode` smallint(5) unsigned NOT NULL,
  `vrcContact` varchar(256) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acl_user_contact_to_user_idx` (`fkUser`),
  KEY `fk_acl_user_contact_to_mode_idx` (`fkContactMode`),
  CONSTRAINT `fk_acl_user_contact_to_mode` FOREIGN KEY (`fkContactMode`) REFERENCES `acl_user_contact_mode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acl_user_contact_to_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_user_contact`
--

LOCK TABLES `acl_user_contact` WRITE;
/*!40000 ALTER TABLE `acl_user_contact` DISABLE KEYS */;
INSERT INTO `acl_user_contact` VALUES (1,1,1,'41 991447308',NULL),(2,2,4,'/myfacebook',NULL);
/*!40000 ALTER TABLE `acl_user_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_user_contact_mode`
--

DROP TABLE IF EXISTS `acl_user_contact_mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_user_contact_mode` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `chrAlias` char(32) NOT NULL,
  `chrMode` char(32) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_user_contact_mode`
--

LOCK TABLES `acl_user_contact_mode` WRITE;
/*!40000 ALTER TABLE `acl_user_contact_mode` DISABLE KEYS */;
INSERT INTO `acl_user_contact_mode` VALUES (1,'Telefone / Celular','phone',NULL),(2,'Email','email',NULL),(3,'WhatsApp','phone',NULL),(4,'Facebook','facebook',NULL),(5,'Linkedin','linkedin',NULL),(6,'Website','website',NULL),(7,'Skype','skype',NULL);
/*!40000 ALTER TABLE `acl_user_contact_mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_user_group`
--

DROP TABLE IF EXISTS `acl_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_user_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkGroup` int(11) unsigned NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spl_acl_user_group_fk_user` (`fkUser`),
  KEY `fk_spl_acl_user_group_fk_group` (`fkGroup`),
  CONSTRAINT `fk_spl_acl_user_group_fk_group` FOREIGN KEY (`fkGroup`) REFERENCES `acl_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_spl_acl_user_group_fk_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_user_group`
--

LOCK TABLES `acl_user_group` WRITE;
/*!40000 ALTER TABLE `acl_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_user_profile`
--

DROP TABLE IF EXISTS `acl_user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_user_profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkProfile` int(11) unsigned NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spl_acl_user_profile_fk_user` (`fkUser`),
  KEY `fk_spl_acl_user_profile_fk_profile` (`fkProfile`),
  CONSTRAINT `fk_spl_acl_user_profile_fk_profile` FOREIGN KEY (`fkProfile`) REFERENCES `acl_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_spl_acl_user_profile_fk_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_user_profile`
--

LOCK TABLES `acl_user_profile` WRITE;
/*!40000 ALTER TABLE `acl_user_profile` DISABLE KEYS */;
INSERT INTO `acl_user_profile` VALUES (1,2,1,NULL);
/*!40000 ALTER TABLE `acl_user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_article`
--

DROP TABLE IF EXISTS `cms_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkGroup` int(11) unsigned NOT NULL,
  `fkCategory` int(11) unsigned NOT NULL,
  `intOrder` int(11) unsigned NOT NULL,
  `dttPublished` datetime NOT NULL,
  `vrcTitle` varchar(512) NOT NULL,
  `vrcAlias` varchar(512) NOT NULL,
  `vrcSummary` varchar(2048) DEFAULT NULL,
  `txtContent` text,
  `vrcImageSrc` varchar(1024) DEFAULT NULL,
  `vrcImageTitle` varchar(128) DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_article_fk_group` (`fkGroup`),
  KEY `fk_cms_article_fk_category` (`fkCategory`),
  CONSTRAINT `fk_cms_article_fk_category` FOREIGN KEY (`fkCategory`) REFERENCES `cms_article_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_article_fk_group` FOREIGN KEY (`fkGroup`) REFERENCES `cms_article_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_article`
--

LOCK TABLES `cms_article` WRITE;
/*!40000 ALTER TABLE `cms_article` DISABLE KEYS */;
INSERT INTO `cms_article` VALUES (1,1,1,0,'2018-04-03 01:29:46','sadasd','o-o-o','rfdsf','<p style=\"margin-bottom: 0cm; line-height: 100%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Termos\r\ne Condições de Uso da Plataforma Mais Justiça</strong></span></font></font></font></font></p><p style=\"margin-bottom: 0cm; line-height: 100%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Versão\r\n1.0 - 21/02/2018</strong></span></font></font></font></font></p>\r\n<br>\r\n\r\n<p align=\"center\" style=\"margin-bottom: 0cm; line-height: 100%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Introdução</strong></span></font></font></font></font></p>\r\n<br>\r\n\r\n<ol>\r\n	<li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">O\r\n	Mais Justiça é uma plataforma digital que conecta pessoas físicas\r\n	e jurídicas à advogados cadastrados, para que estes lhes prestem\r\n	orientação ou serviços jurídicos. A missão do Mais Justiça é\r\n	utilizar a tecnologia e a internet para difundir o conhecimento\r\n	jurídico, ampliar o acesso à justiça, fortalecer a advocacia e\r\n	construir uma sociedade mais justa. </span></font></font></font>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">Todos\r\n	os direitos e deveres relativos à plataforma Mais Justiça são de\r\n	propriedade de RED LIONS SOLUTIONS EIRELI - ME, CNPJ nº\r\n	20.886.921/0001-00, a qual é responsável pelos sistemas e serviços\r\n	fornecidos e comercializados.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">O\r\n	Mais Justiça não é um escritório de advocacia, não mantém\r\n	vínculos dessa natureza com advogados e não presta serviços\r\n	jurídicos, mas tão somente, coleta, organiza e disponibiliza\r\n	informações obtidas por meio da internet, fornecidas pelos\r\n	próprios usuários ou obtidas de bancos de dados públicos ou\r\n	privados de acesso amplo. </span></font></font></font>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">A\r\n	utilização de todo e qualquer serviço ou funcionalidade\r\n	relacionada, direta ou indiretamente, à plataforma Mais Justiça\r\n	está condicionada a plena, total e irrestrita aceitação por parte\r\n	do usuário, das cláusulas, condições e obrigações estipuladas\r\n	no presente termo. </span></font></font></font>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">Caso\r\n	o usuário não concorde, ainda que minimamente, com as disposições\r\n	previstas neste instrumento, não deverá utilizá-la, pois o\r\n	fazendo, automaticamente renunciará ao direito de questioná-las,\r\n	judicial e extrajudicialmente.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">O\r\n	usuário declarará sua plena, total e irrestrita aceitação dos\r\n	termos e condições de uso da plataforma Mais Justiça, mediante a\r\n	seleção/marcação de campo específico existente no formulário\r\n	de cadastro, com a mensagem </span></font><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\"><em>“</em></span></font><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\"><em><u>Li\r\n	e aceito os termos e condições de uso</u></em></span></font><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\"><em>”</em></span></font><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">\r\n	e somente serão registrados e cadastrados os usuários que assim o\r\n	fizerem.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">O\r\n	usuário declara estar ciente que o Mais Justiça poderá a qualquer\r\n	momento, unilateralmente e sem necessidade de prévia notificação,\r\n	modificar o presente instrumento e a plataforma, inclusive alterando\r\n	obrigações, preços, prazos, sistemas ou qualquer funcionalidade\r\n	disponibilizada e comercializada.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">Todos\r\n	os dados coletados por meio da plataforma Mais Justiça serão\r\n	utilizados exclusivamente para fins de execução, desenvolvimento e\r\n	aprimoramento dos serviços ofertados, e não serão compartilhados\r\n	com outras empresas, salvo se em estrita observância do dever\r\n	legal.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">Os\r\n	usuários da plataforma Mais Justiça se subdividem em duas\r\n	categorias denominadas, ADVOGADOS e CLIENTES, e ambos poderão se\r\n	cadastrar gratuitamente no sistema, mediante a inserção dos dados\r\n	constante no formulário próprio.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">A\r\n	veracidade das informações apresentadas no formulário de cadastro\r\n	são de inteira responsabilidade do usuário, e uma vez constatada\r\n	qualquer inverdade ou irregularidade, o usuário será\r\n	automaticamente bloqueado, sem prejuízo da adoção das medidas\r\n	civis e criminais cabíveis.</span></font></font></font></p>\r\n</li></ol>\r\n<br>\r\n\r\n<p align=\"center\" style=\"margin-bottom: 0cm; line-height: 100%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Dos\r\nClientes</strong></span></font></font></font></font></p>\r\n<br>\r\n\r\n<ol start=\"11\">\r\n	<li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">Os\r\n	usuários da categoria CLIENTES poderão cadastrar casos, dúvidas e\r\n	perguntas com conteúdos jurídicos, denominados DEMANDA, os quais\r\n	serão mantidos sob sigilo, e somente serão disponibilizados aos\r\n	usuários da categoria ADVOGADOS.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">O\r\n	Mais Justiça poderá excluir ou não exibir DEMANDA com mensagem\r\n	com conteúdo racista, discriminatório, ofensivo, ilegal ou que, de\r\n	alguma forma, entenda não estar em consonância com a legislação\r\n	brasileira. </font></font></font></span>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Para\r\n	o cadastramento da DEMANDA os CLIENTES deverão fornecer dados de\r\n	contato, celular e/ou e-mail, pelos quais os ADVOGADOS poderão\r\n	contacta-los para esclarecimento ou oferecimento de seus serviços.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Os\r\n	dados de contato dos CLIENTES somente serão disponibilizados a no\r\n	máximo 3 (três) ADVOGADOS por demanda, os quais deverão\r\n	manifestar em campo próprio do sistema o interesse em assumir a\r\n	DEMANDA.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Para\r\n	a liberação dos dados de contato do CLIENTE que cadastrou a\r\n	DEMANDA, o Mais Justiça cobrará dos ADVOGADOS uma quantidade\r\n	específica de créditos, a serem subtraídos de sua conta na\r\n	plataforma. A inexistência de créditos suficientes impedirá o\r\n	acesso aos referidos dados.</font></font></font></span></p>\r\n</li></ol>\r\n<br>\r\n\r\n<p align=\"center\" style=\"margin-bottom: 0cm; line-height: 100%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Dos\r\nAdvogados</strong></span></font></font></font></font></p>\r\n<br>\r\n\r\n<ol start=\"16\">\r\n	<li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Somente\r\n	serão cadastrados ADVOGADOS que estiverem regularmente inscritos\r\n	junto a Ordem dos Advogados do Brasil, os quais prestarão seus\r\n	serviços aos CLIENTES sem nenhum vínculo de natureza técnica,\r\n	comercial, trabalhista ou empresarial com o Mais Justiça, isto é,\r\n	atuarão de forma independente e autônoma.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">O\r\n	Mais Justiça é isento e não tem nenhuma responsabilidade técnica\r\n	ou profissional pela conduta ou qualidade dos serviços prestados\r\n	pelos ADVOGADOS, os quais são os únicos responsáveis por seus\r\n	atos, em especial aqueles decorrentes do uso da plataforma.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Os\r\n	ADVOGADOS serão relacionados em um diretório de advogados, que se\r\n	assemelha a uma lista telefônica, que possibilitará aos CLIENTES\r\n	uma pesquisa organizada dos profissionais cadastrados por cidades e\r\n	por área jurídica de atuação.  </font></font></font></span>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">O\r\n	diretório de advogados é um serviço gratuito a todos os\r\n	advogados.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Não\r\n	é permitido que bacharéis ou estudantes de direito se inscrevam ou\r\n	cadastrem como ADVOGADOS na plataforma, sendo de total\r\n	responsabilidade dos usuários a veracidade das informações\r\n	apresentadas no formulário de cadastro.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Os\r\n	ADVOGADOS terão acesso livre a um banco de dados contendo as\r\n	informações encaminhadas pelos CLIENTES no ato de cadastramento da\r\n	DEMANDA, exceção feita aos dados relacionados ao contato do\r\n	cliente, que serão liberados mediante o pagamento de determinada\r\n	quantidade de  CRÉDITOS que poderá sofrer variação a critério\r\n	do Mais Justiça. </font></font></font></span>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\">  <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Ao\r\n	manifestar interesse em assumir a DEMANDA os ADVOGADOS autorizam o\r\n	sistema a debitar automaticamente de sua conta a quantidade de\r\n	créditos correspondente.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">A\r\n	plataforma Mais Justiça não garante sucesso na realização de\r\n	negócios ou no fechamento de contratos entre ADVOGADOS e CLIENTES,\r\n	restringindo-se apenas em manter um ambiente propício a adequada\r\n	interação entre as partes.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">O\r\n	Mais Justiça não recebe nem cobra nenhum valor com base em\r\n	honorários ou contratos firmados entre ADVOGADOS e CLIENTES.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">A\r\n	plataforma Mais Justiça é elaborada com total observância da\r\n	legislação brasileira, em especial no tocante aos aspectos\r\n	relacionados a atividade da advocacia, e assim está alinhada com os\r\n	princípios e dispositivos do Estatuto da Advocacia da Ordem dos\r\n	Advogados do Brasil - OAB e demais regramentos aplicáveis à\r\n	matéria.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">O\r\n	Mais Justiça zelará pela segurança, neutralidade, acessibilidade\r\n	e manutenção do sistema, entretanto, bugs, panes ou outros\r\n	problemas técnicos poderão impedir momentaneamente o acesso ao\r\n	sistema, o que não implicará em direito a indenizações,\r\n	restituições ou similares aos usuários pelo tempo de interrupção\r\n	nos serviços.  </font></font></font></span>\r\n	</p>\r\n</li></ol>\r\n<br>\r\n\r\n<p align=\"center\" style=\"margin-bottom: 0cm; line-height: 100%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Dos\r\nCréditos</strong></span></font></font></font></font></p>\r\n<br>\r\n\r\n<ol start=\"27\">\r\n	<li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> </span><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">A\r\n	utilização de qualquer dos serviços ou funcionalidades\r\n	disponibilizadas pelo Mais Justiça estarão condicionadas a\r\n	aquisição de créditos pelos ADVOGADOS, que poderão optar por\r\n	pacotes pré-estabelecidos e de valores variados.</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Os\r\n	créditos adquiridos ficarão em uma conta on-line vinculada ao\r\n	cadastro do ADVOGADO, e o respectivo saldo somente poderá ser\r\n	utilizado para o pagamento de serviços ou funcionalidades\r\n	comercializadas na plataforma Mais Justiça.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font size=\"4\" style=\"font-size: 14pt\">Os\r\n	créditos adquiridos terão validade de 90 (noventa) dias e não são\r\n	reembolsáveis, salvo se devidamente comprovado algum motivo legal. </font></font></font></span>\r\n	</p>\r\n</li></ol>\r\n<br>\r\n\r\n<p align=\"center\" style=\"margin-bottom: 0cm; line-height: 150%\"><font face=\"Times New Roman, serif\"><font size=\"3\" style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font size=\"4\" style=\"font-size: 15pt\"><span style=\"letter-spacing: 0.1pt\"><strong>Disposições\r\nGerais</strong></span></font></font></font></font></p><p>\r\n	\r\n	\r\n	<style type=\"text/css\">\r\n		@page { margin: 2cm }\r\n		p { margin-bottom: 0.25cm; direction: ltr; line-height: 120%; text-align: left; orphans: 2; widows: 2 }\r\n		a:link { color: #0000ff }\r\n	</style>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><ol start=\"30\">\r\n	<li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font style=\"font-size: 14pt\">O\r\n	usuário se compromete a fornecer dados pessoais verdadeiros,\r\n	precisos, atuais e completos durante o procedimento de registro,\r\n	cadastramento de seus dados e de cobrança dos valores eventualmente\r\n	pactuados, bem como a manter atualizadas as informações prestadas\r\n	para viabilizar o funcionamento adequado da plataforma e sistemas do\r\n	Mais Justiça.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> </span><font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font style=\"font-size: 14pt\"><span style=\"letter-spacing: 0.1pt\">A\r\n	plataforma Mais Justiça destina-se exclusivamente à fins lícitos\r\n	e eventuais aplicações ou utilizações diferentes são de inteira\r\n	e total responsabilidade de seus usuários que responder</span></font></font></font></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font style=\"font-size: 14pt\">A\r\n	inobservância das regras e obrigações estipuladas neste\r\n	instrumento ou na legislação brasileira poderá ensejar a imediata\r\n	rescisão unilateral do contrato por parte do Mais Justiça e o\r\n	bloqueio da conta e serviços prestados ao usuário, hipótese na\r\n	qual não haverá reembolso de eventuais créditos existentes na\r\n	plataforma.</font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\">  <font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font style=\"font-size: 15pt\">Os\r\n	usuários não terão nenhum tipo de ingerência sobre o\r\n	funcionamento ou desenvolvimento da plataforma e não poderão\r\n	hackear ou interferir no sistema e serviços do Mais Justiça,\r\n	representar outra pessoa ou obter acesso não autorizado à conta de\r\n	outra pessoa, introduzir qualquer tipo de vírus, worm, spyware ou\r\n	qualquer outro código computacional, arquivo ou programa que possa\r\n	estar destinado a danificar ou violar a operação, hardware,\r\n	software ou qualquer outro aspecto da plataforma.</font></font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font style=\"font-size: 15pt\">O\r\n	Mais Justiça não se responsabiliza por atos de terceiros que se\r\n	apropriem das imagens ou informações exibidas na plataforma.</font></font></font></font></span></p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font style=\"font-size: 15pt\">Para\r\n	dirimir dúvidas e demais questionamentos relacionados ao presente\r\n	Termo de Uso, fica eleito o foro da comarca de Goiânia/GO. </font></font></font></font></span>\r\n	</p>\r\n	</li><li>\r\n<p align=\"justify\" style=\"margin-bottom: 0cm; line-height: 150%\">\r\n	<span style=\"letter-spacing: 0.1pt\"> <font face=\"Times New Roman, serif\"><font style=\"font-size: 12pt\"><font face=\"Georgia, serif\"><font style=\"font-size: 15pt\">Ao\r\n	efetuarem o cadastro, os usuários de ambas as categorias, CLIENTES\r\n	e ADVOGADOS, declaram ter lido, compreendido e aceitado em sua\r\n	totalidade as regras e obrigações definidas neste Termo de Uso da\r\n	plataforma Mais Justiça.</font></font></font></font></span></p></li></ol><style type=\"text/css\">\r\n		@page { margin: 2cm }\r\n		p { margin-bottom: 0.25cm; direction: ltr; line-height: 120%; text-align: left; orphans: 2; widows: 2 }\r\n		a:link { color: #0000ff }\r\n	</style>','/Public/upload/cms/gallery/image/88d9f5a4c5fcf2abcff7f55de0988f49.jpg',NULL,NULL),(2,1,1,0,'2017-06-23 19:55:02','Surpassing market leaders.','surpassing-market-leaders','In this post I\'ll show why you can compete with any market leader any time you wanted,.','<p style=\"box-sizing: inherit; margin-bottom: 1em; line-height: 1.4285em;\">In this post I\'ll show why you can compete with any market leader any time you wanted, and its the same reason why you never will be insuperable.</p><p style=\"box-sizing: inherit; margin-bottom: 1em; line-height: 1.4285em;\">When you look for the market leaders you think you can\'t compete with them becouse they have more resources, people, customers and everything else, doesn\'t? But if you think about challenge you\'ll see the oportunity you can surpassing them with no much effort, however you, in short time, can be surpassed by someone and it\'s ok, it\'s fair and it\'s exciting. The reason is that most part of companies avoid remake and/or innovation because it\'s expensive and the results can be unpredictable and this is the reason why you can surpassing corporations with innovation. You are not convinced yet? Let-me show this example.</p><br><p style=\"box-sizing: inherit; margin-bottom: 1em; line-height: 1.4285em;\">Assume you have some company who supply ERP with A, B &amp; C technology at last 10 years. Along the time those technologies made obsolete but you have 5.000 customers using this thecnology however the risk of switch technology is to high you decides to mantain this technology besides all problems those old technologies can make. Instead of innovate you\'ll put time and efort to mantain the customers and focus on current product and you are trapped on this situation.</p><br><p style=\"box-sizing: inherit; margin-bottom: 1em; line-height: 1.4285em;\">This type of thing not happen when you have small company, so you can compete making an ERP with newer technology, better user interface, better user experience, and steal part of the customers for you, and it\'s ok because if you didn\'t, someone will do. Old technologies and old interfaces is painful for the customers and hard to learn to use, when you improve with innovation you are helping even if you only just rebuild something that already exists.</p><br><p style=\"box-sizing: inherit; margin-bottom: 1em; line-height: 1.4285em;\">So the conclusion is the market is ever open becouse the things is ever change and evolve, market leaders cannot take risks and change things to work in some unknow thing, but you can do this and must to, especially when it comes to technology.</p><p style=\"box-sizing: inherit; margin-bottom: 1em; line-height: 1.4285em;\"><br></p>\r\n\r\n\r\n\r\n\r\n',NULL,NULL,NULL),(3,2,2,0,'2017-08-31 17:45:43','Dados sobre loren ipusn','...','...','...','..','...',NULL),(4,2,6,0,'2017-09-04 15:35:25','asdasdsa','e93ccf5ffc90eefcc0bdb81f87d25d1a',NULL,NULL,NULL,NULL,NULL),(5,2,2,0,'2017-09-04 15:39:13','fdsgfdsfsd','faeca1796ce20f96254874ffffc7efbd',NULL,NULL,NULL,NULL,NULL),(6,2,3,0,'2017-09-04 15:43:29','sdfsdfsd','8c71fb3f7593543f2ad180d31148a7cf',NULL,NULL,NULL,NULL,NULL),(7,2,4,0,'2017-09-04 15:44:34','sdfdsfsd','ba372aa41a6c63b059cbf047f37f712a',NULL,NULL,NULL,NULL,NULL),(8,2,4,0,'2018-04-03 01:30:34','asdasdas','bff149a0b87f5b0e00d9dd364e9ddaa0','hgfh','fghf','/Public/upload/cms/gallery/image/e88ada296d5244d94dbc899a3668c4d0.png',NULL,NULL),(9,2,6,0,'2017-09-15 18:04:01','asdasd','a8f5f167f44f4964e6c998dee827110c','lnlnl','kjnkk',NULL,NULL,NULL),(10,2,6,0,'2017-09-04 15:46:21','asdsadas','630faa05ea22c48ed5c4b16ad64f6dfa',NULL,NULL,NULL,NULL,NULL),(11,2,3,0,'2017-09-04 17:50:11','manual proheus','469d4ab8196afec24d30ba85df5fb25a',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cms_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_article_attachment`
--

DROP TABLE IF EXISTS `cms_article_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_article_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkArticle` int(11) unsigned NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `intOrder` int(11) unsigned NOT NULL,
  `vrcSrc` varchar(1024) NOT NULL,
  `chrExt` char(16) NOT NULL,
  `vrcName` varchar(256) NOT NULL,
  `dttAdded` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_article_att_fk_article` (`fkArticle`),
  CONSTRAINT `fk_cms_article_att_fk_article` FOREIGN KEY (`fkArticle`) REFERENCES `cms_article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_article_attachment`
--

LOCK TABLES `cms_article_attachment` WRITE;
/*!40000 ALTER TABLE `cms_article_attachment` DISABLE KEYS */;
INSERT INTO `cms_article_attachment` VALUES (1,2,1,0,'//spellphp.dev/Public/upload/cms/document/25d8635684f110eb48a558010bc9dd45.','aws cname','aws cname','2017-08-31 17:19:02','2017-06-23 19:55:02'),(2,2,1,0,'//spellphp.dev/Public/upload/cms/document/ae8abeb4424f78bc3d709f0c23139b39.png','async-js','async-js','2017-08-31 17:19:02','2017-06-23 19:55:02'),(3,2,1,1,'//spellphp.dev/Public/upload/cms/document/8bf050dbfbb6951157495697c336bb4a.png','png','auth','2017-08-31 17:19:02','2017-06-23 19:55:02'),(4,2,1,2,'//spellphp.dev/Public/upload/cms/document/3fc731502b186fa3c24d95230106ca99.png','png','getInvoice','2017-08-31 17:19:02','2017-06-23 19:55:02'),(5,2,1,0,'//spellphp.dev/Public/upload/cms/document/101ab1c02149a394fce62ac349e1cad4.png','png','autorização','2017-08-31 17:19:02',NULL),(6,2,1,1,'//spellphp.dev/Public/upload/cms/document/98feecb48a25bb5135f8d67f925ce592.pdf','pdf','Especificação Técnica Projeto Slinky V3_Atualizado em 28_03_2017','2017-08-31 17:19:02',NULL),(7,2,1,2,'//spellphp.dev/Public/upload/cms/document/554d068160bfd3ffb62c6e4f8b0db4db.xspf','xspf','compreess-playlist','2017-08-31 17:19:02',NULL),(8,3,1,0,'//sulinvest.dev/Public/upload/cms/document/mydoc.abcdef.pdf','pdf','mydoc','2017-08-31 18:29:15',NULL),(9,8,1,0,'Public/upload/sulinvest/library/attach/usuario.7e62e41e7c3dd0ff66ea4c1b98c2a8b1.sql','sql','usuario.sql','2017-09-04 15:45:51',NULL),(10,9,1,0,'Public/upload/sulinvest/library/attach/servicos.f3ac76ddb5fe7bc925629d10fd9d09f1.csv','csv','servicos.csv','2017-09-04 15:46:05',NULL),(11,10,1,0,'Public/upload/sulinvest/library/attach/moyses-oliveira-resume-php-dev.7fdef93cbd9dd890253626d2f9fc2dac.pdf','pdf','moyses-oliveira-resume-php-dev.pdf','2017-09-04 15:46:21',NULL),(12,8,1,1,'Public/upload/sulinvest/library/attach/usuario.a57c851a7d562b89989939941ad7dfe9.sql','sql','usuario.sql','2017-09-04 16:21:18',NULL),(13,9,1,1,'Public/upload/sulinvest/library/attach/artigo.55768dc427f89b5a851639bd6bca0ec0.txt','txt','artigo.txt','2017-09-04 16:21:30',NULL),(14,9,1,2,'Public/upload/sulinvest/library/attach/autoregistro.afdf84c03fa90a5fe617e5ba9afe7cbe.txt','txt','autoregistro.txt','2017-09-04 17:49:31',NULL),(15,11,1,0,'Public/upload/sulinvest/library/attach/Venda a Ordem.30f01b6528558b38a163b6d3d0c24fc1.pdf','pdf','Venda a Ordem.pdf','2017-09-04 17:50:11',NULL),(16,1,2,0,'//sample.lch/Public/upload/cms/document/4f9c4e8f8a9d054dc67238008ed5ded2.pdf','pdf','projeto-de-desenvolvimento','2018-04-03 01:29:46',NULL);
/*!40000 ALTER TABLE `cms_article_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_article_category`
--

DROP TABLE IF EXISTS `cms_article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_article_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkGroup` int(11) unsigned NOT NULL,
  `fkCategory` int(11) unsigned DEFAULT NULL,
  `vrcName` varchar(256) NOT NULL,
  `vrcAlias` varchar(128) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_category_fk_group` (`fkGroup`),
  CONSTRAINT `fk_cms_category_fk_group` FOREIGN KEY (`fkGroup`) REFERENCES `cms_article_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_article_category`
--

LOCK TABLES `cms_article_category` WRITE;
/*!40000 ALTER TABLE `cms_article_category` DISABLE KEYS */;
INSERT INTO `cms_article_category` VALUES (1,1,NULL,'Default','abcd',NULL),(2,2,NULL,'Marketing','marketing',NULL),(3,2,NULL,'TI','ti',NULL),(4,2,NULL,'RH','rh',NULL),(5,2,NULL,'Tesouraria','tesouraria',NULL),(6,2,NULL,'Ouvidoria','ouvidoria',NULL);
/*!40000 ALTER TABLE `cms_article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_article_comment`
--

DROP TABLE IF EXISTS `cms_article_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_article_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkArticle` int(11) unsigned NOT NULL,
  `fkComment` int(11) unsigned DEFAULT NULL,
  `vrcName` varchar(256) NOT NULL,
  `vrcComment` varchar(2048) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_comment_fk_article` (`fkArticle`),
  CONSTRAINT `fk_cms_comment_fk_article` FOREIGN KEY (`fkArticle`) REFERENCES `cms_article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_article_comment`
--

LOCK TABLES `cms_article_comment` WRITE;
/*!40000 ALTER TABLE `cms_article_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_article_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_article_group`
--

DROP TABLE IF EXISTS `cms_article_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_article_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcName` varchar(256) NOT NULL,
  `vrcAlias` varchar(128) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_article_group`
--

LOCK TABLES `cms_article_group` WRITE;
/*!40000 ALTER TABLE `cms_article_group` DISABLE KEYS */;
INSERT INTO `cms_article_group` VALUES (1,'Páginas Estáticas','paginas',NULL),(2,'Bibilioteca','libraries',NULL);
/*!40000 ALTER TABLE `cms_article_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_article_image`
--

DROP TABLE IF EXISTS `cms_article_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_article_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkArticle` int(11) unsigned NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `intOrder` int(11) unsigned NOT NULL,
  `vrcSrc` varchar(1024) NOT NULL,
  `chrExt` char(16) NOT NULL,
  `vrcName` varchar(256) NOT NULL,
  `vrcAlt` varchar(256) NOT NULL,
  `vrcTitle` varchar(256) NOT NULL,
  `vrcSummary` varchar(2048) DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cms_article_img_fk_article` (`fkArticle`),
  CONSTRAINT `fk_cms_article_img_fk_article` FOREIGN KEY (`fkArticle`) REFERENCES `cms_article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_article_image`
--

LOCK TABLES `cms_article_image` WRITE;
/*!40000 ALTER TABLE `cms_article_image` DISABLE KEYS */;
INSERT INTO `cms_article_image` VALUES (1,2,1,1,'//spellphp.dev/Public/upload/cms/document/ae8abeb4424f78bc3d709f0c23139b39.png','png','getInvoice','tela','tela','summary','2017-06-23 19:55:02'),(2,2,1,3,'//spellphp.dev/Public/upload/cms/gallery/01e69f954c76a4dcfd421eeb18c28ecc.png','png','autorização','autorização','autorização',NULL,'2017-06-23 19:55:02'),(3,2,1,2,'//spellphp.dev/Public/upload/cms/gallery/1a816cad225ec30d4938e3bd19cac929.png','png','escape_xml','escape_xml','escape_xml',NULL,'2017-06-23 19:55:02'),(4,2,1,0,'//spellphp.dev/Public/upload/cms/gallery/760e8d058ca773ff8273cf58f55457a2.png','png','finish-to-apply-resume','finish-to-apply-resume','finish-to-apply-resume',NULL,'2017-06-23 19:55:02'),(5,2,1,0,'//spellphp.dev/Public/upload/cms/gallery/8d61f86f63639ae6bb25b08d2481f1df.png','png','Slack-IRC','Slack-IRC','Slack-IRC',NULL,'2017-06-23 19:55:02'),(6,1,1,0,'/Public/upload/cms/gallery/image/c0588e27dc40546a852b76fec806cb51.jpg','jpg','akali_vs_baron_3.jpg','akali_vs_baron_3','akali_vs_baron_3','','2018-04-03 01:29:46'),(7,1,1,1,'/Public/upload/cms/gallery/image/d1a2bed18e82bf90b27effe66c439853.png','png','bearer.png','bearer','bearer','','2018-04-03 01:29:46'),(8,1,1,2,'/Public/upload/cms/gallery/image/1b43040112aa5aee57cd6134e0fea41a.png','png','async-js.png','async-js','async-js','','2018-04-03 01:29:46'),(9,2,1,0,'/Public/upload/cms/gallery/image/3adee286b58cedf82ac4fec6b0517964.png','png','Slack-IRC.png','Slack-IRC','Slack-IRC',NULL,NULL),(10,2,1,2,'/Public/upload/cms/gallery/image/963fc2a6b5e428650003ab0d8802b2e5.png','png','Anonymous.png','Anonymous','Anonymous',NULL,NULL),(11,2,1,1,'/Public/upload/cms/gallery/image/bc4aa3a295844b80bb1f50fb9fbe2e72.jpg','jpg','akali_vs_baron_3.jpg','akali_vs_baron_3','akali_vs_baron_3',NULL,NULL),(12,2,1,3,'/Public/upload/cms/gallery/image/2fcc20179572c696a444326a02c741c6.png','png','Captura de tela de 2016-11-11 10-07-38.png','Captura de tela de 2016-11-11 10-07-38','Captura de tela de 2016-11-11 10-07-38',NULL,NULL),(13,9,1,0,'/Public/upload/cms/gallery/image/9fef278dd6fbecfe0b06d28f0726d5c0.png','png','cripto.png','cripto','cripto',NULL,NULL),(14,1,2,0,'Public/upload/cms/gallery/image/c709c07dd3da08e7a71da50faf1e31c9.png','png','works.png','works','works','',NULL);
/*!40000 ALTER TABLE `cms_article_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_info`
--

DROP TABLE IF EXISTS `cns_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `tnyLevel` tinyint(3) unsigned NOT NULL,
  `vrcSummary` varchar(256) NOT NULL,
  `vrcDescription` varchar(2048) DEFAULT NULL,
  `dttPosted` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cns_info_to_level_idx` (`tnyLevel`),
  KEY `fk_cns_info_to_user_idx` (`fkUser`),
  CONSTRAINT `fk_cns_info_to_level` FOREIGN KEY (`tnyLevel`) REFERENCES `cns_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cns_info_to_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_info`
--

LOCK TABLES `cns_info` WRITE;
/*!40000 ALTER TABLE `cns_info` DISABLE KEYS */;
INSERT INTO `cns_info` VALUES (1,2,2,'cxv','cxvxcv','2018-04-03 01:23:11',NULL),(2,2,2,'fg','dfgdfg','2018-04-03 01:47:55',NULL),(3,2,2,'fg','dfgdfg','2018-04-03 01:48:01',NULL);
/*!40000 ALTER TABLE `cns_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_info_reply`
--

DROP TABLE IF EXISTS `cns_info_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_info_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkInfo` int(11) unsigned NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `vrcReply` varchar(4096) NOT NULL,
  `dttPosted` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cns_info_reply_to_info_idx` (`fkInfo`),
  CONSTRAINT `fk_cns_info_reply_to_info` FOREIGN KEY (`fkInfo`) REFERENCES `cns_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_info_reply`
--

LOCK TABLES `cns_info_reply` WRITE;
/*!40000 ALTER TABLE `cns_info_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_info_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_info_user`
--

DROP TABLE IF EXISTS `cns_info_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_info_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkInfo` int(11) unsigned NOT NULL,
  `dttChecked` datetime DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spl_cns_info_user_fk_user` (`fkUser`),
  KEY `fk_spl_cns_info_user_fk_info` (`fkInfo`),
  CONSTRAINT `fk_spl_cns_info_user_fk_info` FOREIGN KEY (`fkInfo`) REFERENCES `cns_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_spl_cns_info_user_fk_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_info_user`
--

LOCK TABLES `cns_info_user` WRITE;
/*!40000 ALTER TABLE `cns_info_user` DISABLE KEYS */;
INSERT INTO `cns_info_user` VALUES (1,2,1,'2018-04-03 01:52:50',NULL),(2,2,2,'2018-04-03 01:54:04',NULL),(3,2,3,'2018-04-03 01:54:01',NULL);
/*!40000 ALTER TABLE `cns_info_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_level`
--

DROP TABLE IF EXISTS `cns_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_level` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tnyValue` tinyint(3) unsigned NOT NULL,
  `chrLevel` char(32) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_level`
--

LOCK TABLES `cns_level` WRITE;
/*!40000 ALTER TABLE `cns_level` DISABLE KEYS */;
INSERT INTO `cns_level` VALUES (1,100,'high',NULL),(2,75,'medium',NULL),(3,50,'low',NULL);
/*!40000 ALTER TABLE `cns_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_message`
--

DROP TABLE IF EXISTS `cns_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tnyLevel` tinyint(3) unsigned NOT NULL,
  `fkFromUser` int(11) unsigned NOT NULL,
  `fkToUser` int(11) unsigned NOT NULL,
  `vrcMessage` varchar(2048) NOT NULL,
  `dttPosted` datetime NOT NULL,
  `dttCompleted` datetime DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spl_cns_message_fk_to` (`fkFromUser`),
  KEY `fk_cns_message_to_level_idx` (`tnyLevel`),
  CONSTRAINT `fk_cns_message_to_level` FOREIGN KEY (`tnyLevel`) REFERENCES `cns_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_spl_cns_message_fk_from` FOREIGN KEY (`fkFromUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_spl_cns_message_fk_to` FOREIGN KEY (`fkFromUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_message`
--

LOCK TABLES `cns_message` WRITE;
/*!40000 ALTER TABLE `cns_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_schedule_category`
--

DROP TABLE IF EXISTS `cns_schedule_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_schedule_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chrCategory` char(128) NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_schedule_category`
--

LOCK TABLES `cns_schedule_category` WRITE;
/*!40000 ALTER TABLE `cns_schedule_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_schedule_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_schedule_event`
--

DROP TABLE IF EXISTS `cns_schedule_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_schedule_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkCategory` int(11) unsigned NOT NULL,
  `chrTitle` char(128) NOT NULL,
  `vrcDescription` varchar(4096) NOT NULL,
  `dttBegin` datetime NOT NULL,
  `dttFinish` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cns_schedule_event_1_idx` (`fkCategory`),
  KEY `fk_cns_se_to_user_idx` (`fkUser`),
  CONSTRAINT `fk_cns_se_to_category` FOREIGN KEY (`fkCategory`) REFERENCES `cns_schedule_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cns_se_to_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_schedule_event`
--

LOCK TABLES `cns_schedule_event` WRITE;
/*!40000 ALTER TABLE `cns_schedule_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_schedule_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_schedule_user`
--

DROP TABLE IF EXISTS `cns_schedule_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_schedule_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkEvent` int(11) unsigned NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_schedule_user`
--

LOCK TABLES `cns_schedule_user` WRITE;
/*!40000 ALTER TABLE `cns_schedule_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_schedule_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_task`
--

DROP TABLE IF EXISTS `cns_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chrId` char(128) NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `chrFlag` char(32) NOT NULL,
  `vrcSummary` varchar(256) NOT NULL,
  `vrcDescription` varchar(4096) DEFAULT NULL,
  `vrcUrl` varchar(2048) DEFAULT NULL,
  `dttPosted` datetime NOT NULL,
  `dttFinished` datetime DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vrcUid_UNIQUE` (`chrId`),
  KEY `fk_cns_task_to_user_idx` (`fkUser`),
  CONSTRAINT `fk_cns_task_to_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_task`
--

LOCK TABLES `cns_task` WRITE;
/*!40000 ALTER TABLE `cns_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_task_reply`
--

DROP TABLE IF EXISTS `cns_task_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_task_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkTask` int(11) unsigned NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `vrcReply` varchar(4096) NOT NULL,
  `dttPosted` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cns_task_reply_to_task_idx` (`fkTask`),
  CONSTRAINT `fk_cns_task_reply_to_task` FOREIGN KEY (`fkTask`) REFERENCES `cns_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_task_reply`
--

LOCK TABLES `cns_task_reply` WRITE;
/*!40000 ALTER TABLE `cns_task_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_task_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cns_task_user`
--

DROP TABLE IF EXISTS `cns_task_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cns_task_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkTask` int(11) unsigned NOT NULL,
  `dttChecked` datetime DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_spl_cns_task_user_fk_user` (`fkUser`),
  KEY `fk_spl_cns_task_user_fk_task` (`fkTask`),
  CONSTRAINT `fk_spl_cns_task_user_fk_task` FOREIGN KEY (`fkTask`) REFERENCES `cns_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_spl_cns_task_user_fk_user` FOREIGN KEY (`fkUser`) REFERENCES `acl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cns_task_user`
--

LOCK TABLES `cns_task_user` WRITE;
/*!40000 ALTER TABLE `cns_task_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `cns_task_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_file`
--

DROP TABLE IF EXISTS `pms_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkProject` int(11) unsigned NOT NULL,
  `vrcFile` varchar(2048) NOT NULL,
  `dttCreated` datetime NOT NULL,
  `dttUpdated` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_file`
--

LOCK TABLES `pms_file` WRITE;
/*!40000 ALTER TABLE `pms_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_post`
--

DROP TABLE IF EXISTS `pms_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkProject` int(11) unsigned NOT NULL,
  `fkUser` int(11) unsigned NOT NULL,
  `chrType` char(32) NOT NULL DEFAULT 'TEXT' COMMENT 'ENUM(''TEXT'', ''DOCUMENT'', ''IMAGE'', ''VIDEO'', ''AUDIO'', ''URL'');',
  `vrcTitle` varchar(256) NOT NULL,
  `txtNote` text NOT NULL,
  `dttCreated` datetime NOT NULL,
  `dttUpdated` datetime NOT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_post`
--

LOCK TABLES `pms_post` WRITE;
/*!40000 ALTER TABLE `pms_post` DISABLE KEYS */;
INSERT INTO `pms_post` VALUES (1,5,1,'TEXT','basdba','boasbdasjdb obasod bjasodbsaosabd aosbdoasbdo sa','2017-06-05 16:15:07','2017-06-05 16:15:07',NULL),(2,5,1,'TEXT','basdba','boasbdasjdb obasod bjasodbsaosabd aosbdoasbdo sa','2017-06-05 16:15:27','2017-06-05 16:15:27',NULL),(3,5,1,'TEXT','Novo Processo','<p>Novo Processo asds ad asdas das das das</p>','2017-06-05 16:38:38','2017-06-05 16:38:38',NULL),(4,5,1,'TEXT','Novo Processo','<h1><strong>Novo Processo</strong></h1>','2017-06-05 16:38:58','2017-06-05 16:38:58',NULL),(5,5,1,'TEXT','asdasd','aosndoasno','2017-06-19 21:29:47','2017-06-19 21:29:47',NULL),(6,1,2,'TEXT','sdfdsfsdf','dfsfds','2018-04-03 01:45:42','2018-04-03 01:45:42',NULL);
/*!40000 ALTER TABLE `pms_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_post_type`
--

DROP TABLE IF EXISTS `pms_post_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_post_type` (
  `chrType` char(32) NOT NULL,
  PRIMARY KEY (`chrType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_post_type`
--

LOCK TABLES `pms_post_type` WRITE;
/*!40000 ALTER TABLE `pms_post_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_post_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_project`
--

DROP TABLE IF EXISTS `pms_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) unsigned NOT NULL,
  `fkStatus` int(11) unsigned NOT NULL,
  `vrcName` varchar(255) NOT NULL,
  `vrcAlias` varchar(255) NOT NULL,
  `dttStarted` datetime NOT NULL,
  `dttDisabled` datetime DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  `dttCompleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_project`
--

LOCK TABLES `pms_project` WRITE;
/*!40000 ALTER TABLE `pms_project` DISABLE KEYS */;
INSERT INTO `pms_project` VALUES (1,1,1,'Kollsoft | Mão e Formão','mao-formao-kollsoft','2017-05-31 16:27:19',NULL,NULL,NULL),(2,1,1,'Safanelli | Priorize','safanelli-priorize','2017-06-05 12:58:59',NULL,NULL,NULL),(3,1,1,'Império Estofados | Advance','imperio-estofados-advance','2017-06-05 13:00:16',NULL,NULL,NULL),(4,1,1,'UVIM | Indusoft','uvim-indusoft','2017-06-05 13:01:10',NULL,NULL,NULL),(5,1,1,'Grid Sistemas','grid-sistemas','2017-06-05 13:04:27',NULL,NULL,NULL),(6,1,1,'Ventisol | Sankhya','ventisol-sankhya','2017-06-05 13:04:57',NULL,NULL,NULL);
/*!40000 ALTER TABLE `pms_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_proposal`
--

DROP TABLE IF EXISTS `pms_proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_proposal` (
  `id` int(11) NOT NULL,
  `fkProject` int(11) NOT NULL,
  `chrCode` char(32) NOT NULL,
  `txtDescription` text,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_proposal`
--

LOCK TABLES `pms_proposal` WRITE;
/*!40000 ALTER TABLE `pms_proposal` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_proposal_group`
--

DROP TABLE IF EXISTS `pms_proposal_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_proposal_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkProposal` int(11) unsigned NOT NULL,
  `chrTitle` char(128) NOT NULL,
  `vrcSummary` varchar(2048) DEFAULT NULL,
  `txtDescription` text,
  `dttDeleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_proposal_group`
--

LOCK TABLES `pms_proposal_group` WRITE;
/*!40000 ALTER TABLE `pms_proposal_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_proposal_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_proposal_item`
--

DROP TABLE IF EXISTS `pms_proposal_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_proposal_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkProposal` int(11) unsigned NOT NULL,
  `fkGroup` int(11) unsigned NOT NULL,
  `chrTitle` char(128) NOT NULL,
  `vrcSummary` varchar(2048) DEFAULT NULL,
  `intTime` int(11) NOT NULL,
  `dttDeleted` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_proposal_item`
--

LOCK TABLES `pms_proposal_item` WRITE;
/*!40000 ALTER TABLE `pms_proposal_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_proposal_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_status`
--

DROP TABLE IF EXISTS `pms_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vrcName` varchar(255) NOT NULL,
  `vrcAlias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_status`
--

LOCK TABLES `pms_status` WRITE;
/*!40000 ALTER TABLE `pms_status` DISABLE KEYS */;
INSERT INTO `pms_status` VALUES (1,'Register','register'),(2,'Schedule','shedule'),(3,'Homologation','homologation'),(4,'Complete','complete');
/*!40000 ALTER TABLE `pms_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pms_tasks`
--

DROP TABLE IF EXISTS `pms_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pms_tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fkProject` int(11) unsigned NOT NULL,
  `txtDescription` text NOT NULL,
  `dttCreated` datetime NOT NULL,
  `dttUpdated` datetime NOT NULL,
  `dttEStart` datetime NOT NULL,
  `dttEEnd` datetime NOT NULL,
  `dttStart` datetime DEFAULT NULL,
  `dttEnd` datetime DEFAULT NULL,
  `dttDeleted` datetime DEFAULT NULL,
  `dttCompleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_tasks`
--

LOCK TABLES `pms_tasks` WRITE;
/*!40000 ALTER TABLE `pms_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sample'
--
/*!50003 DROP FUNCTION IF EXISTS `fnRadius` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fnRadius`(
	x1 DECIMAL(13,7), 
    y1 DECIMAL(13,7),
	x2 DECIMAL(13,7), 
    y2 DECIMAL(13,7)
) RETURNS decimal(10,2)
BEGIN
	DECLARE c DECIMAL(13, 12);
	DECLARE z DECIMAL(13, 6);
    
	RETURN 
        6371 * 
		ACOS( 
			COS( RADIANS( y2 ) ) * COS( RADIANS( y1 ) ) * 
			COS( RADIANS( x1 ) -  RADIANS( x2 ) ) + 
			SIN( RADIANS( y2 ) ) * SIN( RADIANS( y1) ) 
		);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-03  1:56:37
