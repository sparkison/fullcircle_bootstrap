# fullcircle_bootstrap
**fullcircle_bootstrap** is a Wordpress starter theme with [Underscores (_s)](http://underscores.me/) and [Twitter Bootstrap](http://getbootstrap.com/) integration. Also includes the [wp-bootstrap-navwalker](https://github.com/twittem/wp-bootstrap-navwalker) plugin by [twittem](https://github.com/twittem) for easy Bootstrap menu integration.

![Screenshot](https://raw.githubusercontent.com/sparkison/fullcircle_bootstrap/master/screenshot.jpg)

Notes
-----

This theme implements the Advanced Custom Fields plugin ([ACF](http://www.advancedcustomfields.com/)). You will need to add the contents of this plugin to the **assets/acf** directory, else remove appropriate section from the **functions.php** file.

Using [Grunt](http://gruntjs.com/installing-grunt) for SASS CSS and JS compilation -- use `sudo npm install` (**NOTE**: I've had some problems with Node not install latest modules lately, might need to use `sudo npm install -g npm@latest` instead) command to get Grunt dependancies installed. Currently have `grunt`, `grunt dist` and `grunt dev` setup. `grunt optimize` will need to be configured on a per project basis. Will basically run the `grunt dist` command, and additionaly generate an "Above the fold" css file and remove any unused css based on the URLs passed. The `uncss` method will need extra classes added to the `ignore` variable if css is being added in after site render (i.e. via JavaScript).

- Edit **custom.js** file within the **/assets/js/dev** folder and issue `grunt dist` commmand to compile into **/assets/js** as **fullcircle_bootstrap.min.js**. 
- Edit **_custom.scss** file within the **/assets/scss** folder and issue `grunt dist` commmand to compile into **/assets/css** as **fullcircle_bootstrap.min.css**.

How to use
-----
I created this WordPress+Bootstrap theme to make it easier to get started with custom theme development. This is not intended as an "as-is" theme, but instead as a starting point for your custom theme development.

I've moved some things outside of WordPress to give more control over the scripts and stylesheets loaded to allow more control over the optimization of the theme.

To configure:
- Adding javascript files: if adding additional javascript libraries it is recommend to add them to the `assets/js` directory then add the library name to the `scripts` array within `Gruntfile.js`. This will ensure all javascript files are concatenated and compressed as a singular file.
- Adding stylesheets: it is recommend to add stylesheets to the `assets/css` directory then add them as `@import`'s within the `assets/scss/fullcircle_bootstrap.scss` file. This will ensure all stylsheets are concatenated and compressed as a singular file.
- I've only added 2 stylsheets and 1 javascript file (which are generated automatically via the `grunt` commands) via the WordPress `enqueue` method within the `functions.php` file. This is to allow more flexibility in the optimization of the theme. The primary js and css file are outlined above. To compile them issue the `grunt dist` command, or simply issues `grunt watch` to have them automatically generated if actively making changes.

Questions or issues? Feel free to contact me via [email](shaun@brightmindedmedia.com) or [twitter](https://twitter.com/brightmindedweb).

Extras
-----
**1.** Added Bootstrap hover drop-down to package so Bootstrap drop-down menus will now expand on hover. Can set options in `inc/wp_bootstrap_navwalker.php` lines 85-91. Default is to stay open for 500 milliseconds after hover out.

**2.** Can now easily animate in items when in viewport with [Velocity](https://github.com/julianshapiro/velocity) and jQuery [inview](https://github.com/protonet/jquery.inview). To use simply add the **animate** class to any element, with **data-animation=""** set to your favorite Velocity animation. When the element comes into the viewport, the velocity animation will be added (defaults to only run once). To run each time element comes into viewport, change `$(this).one` to `$(this).bind` on line 21 of `assets/js/dev/custom.js` and re-compile js file with `grunt dist` or `grunt dev` command. 

Example useage: 
```
<div class="animation" data-animation="slideUpBigIn">
  I will "slideUpBigIn" when I come into the viewport
</div>
```

**3.** Theme now includes baked-in minification of inline js/css and html. If you wish to remove this functionality simply uncomment/delete the `require` line from ~line 308 in the `functions.php` file.
