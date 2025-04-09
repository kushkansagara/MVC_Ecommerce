$(document).ready(function () {
  $(document).on("click", ".changestatus", function (e) {
    e.preventDefault();
    let status = $(this).val();
    let id = $(this).closest("tr").find(".id").text();
    let eid = $(this).closest("tr").find(".event_id").text();
    $.ajax({
      url: "http://localhost/mvc_main/admin/event_index/changestatus",
      type: "POST",
      data: {
        status: status,
        id: id,
        eid: eid,
      },

      success: function (response) {
        console.log(response);
        $("#table-data").html($(response).find("#table-data").html());
        // location.reload();
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});
