<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $.support.cors = true;
        $.ajax({
            type: "POST",
            crossDomain: true,
            contentType: "application/json; charset=utf-8",
            url: "https://warehouse.dibumi.com/public/api/login",
            data: "{}",
            dataType: "json",
            success: function (data) {
                for (var i = 0; i < data.d.length; i++) {
                    $("#tbDetails").append("<tr><td>" + data.d[i].Name + "</td><td>" + data.d[i].Ln+ "</td><td>" + data.d[i].Events + "</td></tr>");
                }
            },
            error: function (result) {
                alert("Error");
            }
        });
    });

</script>