$(document).ready(function () {
    var user_href;
    var user_herf_splitted;
    var user_id;
    var image_src;
    var image_herf_splitted;
    var image_name;
    var photo_id;

    $(".modal_thumbnails").click(function () {
        $("#set_user_image").prop("disabled", false);
        user_href = $("#user-id").prop('href');
        user_herf_splitted = user_href.split("=");
        user_id = user_herf_splitted[user_herf_splitted.length - 1];
        image_src = $(this).prop('src');
        image_herf_splitted = image_src.split("/");
        image_name = image_herf_splitted[image_herf_splitted.length - 1];
        photo_id = $(this).attr('data');
        $.ajax({
            url: "includes/ajax_code.php",
            data: { photo_id: photo_id },
            type: "POST",
            success: function (data) {
                if (!data.error) {

                    $("#modal_sidebar").html(data);
                }

            }
        });
    });
    $(".photo-info-box").click(function(){
        $(".inside").slideToggle("fast");
        $("#toggle").toggleClass("glyphicon glyphicon-menu-down  , glyphicon glyphicon-menu-up ");

    });

    $("#set_user_image").click(function () {
        $.ajax({
            url: "includes/ajax_code.php",
            data: { image_name: image_name, user_id: user_id },
            type: "POST",
            success: function (data) {
                if (!data.error) {

                    $(".user_image_box a img").prop("src", data);
                    // location.reload(true);
                }

            }


        });
    });
    $(".delete_link").click(function () {

       return confirm("Are you Sure");
    });
    
});

$(document).ready(function () {
    $("#summernote").summernote({
        height: 300
    });
});