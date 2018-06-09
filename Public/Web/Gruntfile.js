module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        //配置信息入口
        //检查css
        csslint: {
            strict: {
                options: {
                    csslintrc: '.csslintrc'
                },
                src: ['web/css/**/*.css']
            },
        },

        //检查js
        jshint: {
            options: {
                curly: true,
                eqeqeq: true,
                eqnull: true,
                browser: true,
                globals: {
                    jQuery: true
                },
            },
            uses_defaults: ['Gruntfile/**/*.js', 'web/js/**/*.js'],
        },

        //压缩
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                    '<%= grunt.template.today("yyyy-mm-dd") %> */'
            },
            my_target: {
                files: {
                    'web/js/login.min.js': ['web/js/login.js']
                }
            }
        },

        //自动化
        watch: {
            files: ['**/*'],
            tasks: ['jshint'],
        },

        //合并多个文件的代码到一个文件中
        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: ['web/js/login.js', 'web/js/test1.js'],
                dest: 'web/js/built.js',
            },
        },

        //复制文件、文件夹
        copy: {
            main: {
                files: [
                    // 包含路径内的文件
                    { expand: true, src: ['web/js/*'], dest: 'dest', filter: 'isFile' },

                    // 包含路径及其子目录中的文件
                    // { expand: true, src: ['path/**'], dest: 'dest/' },

                    // 让所有的SRC相对于CWD
                    // { expand: true, cwd: 'path/', src: ['**'], dest: 'dest/' },

                    // 把结果单级
                    // { expand: true, flatten: true, src: ['path/**'], dest: 'dest/', filter: 'isFile' },
                ],
            },
        },


    });

    // 加载包含 "uglify" 任务的插件。
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // 默认被执行的任务列表。
    grunt.registerTask('default', ['watch']);

};