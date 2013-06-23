module.exports = function(grunt) {
    
    grunt.initConfig({
        uglify: {
            options: {
                banner: "/* ZD */\n"
            },
            myTask: {
                files: [
                    {
                        expand: true,
                        cwd: 'global/',
                        src: ['**/*.js', '!**/*-min.js'],
                        dest: 'global/',
                        ext: '-min.js'
                    },
                    {
                        expand: true,
                        cwd: 'index/',
                        src: ['**/*.js', '!**/*-min.js'],
                        dest: 'index/',
                        ext: '-min.js'
                    }
                ]
            }
        },
        cssmin: {
            cssminify: {
                files: [
                    {
                        expand: true,
                        cwd: 'global/',
                        src: ['**/*.css', '!**/*-min.css'],
                        dest: 'global/',
                        ext: '-min.css'
                    },
                    {
                        expand: true,
                        cwd: 'index/',
                        src: ['**/*.css', '!**/*-min.css'],
                        dest: 'index/',
                        ext: '-min.css'
                    }
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['uglify', 'cssmin']);

};