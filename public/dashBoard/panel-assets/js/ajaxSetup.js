$.ajaxSetup({
	dataType: 'json',
    headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
});