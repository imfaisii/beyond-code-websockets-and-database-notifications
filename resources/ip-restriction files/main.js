$(".AddIP").click(function (e) {
    e.preventDefault();
    if ($("#AddIPaddressForm").valid()) {
        $.ajax({
            type: "POST",
            url: $("#AddIPaddressForm").attr("action"),
            data: {
                ip: $(".IPaddress").val(),
            },
            beforeSend: function () {
                $(".IPaddressBlock").addClass("block-mode-loading");
            },
            success: function (response) {
                console.log("success");
                console.log(response);
                $(".IPaddressBlock").removeClass("block-mode-loading");
                if (response.message == "success") {
                    One.helpers("notify", {
                        type: "success",
                        icon: "fa fa-check mr-1",
                        message: response.response,
                    });
                    $("#ipaddressestable").load(" #ipaddressestable");
                } else {
                    One.helpers("notify", {
                        type: "danger",
                        icon: "fa fa-times mr-1",
                        message: response.message,
                    });
                }
            },
            error: function (response) {
                console.log("error");
                console.log(response);
                $(".IPaddressBlock").removeClass("block-mode-loading");
                if (response.status == 422) {
                    $.each(response.responseJSON.errors, function (key, value) {
                        One.helpers("notify", {
                            type: "danger",
                            icon: "fa fa-times mr-1",
                            message: value,
                        });
                    });
                } else {
                    One.helpers("notify", {
                        type: "danger",
                        icon: "fa fa-times mr-1",
                        message: response.responseText,
                    });
                }
            },
            complete: function (response) {
                console.log("complete");
                console.log(response);
            },
        });
    }
});

function deleteIpAddress(url, tr) {
    swalWithBootstrapButtons
        .fire({
            title: "Are you sure to remove this IP address ?",
            text: "You won't be able to revert this and this IP will no longer have access to the system !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Do this!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    beforeSend: function () {
                        $(".IPaddressBlockDT").addClass("block-mode-loading");
                    },
                    success: function (response) {
                        var t = $("#ipaddressestable").DataTable();
                        t.row("#" + tr)
                            .remove()
                            .draw();
                        console.log("success");
                        console.log(response);
                        $(".IPaddressBlockDT").removeClass(
                            "block-mode-loading"
                        );
                        if (response.message == "success") {
                            One.helpers("notify", {
                                type: "success",
                                icon: "fa fa-check mr-1",
                                message: response.response,
                            });
                        } else {
                            One.helpers("notify", {
                                type: "danger",
                                icon: "fa fa-times mr-1",
                                message: response.message,
                            });
                        }
                    },
                    error: function (response) {
                        console.log("error");
                        console.log(response);
                        $(".IPaddressBlockDT").removeClass(
                            "block-mode-loading"
                        );
                        if (response.status == 422) {
                            $.each(
                                response.responseJSON.errors,
                                function (key, value) {
                                    One.helpers("notify", {
                                        type: "danger",
                                        icon: "fa fa-times mr-1",
                                        message: value,
                                    });
                                }
                            );
                        } else {
                            One.helpers("notify", {
                                type: "danger",
                                icon: "fa fa-times mr-1",
                                message: response.responseText,
                            });
                        }
                    },
                    complete: function (response) {
                        console.log("complete");
                        console.log(response);
                    },
                });

                swalWithBootstrapButtons.fire(
                    "Deleted!",
                    "Requested Action is Performed Successfully.",
                    "success"
                );
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                //ajax Delete
                swalWithBootstrapButtons.fire(
                    "Cancelled",
                    "The Action is Blocked :)",
                    "error"
                );
            }
        });
}
