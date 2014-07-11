define(function(require){
    var _ = require('underscore'),
        Backbone = require('backbone');

    var baseUrl = '/personal/appH5/project_1/rest_server/index.php';

    var model = Backbone.Model.extend({
        url: baseUrl + 'menu',
        defaults:{
            'id' : null,
            'name':'',
            'slug':'',
            'priority':'',
        },


        sync: function(method, model, options){

            if (method == 'create'){
                options.url = model.url;
                console.log(options.url);
            }else if(method == 'update'){
                options.url = model.url + '/' + model.id;
                console.log(options.url);
            }else if (method == 'delete'){
                options.url = model.url + '/' + model.id;
                console.log(options.url);
            }
            Backbone.sync(method, model, options);
        }
    });

    var collection = Backbone.Collection.extend({
        model : model,
        url: baseUrl + '/menu'
    });
    return {
        menu_model: 		model,
        menu_collection: 	collection
    }
});