(function($){
	var $login 		= $('#login'),
		$from 		 = $login.find('#formLogin'),
		$logo		 = $login.find('.logo'),
		$r_button	 = $from.find('.loginButton'),		
		$main_ani	 = $r_button.find('#main_ani');
			
		
			
		setTimeout(function(){
			$logo.addClass('tran');
			setTimeout(function(){
				$logo.addClass('ani');
				setTimeout(function(){
					$logo.removeClass('ani');					
				},800);
			},400);
			
		},200);
		$logo.bind('webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd',function(){
			$from.addClass('ani');
		});
		$main_ani.btnOnOff();
		
}(jQuery));