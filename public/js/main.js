$(document).ready(function () {
    $('#stageSelect').change(function () {
        let chosenStage = $(this).val();
        let targetTable = $("." + chosenStage);
        $(".table").not(targetTable).hide();
        $(targetTable).show();
    });
});


