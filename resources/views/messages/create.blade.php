@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('send.sms') }}" method="POST">
                	@csrf
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Mobile Number</label>
                                <textarea  class="form-control" name="number" rows="2" placeholder="Multiple নাম্বার a SMS পাঠাইতে , ব্যবহার করুণ &#10;যেমন : 0170000000,01500000000 "></textarea>
                                <div class="items"></div>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="message" rows="4" placeholder="Textarea content.."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Send</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>

@endsection
