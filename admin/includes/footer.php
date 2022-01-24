<!-- Loading Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<script src="<?php echo $base_url ?>/admin/js/jquery.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/bootstrap-select.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/Chart.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/fileinput.js"></script>
<script src="<?php echo $base_url ?>/admin/js/chartData.js"></script>
<script src="<?php echo $base_url ?>/admin/js/main.js"></script>


<script>
    var app = {
        code: '0'
    };
    $('[data-load-kar]').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var code = $this.data('load-kar');
        if (code) {
            $($this.data('remote-target')).load('karyawanview.php?code=' + code);
            app.code = code;

        }
    });
</script>
<script>
    var app = {
        code: '0'
    };
    $('[data-load-trx]').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var code = $this.data('load-trx');
        if (code) {
            $($this.data('remote-target')).load('sewaview.php?code=' + code);
            app.code = code;

        }
    });
</script>
<script>
    var app = {
        code: '0'
    };
    $('[data-load-usr]').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var code = $this.data('load-usr');
        if (code) {
            $($this.data('remote-target')).load('userview.php?code=' + code);
            app.code = code;

        }
    });
</script>
</body>

</html>