<style>
    .b-d{
        border: 1px solid #ee335e !important;
    }
</style>
<script src="<?= base_url('assets/js/company/meet/manager.js') ?>"></script>
<div class="row row-sm mt-3">
    <?php $this->view('company/meet/manager_includes/options') ?>
    <?php $this->view('company/meet/manager_includes/meets') ?>
</div>
<?php $this->view('company/meet/manager_includes/meet_timer') ?>
