urlshortener
============

Custom urlshortener

The url shortener is built with minimal code. I have not taken into account malicious activity by bots 
that may render the service useless by either a SQL injection or repeated url generation.

One way to generate to improve upon the code would be to use classes and use protected methods to access the database.

****************************************************INSTALLATION*******************************************************

1. Create a database named test on your server.
2. Create a table with the following definition using Mysql (use phpmyadmin for ease):
  
  CREATE TABLE IF NOT EXISTS url(
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  longurl VARCHAR(255) NOT NULL,
  shorturl VARCHAR(7) NOT NULL,
  date_created TEXT NOT NULL,
  counter INTEGER UNSIGNED NOT NULL DEFAULT '0',
 
  PRIMARY KEY (id),
  KEY shorturl (shorturl)
    );
    
3. Now all the designing(whatever little it may be) works perfectly well only if you are connected to the internet as I am
  using google font APIs.

4. Also enable curl extension, as the url authencity is checked by curl.
