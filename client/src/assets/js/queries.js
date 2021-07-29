/*
For office
*/

function officeUpdate(requestId, notes, dueDate) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Request ${requestId} updated`);
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
function officeClose(requestId, terminationDate) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Request ${requestId} closed at ${terminationDate}`);
  });
  table_data_requester.query({
    q_name: "close_requests",
    q_data: {
      "d.terminationDate": terminationDate,
      "f.requestId": requestId,
    },
  });
}
function officeRecount(requestId, notes, dueDate) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Request ${requestId} updated`);
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

/*
For warehouse
*/
function lastToPrevious(requestId) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Moved lastCount of request ${requestId} from lastCount to previousCount`);
  });
  table_data_requester.query({
    q_name: "last_to_previous",
    q_data: {
      "f.requestId": requestId,
    },
  });
  return true;
}
function warehouseStateToCountDone(requestId) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Request ${requestId} state changed to countDone`);
  });
  table_data_requester.query({
    q_name: "warehouse_state_to_countDone",
    q_data: {
      "f.requestId": requestId,
    },
  });
  return true;
}
function warehouseStateToRecountDone(requestId) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Request ${requestId} state changed to recountDone`);
  });
  table_data_requester.query({
    q_name: "warehouse_state_to_recountDone",
    q_data: {
      "f.requestId": requestId,
    },
  });
  return true;
}

function warehouseUpdateRequests(requestId, lastCount) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Request ${requestId} updated`);
  });
  table_data_requester.query({
    q_name: "warehouse_update_count",
    q_data: {
      "d.lastCount": lastCount,
      "f.requestId": requestId,
    },
  });
}

function warehouseCount(requestId, lastCount, requestState) {
  $("#edit-popup").hide();
  if (lastToPrevious(requestId)) {
    if (requestState == "countRequest") {
      if (warehouseStateToCountDone(requestId)) {
        warehouseUpdateRequests(requestId, lastCount);
      }
    } else if (requestState == "recountRequest") {
      if (warehouseStateToRecountDone(requestId)) {
        warehouseUpdateRequests(requestId, lastCount);
      }
    }
  }
}
