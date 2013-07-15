#
# Table structure for table 'tx_abcourses_course_categorie_mm'
# ## WOP:[tables][1][fields][19][conf_relations_mm]
#
CREATE TABLE tx_abcourses_course_categorie_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_course_type_mm'
# ## WOP:[tables][1][fields][3][conf_relations_mm]
#
CREATE TABLE tx_abcourses_course_type_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_course_trainers_mm'
# ## WOP:[tables][1][fields][10][conf_relations_mm]
#
CREATE TABLE tx_abcourses_course_trainers_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_course_conditionsref_mm'
# ## WOP:[tables][1][fields][18][conf_relations_mm]
#
CREATE TABLE tx_abcourses_course_conditionsref_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_abcourses_course'
#
CREATE TABLE tx_abcourses_course (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	number tinytext NOT NULL,
	title tinytext NOT NULL,
	subtitle tinytext NOT NULL,
	categorie int(11) DEFAULT '0' NOT NULL,
	type int(11) DEFAULT '0' NOT NULL,
	teachingaids int(11) DEFAULT '0' NOT NULL,
	teaser text NOT NULL,
	description text NOT NULL,
	seodesc text NOT NULL,
  keywords tinytext NOT NULL,
	pages blob NOT NULL,
	files tinyblob NOT NULL,
	trainers int(11) DEFAULT '0' NOT NULL,
	skilllevel int(11) DEFAULT '0' NOT NULL,
	edupoints int(11) DEFAULT '0' NOT NULL,
	days int(11) DEFAULT '0' NOT NULL,
	contingent int(11) DEFAULT '0' NOT NULL,
	conditions text NOT NULL,
	conditionsref int(11) DEFAULT '0' NOT NULL,
	cost tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_abcourses_type'
#
CREATE TABLE tx_abcourses_type (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	typename tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_abcourses_teachingaids'
#
CREATE TABLE tx_abcourses_teachingaids (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	name tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);


#
# Table structure for table 'tx_abcourses_course_teachingaids_mm'
# ## WOP:[tables][1][fields][3][conf_relations_mm]
#
CREATE TABLE tx_abcourses_course_teachingaids_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_event_course_mm'
# ## WOP:[tables][4][fields][4][conf_relations_mm]
#
CREATE TABLE tx_abcourses_event_course_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_event_trainer_mm'
# ## WOP:[tables][4][fields][7][conf_relations_mm]
#
CREATE TABLE tx_abcourses_event_trainer_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_event_participants_mm'
# ## WOP:[tables][4][fields][8][conf_relations_mm]
#
CREATE TABLE tx_abcourses_event_participants_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_abcourses_event_location_mm'
# ## WOP:[tables][4][fields][9][conf_relations_mm]
#
CREATE TABLE tx_abcourses_event_location_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_abcourses_event'
#
CREATE TABLE tx_abcourses_event (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	starttime int(11) DEFAULT '0' NOT NULL,
	endtime int(11) DEFAULT '0' NOT NULL,
	event tinytext NOT NULL,
	regstart int(11) DEFAULT '0' NOT NULL,
	regend int(11) DEFAULT '0' NOT NULL,
	course int(11) DEFAULT '0' NOT NULL,
	coursestart int(11) DEFAULT '0' NOT NULL,
	firstdaytimestart int(11) DEFAULT '0' NOT NULL,
	firstdaytimeend int(11) DEFAULT '0' NOT NULL,
	courseend int(11) DEFAULT '0' NOT NULL,
	lastdaytimestart int(11) DEFAULT '0' NOT NULL,
	lastdaytimeend int(11) DEFAULT '0' NOT NULL,
	trainer int(11) DEFAULT '0' NOT NULL,
	participants int(11) DEFAULT '0' NOT NULL,
	location int(11) DEFAULT '0' NOT NULL,
	discount tinyint(3) DEFAULT '0' NOT NULL,
	discountvalue tinytext NOT NULL,
	lastminute tinyint(3) DEFAULT '0' NOT NULL,
	contingent int(11) DEFAULT '0' NOT NULL,
	subscriptions int(11) DEFAULT '0' NOT NULL,
	arrangement int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);


#
# Table structure for table 'tx_abcourses_event_arrangement_mm'
# ## WOP:[tables][5][fields][9][conf_relations_mm]
#
CREATE TABLE tx_abcourses_event_arrangement_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_abcourses_location_informations_mm'
# ## WOP:[tables][5][fields][9][conf_relations_mm]
#
CREATE TABLE tx_abcourses_location_informations_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_abcourses_location'
#
CREATE TABLE tx_abcourses_location (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	street tinytext NOT NULL,
	zip tinytext NOT NULL,
	city tinytext NOT NULL,
	phone tinytext NOT NULL,
	fax tinytext NOT NULL,
	email tinytext NOT NULL,
	person tinytext NOT NULL,
	informations int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_abcourses_categorie'
#
CREATE TABLE tx_abcourses_categorie (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	teaser text NOT NULL,
	image blob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tt_address_tx_abcourses_courses_mm'
# ## WOP:[fields][1][fields][4][conf_relations_mm]
#
CREATE TABLE tt_address_tx_abcourses_courses_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_abcourses_hotel'
#
CREATE TABLE tx_abcourses_hotel (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	name tinytext NOT NULL,
	subtitle tinytext NOT NULL,
	link tinytext NOT NULL,
	image blob NOT NULL,
	rating int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_abcourses_arrangement'
#
CREATE TABLE tx_abcourses_arrangement (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	starttime int(11) DEFAULT '0' NOT NULL,
	endtime int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	backendname tinytext NOT NULL,
	frontendname tinytext NOT NULL,
	hotel int(11) DEFAULT '0' NOT NULL,
	price tinytext NOT NULL

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_abcourses_hotel_arrangement_mm'
# ## WOP:[tables][5][fields][9][conf_relations_mm]
#
CREATE TABLE tx_abcourses_arrangement_hotel_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tt_address'
#
CREATE TABLE tt_address (
	tx_abcourses_tnumber tinytext NOT NULL,
	tx_abcourses_position tinytext NOT NULL,
	tx_abcourses_courses int(11) DEFAULT '0' NOT NULL
);



#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_abcourses_type int(11) DEFAULT '0' NOT NULL
);
