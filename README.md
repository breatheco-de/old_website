# BreatheCode LMS Theme for Wordpress

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

4) **Create database for your installation**
```sh
$ wp db create
```

5) **Install wordpress**
```sh
$ wp core install --url={domain.com} --title="First Attempt" --admin_user={yourusername} --admin_password={yourpassword} --admin_email={your@email.com}
```

6) **Test your wordpress instalation (login) by going to /wp-admin**

7) **[Install composer](https://getcomposer.org/download/) (if needed)**

8) **If everything is ok, check your composer.json remove or add any plugins based on your taste and run:**
```sh
$ composer install
```
    
## The System Uses the following plugins

These are all the mandatory plugins for the wordpress instalation (any other plugin is not really mandatory)
    
| Included Via      | Plugin        |
| -                 | -             |
| composer install  | [polylang](https://wordpress.org/plugins/polylang/)     |
| composer install  | [nav-menu-roles](https://wordpress.org/plugins/nav-menu-roles/)     |
| composer install  | [post-types-order](https://wordpress.org/plugins/post-types-order/)     |
| current repo      | [GravityForms](http://www.gravityforms.com/)  |
| current repo      | [Visual Composer](https://vc.wpbakery.com/)   |
| current repo      | [GravityForms Registration Add-On](http://www.gravityforms.com/add-ons/user-registration/)|
| current repo      | [Restrict User Access](https://wordpress.org/plugins/restrict-user-access/) |
| current repo      | [Toolset Types](https://wordpress.org/plugins/types/) |

## Author

**Alejandro Sanchez**
- About me: [alesanchezr.com](alesanchezr.com)
