
<h1>Contacts Application v1.0</h1>
<hr>
<h2>About:</h2>
<p>This application was created on <b>Laravel v5.4.10</b> framework.<br>
    Unit tests were created on <b>PHPUnit v4.8.35</b>.</p>
<h3>To get started - first of all, you should install:</h3>
<ol>
    <li>XAMPP (or other local server program) with PHP 5.6 or higher</li>
    <p></p>
    <li>Composer manager: <br>
        a) download composer installer from <a href="https://getcomposer.org/">getcomposer.org</a>
        and follow installation instructions
        for global install;
    </li>
    <p></p>
    <li>Install composer for this app: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; <br>
        &nbsp;&nbsp;&nbsp;- composer install;
    </li>
    <p></p>
    <li>PHPUnit PHP Testing Framework: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; (if needed) <br>
        &nbsp;&nbsp;&nbsp;- composer requires phpunit/phpunit;
    </li>
</ol>
<p></p>
<h3>Step by step guide for launching the Contacts Application:</h3>
<ol>
    <li>Copy all files to c:\path to your directory\</li>
    <p></p>
    <li>Launch XAMPP local server program: <br>
        a) click 'start' button on 'Apache' module;<br>
        b) click 'start' button on 'MySQL' module;
    </li>
    <p></p>
    <li>Launch your DataBase Manager (like phpMyAdmin)</li>
    <p></p>
    <li>Create new DataBase with the name 'contacts_app' (if you want to change to another DB name -
        see: 'If you want to change default config' chapter of this manual)
    </li>
    <p></p>
    <li>On next step, you should add tables to this database, which are used in this app: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; <br>
        &nbsp;&nbsp;&nbsp;- php artisan migrate;
    </li>
    <p></p>
    <li>To launch this app: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; (if needed) <br>
        &nbsp;&nbsp;&nbsp;- php -S localhost:8888 -t public; <br>
        b) Launch your browser; <br>
        c) put <i>'http://localhost:8888'</i> in the browser address bar
        That's all. Application is running.
    </li>
    <p></p>
</ol>
<h3>Unit Testing</h3>
<p>All unit tests can be found in <i>project_dir/tests/unit/</i>. <br>
    <b style="color: red;">Be aware</b> - For correct execution of unit-tests - DB tables must be
    empty!</p>
<h4>Step by step guide for launching the unit-tests fo this app.</h4>
<ol>
    <li>To refresh database: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; <br>
        &nbsp;&nbsp;&nbsp;- php artisan migrate:refresh; <br>
    </li>
    <p></p>
    <li>To check phpunit installed: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; (if needed) <br>
        &nbsp;&nbsp;&nbsp;- phpunit --version; (if no errors, then OK) <br>
    </li>
    <p></p>
    <li>To start all unit tests for this app, you should: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; (if needed) <br>
        &nbsp;&nbsp;&nbsp;- phpunit; <br>
    </li>
    <p></p>
    <li>To start a specific unit test (for example, 'ExampleTest'), you should: <br>
        a) Launch terminal and input: <br>
        &nbsp;&nbsp;&nbsp;- cd /path_to_project; (if needed) <br>
        &nbsp;&nbsp;&nbsp;- phpunit --filter ExampleTest; <br>
    </li>
</ol>
<p></p>
<h3>If you want to change default config options:</h3>
<ol>
    <li>To switch to debug mode: <br>
        a) open <i>.env</i> file in root directory; <br>
        b) find <i>APP_DEBUG=false</i> and switch to <i>APP_DEBUG=true</i>.
    </li>
    <p></p>
    <li>TimeZone config (Europe/Kiev by default):<br>
        a) go to <i>\config\app.php</i>; <br>
        b) find <i>'timezone' => 'Europe/Kiev'</i> and change value to the timezone required.
    </li>
    <p></p>
    <li>DataBase Config (mySQL by default):<br>
        a) to change mySQL to other RDBMS: <br>
        &nbsp;&nbsp;&nbsp;- go to <i>\config\database.php</i>; <br>
        &nbsp;&nbsp;&nbsp;- go to <i>.env</i> file and change DB_CONNECTION=mysql to other RDBMS. <br>
        b) to change DB name ('contacts_app' by default): <br>
        &nbsp;&nbsp;&nbsp;- go to <i>.env</i> file and change DB_DATABASE=contacts_app to the name of your choice.
    </li>
    <p></p>

</ol>


