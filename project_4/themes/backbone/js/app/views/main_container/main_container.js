define(function(require){
    var $ = require('jquery'),
        _ = require('underscore'),
        Backbone 	= require('backbone'),
        MenuView = require('views/main_container/menus/vertical_menu'),
        MainContent = require('views/main_container/main_content/main_content');

    

    vietdigis.Events.menuClick = _.extend({},Backbone.Events);
    vietdigis.Events.contentsSwipe = _.extend({},Backbone.Events);

    var mainContainerView = Backbone.View.extend({
        initialize: function(){
            var $wrapper = $('<div class="container"></div>').appendTo(vietdigis.$main_container);
            this.config_bar = $('<div id="config-bar" class="config-bar"></div>').appendTo($wrapper);
            var $left_content = $('<div id="left-content" class="col-xs-3"></div>').appendTo($wrapper),
                $center_content = $('<div id="center-content" class="mct col-xs-12"></div>').appendTo($wrapper);                

            // -------------------- Start: Menu ------------------------
            var MenuViewController = MenuView.extend({
                
                events: {
                    'tap li':'eventHandler',
                    'tap div#slide-Button': 'slideHandler'
                },
                eventHandler: function(e){
                    var self = this,
                        currentTarget = e.currentTarget, $currentTarget = $(currentTarget),
                        num = currentTarget.getAttribute('num');
                                        
                    //console.log('menu is clicked'); 
                    //self.setMenuClickEvent.trigger('numMenuClick', e.currentTarget.id);
                    self.setMenuClickEvent.trigger('numMenuClick', num);
                    self.setClicked.call(self,num);
                },
                
            });
            vietdigis.Menu.View = new MenuViewController({
                el: $left_content,
                setMenuClickEvent: vietdigis.Events.menuClick, // truyền event vào Menu
                getContentSwipeEvent: vietdigis.Events.contentsSwipe
            });
            // -------------------- End: Menu ------------------------
         
            /* ver 2;
            MenuView.prototype.events = {
                'click li':'eventHandler'
            }
            MenuView.prototype.eventHandler = function(e){
                var self = this,
                    currentTarget = e.currentTarget, $currentTarget = $(currentTarget);

                $currentTarget.find('span').html('clicked');
            }
            vietdigis.Menu.View = new MenuView({el: $left_content});
             */

            // -------------------- Start: Content ------------------------
            vietdigis.mainContent.View = new MainContent({
                el: $center_content,
                getMenuClickEvent: vietdigis.Events.menuClick, // truyen event vao main content
                setContentSwipeEvent: vietdigis.Events.contentsSwipe
            });
            // -------------------- End: Menu ------------------------
        },
        render: function(){
            var self = this;
            //log('main container is running');
            vietdigis.Menu.View.render(function(){
                vietdigis.mainContent.View.render();
            });
            
        },
        
    });


    return mainContainerView;
});
