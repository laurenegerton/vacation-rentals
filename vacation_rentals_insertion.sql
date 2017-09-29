# Vacation Rental Database
# Lauren Egerton and Joseph DePrey
# CS 340 / Fall 2016
# Final Project

# The data below was inserted in to the database before the user has access to the website.

# property_type (6)
INSERT INTO property_type (name) VALUES ('apartment'); 	#1
INSERT INTO property_type (name) VALUES ('house'); 		#2
INSERT INTO property_type (name) VALUES ('villa'); 		#3
INSERT INTO property_type (name) VALUES ('cabin'); 		#4
INSERT INTO property_type (name) VALUES ('treehouse');	#5
INSERT INTO property_type (name) VALUES ('tent');		#6

# hosts (15)
INSERT INTO hosts (fname, lname, email) VALUES ('Reid', 'Cutshaw', 'Reid.Cutshaw@gmail.com'); 		#1
INSERT INTO hosts (fname, lname, email) VALUES ('Rema', 'Luz', 'Rema.Luz@outlook.com');				#2
INSERT INTO hosts (fname, lname, email) VALUES ('Kendrick', 'Montano', 'K.Montano@gmail.com');		#3
INSERT INTO hosts (fname, lname, email) VALUES ('Marissa', 'Luick', 'Marissa.Luick@gmail.com');		#4
INSERT INTO hosts (fname, lname, email) VALUES ('Katelin', 'Boston', 'KateB@gmail.com');			#5
INSERT INTO hosts (fname, lname, email) VALUES ('Candra', 'Headley', 'CHeadley@outlook.com');		#6
INSERT INTO hosts (fname, lname, email) VALUES ('Percy', 'Branton', 'PercyBranton@yahoo.com');		#7
INSERT INTO hosts (fname, lname, email) VALUES ('Rolanda', 'Benitez', 'R.Benitez@gmail.com');		#8
INSERT INTO hosts (fname, lname, email) VALUES ('Harley', 'Catlett', 'Harley.Catlett@outlook.com');	#9
INSERT INTO hosts (fname, lname, email) VALUES ('Zandra', 'Mummert', 'ZandraMumm@gmail.com');		#10
INSERT INTO hosts (fname, lname, email) VALUES ('Teddy', 'Emert', 'EmertyT@hotmail.com');			#11
INSERT INTO hosts (fname, lname, email) VALUES ('Gil', 'Minns', 'Gil.Minns@yahoo.com');				#12
INSERT INTO hosts (fname, lname, email) VALUES ('Kristopher', 'Mucci', 'Kris.Mucci@outlook.com');	#13
INSERT INTO hosts (fname, lname, email) VALUES ('Usha', 'Judge', 'UshaJ@gmail.com');				#14
INSERT INTO hosts (fname, lname, email) VALUES ('Karly', 'Lechler', 'Karly.Lechler@gmail.com');		#15

# properties (20)
#1 - Reid
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '4490 Bell St.', 'Manhattan', 'NY', '10024', 287, 'Sunny loft near Central Park',
	(SELECT host_id FROM hosts WHERE fname='Reid'));	
#2 - Reid
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '3141 Church St.', 'Brooklyn', 'NY', '11209', 148, '30 minutes to Manhattan',
	(SELECT host_id FROM hosts WHERE fname='Reid'));	
#3 - Rema
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '2594 Rosa Lane', 'San Francisco', 'CA', '94115', 226, 'Pacific Heights Victorian Flat',
	(SELECT host_id FROM hosts WHERE fname='Rema'));
#4 - Kendrick
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '275 Longbranch Rd.', 'Chicago', 'IL', '60614', 138, 'Spectacular Lincoln Park Garden Apt',
	(SELECT host_id FROM hosts WHERE fname='Kendrick'));
#5 - Marissa
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '64 Thatcher St.', 'Seattle', 'WA', '98101', 130, 'Pike Place Market Downtown Apt',
	(SELECT host_id FROM hosts WHERE fname='Marissa'));
#6 - Katelin
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '571 Ashcraft Court', 'San Diego', 'CA', '92102', 64, 'Cool Casita in South Park',
	(SELECT host_id FROM hosts WHERE fname='Katelin'));
#7 - Candra
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '3741 Adams Dr.', 'Houston', 'TX', '77003', 175, 'Updated House Close to Everything',
	(SELECT host_id FROM hosts WHERE fname='Candra'));
#8 - Rema 
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '2746 Roosevelt St.', 'San Francisco', 'CA', '94110', 411, 'Sunny, Clean, Great Location',
	(SELECT host_id FROM hosts WHERE fname='Rema'));
#9 - Percy
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '4408 Clearview Dr.', 'Boulder', 'CO', '80302', 425, 'Central Boulder Home with Spectacular Views',
	(SELECT host_id FROM hosts WHERE fname='Percy'));
