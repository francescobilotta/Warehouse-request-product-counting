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
function officeRecount(requestId) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Asked for recount of request ${requestId}`);
  });
  table_data_requester.query({
    q_name: "ask_for_recount",
    q_data: {
      "f.requestId": requestId,
    },
  });
}

/*
For warehouse
*/
function lastToPrevious(requestId, lastCount, requestState) {
  const table_data_requester = new Requester(function (result) {
    console.log(`Moved lastCount of request ${requestId} from lastCount to previousCount`);
    const savedEvent = new Event('savedCount');

    document.addEventListener('savedCount', () => {
      console.log("Check if requestState is countRequest or recountRequest");
      if (requestState === "countRequest") {
        console.log("It's countRequest");
        console.log("Going to change requestState to countDone");
        warehouseStateToCountDone(requestId);
        console.log("Changed state to countDone");
        warehouseUpdateRequests(requestId, lastCount);
      } else if (requestState === "recountRequest") {
        console.log("It's recountRequest");
        console.log("Going to change requestState to recountDone");
        warehouseStateToRecountDone(requestId);
        console.log("Changed state to recountDone");
        console.log("Going to change the lastCount value");
        warehouseUpdateRequests(requestId, lastCount);
        console.log(`Changed the lastCount value to ${lastCount}`);
      }
    })

    document.dispatchEvent(savedEvent);
  });
  table_data_requester.query({
    q_name: "last_to_previous",
    q_data: {
      "f.requestId": requestId,
    },
  });
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
  console.log("Going to move from last to previous");
  lastToPrevious(requestId, lastCount, requestState);
  console.log("Moved from last to previous");

}
