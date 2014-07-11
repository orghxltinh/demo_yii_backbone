define(function(require){
    //console.log('alo');
    var $ = require('jquery'),
        headerView = require('views/header/header'),
        mainContainerView = require('views/main_container/main_container'),
        footerView = require('views/footer/footer');

    var $body = $('body');
    vietdigis.$header = $('<div id="header" class="one-clear"></div>').appendTo($body);
    vietdigis.$main_container = $('<div id="main_container" class="one-clear"></div>').appendTo($body);
    vietdigis.$footer = $('<div id="footer" class="one-clear"></div>').appendTo($body);

    vietdigis.mainContainer = {};

    vietdigis.router =  Backbone.Router.extend({
        initialize: function(){
            vietdigis.loadCss(jglobal.appPath+'/css/main.css');
            
        },
        routes:{
            "": 'defaultRoute',
            "admin": 'adminView'
        },
        defaultRoute: function(){
            vietdigis.mainContainer.View = new mainContainerView();
            vietdigis.mainContainer.View.render();
        }
    });

    return vietdigis.router;

});