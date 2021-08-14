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
<h4 class="modal-title">Add Sub Category</h4>
</div>
<div class="modal-body">
<form method="post" action="{{route('subcategories.store')}}">
@csrf
<input class="form-control" type="text" name="subcategory" placeholder="Enter Sub Category Name">
<br>
<select name="category_id" class="form-control">
<option>Select Category</option>
@foreach($categories as $category)
<option value="{{$category->id}}">
{{$category->category_name}}
</option>
@endforeach
</select>
<br><button type="submit" class="btn btn-info" style="">Submit</button>
</form>
</div>

</div>

</div>
</div>
<div class="card">
<div class="card-header">

<a href="{{route('subcategories.create')}}" data-toggle="modal" data-target="#cbc" class="btn btn-success white">Add Sub Category</a>
</div>

<div class="card-body">
@if (session('status'))
<div class="alert alert-success" role="alert">
{{ session('status') }}
</div>
@endif



@foreach($subcategories as $subcategory)
<table class="table py-4">

<tr>
                    <td width="100%">
                    <form method="post" action="{{url('subcategories')}}/{{$subcategory->id}}">
                    @csrf
                    @method('PUT')
                    <input name="subcategory_name" value="{{$subcategory->subcategory_name}}" class="form-control">
                    
                </form>
                    </td>
                    <td>
                    <form method="post" action="{{url('subcategories')}}/{{$subcategory->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('are your sure ?')" class="btn btn-danger">delete</button>
                    </form>
                    </tr>
</table>
@endforeach
</div>
</div>
</div>
</div>
</div>
@endsection
