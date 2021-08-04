function table_maker(table_data, destination_id, headers) {
    const table_id = "records_table";
    let table = $("<table>").addClass("table table-striped table-hover").attr("id", table_id);
    let thead_tr = $("<tr>");
    let tbody = $("<tbody>");
    table.append($("<thead>").append(thead_tr));
    table.append(tbody);

    Object.keys(headers).forEach(function (key) {
        thead_tr.append($("<th>").text(key));
    });

    for (const row of table_data) {
        let current_row = $("<tr>").addClass("table-row").attr("id", row["requestId"]);

        var image_size = "50px";

        Object.keys(headers).forEach(function (key) {
            //CHECK isClosed
            if (headers[key] === "isClosed" && row[headers[key]] === "1") {
                current_row.append(
                    $("<td>").append(
                        $("<img src='../../assets/images/countDone_icon.png' height='" + image_size + "' width='" + image_size + "' title='Request closed'>"),
                        $("<p>Request closed</p>")
                    )
                );
            } else if (headers[key] === "isClosed" && row[headers[key]] === "0") {
                current_row.append(
                    $("<td>").append(
                        $("<img src='../../assets/images/closed_icon.png' height='" + image_size + "' width='" + image_size + "' title='Request open'>"),
                        $("<p>Request open</p>")
                    )
                );
            } else if (headers[key] == "requestDate" && row[headers[key]]) {
                current_row.append(
                    $("<td>").text(
                        row[headers[key]].replace(" 00:00:00", "").split("-")[2] +
                            "-" +
                            row[headers[key]].replace(" 00:00:00", "").split("-")[1] +
                            "-" +
                            row[headers[key]].replace(" 00:00:00", "").split("-")[0]
                    )
                );
            } else if (headers[key] == "dueDate" && row[headers[key]]) {
                current_row.append(
                    $("<td>").text(
                        row[headers[key]].replace(" 00:00:00", "").split("-")[2] +
                            "-" +
                            row[headers[key]].replace(" 00:00:00", "").split("-")[1] +
                            "-" +
                            row[headers[key]].replace(" 00:00:00", "").split("-")[0]
                    )
                );
            } else if (headers[key] == "terminationDate" && row[headers[key]]) {
                current_row.append(
                    $("<td>").text(
                        row[headers[key]].replace(" 00:00:00", "").split("-")[2] +
                            "-" +
                            row[headers[key]].replace(" 00:00:00", "").split("-")[1] +
                            "-" +
                            row[headers[key]].replace(" 00:00:00", "").split("-")[0]
                    )
                );
            } else {
                //CHECK requestState
                if (headers[key]) {
                    switch (row[headers[key]]) {
                        case "countRequest":
                            current_row.append(
                                $("<td>").append(
                                    $("<img src='../../assets/images/countRequest.png' height='" + image_size + "' width='" + image_size + "' title='Conta richiesta'>")
                                )
                            );
                            break;
                        case "countDone":
                            current_row.append(
                                $("<td>").append($("<img src='../../assets/images/countDone.png' height='" + image_size + "' width='" + image_size + "' title='Conta effettuata'>"))
                            );
                            break;
                        case "recountRequest":
                            current_row.append(
                                $("<td>").append(
                                    $("<img src='../../assets/images/recountRequest.png' height='" + image_size + "' width='" + image_size + "' title='Riconta richiesta'>")
                                )
                            );
                            break;
                        case "recountDone":
                            current_row.append(
                                $("<td>").append(
                                    $("<img src='../../assets/images/recountDone.png' height='" + image_size + "' width='" + image_size + "' title='Riconta effettuata'>")
                                )
                            );
                            break;
                        default:
                            current_row.append($("<td>").text(row[headers[key]]));
                    }
                }
            }
        });

        tbody.append(current_row);
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

function flavour_builder(flavours, container_id) {
    const container = $("#" + container_id);
    container.empty();
    const flavour_group = $("<div>").addClass("form-group col no-gutters").appendTo(container);
    flavours[0] === "." ? container.hide() : container.show();
    const label = $("<label>").addClass("col-2").text("Variante").appendTo(flavour_group);
    const helper = $("<div>").addClass("col-12").appendTo(flavour_group);

    for (const flavour of flavours) {
        create_flavour(flavour).appendTo(helper);
    }
}
