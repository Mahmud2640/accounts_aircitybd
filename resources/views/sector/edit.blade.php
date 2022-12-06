@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('sector.update',$sector) }}" method="POST">
                	@csrf
                	@method('PUT')
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Sector Name</label>
                                <input required type="text" class="form-control" id="example-text-input" name="name" placeholder="Sector Name Input" value="{{ $sector->name }}">
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