# Secure Web-based Systems Assignment 4

# Notes

## TODO

- [x] Create the database.
- [x] Make registration page.
- [x] Make login page.
- [x] Change banner based on whether or not the user is logged in.
- [x] Show the user's info in the banner when they are logged in.
- [x] Make the home page, this page will have the list of graduates that can be filtered.
- [ ] Show list of degrees, make it filterable and searchable
- [x] Add a button on the entires of students who have registered a profile.
- [ ] Create the users profiles.
- [x] Allow the users to edit their profile.
- [ ] Allow the users to choose what is displayed on their public profile.
- [ ] Show the messages users have posted in their edit profile page and all them to modify or delete them.
- [x] Make the bulletin board.
- [x] Make page to post to the bulletin board.
- [ ] If there is time make it so that other users can post to other graduates profile pages.

## Functionality Requirements

1. Allow visitors to view the list of graduates and filter them based on different criteria.
2. Clicking on the graduate, or a button takes you to the profile of that graduate.
3. Visitors should only be able to see the part of the profile that the graduate has made public, the whole profile should be accessible to those logged in.
4. Graduates should be able to log in.
5. Graduate should be able to edit their profile, as well as set privacy options on profile items.
6. Graduates should be able to register for a profile as long as their name is on the list.
7. Users must be logged in to view the bulletin board.
8. Anyone who is logged in may post to the bulletin board.

## Pages

The website should contain the following pages:

1. Home. (index.php)
2. Search, look at the list of people in the database and filter based on certain criteria.
3. Profile.
4. Registration page.
5. Log in page
6. Bulletin board

## Page Contents and Functionality:

### Home

Not sure what should be on this page yet.

### Search

Shows the list of graduates and allows visitors to filter them by different criteria.

### Profile

Graduates that register of the site fill out additional information that will be included in their profile. The extra information they should provide is:

- E-mail address
- Location

  - City
  - State
  - Country

- Phone number

- A short bio about what they are up to now.

- If there is time add the functionality for them to add a profile picture.
- On the profile page the users will be able to view the posts they have made create new posts and edit or delete their previous posts to the bulletin board.

### Registration

When graduates register for an account on the website they must provide information to prove that they are on the list of graduates provided. Once that has been confirmed they will be asked to create an account by making a unique username, password, and filling out additional information for their profiles. As outlined above those fields are:

- E-mail
- City
- State
- Country
- Phone number
- Bio

### Login

Once graduates have registered for an account they must log in with their username and password to be able to view other graduates full profiles and to view and post on the bulletin board.

### Bulletin Board

The bulletin board will be formatted in a similar way to twitter with the text area at the top and posts made by the other graduates appearing under it. The user will be able to view and edit their posts on their profile.

# _Assignment Text_

## Summary

This assignment is a group project to develop a web site. It should bring together most of the topics we have covered in this class. In the real world, web development is usually a team effort, and this last project attempts to model this situation.

## Description

You have read access to a database containing the list of students who have graduated from the UTEP CS department. Your web site will offer public access to the list with different options of filtering and ordering. It will also allow CS alumni to create profiles and set whether each profile item is accessible to public or only other alumni. You will also create a bulletin board accessible by alumni.

### The web site should have the following characteristics:

1. Consistent look and feel, where all pages share a similar design and navigation scheme. Use CSS to create some style. We are not using packages, we are not trained as graphic artists, and time is limited, so we don't expect anything elaborate.

2. Works on different browsers (test on at least 3 different browsers)

3. It should be the group's own work. Do not include packages or themes downloaded from the internet. If you wish, you may use Jquery. We did no cover it in class, but it is part of our textbook.

### The web site should have the following functionality:

When we refer to visitors, we mean someone who is not logged in.

1. Allow visitors to view the list of graduates in different formats (by year, alphabetic, etc.)

2. Allow visitors to filter the list with different criteria (just one year, specific degrees, etc.)

3. Clicking on a graduate or a button in the graduate row from the list displays the profile of that graduate. For visitors, only display the part of the profile accessible to public. For those logged in, display the whole profile.

4. Allow graduates to log in and manage their profile.

5. Users who are logged in should be allowed to change privacy setting on individual profile items. Settings include: public, registered user.

6. Have a page (like assignment 2) where graduates can register. Every account should be linked to a record from the database of graduates. For this assignment, we are not doing any verification other than that no account linked to the record already exists.

7. Require login to access the bulletin board.

8. Anyone logged in can add a message on the bulletin board.

### Extra credit (at most 10% extra)

1. Use AJAX to change the filter or ordering of the list of graduates.

2. Allow pictures in the profile.

3. Allow the author of a bulletin board message to edit or delete a posted message.

4. Make the web site cell-phone friendly.

Instructions for what to include in your report will be communicated later.

## Due date

Team reports are due December 2\. Penalty is .5% per day late until December 11, 11pm. Reports not accepted after that.
