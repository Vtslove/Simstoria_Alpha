<div class="loader">
    <img src="{{asset('favicon.ico')}}" />

</div>
<div class="loader">
    <div class="pre_logo">
    <img src="{{asset('favicon.ico')}}" />
    </div>
    <img src="{{ asset('assets/images/oval.svg') }}" />
</div>

<script>
    $(function() {
        setTimeout(() => {
            $(".loader").fadeOut(100);
        },999999999999999)
    })
</script>

<script>
    $(function() {
        setTimeout(() => {
            $(".loader").fadeOut(600);
        },2000)
    })
</script>
