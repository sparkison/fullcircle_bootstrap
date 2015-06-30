# fullcircle_bootstrap
Was getting tired of re-creating base theme each time, so this repo was born.

fullcircle_bootstrap is a Wordpress starter theme with Underscores (_s) and Twitter Bootstrap integration. Also includes the [wp-bootstrap-navwalker](https://github.com/twittem/wp-bootstrap-navwalker) plugin by [twittem](https://github.com/twittem) for easy Bootstrap menu integration.

Still largely a work in progress. Currently implements the Advanced Custom Fields plugin (ACF). Will need to add this ACF plugin to the "**assets/acf**" directory, else remove appropriate section from the **functions.php** file.

Using Grunt for SASS CSS and JS compilation -- Use `grunt install` command to get Grunt dependancies installed. 
- Edit "**custom.js**" file within the "**/assets/js**" folder and issue `grunt dist` commmand to compile into **/assets/js** as **fullcircle_bootstrap.min.js**. 
- Edit "**_custom.scss**" file within the "**/assets/scss**" folder and issue `grunt dist` commmand to compile into **/assets/css** as **fullcircle_bootstrap.min.css**.
