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
              $("<td>").append($("<img src='../../assets/img/countRequest.png' height='80px' width='80px' title='Asked for count'>"))
            );
            break;
          case "countDone":
            current_row.append(
              $("<td>").append($("<img src='../../assets/img/countDone.png' height='80px' width='80px' title='Count done'>"))
            );
            break;
          case "recountRequest":
            current_row.append(
              $("<td>").append($("<img src='../../assets/img/recountRequest.png' height='80px' width='80px' title='Asked for recount'>"))
            );
            break;
          case "recountDone":
            current_row.append(
              $("<td>").append($("<img src='../../assets/img/recountDone.png' height='80px' width='80px' title='Recount done'>"))
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
