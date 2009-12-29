#Key Help
In order to publish packages with _*pearfarm push*_, the user needs to generate a SSH key using _*pearfarm keygen*_ command. It will output a key like (*Note: this is not your ssh key it is an openssl public key*):

	-----BEGIN PUBLIC KEY-----
    	...your key...
	-----END PUBLIC KEY-----

Just copy and paste this key to your profile at PEAR Farm server. Do not forget to include the first and last lines that starts with dashes.

The channel server will also have a web site to browse packages and see package info. It should probably track download statistics and have "hot packages" lists.