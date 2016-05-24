SuperSaaS Online Appointment Scheduling Integration
---------------------------------------------------------

CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Troubleshooting
 * FAQ
 * Maintainers

INTRODUCTION
------------

SuperSaaS.com is a flexible online appointment scheduling system that works with
many different businesses and is available in 24 languages. The basic version is
free, a paid version is available for large users and commercial uses.

The module displays a *Book now* button that automatically logs the user into a
SuperSaaS schedule using his Drupal user name. It passes the user's information
along, creating or updating the user's information on SuperSaaS as needed. This
saves users from having to log in twice.

REQUIREMENTS
------------
The only requirement for this module is Drupal 8.1.1.

INSTALLATION
------------
 * Install as you would normally install a contributed Drupal module. See:
   https://drupal.org/documentation/install/modules-themes/modules-8
   for further information.
 * You will need to configure your SuperSaaS account. See:
  https://www.supersaas.com/info/doc/integration/drupal_integration
  for further information.

CONFIGURATION
-------------
* Navigate to *Administer » Modules*. Check the *Enabled* box next to the module
and then click the *Save Configuration* button at the bottom
* Configure the parameters of the module at *You
are Configuration » Content authoring*:
  - SuperSaaS account name - This is the name of your SuperSaaS account
  (not your email address)
  - SuperSaaS password - This is the password that the administrator uses to log
  in to SuperSaaS
  - Schedule name or URL - You can either put the name of a schedule or you can
  provide a full URL if you want to add specific parameters to direct
  the user to a specific view
  - Button image - You can enter a URL like this one:
  http://cdn.supersaas.net/en/but/booknow_red.png.
  If you leave this blank, a standard HTML button will be used.
  - Custom Domain Name - If you created a custom domain name to point to your
  schedule, then you can enter it here to correctly point your users to it.
* Navigate to *Structure » Blocks*. Drag the SuperSaaS Login block to
an appropriate location on the page. You can click configure to further
customize the title and the pages on which the button should display.
* On your SuperSaaS dashboard navigate to the *Access Control* page and make
the following changes:
  - Select the *Log in and registration managed on your site* option.
  - Select the *Prevent users from updating their own information* option.
  - Deselect the *Use email address as login name* option
  - Switch the *Email address* radio button that appears to *Optional*
  (or *Mandatory*)
  - Switch all other fields to *Don’t Ask* (you can switch off the *Password*
  field too if you have selected  Login is not handled here)
* On your SuperSaaS dashboard navigate to the *Layout Settings* page
and make the following change:
  - On the Layout Settings page, fill out the box *Your URL* with the URL of
  the page on your site where users can be redirected after they log out of
  SuperSaaS

TROUBLESHOOTING
---------------
* Please read the full set up guide here:
http://www.supersaas.com/info/doc/integration/drupal_integration
* Troubleshooting Tips:
  - Note that the button only appears to users who are logged in to your Drupal
  site.
  - If you see an error Email is not a valid email address then make sure that
  you have configured correctly your SuperSaaS account.
  - If the button redirects the user but does not appear to actually log him in
  and you have used a URL in the field Schedule name or URL then make sure that
  the domain of that URL is entered in the Custom Domain Name field.

FAQ
----------------
Q: I have difficulties getting it work (or where can I report an issue regarding
the module)?
A: You can write a mail to support@supersaas.com describing your problem.

Q: How can I find out more about SuperSaaS?
A: You can visit the http://www.supersaas.com/info/features page to check out
the features offered by SuperSaaS. We always recommend to try out our system
first by signing up with a free account.
