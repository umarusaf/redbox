About
======
Magento 2 Module to Add Customer Linkedin Profile URL field for customer registration, account edit and Customer Management section
in magento admin.


Installation
=============

( Using Composer )



Step 1:
Open Magento root compoer.json file



Step 2:
Find "repositories" entry and add module repository path :

"repositories": [
        {
            "type": "composer",
            "url": "https://repo.magento.com/"
        },
        {
            "type": "vcs",
            "url": "git@bitbucket.org:webworksninjas/assignment-dev-01.git"
        }
    ],



Step 3 :
Run below command in CLI :
composer require redbox/customerlinkedinprofile



( Manual Instalation ) :




Step 1 - Download module from git clone https://webworksninjas@bitbucket.org/webworksninjas/assignment-dev-01.git


Step 2 - create "Redbox/CustomerLinkedinProfile" directory in app/code folder and unzip source code within it.


Step 3 - Run php bin/magento setup:upgrade

And you will see module there.

Requirementes
It require atleast Magento 2.x version and PHP 7.x >