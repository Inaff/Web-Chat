-------
GENERAL
-------
This chat server is very bare-bones server-side, so features such as redundancy and encryption will be entirely or mostly left to the server setup, such as HTTPS and restriction of directories/files. 



-------------------
USER CONFIGURATION
-------------------
Registering users - 
	There is no GUI registration, and users must be added manually. NOTE that salt is not used, and stupid passwords WILL compromise security. To add a user, open /usr/users.txt, and write the sha512 of the user's password, followed by a colon, and the user's name. Only the user's password will be used to log in (no accompanying ID, email, etc)... Example: 6lcIUHioKDD7IjhzTvJ55lcIUHUZKhb7IjhzOvJ53lcIxxPwKDb7IjhzOQJ58aMn:JohnDoe

User icons -
	Icons are used to represent users in the chat, therefore user-specific icons are recommended, though not required for functionality- If no icon is given, a generic icon will be used. To give a user an icon, add an image to /usr/icon with the user's name as the filename. Icons are square, and recommended to be 16x16 or 32x32 in size, depending on how detailed the image is... Example: /usr/icon/john.png

User themes - 
	Per-user theming is possible, and also must be done manually. To change a user's theme, open /usr/users.config, and write (with no spaces) the user's name, followed by a colon, and the css file name (with no extension). You can look at the available themes in /css/theme... Example: JohnDoe:default


---------------------
SERVER CONFIGURATION
---------------------
How do I change the logs directory? - 
	In both post.php and js/script.js, CTRL+F ".htm" and modify the path in both files.
