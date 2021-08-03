function append_img_request_state(divToAppend, url, imgSize, title) {
    $("#img_request_state").remove();
    $("#" + divToAppend + "").append(
        $("<div id='img_request_state'>").append($("<images src='" + url + "' height=' " + imgSize + " ' width=' " + imgSize + " ' title='" + title + "'>"))
    );
}
