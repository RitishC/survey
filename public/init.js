$(document).ready(function() {
    // will replace .form-g class when referenced
    var material =  '<div class="input-field col input-g s12">' +
                    '<input name="option_name[]" id="option_name[]" type="text">' +
                    '<span style="float:right; cursor:pointer;"class="delete-option">Delete</span>' +
                    '<label for="option_name">Options</label>' +
                    '<span class="add-option" style="cursor:pointer;">Add Another</span>' +
                    '</div>';

    $('.collapsible').collapsible({
        accordion: false
    });

    $('.modal-trigger').leanModal();

    $(document).on('click', '.delete-option', function() {
        $(this).parent(".input-field").remove();
    });

    // for adding new option
    $(document).on('click', '.add-option', function() {
        $(".form-g").append(material);
    });

    // allow for more options if radio or checkbox is enabled
    $(document).on('change', '#question_type', function() {
        var selected_option = $('#question_type :selected').val();
        if (selected_option === "radio" || selected_option === "checkbox") {
            $(".form-g").html(material);
            $(".category_names_container").show();
            $(".category_names").show();
            get_categories();
        } else {
            $(".input-g").remove();
            $(".category_names").hide();
        }
    });

});

function get_categories() {
    $.get( "/survey/questions/categories", function( data ) {
        select = $(".category_names").html("");
        $.each(data.categories, function(i, v) {
            select.append($("<option></option>")
                    .attr("value", v.id)
                    .text(v.category_name)
            );
        });
    });
}