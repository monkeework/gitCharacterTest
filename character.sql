SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `character` (
	`characterID` int(11) NOT NULL AUTO_INCREMENT,

	`character_type_id` int(11) NOT NULL,
	`time_created` int(11) NOT NULL,
	`time_updated` int(11) NOT NULL,
	`characterType` int(11) NOT NULL,

	`firstName` varchar(255) NOT NULL,
	`lastName` varchar(255) NOT NULL,
	`codeName` varchar(255) NOT NULL,
	`characterAlignment` varchar(255) NOT NULL,
	`characterPower` varchar(255) NOT NULL,
	`characterAffiliation` varchar(255) NOT NULL,
	PRIMARY KEY (`characterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `character` (`characterID`, `character_type_id`, `time_created`, `time_updated`, `firstName`, `lastName`, `codeName`, `characterAlignment`, `characterPower`, `characterAffiliation`) VALUES
(1, 3, 762483360, 0, 'Billy', 'Kaplan', 'Wiccan', 'Goody Two Shoes', 'GaryStewness', 'Young Avengers');

INSERT INTO `character` (`characterID`, `character_type_id`, `time_created`, `time_updated`, `firstName`, `lastName`, `codeName`, `characterAlignment`, `characterPower`, `characterAffiliation`) VALUES
(2, 2, 762483360, 0, 'Teddy', 'Altman', 'Hulkling', 'Naughty Good', 'Metamorph', 'Young Avengers');

INSERT INTO `character` (`characterID`, `character_type_id`, `time_created`, `time_updated`, `firstName`, `lastName`, `codeName`, `characterAlignment`, `characterPower`, `characterAffiliation`) VALUES
(3, 1, 762483360, 0, 'Tommy', 'Sheppard', 'Speed', 'Sort of Good', 'Speedster', 'Young Avengers');


CREATE TABLE IF NOT EXISTS `location` (
	`location_id` int(11) NOT NULL AUTO_INCREMENT,
	`city_name` varchar(255) NOT NULL,
	`city_latitude` double NOT NULL,
	`city_longitude` double NOT NULL,
	`subdivision_name` varchar(255) NOT NULL,
	`postal_code` varchar(20) NOT NULL,
	PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `location` (`location_id`, `city_name`, `city_latitude`, `city_longitude`, `subdivision_name`, `postal_code`) VALUES
(1, 'Townsville', 38.7153408676386, -75.0866805016994, 'State', '12345'),
(2, 'Villageland', 33.1156463623047, -117.120277404785, 'Region', '67890'),
(3, 'Hamlet', 43.6666296, -92.9746367, 'Territory', '34567'),
(4, 'Redwood City', 37.5311965942383, -122.2646484375, 'California', '94065');
