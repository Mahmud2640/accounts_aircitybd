@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('banks.store') }}" method="POST">
                	@csrf
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Bank Name" required>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" stop="0.01" class="form-control" name="amount" placeholder="Bank Name" value="0">
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