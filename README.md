README for Specbeetask module
---------------------------

CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Implementation details
 * Requirements
 * Installation
 * Maintainers

INTRODUCTION
------------

Specbeetask module contains administrative configuration form, which will save
the value for Country, City and Timezone. A service will return the value selected
in the form and redered the value in blocks template.
Please read the below **Implementation** for more details.

IMPLEMENTATION DETAILS
------------
 - Add an ADMIN CONFIGURATION form which will take the following inputs:
	 - Country - text field
	 - City - text field
	 - Timezone - select list
	   - Options in the select list
			- America/Chicago
			- America/New_York
			- Asia/Tokyo
			- Asia/Dubai
			- Asia/Kolkata
			- Europe/Amsterdam
			- Europe/Oslo
			- Europe/London
 - A service that will return the current time based on the time zone
   selection in the above form. Time should be in the format 25th Oct 2019 - 10:30 PM
 - Add a Plugin block which will render the Location from the configuration set
   in the ACF and the current time calling the service in the previous step.
	 Pass the variables to a template to be rendered.


REQUIREMENTS
------------
 - Drupal: 8+
 - Database:
	 - MariaDB: 10.3.7+
	 - MySQL/Percona 5.7.8+
 - Server
 	 - Apache: 2.4+
	 - Nginx: 1.8+ or 1.9+
 - PHP: Ver 7.2 or higher

This module requires no modules outside of Drupal core.


INSTALLATION
------------

 - Install the Specbees module as you would normally install a custom Drupal
   module. Visit https://www.drupal.org/node/1897420 for further information.


FUNCTIONALITY CHECK
-------------------

 - After installation you need to goto this path
   admin->config->development->adminconfigform.
 - Save the relevant values in the country, city and timezone field.
 - Now goto structure->block layout and place the timezone block in the
   any region and check.


Author/Maintainers
------------------

 - Manav (Manav/ArjunKumar) - https://www.drupal.org/u/manav
