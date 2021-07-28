### [ close_requests.q ]

#### Used to close a request and save the terminationDate.

###### Variables needed:

- {d.terminationDate}
- {f.requestId}

---

### [ create_requests.q ]

#### Used to create a request.

###### Variables needed:

- {d.requestDate}
- {d.productCode}
- {d.productName}
- {d.productFlavour}
- {d.dueDate}
- {d.requestState}
- {d.notes}

---

### [ ask_for_recount.q ]

#### Used to ask for a recount. </br> To use after having checked that it has been counted at least once.

###### Variables needed:

- {f.requestId}

---

### [ office_requests_details.q ]

#### Used to get back the request details needed for office visualization.

###### Variables needed:

- {f.requestId}

---

### [ office_requests.q ]

#### Used to get back all the requests ever made to then filter them out.

###### Variables needed:

- No variables needed

---

### [ office_update_requests.q ]

#### Used to update product informations.

###### It should be used after retrieve_product_information.q

###### Variables needed:

- {d.productCode}
- {d.productName}
- {d.productFlavour}
- {d.notes}
- {d.dueDate}
- {f.requestId}

---

### [ warehouse_requests_details.q ]

#### Used to get back the request details needed for warehouse visualization.

###### Variables needed:

- {f.requestId}

### [ warehouse_requests.q ]

#### Used to get back all the OPEN requests to then filter them out.

###### Variables needed:

- No variables needed

---

### [ warehouse_update_requests.q ]

#### Used to update the last count of the request.

###### Variables needed:

- {d.lastCount}
- {f.requestId}

---

### [ last_to_previous.q ]

#### Used to move lastCount value to previousCount to be able to then store the new value into lastCount.

###### Variables needed:

- {f.requestId}

---

### [ retrieve_product_information.q ]

#### Used to close a request and save the terminationDate.

###### Variables needed:

- TO DO
