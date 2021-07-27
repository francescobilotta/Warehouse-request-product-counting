function table_maker(table_data, destination_id, headers) {
  let table = $("<table>").addClass("table table-hover");
  let thead_tr = $("<tr>");
  let tbody = $("<tbody>");

  table.append($("<thead>").append(thead_tr));
  table.append(tbody);

  Object.keys(headers).forEach(function (key) {
    thead_tr.append($("<th>").text(key));
  });

  for (const row of table_data) {
    let current_row = $("<tr>").addClass("table-row").attr("id", row["requestId"]);

    Object.keys(headers).forEach(function (key) {
      if (headers[key]) {
        switch (row[headers[key]]) {
          case "countRequest":
            current_row.append(
              $("<td>").append($("<img src='../../assets/img/countRequest_icon.png' height='40px' width='40px' title='Asked for count'>"))
            );
            break;
          case "countDone":
            current_row.append(
              $("<td>").append($("<img src='../../assets/img/countDone_icon.png' height='40px' width='40px' title='Count done'>"))
            );
            break;
          case "recountRequest":
            current_row.append(
              $("<td>").append(
                $("<img src='../../assets/img/recountRequest_icon.png' height='40px' width='40px' title='Asked for recount'>")
              )
            );
            break;
          case "recountDone":
            current_row.append(
              $("<td>").append($("<img src='../../assets/img/recountDone_icon.png' height='40px' width='40px' title='Recount done'>"))
            );
            break;
          default:
            current_row.append($("<td>").text(row[headers[key]]));
        }
      }
    });

    tbody.append(current_row);
  }
  $("#" + destination_id).html(table);
}
