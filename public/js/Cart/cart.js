(function($) {
    $('.item-quantity').on('change', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var quantity = $(this).val();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/cart/" + id,
            method: 'PUT',
            data: {
                quantity: quantity,
                _token: csrf_token
            },
            success: function(response) {
                if (response.success) {
                    alert('تم تحديث الكمية بنجاح');
                    // يمكنك تحديث الإجمالي الكلي أو المجموع هنا أيضًا
                } else {
                    alert('حدث خطأ أثناء تحديث الكمية');
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    alert('الرجاء التحقق من البيانات المدخلة');
                } else {
                    alert('حدث خطأ غير متوقع');
                }
            }
        });
    });



    $('.remove-item').on('click', function(e) {

        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: "/cart/" + id,
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $(`#${id}`).remove();
                alert('تم حذف المنتج بنجاح');

                },
                    // يمكنك تحديث الإجمالي الكلي أو المجموع هنا أيضًا
        });
    });
})(jQuery);
