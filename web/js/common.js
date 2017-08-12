/**
 * Created by ANDREW on 09.08.2017.
 */

$(function () {

    $(".geocomplete").geocomplete({
        details: ".details",
        detailsScope: '.location',
        detailsAttribute: "data-geo",
        types: ["geocode", "establishment"],
    });

    $('form').on('beforeSubmit', function () {
        return isEmpty();
    });

    $("form .details :input").on('change keyup paste click', function () {
        var element = $(this);
        if ($.trim(element.val()) !== "" && element.attr("aria-required") === "true") {
            element.attr('aria-invalid', 'false');
            element.parent().removeClass('has-error');
            element.parent().addClass('has-success');
            element.next().text('');

        }
    });

    $("#find").click(function () {
        $("#geocomplete").trigger("geocode");
    });

    $(".new-addr").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var $self = $(this);
        var clone = $self.prev('.location').clone();
        clone.find('input').val('');
        clone.find("div").removeClass('has-error');
        clone.find(".help-block").html("");
        clone.insertAfter('.location:last');

        $(".geocomplete").geocomplete({
            details: ".details",
            detailsScope: '.location',
            detailsAttribute: "data-geo",
            types: ["geocode", "establishment"],
        });

    })

});
var newId = (function () {
    var id = 1;
    return function () {
        return id++;
    };
}());

function isEmpty() {
    var notEmpty = true;
    $("form .details :input").each(function () {
        var element = $(this);
        if ($.trim(element.val()) === "" && element.attr("aria-required") === "true") {
            element.attr('aria-invalid', 'true');
            element.parent().addClass('has-error');
            element.next().text(element.prev().text() + ' is required');
            notEmpty = false;
        }
    });
    return notEmpty;
}