#10 - Rolanda
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '317 Adonais Way', 'Atlanta', 'GA', '30310', 110, 'Awesome home in quiet area',
	(SELECT host_id FROM hosts WHERE fname='Rolanda'));
#11 - Harley
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '410 Baltimore Ave.', 'Philadelphia', 'PA', '19130', 750, 'Charming Spruce Hill Home',
	(SELECT host_id FROM hosts WHERE fname='Harley'));
#12 - Zandra
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='villa'), '580 Ocean Dr.', 'Miami Beach', 'FL', '33139', 1999, '3BR Villa with Ocean View',
	(SELECT host_id FROM hosts WHERE fname='Zandra'));
#13 - Zandra
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='villa'), '86 Roma Ct.', 'Venice', 'CA', '90291', 990, 'Venice Architectural Villa Beach House',
	(SELECT host_id FROM hosts WHERE fname='Zandra'));
#14 - Teddy
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='cabin'), '1257 Duck Pond Rd.', 'Waterford', 'VT', '05819', 120, 'Vermont Cedar Cabin, A Cozy Retreat',
	(SELECT host_id FROM hosts WHERE fname='Teddy'));
#15 - Gil
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='cabin'), '405 Flying Point Rd.', 'Freeport', 'ME', '04034', 100, 'Cozy Cabin near Harbor and Park',
	(SELECT host_id FROM hosts WHERE fname='Gil'));
#16 - Kristopher
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='cabin'), '15 Calhoun St.', 'Bluffton', 'SC', '29910', 85, 'Charming Cabin Built in 1910',
	(SELECT host_id FROM hosts WHERE fname='Kristopher'));
#17 - Candra
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '4965 Ventura Lane', 'Houston', 'TX', '77021', 375, 'Cute Modern House on Light Rail',
	(SELECT host_id FROM hosts WHERE fname='Candra'));
#18 - Usha
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='treehouse'), '144 Salt Creek Rd.', 'Tiller', 'OR', '97484', 175, 'Off the Grid and Forty Feet Up',
	(SELECT host_id FROM hosts WHERE fname='Usha'));
#19 - Usha
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='tent'), '99 Skyline Dr.', 'Cody', 'WY', '82414', 85, 'Canvas Under the Stars',
	(SELECT host_id FROM hosts WHERE fname='Usha'));
#20 - Karly 
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='tent'), '694 Deerview Rd.', 'Asheville', 'NC', '28806', 125, 'Camping with a Hot Tub',
	(SELECT host_id FROM hosts WHERE fname='Karly'));
#21 - Usha
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='treehouse'), '5900 North Shepherd Rd.', 'Washougal', 'OR', '98671', 95, 'Riverside Treehouse',
	(SELECT host_id FROM hosts WHERE fname='Usha'));
#22 - Marissa
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '126 SE Oak St.', 'Portland', 'OR', '97232', 93, 'Comfy Studio Apartment',
	(SELECT host_id FROM hosts WHERE fname='Marissa'));
#23 - Zandra
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '46 S Olive St.', 'Los Angeles', 'CA', '90015', 124, 'Downtown Luxury Loft in Historic District',
	(SELECT host_id FROM hosts WHERE fname='Zandra'));
#24 - Harley
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '52 Walnut St.', 'Philadelphia', 'PA', '19103', 97, 'One BR Retreat in the Heart of Center City',
	(SELECT host_id FROM hosts WHERE fname='Harley'));
#25 - Reid
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '1946 68th Ave.', 'Flushing', 'NY', '11367', 150, 'Gorgeous 2 BR in Queens',
	(SELECT host_id FROM hosts WHERE fname='Reid'));	
#26 - Teddy
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='house'), '52 Chestnut Terrace', 'Burlington', 'VT', '05401', 364, 'Hill Section Executive Home',
	(SELECT host_id FROM hosts WHERE fname='Teddy'));	
#27 - Percy
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '9101 Grove St.', 'Boulder', 'CO', '80302', 135, 'Heart of Boulder Victorian Apt',
	(SELECT host_id FROM hosts WHERE fname='Percy'));
#28 - Kendrick
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '506 Lake St.', 'Chicago', 'IL', '60601', 149, 'Luxury Chicago Skyline Condo',
	(SELECT host_id FROM hosts WHERE fname='Kendrick'));
#29- Marissa
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '1353 11th Ave E', 'Seattle', 'WA', '98102', 125, 'Charming Capitol Hill Condo',
	(SELECT host_id FROM hosts WHERE fname='Marissa'));
#30 - Katelin
INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
	(SELECT type_id FROM property_type WHERE name='apartment'), '209 W Cedar St', 'San Diego', 'CA', '92101', 139, 'Sunny 2BR in Little Italy',
	(SELECT host_id FROM hosts WHERE fname='Katelin'));

