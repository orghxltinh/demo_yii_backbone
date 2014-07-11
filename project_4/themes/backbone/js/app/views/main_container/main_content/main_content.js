define(function(require){
    var $ = require('jquery'), _ = require('underscore'), Backbone = require('backbone');
    var baseUrl = 'views/main_container/main_content/';
    var tpl = require('text!views/main_container/main_content/main_content.html');
    
    
    //console.log($(tpl).find('#asw'));
    _.templateSettings.variable = "pages";
    var Template = _.template(tpl);
    vietdigis.Events.contentSwipe = _.extend({},Backbone.Events);
    
    var contentView = Backbone.View.extend({
        custom:{
          mainId:'content',
          mainClass:'contents',
          aniTime:500
        },
        initialize: function(options){
            this.getMenuClickEvent = options.getMenuClickEvent;
            this.setContentSwipeEvent = options.setContentSwipeEvent;
            
            _.bindAll(this,'menuClickEvent','swipeEvent','loadPages');
            this.getMenuClickEvent.bind('numMenuClick',this.menuClickEvent);
            this.swipe = 'swipe .'+ this.custom.mainClass;
            
            this.$content = this.$el.find('.contents');
        },
        events:{
             //'swipe .contents' : 'swipeEvent'
        },
        render: function(){
            var self = this;
            self.$el.hammer();
            self.loadPages();
        },
        menuClickEvent: function(num){
            var self = this;     
            vietdigis.Config.currentNum = parseInt(num);
            self.showContent.call(self,vietdigis.Config.currentNum);
        },
        showContent: function(){
            var num = arguments[0], self = this;
            
            var $clickedContent = self.$contents.eq(num);            
            $clickedContent.fadeIn(self.custom.aniTime);
            self.$contents.not($clickedContent).fadeOut(self.custom.aniTime);
        },
        swipeEvent: function(e){
                      
        },
        loadPages: function(){            
            var self = this;
            var models = vietdigis.Menu.View.models;    
           
            var info = {
                idName : self.custom.mainId,
                className : self.custom.mainClass,
                models : models
            };            
            
            self.$el.append(Template(info));
            self.$contents = self.$el.find('div.'+self.custom.mainClass);    
            
            self.addPageEvents.call(self);
            self.addPages.call(self);
            
        },
        addPageEvents: function(){
            var self = this;
            this.$contents.on('swipe',function(e){
                switch(e.gesture.direction){
                    case "left":
                    case "down":
                        self.swipeNext.call(self);
                    break;
                    case "right":
                    case "up":
                        self.swipePrev.call(self);
                    break;    
                }
            });
        },
        // add pages and it's DOM element in to pages Controller
        addPages: function(){
            
            var self = this,pages = vietdigis.mainContent.Pages,
                models = vietdigis.Menu.View.models;
                        
            var loadingArr = [];
            var nameArr = [];
            _.each(models,function(item){
                var attr = item.attributes, id = attr.id, name = attr.name;    
                loadingArr.push('pages/'+name.toLowerCase()+ '/' + name.toLowerCase());
                nameArr.push(name.toLowerCase());
            });                       
            // ------------ require all pages ------------
            require(['template'],function(){
                console.log(loadingArr);
                require(loadingArr,function(){
                    self.$contents = self.$el.find('div.'+self.custom.mainClass);  
                    console.log('done');    
                    _.each(nameArr,function(item){        
                        var $obj = self.$el.find('div.'+item); 
                        
                        /*
                        require(['model/'+item+'/'+item,'text!pages/'+item+'/view/main.html','text!pages/'+item+'/view/form.html','text!pages/'+item+'/view/delete.html'],
                        function(data,_main,_form,_delete){
                            vietdigis.Pages[item].view = new vietdigis.Pages[item]({
                                el:$obj,
                                name: item
                            });
                            vietdigis.Pages[item].view.render();
                        });    
                        */
                        vietdigis.Pages[item].view = new vietdigis.Pages[item]({
                            el:$obj,
                            name: item
                        });
                        vietdigis.Pages[item].view.render();
                    });
                });
            });
            
        },
        
        swipeNext: function(){
            vietdigis.Config.currentNum == (vietdigis.Config.numPages - 1) ? vietdigis.Config.currentNum = 0 : vietdigis.Config.currentNum++;
            this.changePage.call(this);      
        },
        swipePrev: function(){
            vietdigis.Config.currentNum == 0 ? vietdigis.Config.currentNum = (vietdigis.Config.numPages - 1) : vietdigis.Config.currentNum--;
            this.changePage.call(this);       
        },
        changePage: function(){
            this.triggerChangePageEvent.call(this);      
            this.showContent.call(this,vietdigis.Config.currentNum);
        },
        triggerChangePageEvent: function(){
            this.setContentSwipeEvent.trigger('moveTo',vietdigis.Config.currentNum);
        }
        
        
    });
    return contentView;
});


