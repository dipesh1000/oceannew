<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OceanPublication</title>
    <!-- Dflip -->
    <link rel="stylesheet" href="{{ asset('assets/dflip/css/dflip.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dflip/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dflip/css/themify-icons.css') }}">

</head>
<body>
    <div id="flipbook_div" ></div>    
    {{-- http://192.168.10.80:80/a.pdf --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('assets/dflip/js/dflip.min.js') }}"></script>
    
    
    <script>
        var flipBook;
        jQuery(document).ready(function () {
            // var pdf=$('#flipbook_div').attr('source');
            var pdf = "{{asset('/pdf/'.$fileName)}}"
            var options = {
                enableDownload: false,
                hideControls: "share",
            };
            flipBook = $("#flipbook_div").flipBook(pdf, options);
            // $('#flipbook_div').removeAttr('source');
        });
    </script>
    {{-- <script type="text/javascript">
        DFLIP.defaults.enableDownload = false;
        DFLIP.defaults.hideControls = "share"; 

        // window.onload = function(){
        //     document.getElementById('flipbok_div').removeAttribute("source");
        // }
        $('#flipbok_div').removeAttr('source');
    </script> --}}
    
</body>
</html>
 
