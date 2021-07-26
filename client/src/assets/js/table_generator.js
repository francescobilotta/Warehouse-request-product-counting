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

    current_row.append(
      $("<td>").append(
        $("<a>", {
          type: "button",
          addClass: "btn btn-default",
          href: "office_update.php?requestId=" + row.requestId,
        }).append($("<span>").addClass("glyphicon glyphicon-pencil"))
      )
    );
    Object.keys(headers).forEach(function (key) {
      if (headers[key]) {
        current_row.append($("<td>").text(row[headers[key]]));
      }
    });

    tbody.append(current_row);
  }
  $("#" + destination_id).html(table);
}
