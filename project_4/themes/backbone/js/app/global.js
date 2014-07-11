window.global = window.global||{};

global.getTapValue = function(e,arr){
    var target = e.currentTarget;
    var obj = {
        target : e.target,
        id : target.getAttribute('id'),
        class: target.getAttribute('class')        
    };    
    var ext = {};
    if(typeof(arr) === "object"){    
        for(var x in arr){
            ext[arr[x]] = target.getAttribute(arr[x]);
        }
    }
    return _.extend(ext,obj);    
};
