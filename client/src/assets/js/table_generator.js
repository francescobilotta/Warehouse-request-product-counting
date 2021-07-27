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
            //<a href='ruoli_mod.php?id_ruolo=<?php echo $id_ruolo;?>'> <img title="Modifica" src="../../processi_images/modify_icon.png" style="width: 35px; height: 35px;"> </a>
            current_row.append(
              $("<td>").append(
                $("<a>", {
                  href: "office_update.php?requestId=" + row.requestId,
                }).append($("<img src='../../assets/img/countRequest_icon.png' height='40px' width='40px'>"))
              )
            );
            break;
          case "countDone":
            current_row.append(
              $("<td>").append(
                $("<a>", {
                  href: "office_update.php?requestId=" + row.requestId,
                }).append($("<img src='../../assets/img/countDone_icon.png' height='40px' width='40px'>"))
              )
            );
            break;
          case "recountRequest":
            current_row.append(
              $("<td>").append(
                $("<a>", {
                  href: "office_update.php?requestId=" + row.requestId,
                }).append($("<img src='../../assets/img/recountRequest_icon.png' height='40px' width='40px'>"))
              )
            );
            break;
          case "recountDone":
            current_row.append(
              $("<td>").append(
                $("<a>", {
                  href: "office_update.php?requestId=" + row.requestId,
                }).append($("<img src='../../assets/img/recountDone_icon.png' height='40px' width='40px'>"))
              )
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
