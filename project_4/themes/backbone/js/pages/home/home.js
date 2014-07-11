(function(){
    var loadArr = [ 'models/home/home',
                    'text!pages/home/view/main.html',
                    'text!pages/home/view/form.html',
                    'text!pages/home/view/delete.html'
                ];
    define(loadArr,function(Data,_main,_form,_delete){  
        
        
        vietdigis.Pages.home = vietdigis.Template.extend({
            initialize: function(options){       
                _.templateSettings.variable = "obj";
                this.mainT = _.template(_main),
                this.updateT = _.template(_form),
                this.createT = _.template(_form),
                this.deleteT = _.template(_delete);
        
                this.Data = Data;
                this.collection = new this.Data.collection();  
                
                this.ready();
            },
        });
    });
})();