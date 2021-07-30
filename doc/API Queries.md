### [ close_requests.q ]

#### Used to close a request and save the terminationDate.

###### Variables needed:

- {d.terminationDate}
- {f.requestId}

---

### [ office_create_requests.q ]

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

### [ warehouse_update_count.q ]

#### Used to update the last count of the request.

###### Variables needed:

- {d.lastCount}
- {f.requestId}

---

### [ warehouse_state_to_countDone.q ]

#### Changes state to countDone.

###### Variables needed:

- {f.requestId}

---

### [ warehouse_state_to_recountDone.q ]

#### Changes state to recountDone.

###### Variables needed:

- {f.requestId}

---

### [ last_to_previous.q ]

#### Used to move lastCount value to previousCount to be able to then store the new value into lastCount.

###### Variables needed:

- {f.requestId}

---

### [ get_products_names.q ]

#### Get all products codes and descriptions from Oracle database.

###### Variables needed:

- No variables needed

---

### [ get_product_flavours.q ]

#### Get all flavours related to an ID.

###### Variables needed:

- {f.productCode}

---

### [ warehouse_get_product_location.q ]

#### Get standard location of a product .

###### Variables needed:

- {f.productCode}
- {f.productFlavour}

---

### [ warehouse_expected_count.q ]

#### Get total amount of products on oracle database.

###### Variables needed:

- {f.productCode}
- {f.productFlavour}
- {f.currentYear}

---

### [ warehouse_expected_ground_count.q ]

#### Get amount of products on ground or ready to shipped, by productId.

###### Variables needed:

- {d.lastYear}
- {d.currentYear}
- {f.productCode}
- {f.productFlavour}
