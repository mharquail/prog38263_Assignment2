# PROG38263 - Assignment 2
## Fixing and Insecure PHP Blog Application

## Description

For this assignment you will work alone or with a classmate to identify and exploit vulnerabilities in an insecure blog application. After that you will add and test security controls to mitigate or prevent the vulnerabilities from being exploited.

The web application’s technology stack is PHP, Nginx and PostgreSQL. The application is provided via Github and can be built/launched with <code>docker-compose build && docker-compose up</code>. For convenience, there is also a container provided for exploring the database. It can be accessed by navigating to the application in a web browser on port 8080. Use the credentials for the <code>postgres</code> user found in <code>config.php</code> to login to the database from the web interface.

If you want to add more initial data, you can add insert statements to the <code>data.sql</code> script. The database schema will be created and populated from the script when you first build the application. To completely reset the database you will need to remove the docker container that holds the data volume for the database.

## Vulnerabilities

The application has the following known vulnerabilities that you must find and exploit.

* Cross-Site Scripting (XSS)
* SQL Injection
* Broken Access Control (i.e. you can do things without authenticating that you should be able to do)
Missing role-based access control enforcement and management (i.e. Blog authors should only be able to delete their posts. Admins can delete anyone’s posts. There is currently no mechanism for changing or managing the roles for users. Actually, there is no mechanism for even creating or managing users without issuing manual SQL against the database).
* Insecure password handling and storage.
* CSRF
* The entire website, including the login page, is served over plaintext HTTP.
* The web application has no logging except for the default logs generated by Nginx.
* The website only uses single-factor authentication.

## Objectives

* For the vulnerabilities described above, find and exploit at least one instance of that vulnerability. 
* Provide proof of your exploit through screenshots or tool output.
* Write a sentence describing the severity and impact of the vulnerability.
* Implement the most appropriate security control for that vulnerability.

## Bonus Objectives!

* Implement database caching using memcachd. 
* Implement persistent session management using redis.
* Allow Articles to be written using either some simple HTML formatting tags (like h1, ol, strong, etc) or Markdown but still prevent the use of malicious JavaScript in articles. 
