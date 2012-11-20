#GIVEN TEST


### MySQL Database

CREATE DATABASE `imdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `imdb`;

CREATE TABLE `imdb_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL,
  `rank` smallint(3) NOT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `votes` int(11) NOT NULL DEFAULT '0',
  `datestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

### Setup project

Set the Database connection settings in /conf/config.php

## First launch

To see result, for the first time you should run an IMDB top 10 updater script. You should run from the web browser call my_project_root/index.php?fnc=updatearchive
For example, if we are working on localhost in root directory "imdb", the following will be
http://localhost/imdb/index.php?fnc=updatearchive

To see results page, just launch the projects root page.

