<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){
        //add product
        $(document).on('click','.add_role',function(e){
            e.preventDefault();
            let name = $('#name').val();
             console.log(name);
            $.ajax({
                url:"{{ route('admin.roles.store') }}",
                method:'POST',
                data:{name:name},
                success:function(res){
                    if(res.status=='success'){
                        $('#addModal').modal('hide');
                        $('#addRoleForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        });
    });
     //show role value 
     $(document).on('click','.update_role_form',function(e){
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#up_id').val(id);
            $('#up_name').val(name);
        });
        //update Role
        $(document).on('click','.update_role',function(e){
            e.preventDefault();
            let role = $('#up_id').val();
            var url = "{{ route('admin.roles.update', ":role") }}";
            url = url.replace(':role', role);
            let name = $('#up_name').val();
            //console.log(role+up_name);
            $.ajax({
                url:url,
                method:'PUT',
                data:{name:name},
                success:function(res){
                    //console.log(res.data);
                    if(res.status=='success'){
                        $('#updateModal').modal('hide');
                        $('#updateRoleForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        });
    //delete product
    $(document).on('click','.delete_role',function(e){
            e.preventDefault();
            let role = $(this).data('id');
            var url = "{{ route('admin.roles.destroy', ":role") }}";
            url = url.replace(':role', role);
            if(confirm('Are you sure to delete this role?')){
                $.ajax({
                    url:url,
                    method:'DELETE',
                    success:function(res){
                        // console.log(res.data);
                        if(res.status=='success'){
                            $('.table').load(location.href+' .table');
                        }
                    }
                });
            }
            
        });

        //paginate
        $(document).on('click','.pagination a',function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            role(page)
        });
        function role(page){
            $.ajax({
                url:"/admin/pagination/paginate-role?page="+page,
                success:function(res){
                    $('.table-bordered').html(res);
                }
            });
        }
    //search 
    $(document).on('keyup',function(e){
            e.preventDefault();
            let search_string = $('#search').val();
            console.log(search_string);
            $.ajax({
                url:"{{ route('admin.role.serach') }}",
                method:'GET',
                data:{search_string:search_string},
                success:function(res){
                    $('.table-bordered').html(res);
                    if(res.status=='nothing_found'){
                        $('.table-bordered').html('<span class="text-danger">'+'Nothing Found'+'</span>');
                    }
                }
            });
        });
</script>