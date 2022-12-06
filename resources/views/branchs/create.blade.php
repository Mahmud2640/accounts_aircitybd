@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('branchs.store') }}" method="POST">
                	@csrf
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Branch Name</label>
                                <input required type="text" class="form-control" id="example-text-input" name="name" placeholder="Name Input">
                            </div>
                            <div class="form-group">
                                <label for="example-email-input">Email</label>
                                <input type="email" class="form-control" id="example-email-input" name="email" placeholder="Emai Input">
                            </div>
                            <div class="form-group">
                                <label for="example-password-input">Mobile Number</label>
                                <input type="tel" class="form-control" id="example-password-input" name="mobile" placeholder="Mobile Number">
                            </div>
                            <div class="form-group">
                                <label for="example-textarea-input">Address</label>
                                <textarea required="" class="form-control" id="example-textarea-input" name="location" rows="4" placeholder="Branch Address...."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>
@endsection