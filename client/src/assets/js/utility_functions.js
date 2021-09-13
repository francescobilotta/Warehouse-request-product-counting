function get_now() {
    const now = new Date();
    return now;
}
function getToday() {
    let now = get_now();
    const day = ("0" + now.getDate()).slice(-2);
    const month = ("0" + (now.getMonth() + 1)).slice(-2);
    return day + "-" + month + "-" + now.getFullYear();
}
function getTodayFormattedForInput() {
    let now = get_now();
    const day = ("0" + now.getDate()).slice(-2);
    const month = ("0" + (now.getMonth() + 1)).slice(-2);
    return now.getFullYear() + "-" + month + "-" + day;
}
function setDateDueMin(when) {
    $("#dateDuePicker").val(when).attr({
        min: when,
    });
}

function makeRequestEditable(element, comingFrom) {
    $("#edit-popup").show();
    $("#popup").removeClass().addClass(element.attr("id"));

    if (comingFrom == "office") {
        officeRequestsDetails(element.attr("id"));
    } else {
        warehouseRequestsDetails(element.attr("id"), get_now());
    }
}

function register_clicks(comingFrom) {
    $(".table-row").dblclick(function (e) {
        makeRequestEditable($(this), comingFrom);
    });

    $("#edit-popup").click(function (e) {
        if (e.target === this) {
            $(this).hide();
        }
    });

    $(".exit-button").click(function (e) {
        if (e.target === this) {
            $("#edit-popup").hide();
        }
    });
}
