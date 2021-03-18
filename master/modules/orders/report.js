$("#frmReport").submit(function(e){
    e.preventDefault();
    //console.log(startD);
    //console.log(endD);
    $("#result").html("<tr><td colspan='7' style='text-align:center'><img src='https://i.ibb.co/CzWHLwL/loading.gif' style='width:120px'></td></tr>");
    $.ajax({
        type: "POST",
        url: 'modules/orders/report-ajax.php',
        dataType: "text",
        data: {
            type : $("#select").val(),
            tu : startD,
            den : endD
        },
        success: function(data)
        {
            $("#result").html(data);
        },
        error : function(){
            alert("Something wrong...");
        }
    });
});