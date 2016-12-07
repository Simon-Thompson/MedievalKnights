# MedievalKnights

Comp 307 project by Simon Thompson, Karl Chiraz and Thomas Jansen
	
Technologies:
	XAMPP
	HTML5/css/cgi
	javascript
	JQuery
	Ajax
	JSON
	BootStrap
	PHP
	MySQL
	Phython
	Security


Instructions:

1 XAMPP with Python installation

Install XAMPP and make sure that you are able to run .py scripts on it
	- In order to run .py script you need to:
		- In http.conf look for this line: AddHandler cgi-script .cgi .pl .asp. Modify it so it looks like this: AddHandler cgi-script .cgi .pl .asp .py
    
		- You probably won't need to do this, but just to be sure, look for this line: Options Indexes FollowSymLinks. Ensure that it looks like this: Options Indexes FollowSymLinks ExecCGI
		- Make sure the ! in the py scripts point to the location of the python installation on your pc

-------------------------------------------------------------------------------
2 Database Setup
	
Go into phpMyAdmin
Create a database called loveydovey
Import the sql script for the database

-------------------------------------------------------------------------------
3 Site Setup

Put the cgi bin elements into your xampp cgi bin
Put the elements in the htdocs into your xampp htdocs
Open localhost/cgi-bin/logCheck.py which is our login page
Click on registration and create a new profile and explore

