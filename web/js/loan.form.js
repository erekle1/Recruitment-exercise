$(function () {
    let date = new Date();
    date.setDate(date.getDate());

    $('#loan-end_date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: date
    });

    $('#loan-start_date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: date
    });
});

