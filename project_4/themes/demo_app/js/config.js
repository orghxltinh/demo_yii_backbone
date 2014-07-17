window.demo = window.demo || {};    
demo.Views = {}; 
demo.Events = {}; 
demo.Info = {};

demo.loadCss = function(url){
    var link = document.createElement('link');
    link.type = 'text/css'; link.rel = 'stylesheet'; link.href = url;
    document.getElementsByTagName('head')[0].appendChild(link);
};

(function(){
    document.body.addEventListener('touchmove', function(event) {
        event.preventDefault();
    }, false);
    demo.Info.height = window.innerHeight; 
    var main = document.getElementsByClassName('main-contain'),
        loadingPage = document.getElementById('loadingPage');
    main[0].style.height = demo.Info.height+'px';
    loadingPage.style.height = demo.Info.height+'px';
    loadingPage.style.display = 'block';
})();

