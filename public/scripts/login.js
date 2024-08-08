$(function() {
    $("#frm-login").validate({
        rules: {
            username: {
                required: true
            , }
            , password: {
                required: true
            , }
        , }
        , messages: {
            username: {
                required: "Anda belum mengisi nama pengguna"
            , }
            , password: {
                required: "Anda belum mengisi kata sandi"
            , }
        , }
        , submitHandler: function(form) {
            $(this).prop("disabled", true);
            // $(".loader-container").addClass("show");
            form.submit();
        }
    , });
});

//#region Events
$("#changeTheme").on("change", function(e) {
    $.cookie("theme",$(this).val());
    window.location.reload();
    return;
    $.ajax({
        url : "index.php",
        type : "POST",
        dataType : "JSON",
        data :{
            action:"change-theme",
            theme:$(this).val()
        },
        success:(data)=>{
            window.location.reload();
        }
    });
});

$("input").on("change keyup", function(e) {
    $("#btn-login").prop("disabled", false);
    $(this).removeClass("is-invalid");
    $(this).closest(".form-group").find(".invalid-message").remove();
    $(".loader-container").removeClass("show");

});

$("input[name=password]").on("keyup", function(e) {
    if (e.originalEvent.keyCode == 13) $("#btn-login").trigger("click");
});

$("#btn-login").on("click", function(e) {
    $(this).prop("disabled", true);
    $(this).text("Sedang Memproses");
    $("#frm-login").submit();
});
//#endregion
