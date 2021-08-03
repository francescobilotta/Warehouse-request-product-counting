/*
For office
*/

function officeUpdate(requestId, notes, dueDate) {
    const table_data_requester = new Requester(function (result) {});
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
    let year = terminationDate.split("-")[2];
    let month = terminationDate.split("-")[1];
    let day = terminationDate.split("-")[0];
    terminationDate = year + "-" + month + "-" + day + " 00:00:00";
    const table_data_requester = new Requester(function (result) {});
    table_data_requester.query({
        q_name: "close_requests",
        q_data: {
            "d.terminationDate": terminationDate,
            "f.requestId": requestId,
        },
    });
}

function officeRecount(requestId) {
    const table_data_requester = new Requester(function (result) {});
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
        const savedEvent = new Event("savedCount");
        document.addEventListener("savedCount", () => {
            if (requestState === "countRequest") {
                warehouseStateToCountDone(requestId);
                warehouseUpdateRequests(requestId, lastCount);
                warehouseLastExpectedCount(requestId, expectedCount);
                //TODO FINISH
            } else if (requestState === "recountRequest") {
                warehouseStateToRecountDone(requestId);
                warehouseUpdateRequests(requestId, lastCount);
            }
        });
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
    const table_data_requester = new Requester(function (result) {});
    table_data_requester.query({
        q_name: "warehouse_state_to_countDone",
        q_data: {
            "f.requestId": requestId,
        },
    });
    return true;
}

function warehouseLastExpectedCount(requestId, expectedCount) {
    const table_data_requester = new Requester(function (result) {});
    table_data_requester.query({
        q_name: "warehouse_update_expectedCount",
        q_data: {
            "d.expectedCount": expectedCount,
            "f.requestId": requestId,
        },
    });
    return true;
}

function warehouseStateToRecountDone(requestId) {
    const table_data_requester = new Requester(function (result) {});
    table_data_requester.query({
        q_name: "warehouse_state_to_recountDone",
        q_data: {
            "f.requestId": requestId,
        },
    });
    return true;
}

function warehouseUpdateRequests(requestId, lastCount) {
    const table_data_requester = new Requester(function (result) {});
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

    lastToPrevious(requestId, lastCount, requestState);
}