# guests (10)
INSERT INTO guests (fname, lname, email) VALUES ('Leticia', 'Massey', 'L.Massey@gmail.com'); 		#1
INSERT INTO guests (fname, lname, email) VALUES ('Opal', 'Phelps', 'opal.phelps@outlook.com'); 		#2
INSERT INTO guests (fname, lname, email) VALUES ('Marguerite', 'West', 'westmarguerite@yahoo.com'); #3
INSERT INTO guests (fname, lname, email) VALUES ('Brian', 'McCoy', 'brian.mccoy@gmail.com'); 		#4
INSERT INTO guests (fname, lname, email) VALUES ('Janet', 'Hogan', 'jhogan@yahoo.com'); 			#5
INSERT INTO guests (fname, lname, email) VALUES ('Scott', 'Ellis', 'ellis.scott@outlook.com'); 		#6
INSERT INTO guests (fname, lname, email) VALUES ('Inez', 'Burkey', 'inezb@gmail.com'); 				#7
INSERT INTO guests (fname, lname, email) VALUES ('Allen', 'Silva', 'allen.silva@gmail.com'); 		#8
INSERT INTO guests (fname, lname, email) VALUES ('Lila', 'Sherman', 'lila.sherman@gmail.com'); 		#9
INSERT INTO guests (fname, lname, email) VALUES ('Gerald', 'Medina', 'geraldm@yahoo.com'); 			#10

# bookings (5)
# 1 - prop_id = 1
INSERT INTO bookings (beg_date, end_date, prop_id, guest_id) VALUES ('2016-12-20', '2016-12-27',  
	(SELECT prop_id FROM properties WHERE description = 'Sunny loft near Central Park'), 
	(SELECT guest_id FROM guests WHERE fname = 'Leticia' && lname = 'Massey'));

UPDATE bookings b
INNER JOIN (SELECT beg_date, end_date, daily_cost FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
WHERE booking_id = 1) AS table1 
SET b.total_cost = (SELECT DATEDIFF(table1.end_date, table1.beg_date)*(table1.daily_cost))
WHERE booking_id = 1;

#2 - prop_id = 2
INSERT INTO bookings (beg_date, end_date, prop_id, guest_id) VALUES ('2017-01-15', '2017-01-18',  
	(SELECT prop_id FROM properties WHERE description = '30 minutes to Manhattan'), 
	(SELECT guest_id FROM guests WHERE fname = 'Opal' && lname = 'Phelps'));

UPDATE bookings b
INNER JOIN (SELECT beg_date, end_date, daily_cost FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
WHERE booking_id = 2) AS table1 
SET b.total_cost = (SELECT DATEDIFF(table1.end_date, table1.beg_date)*(table1.daily_cost))
WHERE booking_id = 2;

#3 - prop_id = 3
INSERT INTO bookings (beg_date, end_date, prop_id, guest_id) VALUES ('2016-12-23', '2016-12-31',  
	(SELECT prop_id FROM properties WHERE description = 'Pacific Heights Victorian Flat'), 
	(SELECT guest_id FROM guests WHERE fname = 'Marguerite' && lname = 'West'));

UPDATE bookings b
INNER JOIN (SELECT beg_date, end_date, daily_cost FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
WHERE booking_id = 3) AS table1 
SET b.total_cost = (SELECT DATEDIFF(table1.end_date, table1.beg_date)*(table1.daily_cost))
WHERE booking_id = 3;

#4 - prop_id = 4
INSERT INTO bookings (beg_date, end_date, prop_id, guest_id) VALUES ('2017-02-10', '2017-02-15',  
	(SELECT prop_id FROM properties WHERE description = 'Spectacular Lincoln Park Garden Apt'), 
	(SELECT guest_id FROM guests WHERE fname = 'Brian' && lname = 'McCoy'));

UPDATE bookings b
INNER JOIN (SELECT beg_date, end_date, daily_cost FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
WHERE booking_id = 4) AS table1 
SET b.total_cost = (SELECT DATEDIFF(table1.end_date, table1.beg_date)*(table1.daily_cost))
WHERE booking_id = 4;

#5 - prop_id = 5
INSERT INTO bookings (beg_date, end_date, prop_id, guest_id) VALUES ('2017-03-05', '2017-03-07',  
	(SELECT prop_id FROM properties WHERE description = 'Pike Place Market Downtown Apt'), 
	(SELECT guest_id FROM guests WHERE fname = 'Scott' && lname = 'Ellis'));

UPDATE bookings b
INNER JOIN (SELECT beg_date, end_date, daily_cost FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
WHERE booking_id = 5) AS table1 
SET b.total_cost = (SELECT DATEDIFF(table1.end_date, table1.beg_date)*(table1.daily_cost))
WHERE booking_id = 5;





