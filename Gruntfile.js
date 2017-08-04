module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
    sass: {
            options: {
                sourceMap: true
            },
            dist: {
                files: [
                    {
                        expand: true,
                        cwd: "src/css",
                        src: [
                            "**/*.sass",
                            "**/*.scss"
                        ],
                        dest: "web/themes/custom/bootstraped/css",
                        ext: ".css"
                    }
                ]
            }
        }
    });
    
    // Load the plugin that provides the "sass" task.
    grunt.loadNpmTasks('grunt-sass');

    // Default task(s).
    grunt.registerTask('default', ['sass']);

};
