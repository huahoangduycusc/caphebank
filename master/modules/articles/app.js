$(document).on("click", '.btn-danger', function(e){
    e.preventDefault();
    var oid = $(this).attr("data-id");
    //alert("Yes, you just clicked me " + oid);
    Swal.fire({
        title: 'Bạn có chắc?',
        text: "Bạn sẽ không thể khôi phục lại dữ liệu!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'modules/articles/del.php',
                type: 'get',
                cache: false,
                dataType : 'json',
                data: {
                    id : oid
                },
                success: function (data) {
                    if (data != null) {
                        if(data.msg == "success"){
                            $("#row"+oid).fadeOut(1000);
                            Swal.fire(
                                'Đã xóa!',
                                'Dữ liệu đã được xóa khỏi hệ thống.',
                                'success'
                              );
                        }
                        else{
                            Swal.fire(
                                'Lỗi!',
                                'Xảy ra lỗi khi xóa bài viết này.',
                                'error'
                              );
                        }
                    }
                },
                error: function(){
                    alert("Some thing wrong");
                }
            });
        }
      });
  });