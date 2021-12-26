# <img src='imgs/icons/logo.png' height='100' width='100'> Med Lab Reports
http://med-lab-reports.great-site.net

## What is Med Lab Reports?
* **Med Lab Reports** is a web application for managing medical tests and reports with PHP and MySQL.
* This is a college project for DBMS course under the supervision of **Dr. Sangram Ray**.

## How to get a working installation from the source
You will need:
* PHP - programming language. (https://www.php.net/)
* MySQL - for database. (https://www.mysql.com/)
* Composer - for managing PHP Dependencies. (https://getcomposer.org/)
* Git - for version management. (https://git-scm.com/)

### Steps to setup the local environment:
* Clone the repository:
```
git clone git@github.com:rjharishabh/med-lab-reports.git
```

* Go to the med-lab-reports folder:
```
cd med-lab-reports
```

* Install all the needed composer packages:
```
composer install
```

* Change host, database name, username and password [here](https://github.com/rjharishabh/med-lab-reports/blob/a36a3dbb6e62f0fe466bf5483f4be062b71896b4/db/connect_db.php#L2)

* Create SQL tables and dump tests data into database [db.sql](https://github.com/rjharishabh/med-lab-reports/blob/a36a3dbb6e62f0fe466bf5483f4be062b71896b4/sql/db.sql#L1-L55)

* Create **Razorpay Test Mode**  API keys and add it [here](https://github.com/rjharishabh/med-lab-reports/blob/a36a3dbb6e62f0fe466bf5483f4be062b71896b4/checkout.php#L19-L20) and [here](https://github.com/rjharishabh/med-lab-reports/blob/a36a3dbb6e62f0fe466bf5483f4be062b71896b4/db/payment-completed.php#L14-L15)

* Replace every instance of **mail@gmail.com** with your actual **gmail Id**.

* Add your actual gmail password here. If you have enabled 2FA then create an app password and add it here.
* Congrats setup is complete, now you can use the application.

* You can also use [XAMPP](https://www.apachefriends.org/index.html) and [MAMP](https://www.mamp.info/en/windows/).

### Packages Used:
* PHPMailer - https://github.com/PHPMailer/PHPMailer
* Dompdf - https://github.com/dompdf/dompdf
* Razorpay PHP Library - https://github.com/razorpay/razorpay-php

## Copyright
* (C) 2021 Rishabh Ranjan Jha ([rjharishabh](https://github.com/rjharishabh))
* Distributed under the GNU General Public License version 2
* See [License details](https://github.com/rjharishabh/med-lab-reports/blob/a36a3dbb6e62f0fe466bf5483f4be062b71896b4/LICENSE#L1)
