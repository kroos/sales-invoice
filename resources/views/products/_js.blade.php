window.data = {
	routes: {
		getProductsdT: '{{ route('getProductsdT') }}',
		getProducts:'{{ route('getProducts') }}',
	},
	urls: {
		productimages: '{{ url('productimages') }}',
	},
	olds: {
		id_category: @json(old('id_category', @$product->id_category))??[],
	},
	productid: {{ $product->id }},
};
