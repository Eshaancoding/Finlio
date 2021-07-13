## Finlio

Attempting to create a portfolio / resume project, in submission for a challenge hosted on Slingshot, on June 11th, 2021. 

This is my first application! Please email me at eshaanbarkataki@gmail.com if you have any questions, or any concerns with my code. Any feedback is welcome! 


## How to run:

- Install XAMPP, this is where you would run the server: localhost. Installation: https://www.apachefriends.org/download.html. Please download all the components to continue. After you finish installing, boot up XAMPP Control Panel (You should be able to search for it using the windows key or it may automatically open after installing) and start two things from there: Apache and MySQL.

- Next, clone this repository and put it into htdocs. htdocs is located under "xampp", which is the folder that has everything you need for XAMPP. By default, it should be in the C: directory. Putting this repository into htdocs will allow XAMPP to host the website. You could kind of think of that folder as a "public" folder. 

- Now setup MySQL using phpmyadmin. This web application uses MySQL to store and retrieve all the applicants, so we need to set that up. First, go to http://localhost/phpmyadmin/. Create a new database, that is named "form_submissions", using the + button on the left side menu. Also, instead of utfxxxxxxxx, scroll up and select "Collation". You then have to create the sql tables. Make sure you select "form_submissions" on the left side menu, go to the SQL tab, then copy & paste the SQLCommands.sql into the text editor. To execute these commands, simple hit Ctrl+Enter. This will create the database. After that, the SQL database is all set up!

- Type in your browser "http://localhost/Finlio/main.html". The "localhost" is what XAMPP is hosting, Finlio is the name of this repository, and main.html is the main file. If you get the website, which should say "Finlio" at the top, then great! The website works! If it doesn't, please email me at eshaanbarkataki@gmail.com, or you can ping me at discord: SMILEYYY#0260.

- At first, there will be no applicants when you click "Look at other portfolios" because the SQL database is empty. So I recommend creating a few portfolios so the SQL database can store some data and be used later. You can do this by clicking "Create a portfolio" and fill out some information (they can be random :) ). Then you could check "Look at other portfolios" at main.html to see what portfolios you have made! Enjoy! :)
