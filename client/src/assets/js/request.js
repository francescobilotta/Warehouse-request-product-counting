class Requester {
  constructor(
    query_data,
    results_callback,
    req_type = "GET",
    req_url = "../../../../server/api/request_receiver.php",
    req_ret_type = "json"
  ) {
    this.query_data = query_data;
    this.results_callback = results_callback;
    this.req_type = req_type;
    this.req_url = req_url;
    this.req_ret_type = req_ret_type;
  }

  query() {
    let request = $.ajax({
      async: true,
      type: this.req_type,
      url: this.req_url,
      dataType: this.req_ret_type,
      data: this.query_data,
      success: (data) => {
        if (data.status === "ok") {
          this.result = data;
          this.results_callback(this.result);
        } else {
          console.log("Error, the api has encountered a problem. Status: " + data.status);
          this.result = undefined;
        }
      },
      error: (error) => {
        console.log("Error, the ajax request could not be completed. Message: " + error);
        console.log(error);
        this.result = undefined;
      },
    });
  }
}

class q_data {
  constructor() {
  }
}
