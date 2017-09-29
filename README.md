# Team 17 Homework 4
To access Team 17 main status page, you will be required to go to 159.203.248.29/ 
Then, whenever prompt for basic AUTH, the credentials are:
```
username : team 
password : teamteam
```

> Then, in order to access the soundboard app, either click the link on the index page or go to
> 159.203.248.29/soundboard/index

> Click [here](https://docs.google.com/presentation/d/1Bpu1G6bDBUfd_gGQ6ERIYukbNJASC5LueoBoXMZpdgM/edit?usp=sharing) to see our report

# User Guide

## App Features
1. Login and Sign-up
``` 
Robust registration services. Contains both server-side and client-side validation. Server-side as well as client-side
validation checks for alphanumeric inputs and input lengths. Both login and sign-up services are username unique, and
the password is encrypted with md5 + salt, where the salt is left outside the root folder so that it as as secure as
possible. 
```

2. Admin Privlieges 
```
Contains admin priveleges which can only be administered through updating the mysql table, so it is only possible through
server-side commands. Admins are able to add/delete/edit any users (aside from their passwords because that does not
make sense) and also all public and private soundboards.
```

3. Pagination
```
Everything that is listed is paginated, and can be altered according in the files in /soundboard/views/. Pagination uses
javascript and jQuery to run, but is also useable when javascript is disabled. However, there would not be previous and next
available when javascript is disabled, but the listing and paging still works.
```

4. Robust
```
Aside from some UI loss, the entire app is runnable with javascript disabled. Hence it is robust, and universally runnable 
in browsers.
```

## UI and Interface
1. Twitter bootstrap
```
Utilizes twitter bootstrap for the app. App design is simple and lightweight, without any necessary colors to blindside
users.
```

## Framework
Modeled after the MVC framework, with all intended pages located in /soundboard/views/, and all actions and controllers 
are in the /soundboard/model/ folder instead. This helps to streamline property and help to separate the code and the
website.
