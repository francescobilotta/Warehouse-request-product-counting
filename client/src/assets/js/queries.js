/* CONSTANTS */
const ASYNC = "false";
const REQ_TYPE = "GET";
const REQ_URL = "../../../../server/api/request_receiver.php";
const REQ_RET_TYPE = "json";
const image_size = "50px";

/* ////////// */
/* FUNCTIONS */
/* ////////// */
function ajaxCall(ajax_data, results_callback) {
    $.ajax({
        async: ASYNC,
        type: REQ_TYPE,
        url: REQ_URL,
        dataType: REQ_RET_TYPE,
        data: ajax_data,
        success: function (resultData) {
            //console.log(resultData);
            results_callback(resultData);
            //console.log("Ajax request completed.");
            //console.log(JSON.stringify(resultData));
            //console.log("\n");
        },
        error: (error) => {
            console.log("Something went wrong");
            console.log("Error, the ajax request could not be completed. Message: " + error);
            console.log(JSON.stringify(error));
            console.log("\n");
            result = undefined;
        },
    });
}

/* ////// */
/* OFFICE */
/* ////// */

function productCodesRequester(autocompleteInit) {
    let ajax_data = {
        q_name: "get_products_names",
    };
    ajaxCall(ajax_data, function (result) {
        autocompleteInit(result.results.COD_ARTICOLO, result.results.DESCRIZIONE);
    });
}
function productFlavourRequester(productCode, flavourBuilder) {
    let ajax_data = {
        q_name: "get_product_flavours",
        q_data: {"f.productCode": productCode},
    };
    ajaxCall(ajax_data, function (result) {
        if (!result.results.VARIANTE || !result.results.VARIANTE[0]) {
            flavourBuilder(["."], "flavours-container");
        } else {
            flavourBuilder(result.results.VARIANTE, "flavours-container");
        }
    });
}
function createRequest(window, today) {
    let ajax_data = {
        q_name: "office_create_requests",
        q_data: {
            "d.requestDate": today,
            "d.productCode": $("#prod_code").val(),
            "d.productName": $("#prod_name").val(),
            "d.productFlavour": $("input[name='flavour']:checked").val(),
            "d.dueDate": $("#dateDuePicker").val(),
            "d.requestState": "countRequest",
            "d.notes": $("#notes").val(),
        },
    };
    ajaxCall(ajax_data, function (result) {
        window.location.replace("office_homepage.html");
    });
}
function officeRequests(table_headers_strings) {
    let tableHeadersStrings = table_headers_strings;
    let ajax_data = {
        q_name: "office_requests",
    };
    ajaxCall(ajax_data, function (result) {
        table_maker(result.results, "request-table-container", tableHeadersStrings);
        $("#records_table").on("click", () => {
            register_clicks("office");
        });
    });
}
function officeRequestsOpen(table_headers_strings) {
    let tableHeadersStrings = table_headers_strings;
    let ajax_data = {
        q_name: "office_requests_open",
    };
    ajaxCall(ajax_data, function (result) {
        table_maker(result.results, "request-table-container", tableHeadersStrings);
        $("#records_table").on("click", () => {
            register_clicks("office");
        });
    });
}

function officeRequestsDetails(requestId) {
    let ajax_data = {
        q_name: "office_requests_details",
        q_data: {
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        resultsData = result.results[0];
        let creationDate = resultsData.requestDate.replace(" 00:00:00", "");
        creationDate = creationDate.split("-")[1] + "-" + creationDate.split("-")[2] + "-" + creationDate.split("-")[0];

        $("#req_id").val(requestId);
        $("#prod_code").val(resultsData.productCode);
        $("#prod_name").val(resultsData.productName);
        $("#prod_variant").val(resultsData.productFlavour);
        $("#notes").val(resultsData.notes);
        $("#dateDuePicker").val(resultsData.dueDate.split(" ")[0]).attr({min: getToday()});
        $("#dateCreationInput").val(creationDate);
        $("#expected_previous").val(resultsData.expectedCount);
        $("#count_previous").val(resultsData.previousCount);
        $("#count_last").val(resultsData.lastCount);

        //Hide all buttons before selecting which to show
        $("#btn-update").hide();
        $("#btn-close").hide();
        $("#btn-recount").hide();

        if (resultsData.isClosed == 0) {
            switch (resultsData.requestState) {
                case "countRequest":
                    append_img_request_state("request_state", "../../assets/images/countRequest.png", image_size, "Richiesto Conteggio");
                    $("#btn-update").show();
                    $("#btn-close").show();
                    break;
                case "countDone":
                    append_img_request_state("request_state", "../../assets/images/countDone.png", image_size, "Conteggio Effettuato");
                    $("#btn-update").show();
                    $("#btn-close").show();
                    $("#btn-recount").show();
                    break;
                case "recountRequest":
                    append_img_request_state("request_state", "../../assets/images/recountRequest.png", image_size, "Richiesta Riconta");
                    $("#btn-update").show();
                    $("#btn-close").show();
                    break;
                case "recountDone":
                    append_img_request_state("request_state", "../../assets/images/recountDone.png", image_size, "Riconta Effettuata");
                    $("#btn-update").show();
                    $("#btn-close").show();
                    $("#btn-recount").show();
                    break;
                default:
            }
        } else {
            append_img_request_state("request_state", "../../assets/images/requestClosed.png", image_size, "Richiesta chiusa");
        }
    });
}

