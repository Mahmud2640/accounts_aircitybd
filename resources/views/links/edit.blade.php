@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('links.update',$link) }}" method="POST" enctype="multipart/form-data">
                	@csrf
                	@method('PUT')
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Website Name</label>
                                <input required type="text" class="form-control" id="example-text-input" name="name" placeholder="Website Name Input" value="{{ $link->name }}">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Website Link</label>
                                <input required type="text" class="form-control" id="example-text-input" name="link" placeholder="Vendor Name Input" value="{{ $link->link }}">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Image</label>
                                <input type="file" class="form-control" id="example-text-input" name="image"required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>
@endsection