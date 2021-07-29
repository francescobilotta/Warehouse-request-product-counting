class Requester {
  constructor(
    results_callback,
    req_type = "GET",
    req_url = "../../../../server/api/request_receiver.php",
    req_ret_type = "json"
  ) {
    this.query_data = undefined;
    this.results_callback = results_callback;
    this.req_type = req_type;
    this.req_url = req_url;
    this.req_ret_type = req_ret_type;
  }

  query(ajax_data=this.query_data) {
    if (!ajax_data) {
      alert("The ajax request has no data");
    }
    let request = $.ajax({
      async: true,
      type: this.req_type,
      url: this.req_url,
      dataType: this.req_ret_type,
      data: ajax_data,
      error: (error) => {
        console.log("Error, the ajax request could not be completed. Message: " + error);
        console.log(error);
        this.result = undefined;
      },
    }).done((data) => {
      if (data.status === "ok") {
        this.result = data;
        this.results_callback(this.result);
      } else {
        console.log("Error, the api has encountered a problem. Status: " + data.status);
        this.result = undefined;
      }
    });
  }
}

class q_data {
  constructor() {
  }
}

class ajax_data {
  constructor(q_name, q_data) {
    this.q_name = q_name;
    this.q_data = q_data;
  }
}