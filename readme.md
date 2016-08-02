This is the API backend to the Mobile app 'DayVids'.
The idea of the app was to display a certain topic everyday with different categories and videos associated to that category
For example 'Funny Animal Videos' would be a topic for a day , and have sub categories like cats , dogs , monkeys etc...
Each category would then have multiple associated videos for the user to enjoy,
Each day the user can use the application to browse the new topic for that day.

If putting this on your localhost machine the following API endpoints would get the required data from the backend application
http://localhost/dayvids/api/topic/{year}/{month}/{day}       Gets a topic for selected date, gets categories for the topic & associated videos
http://localhost/dayvids/api/video/                           Gets all videos in the database
http://localhost/dayvids/api/video/{id}                       Gets a video by its ID

____________________________
****** Database Setup ******

the current database username is set to 'root'
the current database password is set to 'root'
to change the username & password edit the $db['default'] array in dayvids/application/config/database.php file.

SQL file is located at
dayvids/database.sql

the database.sql file will create a database named is 'dayvids' and 4 tables and insert all needed data to run the endpoints.

________________________________
****** Testable Endpoints ******

after setting up the database the following endpoint will return data in json format
http://localhost/dayvids/api/topic/2016/05/14
http://localhost/dayvids/api/video/                 
http://localhost/dayvids/api/video/1
