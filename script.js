$('document').ready(function() {

    var email_state = false;

    $('#email').on('blur', function() {
       var email_state = $('#email').val();
       if (email == '') {
        email_state = false;
          return;
       }
         $.ajax({
            url: 'register_db.php',
            type: 'POST',
            data: {
                'email_check' : 1,
                email: email
            },
            success: function(response) {
               if (response == 'taken') {
                  email_state = false;
                  $('#email').parent().removeClass();
                    $('#email').parent().addClass("form_error");
                    $('#email').siblings("span").text('Sorry... Email already taken');
               } else if (response == 'not_taken') {
                    email_state = true;
                    $('#email').parent().removeClass();
                        $('#email').parent().addClass("form_success");
                        $('#email').siblings("span").text('Email available');
               }
            }
         });
    });
    $('#reg_btn').on('click', function() {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();
        
        if (email_state == false) {
            $('#error_msg').text('Fix the errors in the form first');
        }
        else {
            $.ajax({
                url: 'register_db.php',
                type: 'POST',
                data: {
                    'save' : 1,
                    'firstname': firstname,
                    'lastname': lastname,
                    'email': email,
                    'password': password,
                    'cpassword': cpassword,  
                },
                success: function(response) {
                    alert(response);
                    $('#firstname').val('');
                    $('#lastname').val('');
                    $('#email').val('');
                    $('#password').val('');
                    $('#cpassword').val('');
                }
            });
        }
    });
});

