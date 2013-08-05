module.exports = function(grunt) {
    
    var roots = ['global', 'index', 'signup', 'honour', 'video', 'news', 'iuploader', 'gallery', 'teacher'];
    
    function getFiles(type) {
        var files = [],
            i = 0,
            l = roots.length;
            
        for (; i < l; i++) {
            files.push(getFile(roots[i], type));
        }
        
        return files;
    }
    
    function getFile(root, type) {
        return {
            expand: true,
            cwd: root + '/',
            src: ['**/*.' + type, '!**/*-min.' + type, '!**/greensock/**', '!**/ZeroClipboard/**'],
            dest: root + '/',
            ext: '-min.' + type 
        };
    }
    
    grunt.initConfig({
        uglify: {
            options: {
                banner: "/* ZD */\n"
            },
            myTask: {
                files: getFiles('js')
            }
        },
        cssmin: {
            cssminify: {
                files: getFiles('css')
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['uglify', 'cssmin']);

};