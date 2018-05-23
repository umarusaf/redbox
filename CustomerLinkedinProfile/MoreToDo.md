Module misses some features :
1 - Customer field Advanced Settings in admin and Field checks
3 - standalone Repo pacakge / Installer

Process / Approach:
---------------------------------------------
1 - Customer field Advanced Settings in admin

Create a system.xml file in mdouel etc/adminhtml folder and add module configuration there.
Then would have created a helper which responsible to check the settings ( enable / disable , field label, required / optional etc ) and
Show / hide field as per settings and required / optional check etc.


2 - Repo package / Installer :
I would have host my package on packagist.org and tag the version. so i would be able to install suing composer require command , instead of updating magento root composer.json file.
