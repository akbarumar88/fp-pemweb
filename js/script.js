$(document).ready(function(){
    $("#dropdownMenu2").dropdown();

    $(".dropdown-menu button").click(function(){

        $(".dropdown-toggle").text($(this).text());
        $(".dropdown-toggle").val($(this).text());

        // Ganti url Video Player
        let newUrl = $(this).attr('data-value')
        console.log(newUrl)
        $("#videoplayer").attr('src', newUrl)
  
        // Disable button
        $(".dropdown-menu button").attr('disabled', false)
        $(this).attr('disabled', true)
     });
  
});
