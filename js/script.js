$(document).ready(function(){
    $("#activitySearchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#activitiesTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    $("#studentSearchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#studentsTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
});

function EditType(id, tip){
    $("#tipId").val(id);
    $("#tipNaziv").val(tip);
    $("#updateTypeDiv").css("visibility", "visible");
}