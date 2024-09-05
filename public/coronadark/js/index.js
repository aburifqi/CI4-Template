$(function() {
});
//#region Functions
//#endregion
//#region Events
$(".nav-item.menu-items").on("click", function(){
    $(this).find("~.nav-item.menu-items").removeClass("active");
    $(this).addClass("active");
})
//#endregion
