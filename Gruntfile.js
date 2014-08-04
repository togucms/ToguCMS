(function() {
"use strict";


module.exports = function(grunt) {
  // Project configuration.
	grunt.initConfig({
		// Metadata.
		pkg: grunt.file.readJSON('package.json'),
		banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
			'<%= grunt.template.today("yyyy-mm-dd") %>\n' +
			'<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
			'* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author %>;' +
			' Licensed <%= pkg.license %> */\n',
		// Task configuration.
		clean: {
			files: [
			        '<%= pkg.js.outputDir %>',
			        '<%= pkg.sass.cssDir %>', 
			        '<%= pkg.frontend.destDir %>',
			        '<%= pkg.admin.linkDir %>', 
			        '<%= pkg.tempDir %>',
			      ]
		},
		symlink: {
			dev: {
				files: [
				    {src:'<%= pkg.admin.srcDir %>', dest: '<%= pkg.admin.linkDir %>'},    
				    {src:'<%= pkg.frontend.srcDir %>', dest: '<%= pkg.frontend.destDir %>'}
				]
			}
		},
		
		copy: {
			fonts: {
				files:[
				       { expand: true, cwd: '<%= pkg.sass.fontsDir %>', src:['**'], dest: '<%= pkg.tempDir %>/<%= pkg.sass.fontsDir %>' },
				]
			},
			dist: {
				files:[
				       { expand: true, cwd: '<%= pkg.admin.srcDir %>/<%= pkg.admin.buildDir %>/', src:['**'], dest: '<%= pkg.admin.installDir %>' }, 
				       { expand: true, cwd: '<%= pkg.frontend.srcDir %>/', src:['aloha*/**', 'vendor/togu/aloha*/**'], dest: '<%= pkg.frontend.destDir %>' } 
				]
			}
		},
		compass: {
			dist: {
				options: {
					sassDir: '<%= pkg.sass.sassDir %>',
					cssDir: '<%= pkg.tempDir %>/<%= pkg.sass.cssDir %>',
					imagesDir: '<%= pkg.sass.imagesDir %>',
					generatedImagesDir: '<%= pkg.sass.generatedImagesDir %>',
					fontsDir: '<%= pkg.sass.fontsDir %>',
					require: '<%= pkg.sass.require %>',
					httpFontsPath: '<%= pkg.sass.httpFontsPath %>',
					httpImagesPath: '<%= pkg.sass.httpImagesPath %>',
					httpGeneratedImagesPath: '<%= pkg.sass.httpGeneratedImagesPath %>',
					environment: 'production'
				}
			},
			dev: {
				options: {
					sassDir: '<%= pkg.sass.sassDir %>',
					cssDir: '<%= pkg.sass.cssDir %>',
					imagesDir: '<%= pkg.sass.imagesDir %>',
					generatedImagesDir: '<%= pkg.sass.generatedImagesDir %>',
					fontsDir: '<%= pkg.sass.fontsDir %>',
					require: '<%= pkg.sass.require %>',
					httpFontsPath: '<%= pkg.sass.httpFontsPath %>',
					httpImagesPath: '<%= pkg.sass.httpImagesPath %>',
					httpGeneratedImagesPath: '<%= pkg.sass.httpGeneratedImagesPath %>',
					outputStyle: "expanded"
				}
			}
		},
		imagemin: {
			dist: {
				files: [{
					expand: true,
					cwd: '<%= pkg.sass.imagesDir %>',
					src: ['**/*.{png,jpg,gif,jpeg}'],
					dest: '<%= pkg.tempDir %>/<%= pkg.sass.imagesDir %>'
				},{
					expand: true,
					cwd: '<%= pkg.sass.generatedImagesDir %>',
					src: ['**/*.{png,jpg,gif,jpeg}'],
					dest: '<%= pkg.frontend.webDir %>/<%= pkg.sass.generatedImagesDir %>'
				}]
			}
		},
		filerev: {
			options: {
				encoding: 'utf8',
				algorithm: 'md5',
				length: 8
			},
			imagesAndFonts: {
				files: [{
					expand: true,
					cwd: '<%= pkg.tempDir %>/<%= pkg.sass.imagesDir %>',
					src: ['**/*.{png,jpg,gif,jpeg}'],
					dest: '<%= pkg.frontend.webDir %>/<%= pkg.sass.imagesDir %>'
				},{
					expand: true,
					cwd: '<%= pkg.tempDir %>/<%= pkg.sass.fontsDir %>',
					src: ['**/*.*'],
					dest: '<%= pkg.frontend.webDir %>/<%= pkg.sass.fontsDir %>'
				}]
			},
			jsAndCss: {
				files:[{
					expand: true,
					cwd: '<%= pkg.tempDir %>/<%= pkg.js.outputDir %>',
					src: ['**/*.js'],
					dest: '<%= pkg.frontend.webDir %>/<%= pkg.js.outputDir %>'
				},{
					expand: true,
					cwd: '<%= pkg.tempDir %>/<%= pkg.sass.cssDir %>',
					src: ['**/*.css'],
					dest: '<%= pkg.frontend.webDir %>/<%= pkg.sass.cssDir %>'
				}]
			}
		},
		uglify: {
			options: {
				banner: '<%= banner %>',
				mangle: {
			        except: ['jQuery', 'Ext', 'App']
			    },
		        sourceMap: false
		    },
			dist: {
				src: '<%= pkg.javascripts %>', 
				dest: '<%= pkg.tempDir %>/<%= pkg.js.outputDir %>/<%= pkg.name %>.min.js'
			}
		},
		qunit: {
			files: ['frontend/test/**/*.html']
		},
		jshint: {
			options: {
	        	jshintrc: true
			},
			gruntfile: {
				src: 'Gruntfile.js'
			},
			src: {
				src: ['frontend/src/**/*.js', 'frontend/togu/**/*.js']
			},
			test: {
				src: ['frontend/test/**/*.js']
			},
		},
		sencha: {
			options: {
				cwd: '<%= pkg.admin.interfaceDir %>',
				failOnWarn: false,
				compressOutput: false
			},
			watch: {
				command: [
				    "app watch"
				]
		    },
		    build: {
		    	command: [
		    	    "app build"      
		    	]
		    },
		    which: {
		    	command: [
		    	    "which"      
		    	]
		    }
		},
		'sf2-console': {
		    options: {},
		    cache_clear: {
		        cmd: 'cache:clear',
		    },
		    cache_clear_prod: {
		        cmd: 'cache:clear',
		        args: {
		            env: 'prod'
		        }
		    },
		    togu_js_generate: {
		    	cmd: 'togu:js:generate'
		    }
		},		
		watch: {
			gruntfile: {
				files: '<%= jshint.gruntfile.src %>',
				tasks: ['build']
			},
/*			src: {
				files: '<%= jshint.src.src %>',
				tasks: ['jshint:src', 'qunit']
			},
			test: {
				files: '<%= jshint.test.src %>',
				tasks: ['jshint:test', 'qunit']
			},
*/			packageJson: {
				files: 'package.json',
				tasks: ['compass:dev', 'symfonyDataFiles:dev']
			},
			css: {
			    files: ['<%= pkg.sass.sassDir %>/**/*.scss'],
			    tasks: ['compass:dev', 'symfonyDataFiles:dev'],
			}
		},
		concurrent: {
			watch: {
				tasks: ['sencha:watch', 'watch'],
				options: { logConcurrentOutput: true }
			}
		
		},
	});
	
	require('load-grunt-tasks')(grunt);

	grunt.registerTask('rewriteCss', 'This task rewrites the css urls with the revved ones', function() {
		grunt.config.requires('pkg.tempDir');
		grunt.config.requires('pkg.frontend.webDir');
		grunt.config.requires('pkg.frontend.srcDir');
		grunt.config.requires('pkg.frontend.destDir');
		
		
		var cssPath = grunt.config('pkg.tempDir') + '/' + grunt.config('pkg.sass.cssDir'),
			cssFiles = grunt.file.expand({}, cssPath + '/**/*.css'),
			summary = {},
			sources = [],
			tempDir = grunt.config('pkg.tempDir'),
			frontSrcDir = grunt.config('pkg.frontend.srcDir'),
			frontDestDir = grunt.config('pkg.frontend.destDir'),
			webDir = grunt.config('pkg.frontend.webDir'),
			regExp = new RegExp('^' + frontDestDir),
			src, dest;
			
		for(src in grunt.filerev.summary) {
			dest = grunt.filerev.summary[src];
			
			src = src.replace(tempDir + '/' + frontSrcDir, '..');
			summary[src] = dest.replace(regExp, '..');
			sources.push(src.replace(/(\.)/g, '\\$1'));
		}
		
		regExp = new RegExp(sources.join('|'), 'g');
		
		cssFiles.forEach(function(file){
			var contents = grunt.file.read(file),
				count = 0;
				
			contents = contents.replace(regExp, function(matches) { count++; return summary[matches]; });
			grunt.file.write(file, contents);
			
			grunt.log.writeln("Processed", file, ":", count, "matches");
		});
	});
	
	grunt.registerTask('symfonyDataFiles', 'This task creates the list of js and css, so symfony can read it easily', function(env) {
		grunt.config.requires('pkg.javascripts');
		grunt.config.requires('uglify.dist.dest');
		grunt.config.requires('pkg.sass.cssDir');
		grunt.config.requires('pkg.symfony.dataDir');
		grunt.config.requires('pkg.frontend.webDir');
		
		var path = grunt.config('pkg.symfony.dataDir'),
			webDir = grunt.config('pkg.frontend.webDir'),
			
			cssDir = (env == "dev" ? "" : webDir + "/") + grunt.config('pkg.sass.cssDir'), 
			jsDir = env == "dev" ? grunt.config('pkg.javascripts') : webDir + '/' + grunt.config('pkg.js.outputDir') + "/**/*.js",
			jsFiles =  grunt.file.expand({}, jsDir),
			cssFiles = grunt.file.expand({}, cssDir + "/**/*.css"),
			
			webDirRegexp = new RegExp('^' + webDir + '/');

		cssFiles = cssFiles.map(function(x) { return x.replace(webDirRegexp, ''); });
		jsFiles = jsFiles.map(function(x) { return x.replace(webDirRegexp, ''); });
			
		grunt.file.mkdir(path);
		
		grunt.file.write(path + '/js.json', JSON.stringify(jsFiles));
		grunt.log.writeln('Created file ' + path + '/js.json');
		
		grunt.file.write(path + '/css.json', JSON.stringify(cssFiles));
		grunt.log.writeln('Created file ' + path + '/css.json');
	});
	
	grunt.registerTask('createCompiledDir', 'This task creates the web/frontend/compiled directory', function(env) {
		grunt.config.requires('pkg.frontend.compiledDir');
		grunt.file.mkdir(grunt.config('pkg.frontend.compiledDir'));
	});

//	grunt.registerTask('test', ['jshint', 'qunit']);
	grunt.registerTask('test', ['jshint:gruntfile']);
	
	grunt.registerTask('build', ['clean', 'symlink:dev', 'test', 'compass:dev', 'symfonyDataFiles:dev', 'concurrent:watch']);
	
	grunt.registerTask('compile', [
       'clean', 
       'compass:dist', 
       'createCompiledDir',
       'sf2-console:cache_clear',
       'sf2-console:togu_js_generate',
       'uglify', 
       'imagemin', 
       'copy:fonts', 
       'filerev:imagesAndFonts', 
       'rewriteCss',
       'filerev:jsAndCss', 
       'symfonyDataFiles:prod',
       'sencha:build', 
       'copy:dist',
       'sf2-console:cache_clear_prod'
    ]);

	// Default task.
	grunt.registerTask('default', ['build']);
};
})();