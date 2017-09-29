# Vacation Rental Database
# Lauren Egerton and Joseph DePrey
# CS 340 / Fall 2016
# Final Project


############ Display Property Types ########### ✓
SELECT name
FROM property_type;

############ Display Cities ########### ✓
SELECT DISTINCT city
FROM properties
ORDER BY city;

############ Display Booking IDs ########### ✓
SELECT booking_id
FROM bookings
ORDER BY booking_id

############ ADD HOST ########### ✓

INSERT INTO hosts (fname, lname, email) VALUES ([fname], [lname], [email]);


############ ADD GUEST ########### ✓

INSERT INTO guests (fname, lname, email) VALUES ([fname], [lname], [email]);


############ ADD PROPERTY ########### ✓

INSERT INTO properties (type_id, st_address, city, state, zip, daily_cost, description, host_id) VALUES (
    (SELECT type_id FROM property_type WHERE name = [name]), [st_address], [city], [state], [zip], [daily_cost]
    [description], (SELECT host_id FROM hosts WHERE fname = [fname] && lname = [lname]));


############ SELECT PROPERTY ########### ✓

# show all 
SELECT prop_id, description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
ORDER BY prop_id;

# by description
SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
WHERE p.description = [description];

# by city
SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
WHERE p.city = [city];

# by state
SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
WHERE p.state = [state];

# by daily_cost less than
SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
WHERE p.daily_cost < [daily_cost];

# by property type name
SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
WHERE pt.name = [property_type];


############ DISPLAY WISHLIST ############ ✓
# all wishlists by guest name
SELECT wishlists.list_id as 'ID no.', listname as 'My Wishlists', COUNT(prop_id) AS 'No. of Properties'
FROM wishlists
INNER JOIN guests g ON g.guest_id = wishlists.guest_id
LEFT JOIN wishlist_props wp ON wishlists.list_id = wp.list_id
WHERE g.fname = [fname] && g.lname = [lname];

# all properties in a specific guest's wishlist
SELECT wp.prop_id as 'ID no.', description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM wishlists
INNER JOIN wishlist_props wp ON wp.list_id = wishlists.list_id
INNER JOIN properties p ON p.prop_id = wp.prop_id
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
INNER JOIN guests g ON g.guest_id = wishlists.guest_id
WHERE listname = [listname] && g.fname = [fname] && g.lname = [lname];

# all properties NOT IN a specific guest's wishlist
SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
FROM properties p
INNER JOIN property_type pt ON p.type_id= pt.type_id
INNER JOIN hosts h ON p.host_id = h.host_id
WHERE p.prop_id NOT IN
    (SELECT prop_id FROM wishlist_props wp
    INNER JOIN wishlists w ON w.list_id = wp.list_id
    INNER JOIN guests g on g.guest_id = w.guest_id
    WHERE w.listname = [listname] && g.fname = [fname] && g.lname = [lname])
ORDER BY prop.id;

############ CREATE A BOOKING ############ ✓

INSERT INTO bookings( beg_date, end_date, prop_id, guest_id, total_cost ) 
VALUES ([beg_date],  [end_date], (SELECT prop_id FROM properties WHERE prop_id = [prop_id]), 
    (SELECT guest_id FROM guests WHERE fname =  [fname] && lname =  [lname]), 
    (SELECT DATEDIFF(  [end_date],  [beg_date]) * (SELECT daily_cost FROM properties p WHERE p.prop_id = [prop_id])));

############ CREATE A WISHLIST ############ ✓

INSERT INTO wishlists (listname, guest_id) VALUES ([listname], 
    (SELECT guest_id FROM guests WHERE guests.fname = [fname] && guests.lname = [lname]));


############ ADD PROPERTY TO WISHLIST ############ ✓

#by property ID
INSERT INTO wishlist_props (prop_id, list_id) VALUES (
    (SELECT prop_id FROM properties WHERE prop_id = [prop_id]),
    (SELECT list_id FROM wishlists
        INNER JOIN guests ON guests.guest_id = wishlists.guest_id
        WHERE listname = [listname] && guests.fname = [fname] && guests.lname = [lname]));

############ DELETE ENTIRE WISHLIST ############ ✓

# Delete a list from wishlists; will also delete all prop_id with this list_id in wishlist_props#
 DELETE w, wp
    FROM wishlists AS w INNER JOIN wishlist_props AS wp ON w.list_id = wp.list_id
    INNER JOIN guests AS g ON g.guest_id = w.guest_id
    WHERE g.fname = [fname] && g.lname = [lname] && w.listname = [listname];

############ SELECT BOOKING ############ ✓

# show all bookings, order by beg_date (don't show total cost or guest name)
SELECT b.booking_id as 'Booking No.', p.description, p.city as city, p.state as state, b.beg_date, b.end_date, h.fname as Host
FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
INNER JOIN guests g ON g.guest_id = b.guest_id
INNER JOIN hosts h ON h.host_id = p.host_id
ORDER BY b.beg_date ASC;

# by guest fname, lname (one guest wants to see all of her/his bookings)
SELECT booking_id as 'Booking No.', g.fname as Name, CONCAT(st_address,', ',city,', ',state) AS Address,
    b.beg_date as 'Check-In', b.end_date as 'Check-Out', b.total_cost as Total
FROM bookings b
INNER JOIN properties p ON p.prop_id = b.prop_id
INNER JOIN guests g ON g.guest_id = b.guest_id
WHERE g.fname = [fname] && g.lname = [lname];


############ DELETE BOOKING ############ ✓

# by booking number (less error prone this way - user just inputs a number to delete)
DELETE FROM bookings
WHERE booking_id = [booking_id];

# by guest fname and lname and booking number
DELETE FROM bookings
WHERE EXISTS
    (SELECT *
    FROM guests
    WHERE guests.guest_id = bookings.guest_id
    AND guests.fname = [fname] && guests.lname = [lname] && bookings.booking_id = [booking_id]);

############ UPDATE BOOKING ############ ✓

UPDATE bookings b INNER JOIN properties p ON b.prop_id = b.prop_id
SET b.beg_date =  [beg_date], b.end_date =  [end_date], total_cost = (
    SELECT DATEDIFF(  [end_date],  [beg_date] ) * (
    SELECT daily_cost
    FROM properties p
    WHERE p.prop_id = b.prop_id))
WHERE b.booking_id = [booking_id];