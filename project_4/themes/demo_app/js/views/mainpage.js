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
            console.log(jglobal.APIbaseUrl);
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
            var $checks = demo.$questions.find('input[type="checkbox"]');
            var $other = demo.$questions.find('input[type="text"]');
            var answer ={}, arr = [], self = this, 
                //url = jglobal.APIbaseUrl + '/question' + '/post';
                url = jglobal.APIbaseUrl + '/question' + '/test';
            $checks.each(function(index,element){
                var $this = $(this), obj={};
                var arrid = $this.attr('id').split('-');
                var id = arrid[arrid.length-1];
                obj.id = id;
                $this.is(':checked') ? obj.value = 1 : obj.value = 0;
                arr.push(obj);
            });            
            answer.user = this.userName;
            answer.data = arr;
            answer.other = $other.val();
            $.ajax({
                url: url, type: 'POST', dataType : 'JSON', data:{'infos':answer} ,
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert("else: "+e.message); // the great unknown
                    }
                },
                success: function(resp){    
                    console.log(resp);
                    require(['chart'],function(){
                        self.showPieChart(resp);
                    });
                    
                }   
            });
        }, 
        userFunc: function(){
            demo.$user.hammer();
            var self = this;
            var $input = demo.$user.find('input.demo-name');
            var $btn = demo.$user.find('div.btn');
            $btn.bind('tap',function(){
                var name = $input.val();
                if(name != ""){
                    demo.$user.addClass('ani');
                    self.userName = $input.val();
                    globalFunc.animationTrans(demo.$user,[0,demo.Info.height*-1,0]);
                    globalFunc.transitionEnd(demo.$user,function(){
                        demo.$user.hide(0,function(){
                            demo.$user.removeClass('ani');
                            globalFunc.unsetAnimationTrans(demo.$user);
                        });                        
                    });
                }
            });
        },
        showPieChart: function(){
            var $popup = demo.$questions.find('.popup'),
                $box = $popup.find('.box'),
                $canvas = $box.find('.canvas-wrapper > canvas');
            var pieData = [
                    {
                            value: 300,
                            color:"#F7464A",
                            highlight: "#FF5A5E",
                            label: "Red"
                    },
                    {
                            value: 50,
                            color: "#46BFBD",
                            highlight: "#5AD3D1",
                            label: "Green"
                    },
                    {
                            value: 100,
                            color: "#FDB45C",
                            highlight: "#FFC870",
                            label: "Yellow"
                    },
                    {
                            value: 40,
                            color: "#949FB1",
                            highlight: "#A8B3C5",
                            label: "Grey"
                    }
		];
            $popup.fadeIn(400,function(){
                console.log($canvas);
                var context = $canvas[0].getContext("2d");
                var pie = new Chart(context).Pie(pieData);
            });
        }
    });
    
    return demo.Views.mainview;
});