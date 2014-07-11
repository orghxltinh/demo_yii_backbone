;(function(){
    identifyGlobal(jglobal,function(){
        structureConfig();
    },20);
    
    function structureConfig(){
        console.log(jglobal);
        requirejs.config({
            baseUrl: jglobal.appPath+'/js/app',
            paths:{
                'vendor':'../vendor',
                backbone:'../vendor/backbone-min',
                underscore: '../vendor/underscore-min',
                text: '../vendor/text',
                jquery: '../vendor/jquery',
                hammerjs: '../vendor/hammer.min',
                'jquery_hammer' : '../vendor/jquery_hammer',
                'backbone_hammer':'../vendor/backbone_hammer',            
                router: 'router/router',
                template: 'template/template',
                'css' : '../css',
                'pages':'../pages',            
            },
            shim:{
                global:['underscore'],
                'backbone':{  deps:['config','jquery','underscore','global'],exports:'Backbone'},
                'underscore':{ exports:'_' },
                'router': ['config','backbone'],
                'backbone_hammer':['jquery','jquery_hammer','backbone','underscore']
            }
        });
        
        require(['config'],function(){
            require(['jquery','backbone','router'],function($,Backbone,Router){
                require(['backbone_hammer'],function(){
                    //log('main app is running');
                    var mainRouter = new Router();
                    Backbone.history.start();
                });
            });
        });
    }
})();
function identifyGlobal(glo,callback,time){
    if(typeof(glo) != 'undefined' && glo !== null){
        if(typeof(callback) == 'function' && callback !== null) callback();
    }else
        window.setTimeout(identifyGlobal(glo,callback,time),time);        
}