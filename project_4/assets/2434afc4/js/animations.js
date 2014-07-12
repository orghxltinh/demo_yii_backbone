
;(function($){
    /* --------- Start: animate Open - Close Popup --------- */
    $.openPu = function(element,options){
        this.$elf = element;
        this.init(options);
    }
    
    $.openPu.prototype = {
        init: function(options){
            var main = this;
            main.options = $.extend(true,{},$.openPu.default,options);
        },
        
        open: function(){
            var main = this,
                $obj = main.$elf,
                anitime = main.options.time,                
                str = 'all '+anitime+'s ease';
            
            $obj.show(0,function(){
                $(this).css({
                    'transition':str,
                    '-webkit-transition':str,
                    '-moz-transition':str,
                    '-o-transition':str,
                }).addClass('ani');
            });
            
        },
        close: function(){
            var main = this,
                $obj = main.$elf;    
            
            $obj.removeClass('ani');
            $obj.one('webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd',function(){
                $(this).css({
                    'transition':'none',
                    '-webkit-transition':'none',
                    '-moz-transition':'none',
                    '-o-transition':'none',
                });
            });
        }
    }
    
    $.openPu.default = {
        time : 1,
        action : 'open'
    }
    
    $.fn.animatePopup = function(options,callback){
        return this.each(function(){
            var $this   = $(this),
                main    = new $.openPu($this,options),
                action  = main.options.action;
            
            if(action === 'open'){
                main.open();
                if(callback && typeof(callback) === "function"){
                    callback();                                    
                }
            }
            else if(action === 'close'){
                main.close();
                if(callback && typeof(callback) === "function"){
                    $this.one('webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd',function(){
                        callback();
                    });                
                }
            }
                
            
            
            
        });
    }
    /* --------- Close: animate Open - Close Popup --------- */
    
}(jQuery));