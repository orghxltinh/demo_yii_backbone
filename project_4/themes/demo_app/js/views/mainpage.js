define(function(require){
    var mainpage_html = require('text!views/html/mainpage.html'),
        form_html = require('text!views/html/userform.html'),
        data = require('models/question'),
        mainpage_T = _.template(mainpage_html);
    
    demo.Views.mainview = Backbone.View.extend({
        initialize: function(options){
            demo.$user.append(form_html);
            this.collection = new data.Collection();
            _.bindAll(this,"postResult");
            this.$el.hammer();
        },
        events:{
            "tap div.button":'postResult'
        },
        render: function(){
            var self = this;
            this.userFunc();
            this.collection.fetch({
                success: function(){
                    self.models = self.collection.models;
                    self.$el.append(mainpage_T({data:self.models}));
                }
            });
            
        },
        postResult: function(){
            console.log('tap one');
        },        
        mainFunc: function(){
            
        },
        userFunc: function(){
            demo.$user.hammer();
            var $input = demo.$user.find('input.demo-name');
            var $btn = demo.$user.find('div.btn');
            $btn.bind('tap',function(){
                
            });
        },
        getUserInfo: function(){
            
        },
        postData:function(){
            
        }
    });
    
    return demo.Views.mainview;
});