# BreatheCode LMS Theme for Wordpress

This LMS is built as a child theme of "TheDocs" a wordpress theme meant for code documentation.
Here is the link: http://thetheme.io/thedocs/landing/?utm_source=themeforest&utm_medium=preview&utm_campaign=thedocs

## Installing the LMS

0) **Clone this repository and then change the remote to your own repository**
```sh
$ git clone git@github.com:alesanchezr/wordpress-for-developers.git

$ git remote set-url origin {your repository url here}
```

1) **Install WP-CLI by going to the following website: [http://wp-cli.org](http://wp-cli.org/#installing)**

    Note: Here you can find [all wp commands](https://developer.wordpress.org/cli/commands/)

2) **Dowload wordpress latest version**
```sh
$ wp core download
```

3) **Generate configuration file (wp-config.php)
```sh
$ wp core config --dbname={yourdatabase} --dbuser={yourusername} --dbpass={YOUR DATABASE PASSWORD}
```

4) Include these new variables into your configuration file:

```php

$_SERVER["HTTP_HOST"] = $_SERVER["SERVER_NAME"];

define('ASSETS_URL', 'https://assets.breatheco.de/');
define('PROJECTS_URL', 'https://projects.breatheco.de/');
define('BREATHECODE_API_HOST', 'https://talenttree-alesanchezr.c9users.io/');
define('BREATHECODE_CLIENT_ID', '');
define('BREATHECODE_CLIENT_SECRET', '');

```

5) **Create database for your installation**
```sh
$ wp db create
```
Note: first check if MySQL is up an running ([here is how to start mysql and phpmyadmin](https://community.c9.io/t/setting-up-phpmyadmin/1723) if you are using c9)

6) **Install wordpress**
```sh
$ wp core install --url={domain.com} --title="First Attempt" --admin_user={yourusername} --admin_password={yourpassword} --admin_email={your@email.com}
```
Note: If you prefer to follow the wordpress wizard, access your website URL to follow it, and can skip this step.

6) **Test your wordpress instalation (login) by going to /wp-admin**

7) **[Install composer](https://getcomposer.org/download/) (if needed)**

8) **If everything is ok, check your composer.json remove or add any plugins based on your taste and run:**
```sh
$ composer install
```

9) **Install node_modules and dependencies**
```sh
$ npm install
```

Note: Make sure you have npm installed.

10) **Run webpack every time you want to generate a new bundle**

```sh
$ npm run build-dev
```
    
## The Application Uses the following plugins

These are all the mandatory plugins for the wordpress instalation (any other plugin is not really mandatory)
    
| Included Via      | Plugin        |
| -                 | -             |
| composer install  | [polylang](https://wordpress.org/plugins/polylang/)     |
| composer install  | [email-templates](https://wordpress.org/plugins/email-templates/)     |
| composer install  | [nav-menu-roles](https://wordpress.org/plugins/nav-menu-roles/)     |
| composer install  | [post-types-order](https://wordpress.org/plugins/post-types-order/)     |
| current repo      | [GravityForms](http://www.gravityforms.com/)  |
| current repo      | [Visual Composer](https://vc.wpbakery.com/)   |
| current repo      | [GravityForms Registration Add-On](http://www.gravityforms.com/add-ons/user-registration/)|
| current repo      | [Restrict User Access](https://wordpress.org/plugins/restrict-user-access/) |
| current repo      | [Toolset Types](https://wordpress.org/plugins/types/) |

## Plugin usage description

1. Toolset WP Types: The theme is heavily integrated with that plugin, all the custom posts and taxonomies have been configured with this tool and there is a folder class/types/ that contains all the code about this integration, staring for TypesSettings.class.php that is the main manager class.

2. Gravity Forms: This plugin handles most of the interactions with the user. We use the "User Registration add-on" to implement the sign-up functionality. All the other forms are heavily integrated as weel, each of the Gravity Forms takes care of a very particular but important data imput from the user.

3. VC Comporser: This plugin is the reason for the platform being on wordpress, the idea is to create many components to help the content team create better courses. Components like: Replit Exercise, Quizz, Regex Parser, etc. 


## Author

**Alejandro Sanchez**
- About me: [alesanchezr.com](alesanchezr.com)
