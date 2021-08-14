@extends('layouts.app')

@section('content')


        <div class="col-md-8">
        <div class="panel-body widget-shadow">
<div id="cbc" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
<h4 class="modal-title">Add Category</h4>
</div>
<div class="modal-body">
<form method="post" action="{{route('categories.store')}}">
@csrf
<input class="form-control" type="text" name="category" placeholder="Enter Category Name">
<br><button type="submit" class="btn btn-info" style="">Submit</button>
</form>

</div>

</div>

</div>
</div>
            <div class="card">
                <div class="card-header">
                <a href="" data-toggle="modal" data-target="#cbc" class="btn btn-success white">Add Category</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                   
                    <table class="table py-4">
                      
                    @foreach($categories as $category)
                    <tr>
                    <td width="100%">
                    <form method="post" action="{{url('categories')}}/{{$category->id}}">
                    @csrf
                    @method('PUT')
                    <input name="category_name" value="{{$category->category_name}}" class="form-control">
                    </form>
                    </td>
                    <td>
                    <form method="post" action="{{url('categories')}}/{{$category->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('are your sure ?')" class="btn btn-danger">delete</button>
                    </form>
                    </tr>
                    @endforeach
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal start -->
<div id="category_edit" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
<h4 class="modal-title">Edit Category</h4>
</div>
<div class="modal-body">
<form method="post" action="{{route('categories.store')}}">
@csrf
<input class="form-control" type="text" name="category" placeholder="Enter Category Name">
<br><button type="submit" class="btn btn-info" style="">Submit</button>
</form>

</div>

</div>

</div>
</div>
<!-- Modal end -->
@endsection
