Custom Admin Branding
=====================

A class to allow theme/plugin developers to easily brand the WordPress login and admin screens.


## Features

* Add a designer credit with logo to login footer
* Change the login page logo link URL and title attribute
* Add small designer credit to backend pages with logo and splittable text
* Remove the built in WordPress button in WP Admin Bar and add custom icon
* Add a favicon to the login, admin and front end of the site
* (The login logo is not changed in this fork, because I solved this differently in my system. The logo of the customer is changed for each project and therefore has to be maintained in the backend via ACF.)


## Who This is For

This is for developers producing custom WordPress themes, plugins, or managed solutions for clients.


## Usage

First, grab the code.  You can do this with git:

    $ cd /your/theme/directory
    $ git clone git://github.com/JWestarp/WP-Custom-Admin-Branding.git branding

Or you can download the [zipball](https://github.com/JWestarp/WP-Custom-Admin-Branding/archive/refs/heads/master.zip).

Add the content of `functions.php` to your `functions.php` and copy the `inc` folder to your theme.
Now you have to copy your logos to `inc/custom-backend-branding/images` and set your logos and text in `inc/custom-backend-branding/config.php`.

Change the CSS files as you need or just search and replace the colors. I just generated the CSS file with an online tool and added some styles to get all elements in the new color.


### Arguments

* `designer_url` - Used in the credit link on the login and admin pages.
* `designer_anchor` - Used in the credit link on the login and admin pages.
* `login_footer_image` - URL of logo in footer on login page.
* `login_footer_image_width` - Logo width.
* `login_footer_image_height` - Logo height.
* `backend_footer_image` - URL of small logo in footer of backend pages.
* `backend_footer_image_widt` - Logo width.
* `backend_footer_image_height` - Logo height.
* `backend_footer_text` - Text arround small backend footer logo
* `favicon_url` - URL of backend favicon
* `admin_bar_icon_url`  - URL of in WP Admin Bar


## Screenshots

* <img src="/screenshots/login-screen-footer-logo.png?raw=true" alt="Screenshot Login Footer Logo" width="420" />
* <img src="/screenshots/backend-admin-bar.png?raw=true" alt="Screenshot Admin Bar Icon" width="420" />
* <img src="/screenshots/backend-footer.png?raw=true" alt="Screenshot Backend Footer Logo" width="420" />


## License

GPLv2, just like WordPress.
