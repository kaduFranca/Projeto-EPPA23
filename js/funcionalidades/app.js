//rolar a página até chegar no conteúdo selecionado no menu
$('nav a').click(function (e) {
	
	var id = $(this).attr('href'),
		targetOffset = $(id).offset().top;
	$('html, body').animate({
		scrollTop: targetOffset - 150
	}, 150);
});

//fechar menu collapse ao clicar no link
$(".nav-link").on("click", function(){
   $('.navbar-collapse').collapse('hide');
});