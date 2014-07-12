$(document).ready(function(e) {
  var $header 	= $('#header')                          ,
  //$acc_info	= $header.find('> ul#account_info')     ,
  $info		= $header.find('div#settings')          ,
  $icon         = $info.find('#settings-ani')           ,
  $subnav       = $info.find(' ul.subnav')            ;
  
  var time=null;
  
  $info.filter(':not(ul.subnav)').hover(
        function(e){
              $subnav.dequeue().css('display','block');
              $subnav.unbind('webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd');
              clearTimeout(time);
              setTimeout(function(){
                  $icon.dequeue().addClass('ani');
                  $subnav.dequeue().addClass('ani');
              },20);
        },
        function(e){
            time = setTimeout(function(){
                $subnav.removeClass('ani');
                $icon.removeClass('ani');
                $subnav.bind('webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd',function(){
                  $(this).css('display','none').unbind();
                });
            },1000);   
        }
   );	

    //Datepicker
    $("input.datepicker").datepicker({ 
      autoSize: true,
      appendText: '(dd-mm-yyyy)',
      dateFormat: 'dd-mm-yy'
    });
    $( "div.datepickerInline" ).datepicker({ 
      dateFormat: 'dd-mm-yy',
      numberOfMonths: 1
    }); 
    $( "input.birthday" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd'
    });
  //Datetimepicker
  //$("#datetimepicker").datetimepicker();
  //$('#timepicker').timepicker({});
});

