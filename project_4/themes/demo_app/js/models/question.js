define(function(require){
   var  _ = require('underscore'),
        Backbone = require('backbone'); 
        
   var baseUrl = jglobal.APIbaseUrl, model_name = '/question';
   
   var Model = Backbone.Model.extend({
       url: baseUrl + model_name,
       defaults:{
           'id':null,
           'text': '',
           'color':'',
           'highlight':''
       },
       sync: function(method, model, options){
            
            if (method == 'create'){
                options.url = model.url + '/' + 'create';
                console.log(options.url);
            }else if(method == 'update'){
                options.url = model.url + '/update/' + model.id;
                console.log(options.url);
            }else if (method == 'delete'){
                options.url = model.url + '/delete/' + model.id;
                console.log(options.url);
            }
            Backbone.sync(method, model, options);
        }
   });
   
   var Collection = Backbone.Collection.extend({
       model : Model,
       url: baseUrl + model_name + '/get'
   });
   
   return {
        Model:     Model,
        Collection: 	Collection
   }
});