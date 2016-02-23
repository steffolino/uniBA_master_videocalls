Master Project Uni Bamberg // Supported Video Calls // Stefan Stretz 2015 / 16
=============================

INSTALLATION
------------
This installation contains the videocall application and also an installation of the yii framework 1.1.17
In order to install both:
	Please make sure the release file is unpacked under a Web-accessible
	directory, e.g. intepub/wwwroot or xampp/htdocs and unzip all content
	
In case you only want to install the videocall application into an existing yii installation,
only extract the /videocalls folder

Content:
      framework/           	framework source files
      requirements/        	requirement checks
	  videocalls/				the video call application source files
      README               	Manual for Installation, Requirements, Repositories


REQUIREMENTS
------------
The minimum requirement is a Web server supporting
PHP 5.1.0 or above. The application has been tested with Apache HTTP and MySQL server
on Windows operating systems.

Please use Firefox or Chrome as the preferred browser to access the application.
Currently IE and Safari are not supported since they do not allow WebRTC functionality

Please access the following URL to check if your Web server reaches
the requirements by Yii, assuming "YiiPath" is where Yii is installed:

      http://hostname/YiiPath/requirements/index.php
		e.g. http://localhost/yii/requirements/index.php

DOCUMENTATION
------------
	Full Documentation and Class Description can be found at videocalls/doc/api/index.html
	Docs have been created using yii-doc-generator (cf. http://www.yiiframework.com/wiki/186/how-to-generate-yii-like-documentation/)
	
REPOSITORIES
------------
Install Files can be downloaded at:
	https://github.com/steffolino/uniBA_master_videocalls.git
	or
	git@github.com:steffolino/uniBA_master_videocalls.git
	
A working version can be found at:
	http://videocalls.stef90210.bplaced.net/index.php
