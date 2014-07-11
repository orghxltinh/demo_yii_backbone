vietdigis.Template = {
    crud: {
        ready: function(){
            this.$el.hammer();
            _.bindAll(this,'buttonClicked','collectionAdd','collectionChange','collectionDelete');
            this.$update = $('<div id="update" class="popup"></div>').appendTo(this.$el);
            this.$delete = $('<div id="delete" class="popup"></div>').appendTo(this.$el);
            this.$create = $('<div id="create" class="popup"></div>').appendTo(this.$el);
            this.$update.$cl = $('<div id="update-close" class="btn-close"></div>').appendTo(this.$update);
            this.$delete.$cl = $('<div id="delete-close" class="btn-close"></div>').appendTo(this.$delete);
            this.$create.$cl = $('<div id="create-close" class="btn-close"></div>').appendTo(this.$create);
        },
        events:{
            'tap div.btns':'buttonClicked'
        },
        render: function(){                
            var self = this;
            this.collection.fetch({
                success: function(){
                    self.models = self.collection.models;
                    //bind collection event
                    self.collection.bind('add',self.collectionAdd);
                    self.collection.bind('change',self.collectionChange);
                    self.collection.bind('destroy',self.collectionDelete);
                    self.$el.append(self.mainT(self.models));//render all records
                }
            });
        },
        buttonClicked: function(e){                
            var self = this;
            var infos = global.getTapValue(e,['action','link']);        

            switch (infos.action){
                case "update":
                    self.$update.fadeIn(500);
                    self.actionUpdate.call(self,infos);
                break;
                case "delete":
                    self.$delete.fadeIn(500);
                    self.actionDelete.call(self,infos);
                break;
                case "create":
                    self.$create.fadeIn(500);
                    self.actionCreate.call(self,infos);
                break;    
            }
        },
        actionDelete: function(){
            var self = this, infos = arguments[0], action = infos.action;
            this.$delete.append(this.deleteT);
            var $box = this.$delete.find('#delete-box'),
                $btns = $box.find('.btns');    
            //this.$delete.$cl = this.$delete.$cl.add($btns);
            var model = _.find(self.models,function(item){
                return item.attributes.id == infos.link;
            });
            $btns.bind('tap',function(){
                var $this = $(this), type = $this.attr('id').split('-')[1];
                switch(type){
                    case "yes":
                        model.destroy({
                            success: function(m, response){//success transfer data and get response
                                console.log(response);
                                self._actionClose.call(self,'delete',function(){
                                    $box.remove();
                                });  
                            },
                            error: function(m, response){
                                console.log(response);
                            }
                        });
                    break;
                    case "no":
                        self._actionClose.call(self,'delete',function(){
                            $box.remove();
                        });  
                    break;
                };

            });   

            self.actionClose.call(self,'delete',function(){
                $box.remove();
            });  
        },
        actionCreate: function(){    
           this.actionSave.apply(this,[arguments,function(){
               console.log('create');
           }]);
        },
        actionUpdate: function(){                
            this.actionSave.apply(this,[arguments,function(){
                console.log('update');
            }]);                
        },
        actionSave: function(){
            console.log(this.Data);
            var self = this, infos = arguments[0][0],action = infos.action,callback = arguments[1];             
            var model;        
            var $content = $('<div class="ctn-'+action+'"></div>').appendTo(self['$'+action]);                
            switch (action){
                case "create":    
                    model = new self.Data.model();
                break;
                case "update":

                    model = _.find(self.models,function(item){
                        return item.attributes.id == infos.link;
                    });
                    console.log('action update');
                break;
            }                
            model.action = action;
            $content.append(self[action + 'T'](model));

            var $submit = $content.find('.sbm-'+action),
                $inputs = $content.find('input'),$newVal = {};


            $submit.on('tap',function(){
                 $inputs.each(function(index,element){
                     var $this = $(this), name = $this.attr('name');

                     $newVal[name]= $this.val();                         
                 });
                 model.set($newVal);
                 model.save(model.attributes,{
                     wait:true,
                     success: function(m, response){//success transfer data and get response

                        switch (action){
                            case "create":    
                                console.log('add model');
                                console.log(m);
                                self.collection.add(m);
                            break;
                            case "update":

                            break;
                        }
                        if(callback) callback();

                        self.afterSubmit(action);
                        $submit.off('tap');
                        $content.remove();
                     },
                     error: function(model, response) {

                     }
                 });   

             });
            this.actionClose.call(this,action,function(){
                $submit.off('tap');
                $content.remove();
            });  

        },
        actionClose: function(name,callback){
            var self = this;          
            self['$'+name]['$cl'].bind('tap',function(){
                self._actionClose(name,callback);
            });
        },
        _actionClose: function(name,callback){
            var self = this;
            self['$'+name].fadeOut(400,function(){
                self['$'+name]['$cl'].unbind('tap');
                if(callback)    callback();
            });
        },
        afterSubmit: function(name,callback){
            this['$'+name].fadeOut(400);
            if(callback)    callback();
        },
        collectionAdd: function(){
            this.reRender.call(this);
        },
        collectionChange: function(){
            this.reRender.call(this);
        },
        collectionDelete: function(){
            this.reRender.call(this);
        },
        reRender: function(){
            var $wrapper = this.$el.find('.content-wrapper');
            $wrapper.remove();
            this.$el.append(this.mainT(this.models));//render all records
        }
    },
    extend: function(funcs){
        var mixFuncs = _.extend(this.crud,funcs);
        return Backbone.View.extend(mixFuncs);
    }
};