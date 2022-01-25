$(document).ready(function() {


	// Modale


    $(document).on("click", ".open-modal" , function(e) {
        e.preventDefault();
        dataModal = $(this).attr("data-modal");
        $("#" + dataModal).load(location.href + " #" + dataModal + " > div");
        $("#" + dataModal).css({"display":"block"});
    });

    $(document).on("click", ".modal .overlay" , function() {
        $(this).parent().css({"display":"none"});
    });



    // Reload auto

    setInterval(function(){ 
    	$('#contenu-disques').load(location.href + '#contenu-disques .disques');
    	$('#contenu-cubes').load(location.href + '#contenu-cubes .cubes');
    	$('#dernier-disque').load(location.href + ' #dernier-disque > p');
    	$('#dernier-cube').load(location.href + ' #dernier-cube > p');
    }, 3000);

    setInterval(function(){ 
    	$('.participants').load(location.href + ' .participants > div');
    }, 10000);

   


  
});







