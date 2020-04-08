$(document).ready(function () {

    $("#loginform").on("submit", function (e) {


        $('#usname').html('');
        $('#upass').html('');
        $('#message').html('');

        var username = $("#username").val();
        var password = $("#password").val();
        if ($("#username").val() == "") {
            $("#usname").html("Please enter username.");
            $("#usname").css("color", "red");
            $("#username").css("border", "1px solid grey");
            $("#username").focus();
        } else if ($("#password").val() == "") {
            $("#upass").html("Please enter password.");
            $("#upass").css("color", "red");
            $("#password").css("border", "1px solid grey");
            $("#password").focus();
        } else {
            $.ajax({
                type: "POST",
                url: "login.php",
                data: {
                    "username": username,
                    "password": password
                },
                success: function (result) {
                    var location = location.origin + '/cheker.php';
                    //alert(result);
                    if (result == 1) {
                        //alert("invalid");
                        $("#message").html("Invalid Username/Password");
                        $("#message").css("color", "red");
                    } 
                    if (result == 0) {
                        $("#message").html("Successfully Login");
                        $("#message").css("color", "green");
                        window.location.href = location;
                    }
                }

            });

        }


    });
});