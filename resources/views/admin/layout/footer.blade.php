 <!-- Footer -->
 <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->


<script>
    $(document).ready(function () { 

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    // --------------------------------
      // Ground CRUD Operatrions Start Here
      // -------------------------------- 
           //  Chnage Brand Status 
$(document).on('click', '.ground_status', function(){
   var status = $(this).prop('checked') == true ? 1 : 0;
   var id = $(this).data('id');
   $.ajax({
          type: 'POST',
          url: "{{route('ground_status_check')}}",
          data: {'status':status, 'id':id},
          success: function(response){
            if(response.errors){
              console.log(response.errors);
              $('#save_errList').html("");
              $('#save_errList').addClass("alert alert-danger");
              $('#save_errList').html('something went Wrong');
            }
            console.log(response);
            Swal.fire(
              'Updated!',
              'Ground Status has been updated.',
              'success'
              )}
          });
          });
      // --------------------------------
      // City Ground Operatrions End Here
      // -------------------------------- 
   
      // --------------------------------
      // Player Category CRUD Operatrions Start Here
      // -------------------------------- 

    //For Player Category Addition 
    $(document).on('click', '.playerCategoryBtn', function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "{{route('admin_add_new_playerCategory')}}",
        data: $("#playerCategoryForm").serialize(),
        dataType: "json",
      success: function(response){
      if(response.errors){
        console.log(response.errors);
        $('#save_errList').html("");
        $('#save_errList').addClass("alert alert-danger");
        $.each(response.errors, function(key, arr_values){
          $('#save_errList').append('<li>'+arr_values+'</li>')
          // $('.modalBtn').click();
        })
      }else{
        $('#save_errList').html("");
        $('#save_errList').removeClass("alert alert-danger");
        Swal.fire(
          'Added!',
          'Player Category has been created successfully.',
          'success'
          )
          console.log(response);
        }
      }
    });
  });
  

  
  //For Player Category Details edit 
  $(document).on('click', '.editcategorymodalbtn', function(e){
    var category_id = $(this).data('id');
    $.ajax({
      type: "POST",
      url: "{{route('admin_edit_playerCategory')}}",
      data: {'category_id': category_id},
      dataType: "json",
      success: function(response){
        if(response.errors){
          console.log(response.errors);
          $('#save_errList').html("");
          $('#save_errList').addClass("alert alert-danger");
          $.each(response.errors, function(key, arr_values){
            $('#save_errList').append('<li>'+arr_values+'</li>')
          })
        }else{
          console.log(response);
          $('#category_id').val(response.category.category_id);
          $('#editCategory_name').val(response.category.category_name);
        }
      }
    });
  });
  

  //For Player Category details Update 
  $(document).on('click', '.updateCategoryBtn', function(e){
       id = $('#category_id').val();
        e.preventDefault();
        $.ajax({
    type: "POST",
    url: "{{url('admin/player_categories/update')}}",
    data: $("#updateCategoryform").serialize(),
    dataType: "json",
    success: function(response){
      if(response.errors){
        console.log(response.errors);
        $('#edit_errList').html("");
        $('#edit_errList').addClass("alert alert-danger");
        $.each(response.errors, function(key, arr_errors){
          $('#edit_errList').append('<li>'+arr_errors+'</li>')
        })
         $('.editcategorymodalbtn').click();
      }else{
            Swal.fire(
              'Updated!',
              'Category has been updated.',
              'success'
              )
              console.log(response);
              setTimeout(function() { 
            window.location.reload();
          }, 500);
            }
          }
        });
      });
      // --------------------------------
      // Player Category CRUD Operatrions End Here
      // -------------------------------- 

      //Get Team members by Members Category  
      $(document).on('change', '.team_playerCategory', function(e){
        let playerCateID = $(".team_playerCategory").val();
        let clubId = $('#clubId').val();
      
    $.ajax({
      type: "POST",
      url: "{{route('get_member_by_category_id')}}",
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

    })
</script>