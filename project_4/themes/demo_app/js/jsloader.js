 (function(){
    identifyGlobal(jglobal,function(){
        mainConfig();
    },20);
    console.log(jglobal);
    function mainConfig(){
        requirejs.config({
            baseUrl: jglobal.appPath+'/js',
            paths:{               
                backbone:'vendor/backbone-min',
                underscore: 'vendor/underscore-min',
                text: 'vendor/text',
                jquery: 'vendor/jquery',
                hammerjs: 'vendor/hammer.min',
                'jquery_hammer' : 'vendor/jquery_hammer',
                'backbone_hammer':'vendor/backbone_hammer',            
                router: 'router/router',
            },
            shim:{
                global:['underscore'],
                'backbone':{  deps:['config','jquery','global','underscore'],exports:'Backbone'},
                'underscore':{ exports:'_' },
                'router': ['config','backbone'],
                'backbone_hammer':['jquery_hammer','backbone']
            }
        });
        
        require(['config'],function(){
            require(['jquery','backbone','router'],function($,Backbone,Router){
                require(['backbone_hammer'],function(){
                    
                    var mainRouter = new Router();
                    Backbone.history.start();
                });
            });
        });
    }

    function identifyGlobal(glo,callback,time){
        if(typeof(glo) != 'undefined' && glo !== null){
            if(typeof(callback) == 'function' && callback !== null) callback();
        }else
            window.setTimeout(identifyGlobal(glo,callback,time),time);        
    }
 })();
 