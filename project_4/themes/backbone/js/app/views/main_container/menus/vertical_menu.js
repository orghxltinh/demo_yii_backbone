define(function(require){
    var $ = require('jquery'),
        _ = require('underscore'),
        Backbone = require('backbone'),
        menuData = require('models/menu/menu'),
        tpl = require('text!views/main_container/menus/menu.html');


    _.templateSettings.variable = "rc";
    var Template = _.template(tpl);

    var menuViews = Backbone.View.extend({
        initialize : function(options){
            var self = this;
            this.collection = new menuData.menu_collection();
            this.setMenuClickEvent = options.setMenuClickEvent;
            this.getContentSwipeEvent = options.getContentSwipeEvent;
            this.getContentSwipeEvent.bind('moveTo',this.setClicked.bind(self));
        },

        render : function(callback){
            var self = this;
            //log('ver menu is running');
            self.$el.hammer();
            this.collection.fetch({
                success: function(){
                    //log('menu đã được lấy dự liệu thành công: '+ self.collection.length);
                    
                    
                    self.models = self.collection.models;  
                    
                    self.models = _.sortBy(self.models,function(item){                        
                        return item.attributes.priority;
                    });
                    
                    vietdigis.Config.numPages = self.models.length;
                    vietdigis.Config.currentId = parseInt(self.models[0].attributes.id);
                    vietdigis.Config.currentNum = 0;
                    
                    self.models.reverse();
                    self.$el.append(Template(self.models));
                    self.$menuItems = self.$el.find('.menu-item');
                    self.$menuItems.first().addClass('selected');
                    callback();
                }
            });
        },

        setClicked: function(num){
            num = parseInt(num);
            var $clicked = this.$menuItems.eq(num);
            this.$menuItems.not($clicked).removeClass('selected');
            $clicked.addClass('selected');
        },
        slideHandler: function(){
            this.$el.toggleClass('ani');
        }
    });

    return  menuViews;
});
