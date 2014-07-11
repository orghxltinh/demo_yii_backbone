window.vietdigis = window.vietdigis || {};    
vietdigis.Menu = {}; 
vietdigis.mainContent = {}; 
vietdigis.Events = {}; 
vietdigis.Config = {};  
vietdigis.Pages = {};

vietdigis.loadCss = function(url){
    var link = document.createElement('link');
    link.type = 'text/css'; link.rel = 'stylesheet'; link.href = url;
    document.getElementsByTagName('head')[0].appendChild(link);
};

function log(text){
    var log = document.getElementById('log');
    var old = log.innerHTML;
    text = old + ', ' + text;
    log.innerHTML = text;
};

(function(){
    document.body.addEventListener('touchmove', function(event) {
        event.preventDefault();
    }, false);
})();

