function status(ids, value) {
    var url = "status_control.php";
    $.post(url, {Id: ids, status: value}, function (data) {
        alert(ids);
        alert(data);
    });
}

function delete_discode(Id) {
    if (Id) {
        var url = "delete_dis.php";
        var deleteid = '#row_' + Id;
        $.post(url, {Id: Id}, function (data) {
            $(deleteid).hide('slow');
            alert(data);

        });
    }
}