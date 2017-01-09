
$('.carregaPagina').on('click',function(event){
	event.preventDefault();
	$('#conteudo').load($(this).attr('href'));
});