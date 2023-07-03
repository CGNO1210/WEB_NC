$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function Delete(id, url){
    if(confirm("Bạn có thực sự muốn xóa đối tượng này không?")){
        $.ajax({
            type: 'DELETE',
            datatype:JSON,
            data:{id},
            url:url,
            success:function (result){
                if(result.error == 'false'){
                    alert(result.message);
                    location.reload();
                }
                else {
                    alert(result.message);
                }
            }
        });
    }
}