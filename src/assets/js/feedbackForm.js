$(document).ready(function () {
  $('#preview').click(function() {
      var now = new Date();
      $('#preview-data .panel-heading').html(function() {
          var username = $('[name=exampleInputName]').val();
          var email = $('[name=exampleInputEmail]').val();
          var date = now.toString();
          return username + ' <a href="mailto:#">' + email + '</a> ' + date;
      });
      $('#preview-data .panel-body').html($('[name=text]').val());
      $('#preview-data').show();
      return false;
  });

  $("#fileUpload").on('change', function() {
      //Get count of selected files
      var countFiles = $(this)[0].files.length;
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      var image_holder = $("#image-holder");
      image_holder.empty();
      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
          if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                      $("<img />", {
                          "src": e.target.result,
                          "class": "thumb-image",
                          "height": 320,
                          "width": 240
                      }).appendTo(image_holder);
                  };
                  image_holder.show();
                  reader.readAsDataURL($(this)[0].files[i]);
              }
          } else {
              alert("This browser does not support FileReader.");
          }
      } else {
          alert("Загрузите пожалуйста файл с расширением jpeg/pmg/gif!");
      }
  });

  $('#feedback').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          exampleInputEmail: {
              validators: {
                  notEmpty: {
                      message: 'The email address is required and cannot be empty'
                  },
                  emailAddress: {
                      message: 'The email address is not a valid'
                  }
              }
          },
          exampleInputName: {
              message: 'The username is not valid',
              validators: {
                  notEmpty: {
                      message: 'The username is required and cannot be empty'
                  },
                  stringLength: {
                      min: 3,
                      max: 50,
                      message: 'The username must be more than 6 and less than 50 characters long'
                  }
              }
          },
          text: {
              validators: {
                  stringLength: {
                      min: 9,
                      max: 3000,
                      message: 'Please enter at least 10 characters and no more than 200'
                  },
                  notEmpty: {
                      message: 'Please supply a description of your project'
                  }
              }
          }

      }
  });
});
