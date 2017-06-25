$(document).ready(function () {

    $('#autocomplete').autocomplete({
        serviceUrl: Routing.generate('app_api_get_postalcodes', {version: "v1", postalCode: $("input[name=postalCode]").val()}),
        onSelect: function (suggestion) {
            alert('You selected: ' + suggestion);
        }
    });

    $('form').on('submit', function (e) {
        e.preventDefault();

        var $this = $(this); // L'objet jQuery du formulaire

        $.ajax({
            url: Routing.generate('app_api_post_contact', {version: "v1"}),
            type: $this.attr('method'),
            data: {
                'gender': undefined === $("input[name=gender]:checked").val() ? '' : $("input[name=gender]:checked").val(),
                'name': $("input[name=name]").val(),
                'firstName': $("input[name=firstName]").val(),
                'postalCode':  $("input[name=postalCode]").val(),
                'mail':  $("input[name=mail]").val(),
                'phone':  $("input[name=phone]").val(),
                'actuality':  undefined === $("input[name=actuality]:checked").val() ? false : $("input[name=actuality]:checked").val(),
                'offer':  undefined === $("input[name=offer]:checked").val() ? false : $("input[name=offer]:checked").val()
            },
            dataType: 'json', // JSON
            success: function () {
                $(location).attr('href', Routing.generate('confirmation'))
            },
            error: function (json) {
                $.each(json.responseJSON.children, function (index, element) {
                    if (element.errors) {
                        $("input[name=" + index + "]").after('<h1>' + element.errors[0] + '</h1>');
                    }
                });
            }
        });
    });
});