var btn = document.querySelector('#search');
btn.addEventListener('click',(e) => {
    e.preventDefault();
    var eValue = $("#value").val();
    var eType = $("input[name='type']:checked").val();
    $("#result").html("<tr><td colspan='7' style='text-align:center'><img src='https://i.ibb.co/CzWHLwL/loading.gif' style='width:120px'></td></tr>");
    if(eValue == ""){
        return;
    }
    $.ajax({
        type: 'GET',
        dataType: 'text',
        cache: false,
        url: 'modules/users/search-ajax.php',
        data: {
            user: eValue,
            type: eType
        },
        success: function(result){
            //alert(result);
            $("#result").html(result);
        },
        error: function(){
            alert("Something is went wrong ??");
        }
    });
});