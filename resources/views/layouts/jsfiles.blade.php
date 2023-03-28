<script src="{{url('Frontend/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{url('Frontend/js/bootstrap.min.js')}}"></script>
<script src="{{url('Frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{url('Frontend/js/jquery.marquee.min.js')}}"></script>
<script src="{{url('Frontend/js/main.js')}}"></script> 

 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables -->
<script src="admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script>
$(function() {
    $('.table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
    });
});

$(document).ready(function () { 

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    //Get Team members by Members Category  
    $(document).on('change', '.team_playerCategory', function(e){
        let playerCateID = $(".team_playerCategory").val();
        let clubId = $('#clubId').val();
      
    $.ajax({
      type: "POST",
      url: "{{route('get_member_by_category_id_for_club')}}",
      data: {'playerCateID': playerCateID, 'clubId': clubId},
      dataType: "json",
      success: function(response){
        if(response.errors){
          console.log(response.errors);
          // $('#save_errList').html("");
          // $('#save_errList').addClass("alert alert-danger");
         
        }else{
          console.log(response);
          console.log(response.teamPlayer);
          $('#team_clubMembers').html('');
           $.each(response.players, function(key, values){
            $('#team_clubMembers').append('<option value='+values.id+'>'+values.name+'</option>')
          })
        }
      }
    });
  });

    // Sweet Alert JQuery 
    $('.deleteBtn').on('click', function (event) {
          event.preventDefault();
      const url = $(this).attr('href');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {  
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
          )
          setTimeout(function() { 
            window.location.href = url;
          }, 500);
        }
      })
    });

    
  });
</script>