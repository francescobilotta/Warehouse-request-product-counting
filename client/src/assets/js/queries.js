function updateRequest(notes, dueDate, requestId) {
  const table_data_requester = new Requester(function (result) {
    alert("updated");
  });
  table_data_requester.query({
    q_name: "office_update_requests",
    q_data: {
      "d.notes": notes,
      "d.dueDate": dueDate,
      "f.requestId": requestId,
    },
  });
}

function closeRequest() {
  //TODO
}

function askRecount() {
  //TODO
}
