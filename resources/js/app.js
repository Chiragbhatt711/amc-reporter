require('./bootstrap');
// nav arrow set in moblie view
$("ul.nav li.sub-menu div").each(function() {
    $(this).children("a").after("<span class='arrow'><i class='fa fa-plus'></i></span>");
});
$("ul.nav li.sub-menu div.menu .arrow").click(function(){
    if($(this).next().is(":visible"))
    {
        $(this).children(".fa").removeClass("fa-minus");
        $(this).children(".fa").addClass("fa-plus");
        $(this).next().slideUp();
}
    else
    {
        $("ul.nav li.sub-menu div.menu .arrow .fa").removeClass("fa-minus");
        $("ul.nav li.sub-menu div.menu .arrow .fa").addClass("fa-plus");
        $("ul.nav li.sub-menu div.menu .arrow").next().slideUp();
        $(this).children(".fa").removeClass("fa-plus");
        $(this).children(".fa").addClass("fa-minus");
        $(this).next().slideDown();
    }
});
