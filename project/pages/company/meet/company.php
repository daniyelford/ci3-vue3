<?php if(!empty($data) && is_array($data)){ ?>
    <style>
        .b-d{
            border: 1px solid #ee335e !important;
        }
    </style>
    <div class="row row-sm mt-3">
    	<?php $this->view('company/meet/company_includes/options') ?>
        <?php $this->view('company/meet/company_includes/from_other') ?>
        <?php $this->view('company/meet/company_includes/from_me') ?>
    </div>
    <?php $this->view('company/meet/company_includes/timer') ?>
    <?php $this->view('company/meet/company_includes/add_timer') ?>
    <script src="<?= base_url('assets/js/company/meet/company.js') ?>"></script>
    <script>
        let userList=[];
        function saveAddMeet(el){
            let t=$('#meet-title').val(),
            d=$('#meet-des').val();
            if(t!=='' && d!=='' && userList.length>0){
                $('#meet-title').removeClass('border-danger');
                $('#meet-des').removeClass('border-danger');
                $('#user-list-meet').removeClass('b-d');
                sendAjax({fromCuId:<?= (!empty($company_user_id) && intval($company_user_id)>0?$company_user_id:0) ?>,t:t,d:d,userList:userList},baseUrl('company/meet/meet/add'),'');
                return true;
            }else{
                if(t!==''){
                    $('#meet-title').removeClass('border-danger');
                }else{
                    $('#meet-title').addClass('border-danger');
                }
                if(d!==''){
                    $('#meet-des').removeClass('border-danger');
                }else{
                    $('#meet-des').addClass('border-danger');
                }
                if(userList.length>0){
                    $('#user-list-meet').removeClass('b-d');
                }else{
                    $('#user-list-meet').addClass('b-d');
                }
                return not1();
            }
        }
    </script>
<?php } ?>