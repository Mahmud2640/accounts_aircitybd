@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('salary.store') }}" method="POST">
                	@csrf
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Employee</label>
                                <select class="js-select2 form-control" id="example-select2" name="user_id" style="width: 100%;" data-placeholder="Choose one Employee" required="">
                                    <option></option>
                                    @foreach (\App\Models\User::where('status',1)->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->branch->name ?? '[No Branch]' }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Months</label>
                                <select class="form-control" name="months" style="width: 100%;" required="">
                                    <option @if(date('F')=='Janaury') selected @endif value='Janaury'>Janaury</option>
                                    <option @if(date('F')=='February') selected @endif value='February'>February</option>
                                    <option @if(date('F')=='March') selected @endif value='March'>March</option>
                                    <option @if(date('F')=='April') selected @endif value='April'>April</option>
                                    <option @if(date('F')=='May') selected @endif value='May'>May</option>
                                    <option @if(date('F')=='June') selected @endif value='June'>June</option>
                                    <option @if(date('F')=='July') selected @endif value='July'>July</option>
                                    <option @if(date('F')=='August') selected @endif value='August'>August</option>
                                    <option @if(date('F')=='September') selected @endif value='September'>September</option>
                                    <option @if(date('F')=='October') selected @endif value='October'>October</option>
                                    <option @if(date('F')=='November') selected @endif value='November'>November</option>
                                    <option @if(date('F')=='December') selected @endif value='December'>December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Amount</label>
                                <input type="number" stop="0.01" class="form-control" id="example-text-input" name="amount" placeholder="Salary Amount" required>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Type</label>
                                <select class="form-control" name="type" style="width: 100%;" required="">
                                    <option value='salary'>Salary</option>
                                    <option value='advance'>Advance</option>
                                </select>
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
