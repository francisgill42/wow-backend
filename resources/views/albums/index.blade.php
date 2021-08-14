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
<h4 class="modal-title">Add Album</h4>
</div>
<div class="modal-body">
<form method="post" action="{{route('albums.store')}}" enctype="multipart/form-data">
@csrf
<select id="category_id" name="category_id" class="form-control">
<option>Select Category</option>
@foreach($categories as $category)
<option value="{{$category->id}}">
{{$category->category_name}}
</option>
@endforeach
</select>
<br>

<select id="brand_id" name="brand_id" class="form-control"></select>
<br>
<select id="sub_category_id" name="sub_category_id" class="form-control"></select>
<br>
<input class="form-control" type="text" name="album_name" placeholder="Enter Album Name">

<br>
<input class="form-control" type="file" style="padding:5px;" name="album_image" placeholder="Enter Album Image">
<br><button type="submit" class="btn btn-info" style="">Submit</button>
</form>
</div>

</div>

</div>
</div>
<div class="card">
<div class="card-header">

<a 
href="{{route('albums.create')}}" 
data-toggle="modal" 
data-target="#cbc" 
class="btn btn-success white"
>
Add Album
</a>
</div>

<div class="card-body">
@if (session('status'))
<div class="alert alert-success" role="alert">
{{ session('status') }}
</div>
@endif



@foreach($albums as $album)
<table class="table py-4">
<tr>
<form method="post" action="{{url('albums')}}/{{$album->album_id}}">	
@csrf
@method('PUT')
<td width="30%">
<input name="album_name" value="{{$album->album_name}}" class="form-control">
</td>
<td>{{$album->category_name}}</td>
<td>{{$album->brand_name}}</td>
<td>{{$album->sub_category_name}}</td>
<td width="20%">
   <img width="100%" src="{{url('uploads/album_images/'.$album->album_image)}}" alt=""> 
</td>
</form>
<td>
                    <form method="post" action="{{url('albums')}}/{{$album->album_id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('are your sure ?')" class="btn btn-danger">delete</button>
                    </form>
                    </td>
                    
</tr>
</table>
@endforeach
</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function () {
        var url = '<?php echo url("/");?>';

        $('#category_id').change(function(){
        
        var cat_id = $('#category_id').val();

      
         $.ajax({
		data:cat_id,	
		url: url+'/get_data_for_albums/'+cat_id,
		type: 'GET',
		beforeSend: function (request) {
		return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
		},
		success: function(response){
            $('#brand_id,#sub_category_id').empty();  

		for (x in response[0]) {
		  $('#brand_id').append('<option value="'+response[0][x].id+'">'+response[0][x].brand_name+'</option>');
        }
        
        for (x in response[1]) {
		  $('#sub_category_id').append('<option value="'+response[1][x].id+'">'+response[1][x].subcategory_name+'</option>');
		}

		}
		});

        });
    });
</script>
@endsection