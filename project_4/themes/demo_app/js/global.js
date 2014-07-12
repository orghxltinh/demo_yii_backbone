window.globalFunc = {};
globalFunc.animationTrans = function($obj,arr){
    $obj.css({
        '-webkit-transform': 'translate3d('+arr[0]+'px,'+arr[1]+'px,'+arr[2]+'px)',
        '-moz-transform':'translate3d('+arr[0]+'px,'+arr[1]+'px,'+arr[2]+'px)',
        '-ms-transform':'translate3d('+arr[0]+'px,'+arr[1]+'px,'+arr[2]+'px)',
        'transform':'translate3d('+arr[0]+'px,'+arr[1]+'px,'+arr[2]+'px)',
    });
};
globalFunc.unsetAnimationTrans = function($obj){
    $obj.css({
        '-webkit-transform': 'initial',
        '-moz-transform':'initial',
        '-ms-transform':'initial',
        'transform':'initial',
    });
};
globalFunc.transitionEndEvent = "webkitTransitionEnd transitionend msTransitionEnd oTransitionEnd";
globalFunc.transitionEnd = function($obj,callback){
    if(callback != null && typeof(callback)==='function'){
        $obj.bind(globalFunc.transitionEndEvent,function(){
            callback();
            $obj.unbind(globalFunc.transitionEndEvent);
        });        
    }     
};