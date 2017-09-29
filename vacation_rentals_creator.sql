# Vacation Rental Database
# Lauren Egerton and Joseph DePrey
# CS 340 / Fall 2016
# Final Project

# Drop tables queries
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `hosts`;
DROP TABLE IF EXISTS `guests`;
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `properties`;
DROP TABLE IF EXISTS `wishlists`;
DROP TABLE IF EXISTS `wishlist_props`;
DROP TABLE IF EXISTS `property_type`;
SET FOREIGN_KEY_CHECKS=1;

# `hosts`
# Hosts of the vacation properties
CREATE TABLE `hosts`(
	host_id INT NOT NULL AUTO_INCREMENT,
	fname VARCHAR(255) NOT NULL,
	lname VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	PRIMARY KEY (host_id),
	UNIQUE KEY (fname, lname, email)
)ENGINE=InnoDB;

# add constraint `hosts`
ALTER TABLE hosts ADD CONSTRAINT hosts UNIQUE (fname, lname);

# `guests`
# Guests who book vacation properties
CREATE TABLE `guests`(
	guest_id INT NOT NULL AUTO_INCREMENT,
	fname VARCHAR(255) NOT NULL,
	lname VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	PRIMARY KEY (guest_id),
	UNIQUE KEY (fname, lname, email)
	UNIQUE (fname, lname)
)ENGINE=InnoDB;

# add constraint `guests`
ALTER TABLE guests ADD CONSTRAINT guests UNIQUE (fname, lname);

#`property_type`
# Each property maps to one type only; one-to-many (type to property)
CREATE TABLE `property_type`(
	type_id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY (type_id),
	UNIQUE KEY (name)
)ENGINE=InnoDB;

# `properties`
# Properties, or the vacation rentals; many-to-one (property and host)
CREATE TABLE `properties`(
	prop_id INT NOT NULL AUTO_INCREMENT,
	type_id INT,
	st_address VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
	state VARCHAR(255) NOT NULL,
	zip VARCHAR(10) NOT NULL,
	daily_cost DECIMAL(7,2),
	description TEXT,
	host_id INT,
	PRIMARY KEY (prop_id),
	FOREIGN KEY (host_id) REFERENCES hosts (host_id),
	FOREIGN KEY (type_id) REFERENCES property_type (type_id),
	UNIQUE KEY (st_address, city, state, zip, daily_cost)
)ENGINE=InnoDB;

# `bookings`
# Transaction when a guest books a property; one-to-many (guest and booking)
CREATE TABLE `bookings`(
	booking_id INT NOT NULL AUTO_INCREMENT,
	beg_date DATE,
	end_date DATE,
	total_cost DECIMAL(7,2),
	prop_id INT,
	guest_id INT,
	PRIMARY KEY (booking_id),
	FOREIGN KEY (guest_id) REFERENCES guests (guest_id),
	FOREIGN KEY (prop_id) REFERENCES properties (prop_id),
	UNIQUE KEY (beg_date, end_date, total_cost)
)ENGINE=InnoDB;

# `wishlists`
# Wish lists of each guest; many-to-one (wishlist and guest)
CREATE TABLE `wishlists`(
	list_id INT NOT NULL AUTO_INCREMENT,
	listname VARCHAR(255) NOT NULL,
	guest_id INT,
	PRIMARY KEY (list_id),
	FOREIGN KEY (guest_id) REFERENCES guests (guest_id),
	UNIQUE KEY (listname)
)ENGINE=InnoDB;

# `wishlist_props`
# Properties in each wish list; many-to-many (wishlist and property)
CREATE TABLE `wishlist_props`(
	prop_id INT,
	list_id INT,
	PRIMARY KEY (prop_id, list_id)
)ENGINE=InnoDB;

# add constraint 'wishlists'
ALTER TABLE wishlists ADD CONSTRAINT wishlists UNIQUE (listname, guest_id);




