(function(){
var highlight = function(element) {
    $(element)
    .closest('.form-group').removeClass('success').addClass('error');
  },
  success = function(element) {
    element
    .text('OK').addClass('valid')
    .closest('.form-group').removeClass('error').addClass('success');
  };

$(document).ready(function(){
  
 $('#comment-form').validate({
  rules: {
    comment: {
      minlength: 3,
      required: true
    }
  },
  highlight: highlight,
  success: success
 });
});


$(document).ready(function(){
  
 $('#confession-form').validate({
  rules: {
    confession: {
      minlength: 3,
      required: true
    }
  },
  highlight: highlight,
  success: success
 });
});
})();