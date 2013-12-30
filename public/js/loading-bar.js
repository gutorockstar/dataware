$(document).ready( function() 
{
    $(".btn").click(function()
    {
        loadPopupBox();
    }); 
  
    $('#popupBoxClose').click( function() 
    {			
        unloadPopupBox();
    });

    function unloadPopupBox() 
    {
        $('#obscure-loading').fadeOut("slow");
    }	

    function loadPopupBox() 
    {
        $('#obscure-loading').fadeIn("slow");
    }
});

$(document).ready(function() 
{
    $('.barlittle').removeClass('stop');
    
    $('.triggerBar').click(function() 
    {
        $('.barlittle').toggleClass('stop');
    });
});