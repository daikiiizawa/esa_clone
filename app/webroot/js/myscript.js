$(function() {
    $("button").click(function () {
        $(".div2 p").text($(".div1 input:text").val());
    });
});
