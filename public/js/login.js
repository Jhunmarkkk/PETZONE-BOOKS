$(function() {
    $(document).on("submit", "#handleAjax", function(event) {
        event.preventDefault();

        var e = this;
        $(this).find("[type='submit']").html("Login...");

        $.ajax({
            url: '/api/login', 
            data: $(this).serialize(),
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $(e).find("[type='submit']").html("Login");

                if (data.status) {
                    window.location.href = data.redirect; // Redirect to the new page
                } else {
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
            },
            error: function (xhr) {
                $(e).find("[type='submit']").html("Login");
                console.log(xhr.responseText); 
                $("#errors-list").append("<div class='alert alert-danger'>An error occurred. Please try again.</div>");
            }
        });

        return false;
    });
});
