# BOT Utilities #

Provides extra functionality and utilities for the BOT website.


## Description ##

Provides extra functionality and utilities for the BOT website.


## Documentation ##

Head over to the [BOT Utilities wiki](https://github.com/UCF/BOT-Utilities/wiki) for detailed information about this plugin, installation instructions, and more.


## Changelog ##

### 1.0.5 ###
Enhancements:
* Added composer file.

### 1.0.4 ###
Enhancements:
* Updated people-list shortcode output for Athena v1.1.1+ compatibility
* Upgraded packages

### 1.0.3 ###
Bugfix:
* Fixed issue where the people-list shortcode was not displaying leadership in their committee assignments.

### 1.0.2 ###
Bugfix:
* Fixed issue where the people-list shortcode was not displaying properly if list was not even.

### 1.0.1 ###
Documentation:
* Updated contributing doc to reflect migration from slack to teams.

### 1.0.0 ###
* Initial release


## Upgrade Notice ##

n/a


## Development ##

Note that compiled, minified css and js files are included within the repo.  Changes to these files should be tracked via git (so that users installing the plugin using traditional installation methods will have a working plugin out-of-the-box.)

[Enabling debug mode](https://codex.wordpress.org/Debugging_in_WordPress) in your `wp-config.php` file is recommended during development to help catch warnings and bugs.

### Requirements ###
* node v16+
* gulp-cli

### Instructions ###
1. Clone the BOT-Utilities repo into your local development environment, within your WordPress installation's `plugins/` directory: `git clone https://github.com/UCF/BOT-Utilities.git`
2. `cd` into the new BOT-Utilities directory, and run `npm install` to install required packages for development into `node_modules/` within the repo
3. Optional: If you'd like to enable [BrowserSync](https://browsersync.io) for local development, or make other changes to this project's default gulp configuration, copy `gulp-config.template.json`, make any desired changes, and save as `gulp-config.json`.

    To enable BrowserSync, set `sync` to `true` and assign `syncTarget` the base URL of a site on your local WordPress instance that will use this plugin, such as `http://localhost/wordpress/my-site/`.  Your `syncTarget` value will vary depending on your local host setup.

    The full list of modifiable config values can be viewed in `gulpfile.js` (see `config` variable).
3. Run `gulp default` to process front-end assets.
4. If you haven't already done so, create a new WordPress site on your development environment to test this plugin.
5. Activate this plugin on your development WordPress site.
6. Configure plugin settings from the WordPress admin under "BOT Utilities".
7. Run `gulp watch` to continuously watch changes to scss and js files. If you enabled BrowserSync in `gulp-config.json`, it will also reload your browser when plugin files change.

### Other Notes ###
* This plugin's README.md file is automatically generated. Please only make modifications to the README.txt file, and make sure the `gulp readme` command has been run before committing README changes.  See the [contributing guidelines](https://github.com/UCF/BOT-Utilities/blob/master/CONTRIBUTING.md) for more information.


## Contributing ##

Want to submit a bug report or feature request?  Check out our [contributing guidelines](https://github.com/UCF/BOT-Utilities/blob/master/CONTRIBUTING.md) for more information.  We'd love to hear from you!
