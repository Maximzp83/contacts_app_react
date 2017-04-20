Contacts Application v1.0.

About:
This application created on Laravel v5.4.10 framework.
Unit-Tests created on PHPUnit v4.8.35.

Step by step guide for launch Contacts Application.
1. Copy all files to c:\path to your directory\
2. Launch your web server program (xampp, mampp or other local server program)
3. Launch DataBase Manager (like phpMyAdmin)
4. Create new DataBase with name 'contacts_app'
5. Check PHP 5.6 or higher installed on you computer
6. For update DataBase Tables:
    a) Launch terminal and input:
        - cd /path to project;
        - php artisan migrate;
7. For Launch This App:
    a) Launch terminal and input:
        - cd /path to project;
        - php -S localhost:8888 -t public;
    b) Launch you browser;
    c) in browser address bar input 'http://localhost:8888'
     That's All. Application running.

----------------- Unit Testing ---------------------
All unit-tests you can find in project_dir/tests/unit/
Be AWARE - For correct execution of unit-tests DB tables must be empty!

To Check phpunit installed:
1. Launch terminal and input:
   - cd /path to project;
   - phpunit --version; (if no errors then OK)

To start All Unit-Tests for this App you should:
1. Launch terminal and input:
    - cd /path to project;
    - phpunit;

To start Specified (for example 'ExampleTest') Unit-Test you should:
1. Launch terminal and input:
    - cd /path to project;
    - phpunit --filter ExampleTest;


=============== If you want change default config ==========================
1. If you want switch to debug mode:
   - open .env file in root directory;
   - APP_DEBUG=false switch to APP_DEBUG=true.
2. TimeZone config (Europe/Kiev by default):
   - go \config\app.php;
   - find 'timezone' => 'Europe/Kiev' and change value to what timezone you want.
3. DataBase Config (mySQL by default):
   a) if you want change mySQL to other RDBMS:
      - go \config\database.php;
      - go .env file and change DB_CONNECTION=mysql to other RDBMS.
   b) If you want change DB name ('contacts_app' by default):
      - go .env file and change DB_DATABASE=contacts_app to what name you want.


