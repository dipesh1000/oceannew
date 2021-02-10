<script>
    $('.remove-from-cart').click(function (e) {
        e.preventDefault();

        var ele = $(this);
        if(confirm("Are You Sure")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: 'DELETE',
                data: {_token: '{{ csrf_token() }}', id: ele.attr('data-id')},
                success: function(response) {
                    console.log(response)
                    window.location.reload();
                }
            })
        }
    })
</script>