<!-- Libs JS -->
<script src="./dist/libs/nouislider/dist/nouislider.min.js"></script>
<script src="./dist/libs/litepicker/dist/litepicker.js"></script>
<script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js"></script>
<!-- Tabler Core -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="./dist/js/tabler.min.js"></script>
<script src="./dist/js/demo.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript" language="javascript"></script>
<script src="./dist/js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript" language="javascript">
    function showPW() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<script type="text/javascript">
    function toggle() {
        document.getElementById("newKode").toggleAttribute("disabled");
    }
</script>
<script type="text/javascript">
    function toggle1() {
        document.getElementById("uraian").toggleAttribute("disabled");
    }
</script>
<script type="text/javascript">
    function toggle2() {
        document.getElementById("coba").toggleAttribute("disabled").reAttribute('id');
    }
</script>



<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {

        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('select-tags-advanced'), {
            copyClassesToDropdown: false,

            optionClass: 'dropdown-item',
            controlInput: '<input>',

        }));
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('drop-status-user'), {
            copyClassesToDropdown: false,
            dropdownClass: 'dropdown-menu',
            optionClass: 'dropdown-item',
            controlInput: '<input>',

        }));
    });
    // @formatter:on
</script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('tanggal_buka'),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
        }));
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('tanggal_tutup'),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
        }));
    });
    // @formatter:on
</script>



<!-- Copyright © 2008, 2014 https://www.fyneworks.com/ -->

</body>

</html>