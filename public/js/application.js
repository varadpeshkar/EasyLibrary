$(function () {
    $.material.init();

    $('#dateofbirth .input-group.date').datepicker({
        startView: 2,
        maxViewMode: 3,
        autoclose: true,
        format: 'dd/mm/yyyy'
    });

    $('.printForm').click(function () {
        var base_url = window.location.origin;
        $(".printArea").printThis({
            debug: false,
            importCSS: true,
            importStyle: true,
            printContainer: true,
            loadCSS: [base_url + "/css/bootstrap.min.css", base_url + "/css/style.css"],
            pageTitle: "Registration Form",
            removeInline: false,
            printDelay: 333,
            header: null,
            formValues: true
        });

    });

});
