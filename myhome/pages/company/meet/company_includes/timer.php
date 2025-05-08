<div class="row d-none" id="meet-timer">
        <div class="modal d-block" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">تعیین زمان جلسه</h6>
                        <button onclick="hideMeetTimer();" aria-label="بستن" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10 mx-auto text-center">
                                <?= (!empty($timer)?$timer:'') ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success-gradient btn-block rounded-10 p-2 w-100" onclick="acceptTimerMeet(this);">
                            تایید زمان  
                        </a>
                        <input type="hidden" id="mT">
                        <input type="hidden" id="mId">
                        <input type="hidden" id="mUId">
                    </div>
                </div>
            </div>
        </div>
    </div>