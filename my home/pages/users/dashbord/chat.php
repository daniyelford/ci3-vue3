<div class="row row-sm mt-3">
    <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
        <div class="card mg-b-20">
            <div class="main-content-left main-content-left-mail card-body">
            	<div class="main-mail-menu">
            	    <?php if(!empty($qr)){ ?>
            	        <img class="rounded-10 mx-auto ht-100" src="<?= $qr ?>" onclick="downloadImage(this);" title="کارت ویزیت" alt="کارت ویزیت">
            	        <hr class="mg-y-20">
            	    <?php } ?>
            	    <label class="main-content-label main-content-label-sm mg-b-20">دسته بندی پیام ها</label>
        			<nav class="nav main-nav-column">
        				<a style="text-align:start;" onclick="showNotificationPage(this);" class="product-chat btn btn-block p-1 rounded-10 nav-link <?= (!empty($_GET) && !empty($_GET['type'])?($_GET['type']=='system'?'btn-success-gradient':'btn-dark-gradient'):'btn-success-gradient') ?>">
        				    <i class="fa fa-cog mx-1"></i>
        				    سیستمی
        			    </a>
                		<a style="text-align:start;" onclick="showPositionChatInChatPage(this);" class="position_chat btn btn-block p-1 rounded-10 nav-link <?= (!empty($_GET) && !empty($_GET['type']) && $_GET['type']=='position'?'btn-success-gradient':'btn-dark-gradient') ?>">
                		    <i class="fe fe-calendar mx-1"></i>
                		    جایگاه
                	    </a>
                		<a style="text-align:start;" onclick="showProductChatInChatPage(this);" class="product-chat btn btn-block p-1 rounded-10 nav-link <?= (!empty($_GET) && !empty($_GET['type']) && $_GET['type']=='product'?'btn-success-gradient':'btn-dark-gradient') ?>">
                		    <i class="fa fa-shopping-cart mx-1"></i>
                		    محصول
                	    </a>
                		<a style="text-align:start;" onclick="showUserChatInChatPage(this);" class="user-chat btn btn-block p-1 rounded-10 nav-link <?= (!empty($_GET) && !empty($_GET['type']) && $_GET['type']=='users'?'btn-success-gradient':'btn-dark-gradient') ?>">
                		    <i class="fa fa-users mx-1"></i>
                		    کاربران
                	    </a>
                		<a style="text-align:start;" onclick="showSupportChatInChatPage(this);" class="user-chat btn btn-block p-1 rounded-10 nav-link <?= (!empty($_GET) && !empty($_GET['type']) && $_GET['type']=='support'?'btn-success-gradient':'btn-dark-gradient') ?>">
                		    <i class="fa fa-user mx-1"></i>
                		    پشتیبانی
                	    </a>
        			</nav>
    				<hr class="mg-y-20">
        			<label class="main-content-label main-content-label-sm ">دسترسی سریع</label>
    				<nav class="nav main-nav-column">
    					<a style="text-align:start;" href="<?= base_url() ?>" class="btn btn-dark-gradient btn-block p-1 rounded-10 nav-link">
        				    <i class="la la-home mx-1"></i>
        				    خانه
        			    </a>
    				</nav>
    			</div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-xl-9 col-md-12 col-sm-12">
        <?php if(!empty($_GET['type'])){
            switch($_GET['type']){
                case 'system':
                    echo '<div class="row row-sm mb-2" id="notification-page">';
                    $this->view('users/dashbord/chat_includes/notification');
                    echo '</div><div class="row row-sm mb-2 d-none" id="user-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/user');
                    echo '</div><div class="row row-sm mb-2 d-none" id="product-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/product');
                    echo '</div><div class="row row-sm mb-2 d-none" id="position-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/position');
                    echo '</div><div class="row row-sm mb-2 d-none" id="support-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/support');
                    echo '</div>';
                    break;
                case 'users':
                    $choose='users';
                    echo '<div class="row row-sm mb-2 " id="user-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/user');
                    echo '</div><div class="row row-sm mb-2 d-none" id="notification-page">';
                    $this->view('users/dashbord/chat_includes/notification');
                    echo '</div><div class="row row-sm mb-2 d-none" id="product-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/product');
                    echo '</div><div class="row row-sm mb-2 d-none" id="position-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/position');
                    echo '</div><div class="row row-sm mb-2 d-none" id="support-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/support');
                    echo '</div>';
                    break;
                case 'product':
                    $choose='product';
                    echo '<div class="row row-sm mb-2 " id="product-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/product');
                    echo '</div><div class="row row-sm mb-2 d-none" id="notification-page">';
                    $this->view('users/dashbord/chat_includes/notification');
                    echo '</div><div class="row row-sm mb-2 d-none" id="user-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/user');
                    echo '</div><div class="row row-sm mb-2 d-none" id="position-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/position');
                    echo '</div><div class="row row-sm mb-2 d-none" id="support-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/support');
                    echo '</div>';
                    break;
                case 'position':
                    $choose='position';
                    echo '<div class="row row-sm mb-2 " id="position-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/position');
                    echo '</div><div class="row row-sm mb-2 d-none" id="notification-page">';
                    $this->view('users/dashbord/chat_includes/notification');
                    echo '</div><div class="row row-sm mb-2 d-none" id="user-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/user');
                    echo '</div><div class="row row-sm mb-2 d-none" id="product-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/product');
                    echo '</div><div class="row row-sm mb-2 d-none" id="support-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/support');
                    echo '</div>';
                    break;
                case 'support':
                    $choose='support';
                    echo '<div class="row row-sm mb-2 " id="support-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/support');
                    echo '</div><div class="row row-sm mb-2 d-none" id="notification-page">';
                    $this->view('users/dashbord/chat_includes/notification');
                    echo '</div><div class="row row-sm mb-2 d-none" id="user-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/user');
                    echo '</div><div class="row row-sm mb-2 d-none" id="product-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/product');
                    echo '</div><div class="row row-sm mb-2 d-none" id="position-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/position');
                    echo '</div>';
                    break;
                default:
                    echo '<div class="row row-sm mb-2" id="notification-page">';
                    $this->view('users/dashbord/chat_includes/notification');
                    echo '</div><div class="row row-sm mb-2 d-none" id="user-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/user');
                    echo '</div><div class="row row-sm mb-2 d-none" id="product-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/product');
                    echo '</div><div class="row row-sm mb-2 d-none" id="position-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/position');
                    echo '</div><div class="row row-sm mb-2 d-none" id="support-chat-in-chat-page">';
                    $this->view('users/dashbord/chat_includes/support');
                    echo '</div>';
                    break;
            } 
        }else{ 
            echo '<div class="row row-sm mb-2" id="notification-page">';
            $this->view('users/dashbord/chat_includes/notification');
            echo '</div><div class="row row-sm mb-2 d-none" id="user-chat-in-chat-page">';
            $this->view('users/dashbord/chat_includes/user');
            echo '</div><div class="row row-sm mb-2 d-none" id="product-chat-in-chat-page">';
            $this->view('users/dashbord/chat_includes/product');
            echo '</div><div class="row row-sm mb-2 d-none" id="position-chat-in-chat-page">';
            $this->view('users/dashbord/chat_includes/position');
            echo '</div><div class="row row-sm mb-2 d-none" id="support-chat-in-chat-page">';
            $this->view('users/dashbord/chat_includes/support');
            echo '</div>';
        }
        if(!empty($data) && !empty($data['data'])){ ?>
            <input type="hidden" value='<?= json_encode($data['data']) ?>' id="liveInput">
        <?php } ?>
    </div>
</div>
<script>
    function checkBackUrlFunction(){
        let urlQuery= changeUrlQueryToArray();
        if(typeof(urlQuery.count)!=='undefined' && Math.floor(urlQuery.count) == urlQuery.count){
            processAjaxData(document.title,$('#content').html(),baseUrl('chat?type='+urlQuery.type));
        }
    }
</script>
<script src="<?= base_url('assets/js/users/dashbord/chat.js') ?>"></script>