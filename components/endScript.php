<script>
    $('#right-side-menu')
        .dropdown({
                on: 'hover'
            }
        )
    ;

    $('#left-side-dropdown')
        .popup({
            on: 'click',
            popup: $('.ui.popup')
        });

    $('#left-side-dropdown-phone')
        .popup({
            on: 'click',
            popup: $('.ui.popup')
        });

    $('#quickAddObjectType').
    dropdown()
    ;

    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
</script>