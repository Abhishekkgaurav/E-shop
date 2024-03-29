@extends('admin.layouts.default')
@section('content')

				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                        <form action="" method="post" id="categoryForm" name="categoryForm">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status">Status</label>
                                                <select type="text" name="status" id="status" class="form-control">
                                                    <option hidden="hidden">--select--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Block</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 pt-3">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{route('categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                            </div>
                        </form>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->


@stop

@section('customJs')
<script>
   $("#categoryForm").submit(function(e){
    e.preventDefault();
    var ele=$(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{route("categories.store")}}',
        type: 'POST',
        data: ele.serializeArray() ,
        dataType:'JSON',
        success: function(res){
            $("button[type=submit]").prop('disabled',false);
            if(res['status']){
                window.location.href="{{route('categories.index')}}";
                 $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                 $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            else{
                 var errors=res['errors'];
            if(errors['name']){
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            }
            else{
                 $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            if(errors['slug']){
                $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            }
            else{
                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            }


        },
        error: function(jqXHR,exception){
            console.log("Something Went Wrong");
        }
    })
   })

$("#name").change(function(){
    var ele=$(this);
     $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{route("getSlug")}}',
        type: 'get',
        data: {title:ele.val()} ,
        dataType:'JSON',
        success: function(res){
             $("button[type=submit]").prop('disabled',false);
            if(res['status']){
                 $("#slug").val(res['slug']);

            }
            else{
                 var errors=res['errors'];
            if(errors['name']){
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            }
            else{
                 $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            if(errors['slug']){
                $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            }
            else{
                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            }


        },
        error: function(jqXHR,exception){
            console.log("Something Went Wrong");
        }
    })
})
</script>

@endsection
