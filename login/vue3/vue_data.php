<?php if(!empty($api_key)){ ?>
    <script>
        window.APP_CONFIG = {
            apiSecretKey: '<?= $api_key ?>'
        };
    </script>
<?php } ?>