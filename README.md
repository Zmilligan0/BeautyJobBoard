# Salonify Documentation

## Project Overview

Salonify is a web platform aimed at beauty salons and professionals. It is designed to bridge the gap between these two by providing a comprehensive job board, educational resources, and profiles for each party. It was built with PHP and MariaDB by GreenTeam.

The job board on Salonify has several features, such as posting jobs with detailed descriptions and requirements, searching for jobs based on location, and applying for jobs with a single click. Candidates can also create a portfolio of their work that salons can view before making a hiring decision.

In addition to the job board, Salonify features educational resources created by industry professionals. These resources will include tutorials, tips, tricks, and live webinars. The goal is to ensure that salons and beauty professionals are up-to-date on the latest trends and techniques.

Finally, Salonify consists of three account levels - candidate, salon, and admin. Candidates can create their profiles and apply for jobs, salons can post and manage job posts, and admins can oversee the overall platform.

By providing salons and beauty professionals with an easy-to-use web platform, Salonify will make it easier for them to connect, find jobs, and stay informed about the latest trends and techniques in the beauty industry.

---

## Technology Stack

> The following technologies were used to build Salonify

Languages, frameworks, and libraries:
* PHP
* MariaDB
* HTML
* CSS
* JavaScript
* Bootstrap
* QuillJS

Third-party APIs used:
* Stripe
* Postmark
* Twilio
* Google reCAPTCHA
* BigDataCloud Geocoding API
* Unsplash API
* Instagram API

Package managers:
* Composer

## Installation
> For continued development

For the continued development of Salonify, we recommend using [XAMPP](https://www.apachefriends.org/index.html) to run the web server and database. `XAMPP` is a free and open-source cross-platform web server solution stack package developed by Apache Friends, consisting mainly of the `Apache` HTTP Server, `MariaDB` database, and interpreters for scripts written in the `PHP` and Perl programming languages. In addition to `XAMPP`, you will need to also install [Composer](https://getcomposer.org/) to install the PHP dependencies.

### Installing XAMPP
To install `XAMPP`, follow the instructions on the [XAMPP website](https://www.apachefriends.org/index.html).

### Installing Composer
To install `Composer`, follow the instructions on the [Composer website](https://getcomposer.org/).

### Installing the PHP dependencies
To install the `PHP` dependencies, run the following command in the root directory of the project:

```bash
composer install
```

> For deployment

For a production environment, we recommend using Apache and MariaDB. To install `Apache`, follow the instructions on the [Apache website](https://httpd.apache.org/). To install `MariaDB`, follow the instructions on the [MariaDB website](https://mariadb.org/). To install the `PHP` dependencies, run the following command in the root directory of the project:

```bash
composer install --no-dev
```

## Configuration

### Environment Variables
In addition to installing the `PHP` dependencies, you will also need to configure the project to work with your local environment. To do this, you will need to create to set up environment variables in an htaccess file. The `.htaccess` file should contain the following variables:

```bash
SetEnv HTTP_TWILIO_ACCOUNT_SID
SetEnv HTTP_TWILIO_AUTH_TOKEN
SetEnv HTTP_STRIPE_EPS
SetEnv HTTP_STRIPE_API_KEY
SetEnv HTTP_STRIPE_BASIC_CHARGE
SetEnv HTTP_STRIPE_BOOST_3
SetEnv HTTP_STRIPE_BOOST_7
SetEnv HTTP_STRIPE_BOOST_30
SetEnv HTTP_HEREAPI_KEY
SetEnv HTTP_POSTMARK_API_KEY
```

### Database
To set up the database, you will need to create two databases in MariaDB. The first database (educational_platform) will be used for the educational resources, and the second database (job_platform) will be used for the job board. To create the databases, run the following commands in MariaDB:

```bash
CREATE DATABASE educational_platform;
CREATE DATABASE job_platform;
```

To create the tables in the databases, you will need to use the SQL files located in the schema folder of the project. To import these files, you may use a tool such as [PHPMyAdmin](https://www.phpmyadmin.net/). If you are using `XAMPP`, you can access `PHPMyAdmin` by navigating to `localhost/phpmyadmin` in your browser.

### PHP Interpreter
> Enabling gd extension

You will also need to enable the `gd` extension in your PHP interpreter. To do this, you will need to edit the `php.ini` file located in the `php` folder of your `XAMPP` installation. Uncomment the following line:

```bash
extension=gd
```

This should enable the `gd` extension which is required for image manipulation.

---

## Next Steps for the Project
Some of the features that we were not able to implement in the time allotted for this project include:

* An email notification system for job applications and new job posts
* Implementation of TikTok API to allow candidates and employers to upload videos to their profiles
* Resume builder
* A more robust reporting system for users
* Restructuring of the database to allow for more flexibility in the future
* Restructuring of the project directory to allow for more flexibility in the future and better security
* Implement recent searches saving from searches being made on the search page, not just index.

## Issues That We Have Not Resolved
* Viewing a candidates resume, as a employer is not working properly.
* The screening questions don't get added to the database as they should.
* Adding educational content with the Admin Dashboard does not work as intended.
* The display of salaries might not work properly. It sometimes displays the same number twice.


---

## Domain Disclaimer
GreenTeam purchased the domain Salonify.ca for presentation purposes. If you wish to take over the domain please email carlosm1@mailbox.org and we will transfer the domain to you for free.

\* <small>Fees may apply for domain transfer depending on the registrar.</small>

---

## Project Contributors
### Business Analyst
- Henry Kruse [→](https://github.com/Hkruse1)
### Project Leader
- Carlos Marquez [→](https://github.com/carlosm3)
### Developers
- Dino Paolo Villanueva [→](https://github.com/dvillanueva2)
- John Oliver A Halasan [→](https://github.com/OliverHalasan)
- Jordan A Del Colle [→](https://github.com/JordanDelColle)
- Maryam Rostamali [→](https://github.com/mrostamali)
- Ping Guan [→](https://github.com/HugeAsNever)
- Tylen Bryan [→](https://github.com/Tbryan4)
- Zachary Milligan [→](https://github.com/Zmilligan0)