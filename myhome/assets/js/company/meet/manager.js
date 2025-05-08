function acceptTimerMeet(){
        let h=$('#hour').val(),d=$('#day').val(),m=$('#month').val(),y=$('#year').val(),
        mId=$('#mId').val(),mUId=$('#mUId').val(),mT=$('#mT').val();
        if(h!==''&&d!==''&&m!==''&&y!==''&&mId!==''&&mUId!==''&&mT!==''){
            sendAjax({h:h,d:d,m:m,y:y,mId:mId,mUId:mUId,mT:mT},baseUrl('company/meet/meet/change_time_meet_manager'),'#content');
            return true;
        }else{
            return not8();
        }
    }
    function changeUserMeetId(el,id){
        $('.changeUserMeetIdBtn').removeClass('bg-dark');
        $(el).addClass('bg-dark');
        $('.changeUserMeetId').addClass('d-none');
        $(id).removeClass('d-none');
        return true;
    }
    function showMeetDetail(el){
        $(el).addClass('d-none');
        $(el).parent().find('.hide').removeClass('d-none');
        $(el).parents('.email-media').find('.eamil-body').removeClass('d-none');
        return true;
    }
    function hideMeetDetail(el){
        $(el).addClass('d-none');
        $(el).parent().find('.show').removeClass('d-none');
        $(el).parents('.email-media').find('.eamil-body').addClass('d-none');
        return true;
    }
    function acceptMeet(id){
        sendAjax({id:id},baseUrl('company/meet/meet/accept_meet'),'#content');
        return true;
    }
    function acceptMeetTimeExp(id){
        sendAjax({id:id},baseUrl('company/meet/meet/accept_meet_exp'),'#content');
        return true;
    }
    function acceptMeetTimeExpSingle(id){
        sendAjax({id:id},baseUrl('company/meet/meet/accept_meet_exp_single'),'#content');
        return true; 
    }
    function changeTime(mId,mUId,mT){
        $('#mId').val(mId);
        $('#mUId').val(mUId);
        $('#mT').val(mT);
        $('#meet-timer').removeClass('d-none');
        return true;
    }
    function hideMeetTimer(){
        $('#mId').val('');
        $('#mUId').val('');
        $('#meet-timer').addClass('d-none');
        return true;
    }