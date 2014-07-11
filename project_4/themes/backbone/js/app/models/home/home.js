define(function(require){
   var  _ = require('underscore'),
        Backbone = require('backbone'); 
        
   var baseUrl = '/personal/appH5/project_1/rest_server/index.php',
        url = baseUrl + '/home';
   
   var model = Backbone.Model.extend({
       url: url,
       defaults:{
           'id':null,
           'text': '',
           'num': 0,
           'time': 0,
           'boolean': 0
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
   
   var collection = Backbone.Collection.extend({
       model : model,
       url: url
   });
   
   return {
        model:     model,
        collection: 	collection
   }
});