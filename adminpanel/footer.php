<div class="footer">
    <!-- Jquery -->
    <script src="jstheme/jquery-1.10.2.min.js"></script>

    <!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Waypoint -->
    <script src='jstheme/waypoints.min.js'></script>

    <!-- LocalScroll -->
    <script src='jstheme/jquery.localscroll.min.js'></script>

    <!-- ScrollTo -->
    <script src='jstheme/jquery.scrollTo.min.js'></script>

    <!-- Datatable -->
    <script src='jstheme/jquery.dataTables.min.js'></script>


    <!-- Modernizr -->
    <script src='jstheme/modernizr.min.js'></script>

    <!-- Pace -->
    <script src='jstheme/pace.min.js'></script>

    <!-- Popup Overlay -->
    <script src='jstheme/jquery.popupoverlay.min.js'></script>

    <!-- Slimscroll -->
    <script src='jstheme/jquery.slimscroll.min.js'></script>

    <!-- Cookie -->
    <script src='jstheme/jquery.cookie.min.js'></script>


    <!-- Endless -->
    <script src="jstheme/endless/endless.js"></script>

    <script>
        $(function () {
            $('#dataTable').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "pageLength": 100

            });

            $('#dataTable1').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "pageLength": 10,

            });

            $('#chk-all').click(function () {
                if ($(this).is(':checked')) {
                    $('#responsiveTable').find('.chk-row').each(function () {
                        $(this).prop('checked', true);
                        $(this).parent().parent().parent().addClass('selected');
                    });
                }
                else {
                    $('#responsiveTable').find('.chk-row').each(function () {
                        $(this).prop('checked', false);
                        $(this).parent().parent().parent().removeClass('selected');
                    });
                }
            });
        });
    </script>

    Copyright reserved @ <a href="http://www.osterleycc.com">Osterley Cricket Club</a> - 2013
</div>

</body>
</html>