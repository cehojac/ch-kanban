function allowDrop(ev) {
    ev.preventDefault();
}
function dragStart(ev) {

    ev
        .dataTransfer
        .setData("text/plain", ev.target.id);
}
function dropIt(ev) {
    ev.preventDefault();
    let sourceId = ev
        .dataTransfer
        .getData("text/plain");
    let sourceIdEl = document.getElementById(sourceId);
    let sourceIdParentEl = sourceIdEl.parentElement;

    let targetEl = document.getElementById(ev.target.id)
    let targetParentEl = targetEl.parentElement;

    if (targetParentEl.id !== sourceIdParentEl.id) {

        if (targetEl.className === sourceIdEl.className) {

            targetParentEl.appendChild(sourceIdEl);

        } else {

            targetEl.appendChild(sourceIdEl);

        }
        if (sourceIdParentEl.id != ev.target.id) {
            ChangeStatus(sourceId, ev.target.id, sourceIdParentEl.id);
        }

    }

}
function ChangeStatus(id, status, prev) {
    console.log("id= " + id + " status=" + status);
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        dataType: 'type',
        data: {
            action: 'update_taxonomy',
            nonce: ajax_var.nonce,
            id_post: id,
            previous: prev,
            taxonomy: status
        },
        success: function (response) {},
        error: function (data) {}
    });
}