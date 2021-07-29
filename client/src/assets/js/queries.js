function updateRequest(notes, dueDate, requestId) {
  const table_query_data = {
    q_name: "office_update_requests",
    q_data: {
      "d.notes": notes,
      "d.dueDate": dueDate,
      "f.requestId": requestId,
    },
  };
  const table_data_requester = new Requester(table_query_data, function (result) {});
  table_data_requester.query();
}

function closeRequest() {
  //TODO
}

function askRecount() {
  //TODO
}
