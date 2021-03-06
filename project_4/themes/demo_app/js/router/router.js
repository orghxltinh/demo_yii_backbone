/*
 * the router of app
 * main view is mainpage.js
 */
define(function(require){
    var mainView = require('views/mainpage');
    
    var Router = Backbone.Router.extend({
        initialize: function(){
            demo.loadCss(jglobal.appPath+'/css/prettyCheckable.css');
            demo.$container = $('body').find('.main-contain');            
            demo.$questions = $('<div class="demo-questions"></div>').appendTo(demo.$container);
            demo.$user = $('<div class="demo-user"></div>').appendTo(demo.$container);
            demo.$loadingPage = $('body').find('#loadingPage');  
        },
        routes:{
            "":'defaultRoute'
        },
        defaultRoute: function(){
            var mainview = new mainView({
                el:demo.$questions
            });
            mainview.render();
        }
    });
    
    return Router;
});