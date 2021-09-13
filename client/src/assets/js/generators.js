/* ////////// */
/* CONSTANTS */
/* ////////// */

const IMAGE_SIZE = "50px";

/* //////////////// */
/* HELPER FUNCTIONS */
/* //////////////// */
function appendIcon(currentRow, icon) {
    switch (icon) {
        case "countRequest":
            currentRow.append(
                $("<td>").append($("<img src='../../assets/images/countRequest.png' height='" + IMAGE_SIZE + "' width='" + IMAGE_SIZE + "' title='Conta richiesta'>"))
            );
            break;
        case "countDone":
            currentRow.append($("<td>").append($("<img src='../../assets/images/countDone.png' height='" + IMAGE_SIZE + "' width='" + IMAGE_SIZE + "' title='Conta effettuata'>")));
            break;
        case "recountRequest":
            currentRow.append(
                $("<td>").append($("<img src='../../assets/images/recountRequest.png' height='" + IMAGE_SIZE + "' width='" + IMAGE_SIZE + "' title='Riconta richiesta'>"))
            );
            break;
        case "recountDone":
            currentRow.append(
                $("<td>").append($("<img src='../../assets/images/recountDone.png' height='" + IMAGE_SIZE + "' width='" + IMAGE_SIZE + "' title='Riconta effettuata'>"))
            );
            break;
        case "requestClosed":
            currentRow.append(
                $("<td>").append($("<img src='../../assets/images/requestClosed.png' height='" + IMAGE_SIZE + "' width='" + IMAGE_SIZE + "' title='Richiesta chiusa'>"))
            );
            break;
        case "requestOpen":
            currentRow.append(
                $("<td>").append($("<img src='../../assets/images/requestOpen.png' height='" + IMAGE_SIZE + "' width='" + IMAGE_SIZE + "' title='Richiesta aperta'>"))
            );
            break;
    }
}
function writeRequestDate(currentRow, cell) {
    currentRow.append(
        $("<td>").text(cell.replace(" 00:00:00", "").split("-")[2] + "-" + cell.replace(" 00:00:00", "").split("-")[1] + "-" + cell.replace(" 00:00:00", "").split("-")[0])
    );
}
function writeDueDate(currentRow, cell) {
    currentRow.append(
        $("<td>").text(cell.replace(" 00:00:00", "").split("-")[2] + "-" + cell.replace(" 00:00:00", "").split("-")[1] + "-" + cell.replace(" 00:00:00", "").split("-")[0])
    );
}
function writeTerminationDate(currentRow, cell) {
    currentRow.append(
        $("<td>").text(cell.replace(" 00:00:00", "").split("-")[2] + "-" + cell.replace(" 00:00:00", "").split("-")[1] + "-" + cell.replace(" 00:00:00", "").split("-")[0])
    );
}
function writeLastCount(currentRow, cell) {
    let lastCount = cell != null ? new Intl.NumberFormat().format(parseInt(cell)) : "0";
    currentRow.append($("<td>").text(lastCount));
}
function writeExpectedCount(currentRow, cell) {
    let expectedCount = cell != null ? new Intl.NumberFormat().format(parseInt(cell)) : "0";
    currentRow.append($("<td>").text(expectedCount));
}
function writeDifferenceLastAndExpected(currentRow, cell) {
    currentRow.append($("<td>").text(cell));
}

/* //////////// */
/* TABLE MAKER */
/* //////////// */
function table_maker(table_data, destination_id, headers) {
    const table_id = "records_table";
    const table = $("<table>").addClass("table table-striped table-hover").attr("id", table_id);
    const thead_tr = $("<tr>");
    const tbody = $("<tbody>");
    table.append($("<thead>").append(thead_tr));
    table.append(tbody);

    Object.keys(headers).forEach(function (key) {
        thead_tr.append($("<th>").text(key));
    });

    for (const row of table_data) {
        let currentRow = $("<tr>").addClass("table-row").attr("id", row["requestId"]);
        Object.keys(headers).forEach(function (key) {
            valueOfCell = row[headers[key]];
            if (headers[key] === "isClosed" && valueOfCell === "1") {
                appendIcon(currentRow, "requestClosed");
                return;
            }
            if (headers[key] === "isClosed" && valueOfCell === "0") {
                appendIcon(currentRow, "requestOpen");
                return;
            }
            if (headers[key] == "requestDate" && valueOfCell) {
                writeRequestDate(currentRow, valueOfCell);
                return;
            }
            if (headers[key] == "dueDate" && valueOfCell) {
                writeDueDate(currentRow, valueOfCell);
                return;
            }
            if (headers[key] == "terminationDate" && valueOfCell) {
                writeTerminationDate(currentRow, valueOfCell);
                return;
            }
            if (headers[key] == "lastCount") {
                writeLastCount(currentRow, valueOfCell);
                return;
            }
            if (headers[key] == "expectedCount") {
                writeExpectedCount(currentRow, valueOfCell);
                return;
            }
            if (headers[key] == "differenceLastAndExpected") {
                differenza = row.lastCount - row.expectedCount;
                if (differenza > 0) {
                    writeDifferenceLastAndExpected(currentRow, "+" + differenza);
                } else {
                    writeDifferenceLastAndExpected(currentRow, differenza);
                }
                return;
            }

            switch (valueOfCell) {
                case "countRequest":
                    appendIcon(currentRow, "countRequest");
                    break;
                case "countDone":
                    appendIcon(currentRow, "countDone");
                    break;
                case "recountRequest":
                    appendIcon(currentRow, "recountRequest");
                    break;
                case "recountDone":
                    appendIcon(currentRow, "recountDone");
                    break;
                default:
                    currentRow.append($("<td>").text(valueOfCell));
            }
        });

        tbody.append(currentRow);
    }
    $("#" + destination_id).html(table);
    return $("#" + table_id).DataTable();
}

function create_flavour(flavour) {
    const radio_container = $("<div>").addClass("custom-control custom-radio custom-control-inline");
    const radio_element = $("<input>")
        .attr("name", "flavour")
        .attr("id", flavour)
        .attr("type", "radio")
        .attr("aria-describedby", "flavourHelpBlock")
        .attr("required", "required")
        .attr("value", flavour)
        .addClass("custom-control-input")
        .text(flavour)
        .appendTo(radio_container);
    if (flavour === ".") {
        radio_element.prop("checked", true);
    }
    $("<label>").attr("for", flavour).addClass("custom-control-label").text(flavour).appendTo(radio_container);

    return radio_container;
}

function flavourBuilder(flavours, containerId) {
    const container = $("#" + containerId).empty();
    const flavourGroup = $("<div>").addClass("form-group col no-gutters").appendTo(container);
    flavours[0] === "." ? container.hide() : container.show();
    const label = $("<label>").addClass("col-2").text("Variante").appendTo(flavourGroup);
    const helper = $("<div>").addClass("col-12").appendTo(flavourGroup);

    for (const flavour of flavours) {
        create_flavour(flavour).appendTo(helper);
    }
}
