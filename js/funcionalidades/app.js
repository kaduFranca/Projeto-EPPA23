//rolar a página até chegar no conteúdo selecionado no menu
$('nav a').click(function(e){
	e.preventDefault();
	var id = $(this).attr('href'),
			menuHeight = $('nav').innerHeight(),
			targetOffset = $(id).offset().top;
	$('html, body').animate({
		scrollTop: targetOffset - menuHeight
	}, 150);
});

//fechar menu collapse ao clicar no link
$(".nav-link").on("click", function(){
   $('.navbar-collapse').collapse('hide');
});