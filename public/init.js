$(document).ready(function() {
  var categories = [];

  $.get( "/survey/questions/categories", function( data ) {
      self.categories = [data];
  });
  console.log(categories);

  $('.collapsible').collapsible({
    accordion: false
  });

  $('.modal-trigger').leanModal();

  $(document).on('click', '.delete-option', function() {
    $(this).parent(".input-field").remove();
  });

  // will replace .form-g class when referenced
  var material = '<div class="input-field col input-g s12">' +
    '<input name="option_name[]" id="option_name[]" type="text">' +
    'Categorie:' +
    '<select name="category_name[]" id="category_names" style="display:block;">' +
    '</select>' +
    '<span style="float:right; cursor:pointer;"class="delete-option">Delete</span>' +
    '<label for="option_name">Options</label>' +
    '<span class="add-option" style="cursor:pointer;">Add Another</span>' +
    '</div>';

  // for adding new option
  $(document).on('click', '.add-option', function() {
    $(".form-g").append(material);
  });
  // allow for more options if radio or checkbox is enabled
  $(document).on('change', '#question_type', function() {
    var selected_option = $('#question_type :selected').val();
    if (selected_option === "radio" || selected_option === "checkbox") {
      $(".form-g").html(material);
    } else {
      $(".input-g").remove();
    }
  });
});
