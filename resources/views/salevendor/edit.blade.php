@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('salevendor.update',$saleVendor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label>Sale Vendor Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Bank Name" required value="{{ $saleVendor->name }}">
                            </div>
                            <div class="form-group">
                                <label>Sale Vendor Mobile</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+88</span>
                                        </div>
                                        <input value="{{ $saleVendor->mobile }}" type="tel" stop="0.01" class="form-control" name="mobile" placeholder="Mobile number 11 digit">
                                    </div>
                                </div>
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

@section('css')
    <style type="text/css">
        input {
            text-transform: uppercase;
        }
        input:-ms-input-placeholder {
            text-transform: none;
        }
        input::placeholder {
            text-transform: none;
        }
    </style>
@endsection
