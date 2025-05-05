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
        function showMyMeet(el){
            $(el).parent().children().removeClass('active');
            $(el).addClass('active');
            $('#from-other').addClass('d-none');
            $('#from-me').removeClass('d-none');
            return true;
        }
        function showOtherMeet(el){
            $(el).parent().children().removeClass('active');
            $(el).addClass('active');
            $('#from-me').addClass('d-none');
            $('#from-other').removeClass('d-none');
            return true;
        }
        function acceptMeet(id){
            sendAjax({id:id},baseUrl('company/meet/meet/accept_meet_time'),'#content');
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
        function acceptTimerMeet(el){
            let h=$(el).parent().parent().find('.hour').val(),d=$(el).parent().parent().find('.day').val(),m=$(el).parent().parent().find('.month').val(),y=$(el).parent().parent().find('.year').val(),
            mId=$('#mId').val(),mUId=$('#mUId').val(),mT=$('#mT').val();
            if(h!==''&&d!==''&&m!==''&&y!==''&&mId!==''&&mUId!==''&&mT!==''){
                sendAjax({h:h,d:d,m:m,y:y,mId:mId,mUId:mUId,mT:mT},baseUrl('company/meet/meet/change_time_meet'),'#content');
            }else{
                return not8();
            }
            return true;
        }
        function changeResult(el){
            $(el).parent().parent().find('.meet-result').removeClass('d-none');
            return true;
        }
        function saveResult(el){
            let t=$(el).parent().parent().find('.result').val(),i=$(el).parent().find('.mId').val();
            if(i!==''&&t!==''){
                sendAjax({i:i,t:t},baseUrl('company/meet/meet/save_result'),'#content');
            }else{
                return not1();
            }
        }
        function hideMeetResult(el){
            $(el).parents('.meet-result').addClass('d-none');
            return true;
        }
        function addMeet(){
            $('#add-timer').removeClass('d-none');
            return true;
        }
        function hideAddMeet(){
            $('#add-timer').addClass('d-none');
            return true;
        }
        function checkUserList(el,reqCuId){
            if(el.checked){
                if (!userList.includes(reqCuId)) {
                    userList.push(reqCuId);
                }
            }else{
                let index = userList.indexOf(reqCuId);
                if (index > -1) {
                    userList.splice(index, 1);
                }
            }
            return true;
        }