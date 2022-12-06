@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('salary.update',$salary) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Employee</label>
                                <select class="js-select2 form-control" id="example-select2" name="user_id" style="width: 100%;" data-placeholder="Choose one Employee" required="">
                                    <option></option>
                                    @foreach (\App\Models\User::where('status',1)->get() as $item)
                                        <option @if($salary->user_id==$item->id) selected @endif value="{{ $item->id }}">{{ $item->name }} ({{ $item->branch->name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Months</label>
                                <select class="form-control" name="months" style="width: 100%;" required="">
                                    <option @if($salary->months=='Janaury') selected @endif value='Janaury'>Janaury</option>
                                    <option @if($salary->months=='February') selected @endif value='February'>February</option>
                                    <option @if($salary->months=='March') selected @endif value='March'>March</option>
                                    <option @if($salary->months=='April') selected @endif value='April'>April</option>
                                    <option @if($salary->months=='May') selected @endif value='May'>May</option>
                                    <option @if($salary->months=='June') selected @endif value='June'>June</option>
                                    <option @if($salary->months=='July') selected @endif value='July'>July</option>
                                    <option @if($salary->months=='August') selected @endif value='August'>August</option>
                                    <option @if($salary->months=='September') selected @endif value='September'>September</option>
                                    <option @if($salary->months=='October') selected @endif value='October'>October</option>
                                    <option @if($salary->months=='November') selected @endif value='November'>November</option>
                                    <option @if($salary->months=='December') selected @endif value='December'>December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Amount</label>
                                <input type="number" stop="0.01" class="form-control" id="example-text-input" name="amount" placeholder="Salary Amount" required value="{{ $salary->amount }}">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Type</label>
                                <select class="form-control" name="type" style="width: 100%;" required="">
                                    <option @if($salary->type=='salary') selected  @endif value='salary'>Salary</option>
                                    <option @if($salary->type=='advance') selected  @endif value='advance'>Advance</option>
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