function officeUpdate(requestId, notes, dueDate) {
    let ajax_data = {
        q_name: "office_update_requests",
        q_data: {
            "d.notes": notes,
            "d.dueDate": dueDate,
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        location.reload();
    });
}

function officeClose(requestId, terminationDate) {
    let year = terminationDate.split("-")[2];
    let month = terminationDate.split("-")[1];
    let day = terminationDate.split("-")[0];
    terminationDate = year + "-" + month + "-" + day + " 00:00:00";

    let ajax_data = {
        q_name: "close_requests",
        q_data: {
            "d.terminationDate": terminationDate,
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        location.reload();
    });
}

function officeRecount(requestId) {
    let ajax_data = {
        q_name: "ask_for_recount",
        q_data: {
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        location.reload();
    });
}

/* ////////// */
/* WAREHOUSE */
/* ////////// */
function warehouseRequests(table_headers_strings) {
    let tableHeadersStrings = table_headers_strings;
    let ajax_data = {
        q_name: "warehouse_requests",
    };
    ajaxCall(ajax_data, function (result) {
        table_maker(result.results, "request-table-container", tableHeadersStrings);
        $("#records_table").on("click", () => {
            register_clicks("warehouse");
        });
    });
}

function warehouseRequestsDetails(requestId, now) {
    let ajax_data = {
        q_name: "warehouse_requests_details",
        q_data: {
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        resultsData = result.results[0];

        let creationDate = resultsData.requestDate.replace(" 00:00:00", "");
        creationDate = creationDate.split("-")[1] + "-" + creationDate.split("-")[2] + "-" + creationDate.split("-")[0];

        let requestState = resultsData.requestState;
        $("#req_id").val(requestId);
        $("#prod_code").val(resultsData.productCode);
        $("#prod_name").val(resultsData.productName);
        $("#prod_variant").val(resultsData.productFlavour);
        $("#notes").val(resultsData.notes);
        $("#dateDuePicker").val(resultsData.dueDate.split(" ")[0]).attr({min: getToday()});
        $("#dateCreationInput").val(creationDate);

        //EXPECTED COUNT
        previousExpectedCount = 0;
        let ajax_data = {
            q_name: "warehouse_expected_count",
            q_data: {
                "f.productCode": resultsData.productCode,
                "f.productFlavour": resultsData.productFlavour,
                "f.currentYear": now.getFullYear(),
            },
        };
        ajaxCall(ajax_data, function (warehouseExpectedCount) {
            $("#expected_count").val(warehouseExpectedCount.results.N_TOT[0]);
            previousExpectedCount = warehouseExpectedCount.results.N_TOT[0];
        });

        //EXPECTED GROUND COUNT
        ajax_data = {
            q_name: "warehouse_expected_ground_count",
            q_data: {
                "d.lastYear": now.getFullYear() - 1,
                "d.currentYear": now.getFullYear(),
                "f.productCode": resultsData.productCode,
                "f.productFlavour": resultsData.productFlavour,
            },
        };
        ajaxCall(ajax_data, function (expectedGroundCount) {
            console.log(expectedGroundCount);
            let arrayOfGroundCount = expectedGroundCount.results.PRELEVATO;
            let sumOfGroundCount = arrayOfGroundCount ? arrayOfGroundCount.reduce((a, b) => Number(a) + Number(b), 0) : 0;

            if (arrayOfGroundCount) {
                $("#expected_ground_count").val(sumOfGroundCount);
            } else {
                $("#expected_ground_count").val(0);
            }
        });

        //EXPECTED LOCATION
        ajax_data = {
            q_name: "warehouse_get_product_location",
            q_data: {
                "f.productCode": resultsData.productCode,
                "f.productFlavour": resultsData.productFlavour,
            },
        };
        ajaxCall(ajax_data, function (warehouseGetProductLocation) {
            if (
                !(
                    warehouseGetProductLocation.results.ALTEZZA[0] ||
                    warehouseGetProductLocation.results.CORRIDOIO[0] ||
                    warehouseGetProductLocation.results.TRAVERSA[0] ||
                    warehouseGetProductLocation.results.ZONA[0]
                )
            ) {
                $("#productLocation").text("Nessuna ubicazione standard");
            } else {
                $("#productLocation").text(
                    `${warehouseGetProductLocation.results.ALTEZZA[0]} ${warehouseGetProductLocation.results.CORRIDOIO[0]} ${warehouseGetProductLocation.results.TRAVERSA[0]} ${warehouseGetProductLocation.results.ZONA[0]}`
                );
            }
        });

        //EXPECTED DYNAMIC LOCATIONS
        previousExpectedCount = 0;
        ajax_data = {
            q_name: "warehouse_get_dynamic_locations",
            q_data: {
                "f.productCodeAndFlavour": resultsData.productCode + " " + resultsData.productFlavour,
            },
        };
        ajaxCall(ajax_data, function (warehouseGetDynamicLocations) {
            const dynamic_locations_headers_strings = {
                MATERIAL: "mat",
                UBICAZIONE: "ubic",
                QUANTITÀ: "qta",
                LOTTO: "lotto",
                "TIPO UDM": "tipoudm",
            };
            $("#dynamic-locations-table-container").empty();
            $("#notFoundLocations").empty();
            if (warehouseGetDynamicLocations.results.length !== 0) {
                table_maker(warehouseGetDynamicLocations.results, "dynamic-locations-table-container", dynamic_locations_headers_strings);
            } else {
                $("#notFoundLocations").append("Nessuna posizione trovata");
            }
        });

        //Adding button event
        $("#btn-count").click((e) => {
            if ($.isNumeric($("#counted_items").val()) && $("#counted_items").val() > 0) {
                if (requestState == "countRequest") {
                    warehouseCount($("#popup").attr("class"), $("#counted_items").val(), "countRequest", previousExpectedCount);
                } else if (requestState == "recountRequest") {
                    warehouseCount($("#popup").attr("class"), $("#counted_items").val(), "recountRequest", previousExpectedCount);
                }
            } else {
                alert("Non sono accettati campi vuoti o numeri negativi");
            }
        });
    });
}

