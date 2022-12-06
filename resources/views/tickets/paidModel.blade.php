<form action="{{ route('ticket.dou.paid') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $ticket->id }}">
    <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
            <h3 class="block-title">Confirmation</h3>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Amount</label>
                        <input max="{{ $ticket->due }}" value="{{ $ticket->due }}" type="number" step="0.01" class="form-control form-control-alt"  name="amount" placeholder="Inter dou amount" required>
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Select Bank</label>
                        <select name="bank" class="form-control form-control-alt" required>
                            <option value="" selected> Select A bank</option>
                            @foreach (\App\Models\Bank::all() as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Note</label>
                        <textarea name="note"  cols="35" rows="5" placeholder="type something"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full text-right border-top">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{__('Cancel')}}</button>
            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save mr-1"></i>Paid</button>
        </div>
    </div>
</form>
