TaskManager
------------------------
Manages Tasks, and stuff. 

At the current time, generic authentication is working. Not registration, or Facebook/Google/Twitter integration. The SQL dump will come with your generic user (username: Testing, password: testing). 

Installation
------------------------
**First thing**, you should do is open up ***application/config/config.php*** and edit line 17 ( $config['base_url
] ) to match where the root directory where this application is laying. 

Other than that -- default SQL database dump is in /_assets.

Possible Errors
------------------------
I've been getting numerous reports that the application doesn't even load for anyone else. I personally use WAMP as my local development package; **I did have to enable the CURL (PHP) & Mod_Rewrite (APACHE) modules** on all of the machines I've developed this application so far. Though -- every machine has been Windows/WAMP, so the cross platform local hosting could play a key on this. 

~Thanks



