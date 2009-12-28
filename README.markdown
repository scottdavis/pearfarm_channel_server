#Setting up the server

1. Modify your host file add these lines
		127.0.0.1 joe.localhost.com
		127.0.0.1 jim.localhost.com
		127.0.0.1 bob.localhost.com
		127.0.0.1 steve.localhost.com
2. Install nimblize in your php path or in the config directory (http://github.com/jetviper21/nimblize)
3. Make sure you set up the database info in the database.json files
		config/development/database.json
		config/test/database.json
4. Run these scripts from the app root to load the database and test data
		script/db migrate
		NIMBLE_ENV=test script/db migrate
		script/db stories load
		NIMBLE_ENV=test script/db stories load
5. Navagate to localhost.com in your browser
6 . Note: nimble has a bunch of CLI commands see (http://github.com/jetviper21/nimblize/tree/master/nimble_scripts/)




http://pear.php.net/manual/en/core.rest.php