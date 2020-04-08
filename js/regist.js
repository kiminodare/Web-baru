$(document).ready(function () {

    $("#registerform").on("submit", function (e) {


        $('#usname_regst').html('');
        $('#upass_regst').html('');
        $('#message_regst').html('');

        var username = $("#username_regst").val();
        var password = $("#password_regst").val();
        if ($("#username_regst").val() == "") {
            $("#usname_regst").html("Please enter username.");
            $("#usname_regst").css("color", "red");
            $("#username_regst").css("border", "1px solid grey");
            $("#username_regst").focus();
        } else if ($("#password_regst").val() == "") {
            $("#upass_regst").html("Please enter password.");
            $("#upass_regst").css("color", "red");
            $("#password_regst").css("border", "1px solid grey");
            $("#password_regst").focus();
        } else {
            $.ajax({
                type: "POST",
                url: "regist.php",
                data: {
                    "username_regst": username,
                    "password_regst": password
                },
                success: function (result) {
                    //alert(result);
                    if (result == 3) {
                        //alert("invalid");
                        $("#message_regst").html("Username has already been taken");
                        $("#message_regst").css("color", "red");
                    } else {
                        $("#message_regst").html("You’ve successfully signed up your account!");
                        $("#message_regst").css("color", "green");
                    }
                }

            });

        }

        e.preventDefault();


    });
});