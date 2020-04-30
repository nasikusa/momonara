-- MySQL dump 10.13  Distrib 5.6.37, for Linux (x86_64)
--
-- Host: localhost    Database: ex_momo_db
-- ------------------------------------------------------
-- Server version	5.6.37

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
-- Table structure for table `folfols`
--

DROP TABLE IF EXISTS `folfols`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folfols` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folfols`
--

LOCK TABLES `folfols` WRITE;
/*!40000 ALTER TABLE `folfols` DISABLE KEYS */;
/*!40000 ALTER TABLE `folfols` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `article_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (4,1,'d7KLlBh62jXXJPfSwlezMRcu6wmPQD7iIbJVMq4B.gif','2017-12-19 14:24:57','2017-12-19 14:24:57','1'),(5,1,'4VTnAlw6ISJfPdCuFiahaiAhlBOrEyNbxiJG1C8h.jpeg','2017-12-19 19:19:38','2017-12-19 19:19:38','4'),(6,1,'BLYzZgNY3TYJBcqWA3yNyRHNtb6PRkE94bCLQruS.jpeg','2017-12-19 19:30:38','2017-12-19 19:30:38','4'),(7,11,'abuM2BfJ2R2rkKQxN4ofV69bByeNjELPNQP6Naj8.gif','2017-12-19 22:21:26','2017-12-19 22:21:26','5');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_12_13_055711_create_momo2s_table',1),(4,'2017_12_13_072711_create_papers_table',1),(5,'2017_12_13_072737_create_folfols_table',1),(6,'2017_12_13_072900_create_likes_table',1),(7,'2017_12_13_072911_create_stocks_table',1),(8,'2017_12_19_225630_create_images_table',2),(9,'2017_12_20_073411_add_article_id_to_images_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `momo2s`
--

DROP TABLE IF EXISTS `momo2s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `momo2s` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `momo2s`
--

LOCK TABLES `momo2s` WRITE;
/*!40000 ALTER TABLE `momo2s` DISABLE KEYS */;
/*!40000 ALTER TABLE `momo2s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `papers`
--

LOCK TABLES `papers` WRITE;
/*!40000 ALTER TABLE `papers` DISABLE KEYS */;
INSERT INTO `papers` VALUES (1,'【Blender】現在の3Dビュー視点位置にカメラを移動させるショートカット（メモ）',1,'**ctrl + alt + ナムパッドの0**で3Dビューの位置へカメラを移動できます。\n        ![image1](/storage/images/d7KLlBh62jXXJPfSwlezMRcu6wmPQD7iIbJVMq4B.gif)\n        結構よく使う印象です。',0,'2017-12-18 03:14:23','2017-12-19 14:38:06'),(2,'【Blender】法線の表示をする方法',3,'例として、球状のメッシュを用意しました。\n\nこのメッシュの**法線**を表示してみます。\n![image6](https://arusato.net/momonara/wp-content/uploads/2017/10/hou1.jpg)\nまずは、**tab** か ボタンから「**編集モード**」に移行します。\n\nボタンから移行する場合は下の画像を参考にしてください。\n\n![image7](https://arusato.net/momonara/wp-content/uploads/2017/10/hou2.jpg)\nN キーを押して現れるエリアのなかに法線を表示する設定があります。\n\n![image8](https://arusato.net/momonara/wp-content/uploads/2017/10/hou3.jpg)\n**頂点法線、辺法線、面法線**を表示することが出来ます。\n\nまた、サイズから表示される法線の大きさを変えることが出来ます。\n\n(このパラメーターをいじっても法線自体が変わるわけではありません。ただ単に、表示の大きさを変えるだけのものです。)\n![image9](https://arusato.net/momonara/wp-content/uploads/2017/10/hou4.jpg)\n\n面法線が表示された状態\ngifアニメで動作を確認してみます。頂点→辺→面の順番で法線の表示のチェックを入れていきます。また、最後に面法線の表示のサイズの変更を行っています。\n![image10](https://arusato.net/momonara/wp-content/uploads/2017/10/houhou.gif)',0,'2017-12-18 04:05:01','2017-12-18 04:05:01'),(3,'【Blender】細分割曲面モディファイアを使用しつつ、辺をくっきりさせる',2,'まず例として、普通の立方体に**細分割曲面モディファイア**をかけてみます（ビューは3に設定しました）。\n![image2](https://arusato.net/momonara/wp-content/uploads/2017/10/henda1.jpg)\n![image3](https://arusato.net/momonara/wp-content/uploads/2017/10/henda3.gif)\n\nモディファイアではない通常の**「細分化（w → 細分化)」**をして面数を増やしてみると、細分割曲面モディファイアの結果が変わっていることがわかります。\n\n![image4](https://arusato.net/momonara/wp-content/uploads/2017/10/hendada2.gif)\n**ctrl + R** で分割すると、このように一部だけエッジを強調することが出来ます。\n![image5](https://arusato.net/momonara/wp-content/uploads/2017/10/henndadada1.gif)\n\n\nまた、辺や面を選択した状態で、**shift + e ( もしくは ctrl + e → 「辺のクリース」でも可能）から、クリース**を設定することが出来ます。\n\nまた、クリースはNボタンで開くことが出来るエリアの「トランスフォーム」にも設定できる箇所があります。\n![image6](https://arusato.net/momonara/wp-content/uploads/2017/10/hendadada.gif)',0,'2017-12-18 04:28:14','2017-12-18 04:28:14'),(4,'MMDでエフェクトを使用する方法の解説',1,'### MMDのエフェクトとは\r\nMMDでエフェクトを使用する場合は、**舞力介入P**が作成された「**MikuMikuEffect**」を使用する必要があります。\r\nよく略されて「**MME**」と呼ばれます（こちらのほうが馴染みがあるかもしれません）\r\n\r\nダウンロードは[こちら](https://bowlroll.net/file/35013)から行うことが出来ます。\r\n\r\nダウンロードしたzipファイルを解答すると、このようになっています( 2017/12/20現在 )\r\n\r\n![image1](/storage/images/4VTnAlw6ISJfPdCuFiahaiAhlBOrEyNbxiJG1C8h.jpeg)\r\n\r\nそして、ダウンロードしたファイルをそのまま、MMDの実行ファイルのある場所へペーストします。\r\n\r\n![image2](/storage/images/BLYzZgNY3TYJBcqWA3yNyRHNtb6PRkE94bCLQruS.jpeg)\r\n\r\nこれだけでMMDでエフェクトを使用することが出来るようになります。\r\n簡単ですね。',0,'2017-12-19 20:23:51','2017-12-19 20:23:51'),(6,'【Blender】座標系を変更するショートカット(メモ）',11,'**alt + space** でメニューを出すことが出来るので、自分が見たい座標系を選択します。\r\n\r\n![image1](/storage/images/abuM2BfJ2R2rkKQxN4ofV69bByeNjELPNQP6Naj8.gif)\r\n\r\n座標系を順に変更している様子\r\n\r\n以下の動画にて、詳しい解説を行っています。よければ御覧ください。\r\n\r\n[Blender入門】座標系について ( グローバル・ローカル・ノーマル )](https://www.youtube.com/watch?v=YdAmswPY51E)\r\n更新しました',0,'2017-12-19 22:59:55','2017-12-19 23:30:28');
/*!40000 ALTER TABLE `papers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'youkan','youkan94@gmail.com','$2y$10$UyvKVhtNQxTpqpBNmXEwUugoPOCpbw1F36YJOiLa35yQA/B/ayT6O','breKqUzuENaqvdGWG12v3jKXkH4esairLwn9nkFvKasuZmeKll0DJ8kbNhV8','2017-12-18 13:32:05','2017-12-18 13:32:05'),(2,'sarukani','example2@gmail.com','$2y$10$7r2tVdzcEyO11ZhtG5BeXuLZsYe3TJibeg8xfjwh8N/MlOi2.Lgty','0JngiipvsnVIzA4xP5y8CWlMk3tVYaVfmzD3LEyASp9MR0jICHDyVPQ4K9uo','2017-12-18 13:32:37','2017-12-18 13:32:37'),(3,'onitaiji','example3@gmail.com','$2y$10$yLGsx9jaa3raJ42RRq1wOeiWIdIDOZzGPX5cA93CgQ69J2S0x6mzW','jqBbPgofr01YxPWTnJ3V7OsU430qsJ6SYv9X2EQOHE01c0hw6boCCZnyiY0i','2017-12-18 13:33:06','2017-12-18 13:33:06'),(4,'momotaro','example4@gmail.com','$2y$10$gbcJYmIYpSs.4iTXrcnUdeCivdhKO6moYmlX9juBFW7kqVe9KDnPm','3urKepeaFC3oiugr184AHzi2S1CDGMhBUpBhpoSo3QUQhUcwrRcPTdl849jz','2017-12-18 13:33:34','2017-12-18 13:33:34'),(5,'hanasaka','example5@gmail.com','$2y$10$ERwPtrf6bDSUIJk8yL6gR.DBrcCdzFxA3DQTtoOnRoKFb6gDbuLii','6Xr20hNo8uN6lafEWBUqAn8enh4X7zwQNRF4PlZZabSmskrgMz7ytZG9Htyt','2017-12-18 13:34:07','2017-12-18 13:34:07'),(6,'takarajima','example6@gmail.com','$2y$10$SuzJ9.F6Rx1YoqalzsRkm.Cw.hQa377yrdST6IJ5HFaVH2uSKEvzW','3coUkROgLwOzto3EUiuO1ndiZwfiFkmMvg2C45PcmjxtCQQVYZuNGY4Uc5Kg','2017-12-18 13:34:33','2017-12-18 13:34:33'),(7,'turu','example7@gmail.com','$2y$10$Oci5Qf5IlofaK7UBp5Jof.Y3W5jzqSXUYB45K9RDXs5U4G07HxqTC','sh5fsH6uqambXavYzTLCaHdp34SgkMzJ6NufaAyKTasjVDUyIJUFP511ayQp','2017-12-18 13:35:05','2017-12-18 13:35:05'),(8,'kintaro','example8@gmail.com','$2y$10$6WlxmIzGAzJhuH1q.9x4U.ZNNVXmeIFHnrf6Sc1Z00LCWrSeq8Kku','RFofBSSgz5EuqMBaMSPjo0B9tZfFUBJzSiRo8a8E5Jup93N2o7S4gP6qRryT','2017-12-18 13:35:33','2017-12-18 13:35:33'),(9,'akaoni','example9@gmail.com','$2y$10$VQOgbSQwcqc7.mliIDVFyeKCxn3XcE8/qe9PXhNobZvksXDSLTnIO','mwtmC9LZbwNfBPW983m4BwhFLBTxjW4r0oUxQU0BKCQ67ntoBZ9tiSmqAR9M','2017-12-18 13:35:59','2017-12-18 13:35:59'),(10,'suzume','example10@gmail.com','$2y$10$aijpXRK2ncRiXuVMsGizZ.mEOm19LwHxSD2GAYDfz46DwkR4dK2i2','qIcmEBYRgO897wSP1c8cXYYjniDWj5bxfJXEbO0wIy8c55cJTU8MjEyLwz2j','2017-12-18 13:36:25','2017-12-18 13:36:25'),(11,'houseki_no_kuni','example11@gmail.com','$2y$10$o7GZEZnaC/Vogivu8lsWJOCwXq2dql3jHcJqDI/UllmGb1bOsb5uG',NULL,'2017-12-19 22:17:30','2017-12-19 22:17:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-20  8:51:43