function lastToPrevious(requestId, lastCount, requestState, previousExpectedCount) {
    let ajax_data = {
        q_name: "last_to_previous",
        q_data: {
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        console.log("lastToPrevious");
        const savedEvent = new Event("savedCount");
        document.addEventListener("savedCount", () => {
            warehouseUpdateRequests(requestId, lastCount);
            warehouseLastExpectedCount(requestId, previousExpectedCount);
            if (requestState === "countRequest") {
                warehouseStateToCountDone(requestId);
                console.log("Going to hide");
                $("#edit-popup").hide();
                location.reload();
            } else if (requestState === "recountRequest") {
                warehouseStateToRecountDone(requestId);
                $("#edit-popup").hide();
                location.reload();
            }
        });
        document.dispatchEvent(savedEvent);
    });
}
function warehouseStateToCountDone(requestId) {
    let ajax_data = {
        q_name: "warehouse_state_to_countDone",
        q_data: {
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        console.log("warehouseStateToCountDone");
    });
}
function warehouseLastExpectedCount(requestId, expectedCount) {
    let ajax_data = {
        q_name: "warehouse_update_expectedCount",
        q_data: {
            "d.expectedCount": expectedCount,
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        console.log("warehouseLastExpectedCount");
    });
}
function warehouseStateToRecountDone(requestId) {
    let ajax_data = {
        q_name: "warehouse_state_to_recountDone",
        q_data: {
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        console.log("warehouseStateToRecountDone");
    });
}
function warehouseUpdateRequests(requestId, lastCount) {
    let ajax_data = {
        q_name: "warehouse_update_count",
        q_data: {
            "d.lastCount": lastCount,
            "f.requestId": requestId,
        },
    };
    ajaxCall(ajax_data, function (result) {
        console.log("warehouseUpdateRequests");
    });
}

function warehouseCount(requestId, lastCount, requestState, previousExpectedCount) {
    lastToPrevious(requestId, lastCount, requestState, previousExpectedCount);
}
