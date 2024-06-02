$(document).ready(function() {
    $(".country-icon").on('click', function (){
        let countryAlias = $(this).data('Country');
        setCookie("lang", countryAlias, 1);
        $(this).closest("form").submit();
    });

    $(".alert .close").on('click', function(e){
        e.preventDefault();
        $(".alert").hide();
    })


    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Function to get a cookie
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Function to delete a cookie
    function eraseCookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }
});