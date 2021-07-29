### In office

- Create a request and check you can only pick future dates
- Close a request after having created it
- Close a request after having counted
- Close a request after having reasked for count
- Close a request after having recounted
- When closing check that terminationDate, isClosed are updated
- Show any requests and filter them out
- When just ask for count only allow: UPDATE, CLOSE
- When just counted only allow: UPDATE, CLOSE, RECOUNT
- When recounting only allow: UPDATE, CLOSE
- When recount is done only allow: CLOSE, RECOUNT
- When closed only allow: NOTHING
- Check you can update only dueDate and notes

### In warehouse

- Only show countRequest and recountRequest requests
- Show locations of products
- Show amount of products ready to be shipped (expectedGroundCount)
- On input count: change state to countDone or recountDone, update previousCount and lastCount,
- Count input doesn't accept empty field or negative numbers

### In warehouse director

- Show expectedCount

### In warehouse operator

- Don't show expectedCount
