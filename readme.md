# QuotesApp

This app is written in PHP using the Laravel 5.2 framework on the backend, and BootStrap as the styling framework on the frontend. MySQL served as the database for this project.

**About**

Anyone can access the homepage, where the viewer is treated to famous quotes by famous people, which are retrieved from the database. The viewer can also play Guess The Quote, where he is shown the quote and has to input the last name of the author. His answer is compared to the quote's actual author and if it matches,  his score increments by one and he is shown a positive response; if he answers incorrectly, he is shown the correct answer. This process continues until there are no more quotes in the database, at which time the user is shown the Game Over message. 

If the user wants to contribute to the quotes  database by adding his own, he has to signup/login. The user can view and delete all of his quotes via  the dashboard, which is a secure route only available to authorized users.


**Website logic**

The codebase is neatly organized into three major sections: Models, Views, Controllers. Almost all my code is concentrated in these folders. 

**Models**:

Models are found in the `app` folder
There are three Models; `Quote`, `Author`, `Admin`. 

`Quote` has a `one-to-many` relationship with both the `Admin` model and `Author` model, which in turn have a `has-many` relationship with `Quote`. The table relating to the `Quote` model stores the `quote_id`, `admin_id`, `author_id`. 

`Admin` are the authenticated users who are allowed to post/delete quotes and have access a dashboard where they can view/delete their quotes.

`Author`: Author of the quote(Shakespeare for example). If the user wants, he can view all the quotes in the database by a particular author.

**Views**:
 Views are found in `app/views`. All the routes relating to the views can be found at app/http/routes.php. I tried to make the views as modular as possible so they are broken down into different folders, corresponding to their use. 
 
 **Controllers**:
  Controllers are found in `app/http`. 
