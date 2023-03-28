@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>All Players Categories</h2>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum recusandae nisi asperiores repellendus!</p>
</div>

<div class="container">
    <div class="row">
        {{-- <div class="row"> --}}
            <!-- table section -->
            <div class="col-md-12 mb-5">
              <div class="white_shd full margin_bottom_30">
                 <div class="full graph_head">
                  <div id="success_msg"></div>
                  @if (session()->has('error'))
                  <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
                @endif
                <div id="edit_errList"></div>
                    <div class="heading1 margin_0 d-flex justify-content-between mt-3 mb-4">
                      <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal" >
                          Add Player Categpry+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                       <table class="table">
                          <thead>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                {{-- <th>Status</th> --}}
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($playerCategory as $category)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{$category->category_name}}</td>
                                    {{-- <td>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1 category_status" {{$category->category_status == true ? 'checked' : "" }} data-id="{{$category->category_id}}">
                                        </div>
                                    </td> --}}
                                  <td>
                                    <button type="button" class="btn btn-primary m-1 editcategorymodalbtn" data-toggle="modal" data-target="#editModal" data-id="{{$category->category_id}}">
                                      <i class="fa fa-edit"></i>
                                    </button>
                                      <a href="{{url('admin/player_categories/delete')}}/{{$category->category_id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
                                  </td>
                              </tr>
                              @php
                                   $i++;
                              @endphp
                              @endforeach
                                
                          </tbody>
                       </table>
                       {{-- {{ $grounds->links('pagination::bootstrap-5') }}  --}}
                    </div>
                 </div>
              </div>
           {{-- </div> --}}
      
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container">
              <div id="save_errList"></div>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <form action="{{route('admin_add_new_playerCategory')}}" method="post" id="playerCategoryForm">
                      @csrf
                  <div class="mb-3">
                    <label for="category_name" class="form-label">Player Category Name</label>
                    <input type="text"
                      class="form-control" name="category_name" id="category_name" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">@error('category_name')
                        {{$message}}
                    @enderror</small>
                  </div>
                  </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"   class="btn btn-primary playerCategoryBtn">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit  Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container">
              <div id="save_errList"></div>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <form action="{{route('admin_update_playerCategory')}}" method="post" id="updateCategoryform">
                      @csrf
                  <div class="mb-3">
                      <input type="hidden" id="category_id" name="category_id">
                    <label for="editCategory_name" class="form-label">CategoryName</label>
                    <input type="text"
                      class="form-control" name="editCategory_name" id="editCategory_name" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">@error('editCategory_name')
                        {{$message}}
                    @enderror</small>
                  </div>

                  </div>
              </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updateCategoryBtn">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection