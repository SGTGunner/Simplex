<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');

$sql = "CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `award_image_link` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `award_about` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(222) NOT NULL,
  `year` varchar(222) NOT NULL,
  `month` varchar(222) NOT NULL,
  `time` varchar(222) NOT NULL,
  `location` varchar(222) NOT NULL,
  `event_title` text NOT NULL,
  `description` varchar(222) NOT NULL,
  `about_event` text NOT NULL,
  `image` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `event_signup` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `event_title` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_title` (`event_title`)
);";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `navbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "INSERT INTO `navbar` (`id`, `link`, `title`) VALUES
(1, '/events', 'Events'),
(4, '/roster', 'Roster'),
(5, '/awards', 'Awards');";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `navbar_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `date` varchar(222) NOT NULL,
  `puser` varchar(222) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `roster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `about_internal` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `brand` varchar(222) NOT NULL,
  `copyright` varchar(222) NOT NULL,
  `teamspeak` varchar(222) NOT NULL,
  `system` varchar(222) NOT NULL,
  `events` varchar(44) NOT NULL,
  `donate` varchar(44) NOT NULL,
  `gallery` varchar(44) NOT NULL,
  `serverip` varchar(3333) NOT NULL,
  `port` varchar(3333) NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
$sql = "INSERT INTO `settings` (`id`, `title`, `brand`, `copyright`, `teamspeak`, `system`, `events`, `donate`, `gallery`, `serverip`, `port`) VALUES
(1, 'Simplex v3', 'Brand', 'Sitename copyright', 'true', 'arma', 'true', 'true', 'true', '', '');";
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `last_seen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rank` varchar(222) NOT NULL,
  `unit` varchar(222) NOT NULL,
  `position` varchar(222) NOT NULL,
  `status` varchar(222) NOT NULL,
  `user_avt` varchar(222) NOT NULL,
  `bio` text NOT NULL,
  `gender` varchar(222) NOT NULL,
  `birthday` varchar(222) NOT NULL,
  `website` text NOT NULL,
  `location` varchar(222) NOT NULL,
  `occupation` varchar(222) NOT NULL,
  `admin` varchar(222) NOT NULL,
  `steam` varchar(222) NOT NULL,
  `facebook` varchar(222) NOT NULL,
  `twitter` varchar(222) NOT NULL,
  `youtube` varchar(222) NOT NULL,
  `instagram` varchar(222) NOT NULL,
  `twitch` varchar(222) NOT NULL,
  `skype` varchar(222) NOT NULL,
  `github` varchar(222) NOT NULL,
  `googleplus` varchar(222) NOT NULL,
  `pinterest` varchar(222) NOT NULL,
  `tumblr` varchar(222) NOT NULL,
  `year` varchar(222) NOT NULL,
  `month` varchar(222) NOT NULL,
  `day` varchar(222) NOT NULL,
  `games` text NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysqli_query($conn,$sql);
//
$sql = 'INSERT INTO `users` (`id`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `last_seen`, `rank`, `unit`, `position`, `status`, `user_avt`, `bio`, `gender`, `birthday`, `website`, `location`, `occupation`, `admin`) VALUES
(1, "Admin", "$2y$10$zrvx5mgvQgORCLOIL.rdPeXwCPqRO71DgfTuqMC.W/PHhKFnbVUq2", "SITEEMAIL", "Yes", NULL, "No", "2015-06-11 00:33:20", "", "", "", "Active", "", "", "Unspecified", "", "", "", "", "true");';
mysqli_query($conn,$sql);
//
$sql = "CREATE TABLE IF NOT EXISTS `user_awards`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `award_link` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);";
mysqli_query($conn,$sql);
//
?>
