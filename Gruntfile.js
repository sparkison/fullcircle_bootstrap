	module.exports = function(grunt) {
	// Project configuration.

	scripts = [
		'assets/js/bootstrap.min.js',
		'assets/js/bootstrap-hover-dropdown.min.js',
		'assets/js/jquery.inview.min.js',
		'assets/js/velocity.min.js',
		'assets/js/velocity.ui.min.js',
		'assets/js/dev/custom.js'
	];

	/**
	 * Uglify JS
	 */
	grunt.initConfig({
	pkg: grunt.file.readJSON('package.json'),
	uglify: {
	  options: {
	      banner: '/*!\n' +
		          ' * <%= pkg.name %>\n' +
		          ' * <%= pkg.title %>\n' +
		          ' * <%= pkg.url %>\n' +
		          ' * @author <%= pkg.author %>\n' +
		          ' * @version <%= pkg.version %>\n' +
		          ' * Copyright <%= pkg.copyright %>\n' +
		          ' */\n'
		    },
	  dev: {
				options: {
					compress: false,
					beautify: true,
					mangle: false
				},
				files: {'assets/js/<%= pkg.name %>.min.js' : scripts }
	  },
			dist: {
				files: {'assets/js/<%= pkg.name %>.min.js' : scripts }
			}
	},
	/**
	 * Sass
	 */
	sass: {
		  dev: {
				options: {
					style: 'expanded',
					compass: true
				},
		    files: {
		    	'assets/css/<%= pkg.name %>.min.css' : 'assets/scss/<%= pkg.name %>.scss'
		    }
		  },
		  
		  dist: {
		    options: {
		      banner: '/*!\n' +
		          ' * <%= pkg.name %>\n' +
		          ' * <%= pkg.title %>\n' +
		          ' * <%= pkg.url %>\n' +
		          ' * @author <%= pkg.author %>\n' +
		          ' * @version <%= pkg.version %>\n' +
		          ' * Copyright <%= pkg.copyright %>\n' +
		          ' */\n',
		      style: 'compressed',
		      compass: true
		    },
		    files: {
		    	'assets/css/<%= pkg.name %>.min.css' : 'assets/scss/<%= pkg.name %>.scss'
		    }
		  }
		},
		/**
		 * Watch
		 */
		watch: {
			css: {
				files: ['assets/scss/*.scss', 'assets/scss/includes/*.scss'],
				tasks: ['sass:dev']
			},
			js: {
				files: ['assets/js/*.js', 'assets/js/dev/*.js', 'assets/js/vendor/*.js'],
				tasks: ['uglify:dev']
			}
		},
		/**
		 * uncss - https://github.com/addyosmani/grunt-uncss
		 */
		uncss: {
		  dist: {
		    options: {
		      	ignore			 : [/meta\..+/, 'visible'],
						stylesheets  : ['assets/css/<%= pkg.name %>.min.css'],
		      	//timeout    : 1000,
		      	report       : 'min',
						urls         : [
									'http://test.SITE_URL.dev/'
						]
		    },
		    files: {
		      'assets/css/<%= pkg.name %>.clean.css': ['*.php']
		    }
		  }
		},

		penthouse: {
			extract : {
			    outfile : 'css/<%= pkg.name %>.critical.css',
			    css : 'assets/css/<%= pkg.name %>.min.css',
			    url : 'http://test.SITE_URL.dev/',
			    width : 1300,
			    height : 900
			},
		}
		
	});

	// Load the plugin that provide the tasks
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-penthouse');
	grunt.loadNpmTasks('grunt-uncss');

	// Task(s).
	grunt.registerTask('default', ['uglify:dev', 'sass:dev']);
	grunt.registerTask('dev', ['uglify:dev', 'sass:dev']);
	grunt.registerTask('dist', ['uglify:dist', 'sass:dist']);
	grunt.registerTask('optimize', ['uglify:dist', 'sass:dist', 'uncss:dist']);

};