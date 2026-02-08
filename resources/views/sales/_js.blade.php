@php
	$slipnumber = @$sale?->slipnumber()?->get(['id', 'tracking_number']);
	$itemsArray = $slipnumber?->toArray()??[];
	$oldItemsValue = old('serial', $itemsArray);
	// dd($oldItemsValue);

	$invoiceItems = @$sale?->invitems()?->with('product')?->get(['id', 'id_product', 'commission', 'retail', 'quantity']);
	$invoiceItemsArray = $invoiceItems?->toArray()??[];
	$oldinvoiceItemsValue = old('serial', $invoiceItemsArray);
	// dd($oldinvoiceItemsValue);

	$salespaymentItems = @$sale?->salespayment()?->with('bank')?->get(['id', 'id_bank', 'date_payment', 'amount']);
	$salespaymentItemsArray = $salespaymentItems?->toArray()??[];
	$oldsalespaymentItemsValue = old('pay', $salespaymentItemsArray);
	// dd($oldsalespaymentItemsValue);
@endphp

window.data = {
		routes: {
			getProducts: '{{ route('getProducts') }}',
			getBanks: '{{ route('getBanks') }}',
			getUser: '{{ route('getUser') }}',
			getCustomers: '{{ route('getCustomers') }}',
			payments: '{{ url('payments')}}',
			slippostage: '{{ url('slippostage')}}',
			salesitems: '{{ url('salesitems')}}',
		},
		id : `{{ (\Auth::user()->id_group == 2)?\Auth::user()->id:NULL }}`,
		auth: '{{(\Auth::user()->id_group == 1)?'text':'hidden'}}',
		old: {
			id_user: `{{ old('id_user', @$sale->id_user) }}`,
			repeatcust: `{{ old('repeatcust', @$sale?->customer()?->first()?->id_customer) }}`,
			tracking_number: @json($oldItemsValue),
			inItems: @json($oldinvoiceItemsValue),
			payItems: @json($oldsalespaymentItemsValue),
		},
};
