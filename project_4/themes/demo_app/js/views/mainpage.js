/*
 *this is the main view 
 *
 */
define(function(require){
    var mainpage_html = require('text!views/html/mainpage.html'),
        form_html = require('text!views/html/userform.html'),
        chart_html = require('text!views/html/chart.html'),
        data = require('models/question'),
        mainpage_T = _.template(mainpage_html),
        chart_T = _.template(chart_html);
    
    demo.Views.mainview = Backbone.View.extend({
        initialize: function(options){
            demo.$user.append(form_html);
            this.collection = new data.Collection();
            _.bindAll(this,"postResult");
            this.$el.hammer();
            this.$window = $(window);
            this.window_w = $(window).width();
            
            console.log(this.window_w);
        },
        events:{
            "tap div.button":'postResult'
        },
        
        //render the view
        render: function(){
            var self = this;
            this.userFunc();
            this.collection.fetch({
                success: function(){
                    require(['prettyCheckbox'],function(){
                        self.models = self.collection.models;
                        self.$el.append(mainpage_T({data:self.models}));
                        //console.log(self.models);
                        var $inputs = self.$el.find('input.qs-check');
                        
                        $inputs.prettyCheckable({
                            labelPosition: 'left'
                        });
                        
                        setTimeout(function(){
                            demo.$container.show();
                            demo.$loadingPage.hide();
                            self.reSize();
                        },1000);
                    });                    
                }
            });
            
        },
        
        //post data to PHP Rest API
        postResult: function(){
            var $checks = demo.$questions.find('input[type="checkbox"]');
            var $other = demo.$questions.find('input[type="text"]');
            var answer ={}, arr = [], self = this, 
                url = jglobal.APIbaseUrl + '/index.php/question' + '/post';
			if(parseInt(jglobal.showScriptName) == 0)
				url = jglobal.APIbaseUrl + '/question' + '/post';
                //url = jglobal.APIbaseUrl + '/question' + '/test';
            var isSet = false;    
            $checks.each(function(index,element){
                var $this = $(this), obj={};
                var arrid = $this.attr('id').split('-');
                var id = arrid[arrid.length-1];
                obj.id = id;
                if($this.is(':checked')){
                    obj.value = 1; isSet = true;
                }else obj.value = 0;
                //$this.is(':checked') ? obj.value = 1 : obj.value = 0;
                arr.push(obj);
            });            
            console.log(arr.length);            
            answer.user = this.userName;
            answer.data = arr;
            answer.other = $other.val();
            if(isSet === true || answer.other !=''){
                console.log(arr.length);
                console.log(answer.other);
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
            }
        }, 
        reSize: function(){
            var self = this;
            this.$window.resize(function(){
               var w = self.$window.width(); 
               var h = self.$window.height(); 
               demo.$user.css('height',h);
               demo.$container.css('height',h);
            });
        },
        //get the name of ther user
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
                    demo.$questions.find('#your-name').html(self.userName);
                    globalFunc.animationTrans(demo.$user,[0,demo.Info.height*-1,0]);
                    demo.$questions.show();
                    globalFunc.transitionEnd(demo.$user,function(){
                        demo.$user.hide(0,function(){
                            demo.$user.removeClass('ani');
                            globalFunc.unsetAnimationTrans(demo.$user);
                        });                        
                    });
                }
            });
        },
        
        //handle the Pie Chart
        showPieChart: function(resp){
            var self = this,
                $popup = demo.$questions.find('.popup'),
                $box = $popup.find('.box'),
                $canvas = $box.find('.canvas-wrapper > canvas'),
                $sub = $box.find('.chart-sub');
                
            var pieData = [];
            
            _.each(resp.response.percent,function(item){
                var obj = {
                    value: item.percent*3.6,
                    color: item.color,
                    highlight: item.highlight,
                    label: item.name
                };               
                pieData.push(obj);
            });
            var obj = {
                value: resp.response.other*3.6,
                color: '6a6a6a',
                highlight: '4a4a4a',
                label: 'Other'
            };   
            pieData.push(obj);
            
            $popup.fadeIn(400,function(){
                console.log(self.window_w);
                if(self.window_w < 480){
                    var box_w = $box.innerWidth();
                    console.log(box_w);
                    $canvas[0].width = box_w/2;
                    $canvas[0].height = box_w/2;
                }else{
                    console.log('else');
                    $canvas[0].width = 300;
                    $canvas[0].height = 300;
                }
                var context = $canvas[0].getContext("2d");
                var pie = new Chart(context).Pie(pieData);
                $sub.append(chart_T({data:self.models}));
            });
            this.$window.resize(function(){
                var h = self.$window.height();
                $popup.css('height',h);
                demo.$container.css('overflow','hidden');
            });
        }
    });
    
    return demo.Views.mainview;
});