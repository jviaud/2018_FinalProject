# Database Tables
The Database being used here is named 'Gambit'. The structure of the tables are as follows.

## Level

| id(pk)        | username      | password   |
|:-------------:|:-------------:|:----------:|
| int(10)       | varchar(25)   |varchar(25) |
| auto-increment|     ~         |  ~          |

This table hold the username and password for each level password is 25 characters because they are all MD5 hashes.


# Stats

| entry(pk)     | id            | level    | fintime |
|:-------------:|:-------------:|:--------:|:--------:|
| int(255)      | int(255)(fk)  |int(10)fk | timstamp|
| auto-increment| ~             |default:0 |default:current_timestamp|

This table holds the stats for every player. The ID in this table is a forign key to the ID in the Users table. level and fintime are self explanitory.

# Users

| id(pk)     | username            | password    | salt                    |country    |level  |fintime  |joindate |lastonline|
|:-------------:|:----------------:|:-----------:|:------------------------:|:----------:|:------:|:--------:|:--------:|:---------:|
| int(255)      | varchar(25)(fk)  |varchar(64)  | varchar(32)             |varchar(32)|int(10)|timestamp|timestamp|timestamp |
| auto-increment| ~                |default:0    |~     |    ~    |      ~   |   0000-00-00 00:00:00| current_timestamp|0000-00-00 00:00:00|

This table holds all relevant user data. passwords are 64 chracters long because all passwords are hashed using SHA256 after a random MD5 salt of 32 characters is appended to the end of the password.
fintime represents what time they completed their highest level. Level and fintime are placed here simply because I'm lazy and didn't want to use complex queries where I got the top 1 from 
the stats table where id = ?some id?.

# Core

The core functionality of the website is broken down into php classes with methods, this goes around having 
to manually include each class on each page as well as having to start a new session on each page.
The **init.php** file located in the **core** folder. It initializes a single Global array called config that holds
credentials to the Database in an array.
**127.0.0.1** is used in place of localhost because that is the IP phpmyadmin is being hosted on and this saves time  (not much in my case but I figured 
I'd do it anyway).
username,password and db are are my credentials.

There is also the session array which holds a token(will explain later) and the current user.

I then autolaod every class from this init.php file.

# Classes

## DB
This class handles all connections to the DB and used the PDO concept instead of the mysqli one.
I hated the other concept because I hate using AJAX but the downside to this one is it makes more complex queries a pain.
If i had to do this again I would just use Python.

From this class you can insert,get and update tables. Which is all done using prepared staements to prevent SQL Injections. (This is moreso for Ford's class)

NOTE: you can insert into 1 or more columns at a time

INSERTION: 

$table = DB::getInstance() -> insert( 'table' , array(
    
    'field' => 'value',
    
    'field' => 'value',
    
    'field' => 'value'
   
    ));
    
    
UPDATE:

$table = DB::getInstance()->update('table', id, array(
   
    'field' => 'value',
    
    'field' => 'value'
   
    ));

QUERY:

$DB = DB::getInstance()->get('table', array('field', '[operator]', $value));

## Hash
This Class simply makes a salt and hashes it using SHA256 with the given user password (This is mainly for Ford)

## Input
This is just a helper class that helps me grab user input either from the page header (GET) or a form (POST).
Comes in handy when I need to refrence form fields by name

## Redirect
This is just a helper class that redirects users

## Session
This class handles my session variables. It can check if a Session exsist, delete, get and create a session for a user.
And send data from one page to another with flash.

## Token

This generates a session token which I atttach to forms to prevent cross site request forgery as an extra layer of security (mainly for ford)

## User 
This allows users to register and sign in. Passes all relevant data to the users table as well as the entry table. It also checks if a user already exsist with the given username


## Validate
This validates user input in forms and kicks out erros where needed

# Includes
Stuff that may generally be used on ever page

## GoHome
This is just a button that takes uers back to their profile

## Nav
Its a Navabr

## Stats
A specific user's personal stats

## Update
Form that allows user to change personal info. For now it's just their country. May add stuff like name and password (mainly for Engel)

# JS or Java Script
Just some scripts I'm using on some pages.

# Levels
All of the levels

# Scripts
These are php scripts and not javascripts. This include logging out a user and updating their current level







