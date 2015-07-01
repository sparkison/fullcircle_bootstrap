# fullcircle_bootstrap
**fullcircle_bootstrap** is a Wordpress starter theme with [Underscores (_s)](http://underscores.me/) and [Twitter Bootstrap](http://getbootstrap.com/) integration. Also includes the [wp-bootstrap-navwalker](https://github.com/twittem/wp-bootstrap-navwalker) plugin by [twittem](https://github.com/twittem) for easy Bootstrap menu integration.

![Screenshot](https://raw.githubusercontent.com/sparkison/fullcircle_bootstrap/master/screenshot.jpg)

Notes
-----

Still largely a work in progress – this theme implements the Advanced Custom Fields plugin ([ACF](http://www.advancedcustomfields.com/)). You will need to add the contents of this plugin to the "**assets/acf**" directory, else remove appropriate section from the **functions.php** file.

Using Grunt for SASS CSS and JS compilation -- Use `sudo npm install` command to get Grunt dependancies installed. Currently have `grunt`, `grunt dist` and `grunt dev` setup. `grunt optimize` will need to be configured on a per project basis. Will basically run the `grunt dist` command, and additionaly generate an "Above the fold" css file and remove any unused css based on the URLs passed. The `uncss` method will need extra classes added to the `ignore` variable if css is being added in after site render (i.e. via JavaScript).

- Edit "**custom.js**" file within the "**/assets/js**" folder and issue `grunt dist` commmand to compile into **/assets/js** as **fullcircle_bootstrap.min.js**. 
- Edit "**_custom.scss**" file within the "**/assets/scss**" folder and issue `grunt dist` commmand to compile into **/assets/css** as **fullcircle_bootstrap.min.css**.
