## Done



***
## Admin module
1. Fix: the countries docs links, use md for the links.
2. Create the other pages documentations.


## Application module
1. Fix: Send a session destroy request to the server when the js logoff method is called.
2. Create language files starting with the application and all controllers.
3. Translate navigation, toolbars and messages from the server.
4. Rewrite all controllers and view, so the only use itemIds and ComponentQuery.
5. Add browser info to the report bug.
6. Make a file uploader, always show all uploaded file for that user.


## Core
1. Fix: the saveSystemData when the system shuts-down.
2. Add a shutdown method to each controller and call this method before a new controller starts-up.
   this shutdown method need to destroy all created view and the created data.
3. Make it possible to dispatch silent:
   IF the silent flag is raised:  
*  Do not shutdown the current controller
*  Do not overwrite the current controller
4. Fix: the 404 page.


## User module


Describe the inappropriate behaviour,
or The error message,
or What you expected and what you see instead.