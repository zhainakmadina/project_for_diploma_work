$(document).ready(function() {
    $('#signup').submit(function() {
        var th = $(this);
		$.ajax({
			type: "POST",
			url: "/signup/post.php",
			data: th.serialize()
		}).done(function(data) {
			if(data != "Success") {
                $('#err').text(data);
            } else {
                $('#err').css("color", "green");
                $('#err').text("You have successfully registered");
                th.trigger("reset");
                setTimeout(function() {
                    window.location.href = "/signin";
                }, 2000);
            }
		});
        return false;
    });

    $('#signin').submit(function() {
        var th = $(this);
		$.ajax({
			type: "POST",
			url: "/signin/post.php",
			data: th.serialize()
		}).done(function(data) {
            $('#err').text(data);
			if(data != "Success") {
                $('#err').text(data);
            } else {
                window.location.href = "/?page=dashboard";
            }
		});
        return false;
    });
});