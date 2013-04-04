## Done
 >10. Use Senca CDN.


***
## Admin module
1. Fix: the countries docs links, use md for the links.
2. Create the other pages documentations.


## Application module
>1. Fix: Send a session destroy request to the server when the js logoff method is called.
2. Create language files starting with the application and all controllers.
3. Translate navigation, toolbars and messages from the server.
4. Rewrite all controllers and view, so the only use itemIds and ComponentQuery.
5. Add browser info to the report bug.
6. Make a file uploader, always show all uploaded file for that user.
7. Bug report and manage service.
8. Personal messaging service.
9. System data and settings handler
10. Create the logout, also in the js controller.
11. fix system info
12. Create the session management.
13. Let the system only return system data like navigation.



## Core
1. Fix: the saveSystemData when the system shuts-down.
2. Add a shutdown method to each controller and call this method before a new controller starts-up.
   this shutdown method need to destroy all created view and the created data.
3. Make it possible to dispatch silent:
   IF the silent flag is raised:  
-  Do not shutdown the current controller
-  Do not overwrite the current controller
5. Show an error if an controller is dispatched and the system is not started-up.
-  If the authentication request returns an exception, the report issue shows up.
6. Use EntityRepositories instead of eager loading.



## User module


Describe the inappropriate behaviour,
or The error message,
or What you expected and what you see instead.