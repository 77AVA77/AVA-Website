$(document).ready(function() {
    $(".country-icon").on('click', function (){
        let countryAlias = $(this).data('Country');
        $.cookie("lang", countryAlias);
        $(this).closest("form").submit();
    });
    $(".SignUpSubmit").on('click', function (){
        $.cookie("signed", true);
    });

    $(".alert .close").on('click', function(e){
        e.preventDefault();
        $(".alert").hide();
    })
});