window.demo = window.demo || {};    
demo.Views = {}; 
demo.Events = {}; 

demo.loadCss = function(url){
    var link = document.createElement('link');
    link.type = 'text/css'; link.rel = 'stylesheet'; link.href = url;
    document.getElementsByTagName('head')[0].appendChild(link);
};

(function(){
    document.body.addEventListener('touchmove', function(event) {
        event.preventDefault();
    }, false);
    var h = window.innerHeight; 
    var main = document.getElementsByClassName('main-contain');
    main[0].style.height = h+'px';
})();

