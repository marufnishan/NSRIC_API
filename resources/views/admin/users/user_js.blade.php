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
    //delete User
    $(document).on('click','.delete_user',function(e){
            e.preventDefault();
            let user = $(this).data('id');
            var url = "{{ route('admin.users.destroy', ":user") }}";
            url = url.replace(':user', user);
            if(confirm('Are you sure to delete this user?')){
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
            user(page)
        });
        function user(page){
            $.ajax({
                url:"/admin/pagination/paginate-user?page="+page,
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
                url:"{{ route('admin.users.serach') }}",
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