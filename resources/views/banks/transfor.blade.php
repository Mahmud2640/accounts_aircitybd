<form action="{{ route('bank_transfor.update') }}" method="POST">
    @csrf
    <input type="hidden" name="form" value="{{ $form->id }}">
    <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
            <h3 class="block-title">Bank Transfor Form</h3>
        </div>
        <div class="block-content" >
            <p>Ac Name : {{ $form->name }} , Current Balance: {{ $form->amount }}</p>
            <div class="row justify-content-center py-sm-3 py-md-1">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label>Amount</label>
                        <input style="border: 1px solid #ddd" type="number" stop="0.01" max="{{ $form->amount }}" class="form-control form-control-alt" name="amount" placeholder="Amount" min="0" required>
                    </div>
                </div>
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label>Send money to that bank</label>
                        <select name="to" class="form-control" required>
                            <option value="" selected>Select a bank</option>
                            @foreach ($tos as $to)
                                <option value="{{ $to->id }}">{{ $to->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full text-right border-top">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Close</button>

            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save mr-1"></i>Transfor Now</button>
        </div>
    </div>
</form>
