function table_maker(table_data, destination_id, headers) {
  let table = $("<table>").addClass(
    "table table-striped table-bordered table-hover"
  );
  let thead_tr = $("<tr>");
  let tbody = $("<tbody>");

  table.append($("<thead>").class("thead-light").append(thead_tr));
  table.append(tbody);

  for (const header in headers) {
    thead_tr.append($("<th>").text(header));
  }

  for (const row in table_data) {
    let current_row = $("<tr>");

    current_row.append(
      $("<td>").append(
        $("<a>")
          .type("button")
          .class("btn btn-default")
          .href("office_update.php?requestId=" + row.requestId)
          .append($("<span>").class("glyphicon glyphicon-pencil"))
      )
    );

    for (const item in row) {
      current_row.append($("<td>").text(item));
    }

    tbody.append(current_row);
  }
}
