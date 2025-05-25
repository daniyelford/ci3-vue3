https://codeload.github.com/bcit-ci/CodeIgniter/zip/3.1.13
پوشه های 
back
front
را ساخته و سپس پوشه های
application
system
و همینطور فایل
composer.json
را در پوشه ی 
back
و داخل فایل
index.php
تغییرات می دهیم
$system_path = 'back/system';
$application_folder = 'back/application';
$view_folder = 'front';
require_once APPPATH. 'config/constants.php';
$conn = new mysqli(HOST, USERNAME, PASSWORD);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!$conn->select_db(DBNAME)){
    $conn->query("CREATE DATABASE IF NOT EXISTS ".DBNAME);
	$conn->select_db(DBNAME);
}
$result = $conn->query("SHOW TABLES");
if ($result->num_rows < 50){
	$sql_file_path = APPPATH.'sql/init.sql';
    if (file_exists($sql_file_path)) {
        $sql_content = file_get_contents($sql_file_path);
		$conn->query($sql_content);
	}
}
	
$conn->close();
در پوشه ی 
front
محتویات پوشه
back/application/views
را ریخته و در فایل
back/application/config/config.php
تغییرات می دهیم

$config['composer_autoload'] = realpath(APPPATH . '../vendor/autoload.php');

$config['index_page'] = '';

$config['enable_query_strings'] = FALSE;


$is_localhost=!(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']!=='localhost');
$http=$is_localhost?'localhost':$_SERVER['HTTP_HOST'];
$root = $is_localhost?'http://':'https://';
$root=$root.$http.str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['base_url']    = $root;

$config['webauthn'] = [
    'origin' => $root,
    'rp_name' => 'my home',
    'rp_id' => $http,
    'attestation' => 'none'
];

با ترمینال به آدرس
back
میریم و 
composer install
و در فایل 
back/application/config/autoload.php
تغییرات میدیم
$autoload['libraries'] = array('database','session','form_validation');
$autoload['helper'] = array('url','file','form');
در فایل 
back/application/config/constants.php
اضافه می کنیم
define('HOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DBNAME','total');
و در فایل
back/application/config/database.php
تغییرات می دهیم
'hostname' => HOST,
'username' => USERNAME,
'password' => PASSWORD,
'database' => DBNAME,
در فایل
composer.json
تغییر می دهیم
{
	"description": "The CodeIgniter framework",
	"name": "codeigniter/framework",
	"type": "project",
	"homepage": "https://codeigniter.com",
	"license": "MIT",
	"support": {
		"forum": "http://forum.codeigniter.com/",
		"wiki": "https://github.com/bcit-ci/CodeIgniter/wiki",
		"slack": "https://codeigniterchat.slack.com",
		"source": "https://github.com/bcit-ci/CodeIgniter"
	},
	"require": {
		"php": ">=5.3.7"
	},
	"suggest": {
		"paragonie/random_compat": "Provides better randomness in PHP 5.x"
	},
	"scripts": {
		"test:coverage": [
			"@putenv XDEBUG_MODE=coverage",
			"phpunit --color=always --coverage-text --configuration tests/travis/sqlite.phpunit.xml"
		]
	},
	"require-dev": {
		"mikey179/vfsstream": "1.6.*",
		"phpunit/phpunit": "4.* || 5.* || 9.*"
	}
}

و به صورت کلی اضافه می کنیم
back/system/core/URI.php

#[\AllowDynamicProperties]
class CI_URI 

back/system/core/Router.php

#[\AllowDynamicProperties]
class CI_Router 

back/system/core/Loader.php

#[\AllowDynamicProperties]
class CI_Loader 

back/system/core/Controller.php

#[\AllowDynamicProperties]
class CI_Controller


back/system/database/DB_driver.php

#[\AllowDynamicProperties]
abstract class CI_DB_driver

در پوشه ی 
back/application
یک پوشه به اسم 
sql
و یک فایل به اسم 
init.sql
اضافه می کنیم
و در نهایت فایل 
.htaccess
را ایجاد کرده و می نویسیم
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>

با ترمینال وارد فایل 
front
شده و مینویسیم
npm init -y
npm install -g @vue/cli
vue create .
{vue 3}
vue add router
{yes,yes}
npm install
npm run build

داخل پوشه 
front
فایل
htaccess
را می سازیم و در داخلش اضافه می کنیم
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} -f [OR]
  RewriteCond %{REQUEST_FILENAME} -d
  RewriteRule ^ - [L]
  RewriteRule ^ index.html [L]
</IfModule>

