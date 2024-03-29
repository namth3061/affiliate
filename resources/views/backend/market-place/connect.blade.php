@include('backend.market-place.market-place-style')
@include('backend.market-place.connect_style')
<div id="app">
    <div id="market-place-wrapper">
        <div id="market-place-content" style="overflow: hidden; height: 100%;">
            <div id="sendo-introduce-wrapper">
                <div id="sendo-introduce-content">
                    <div id="sendo-introduce-logo">
                        <div id="sendo-introduce-logo-sapo">
                            <img src="{{ static_asset('assets/img/logo.png') }}" width="60%">
                        </div>
                    </div>
                    <div id="sendo-introduce-title">BÁN HÀNG TRÊN SÀN TMĐT CÙNG </div>
                    <div class="sendo-introduce-text">Chúng tôi giúp bạn:</div>
                    <div class="sendo-introduce-help">
                        <div class="sendo-introduce-help-icon">
                            <svg width="19" height="12" viewBox="0 0 19 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6.5L7.5 12L17.5 2" stroke="#0089FF" stroke-width="3"
                                      stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <div class="sendo-introduce-text">Kết nối cùng lúc nhiều gian hàng trên  giúp quản lý đồng
                            bộ, xuyên suốt
                        </div>
                    </div>
                    <div class="sendo-introduce-help">
                        <div class="sendo-introduce-help-icon">
                            <svg width="19" height="12" viewBox="0 0 19 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6.5L7.5 12L17.5 2" stroke="#0089FF" stroke-width="3"
                                      stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <div class="sendo-introduce-text">Đồng bộ sản phẩm giữa  và sàn TMĐT giúp kiểm soát tồn kho,
                            tiết kiệm thời gian cập nhật thông tin giá cả
                        </div>
                    </div>
                    <div class="sendo-introduce-help">
                        <div class="sendo-introduce-help-icon">
                            <svg width="19" height="12" viewBox="0 0 19 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6.5L7.5 12L17.5 2" stroke="#0089FF" stroke-width="3"
                                      stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <div class="sendo-introduce-text">Đồng bộ gian hàng từ sàn TMĐT về  giúp giảm tải nguồn lực
                            quản lý cửa hàng
                        </div>
                    </div>
                    <div class="connect-shop">
                        <button type="button" class="btn-login" id="btn-login-shopee">
                            <svg width="17" height="21" viewBox="0 0 17 21" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.833736 6.27536H4.7014C4.81954 4.9656 5.18422 3.78938 5.70812 2.88024C6.40153 1.67834 7.38771 0.938705 8.50229 0.938705C9.61688 0.938705 10.5979 1.68347 11.2965 2.88024C11.8204 3.78424 12.1851 4.9656 12.3032 6.27536H16.1657C16.6229 6.27536 17.0338 6.65032 16.9978 7.10745L16.2222 17.9297C16.1246 19.2857 15.272 20.0613 14.0341 20.0613H2.97045C1.59391 20.0613 0.864554 19.1008 0.782373 17.9297L0.00164889 7.11259C-0.0291692 6.65545 0.376602 6.27536 0.833736 6.27536ZM5.66703 6.27536H11.3273C11.2143 5.14023 10.901 4.13351 10.4541 3.36306C9.94047 2.4642 9.24193 1.90434 8.50229 1.90434C7.75752 1.90434 7.06412 2.4642 6.54021 3.3682C6.09335 4.13351 5.78517 5.14537 5.66703 6.27536Z"
                                    fill="white"></path>
                                <path
                                    d="M5.69265 16.2655C5.51288 16.1423 5.46665 15.9009 5.58992 15.7211C5.71319 15.5413 5.9546 15.4951 6.13437 15.6184C6.24737 15.6954 6.36551 15.7725 6.49392 15.8495C7.39791 16.3991 8.23 16.6713 8.92341 16.6713C9.55004 16.6713 10.0585 16.435 10.3821 15.9574C10.4027 15.9214 10.4232 15.9009 10.4284 15.8855C10.5208 15.7365 10.5876 15.5773 10.6338 15.4232C10.7263 15.1047 10.7109 14.776 10.5824 14.4781C10.4438 14.1648 10.1767 13.8617 9.76063 13.6101C9.48327 13.4406 9.13913 13.2916 8.72309 13.1786C7.665 12.8807 6.88428 12.4595 6.4631 11.8945C6.00083 11.273 5.96487 10.5231 6.45796 9.61398C6.78669 9.01303 7.45955 8.63807 8.31218 8.5713C9.04668 8.5148 9.93013 8.68944 10.829 9.14657C11.0242 9.24416 11.1012 9.48043 10.9985 9.67561C10.8958 9.8708 10.6646 9.94784 10.4694 9.84511C9.70413 9.45475 8.97477 9.3058 8.36868 9.35203C7.78827 9.39825 7.34655 9.62425 7.15137 9.9838C6.82264 10.5847 6.82778 11.0573 7.09487 11.4168C7.40305 11.8329 8.04509 12.1565 8.93881 12.4081C9.42163 12.5468 9.83254 12.7215 10.1715 12.9269C10.7314 13.2659 11.1063 13.6922 11.3067 14.1545C11.5121 14.6322 11.5378 15.1355 11.3991 15.6286C11.3375 15.8495 11.2399 16.0704 11.1064 16.2861C11.0755 16.3323 11.055 16.3683 11.0396 16.3939C10.5619 17.0976 9.8274 17.4469 8.93368 17.452C8.09645 17.452 7.12055 17.1439 6.09328 16.5172C5.96487 16.4453 5.83133 16.3631 5.69265 16.2655Z"
                                    fill="#EA501F"></path>
                            </svg>
                            Kết nối gian hàng Shopee
                        </button>
                        <button type="button" class="btn-login" id="btn-login-tiki">
                            <svg width="27" height="19" viewBox="0 0 27 19" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.10258 6.69345H4.37598C4.22311 6.66452 4.06618 6.66452 3.91332 6.69345H1.18376C0.869809 6.69345 0.568715 6.81817 0.346716 7.04017C0.124717 7.26217 0 7.56326 0 7.87721C0 8.19117 0.124717 8.49226 0.346716 8.71426C0.568715 8.93626 0.869809 9.06098 1.18376 9.06098H2.86668V17.2615C2.89342 17.582 3.03964 17.8808 3.27636 18.0986C3.51307 18.3164 3.82299 18.4373 4.14465 18.4373C4.46631 18.4373 4.77623 18.3164 5.01294 18.0986C5.24965 17.8808 5.39588 17.582 5.42262 17.2615V9.06098H7.10258C7.41653 9.06098 7.71762 8.93626 7.93962 8.71426C8.16162 8.49226 8.28634 8.19117 8.28634 7.87721C8.28634 7.56326 8.16162 7.26217 7.93962 7.04017C7.71762 6.81817 7.41653 6.69345 7.10258 6.69345Z"
                                    fill="white"></path>
                                <path
                                    d="M10.062 6.57703C9.72337 6.57702 9.39852 6.71091 9.15827 6.94949C8.91803 7.18807 8.78189 7.51198 8.77954 7.85056V17.2615C8.80764 17.5809 8.95439 17.8782 9.19086 18.0948C9.42733 18.3114 9.73635 18.4315 10.057 18.4315C10.3777 18.4315 10.6867 18.3114 10.9232 18.0948C11.1596 17.8782 11.3064 17.5809 11.3345 17.2615V7.85056C11.3322 7.51368 11.1974 7.19125 10.9593 6.95295C10.7211 6.71465 10.3988 6.57961 10.062 6.57703Z"
                                    fill="white"></path>
                                <path
                                    d="M23.9712 7.07025C23.6319 7.07156 23.307 7.20724 23.0676 7.4476C22.8282 7.68796 22.6937 8.0134 22.6937 8.35266V17.6649C22.7218 17.9844 22.8686 18.2817 23.105 18.4983C23.3415 18.7148 23.6505 18.835 23.9712 18.835C24.2919 18.835 24.6009 18.7148 24.8374 18.4983C25.0738 18.2817 25.2206 17.9844 25.2487 17.6649V8.34378C25.2463 8.00606 25.1109 7.68289 24.8717 7.44445C24.6325 7.20601 24.3089 7.07154 23.9712 7.07025Z"
                                    fill="white"></path>
                                <path
                                    d="M17.6508 12.2887L20.9851 8.83606C21.189 8.58694 21.2917 8.27026 21.2729 7.9489C21.254 7.62755 21.115 7.32504 20.8835 7.10143C20.6519 6.87782 20.3447 6.74947 20.0229 6.74187C19.7011 6.73428 19.3882 6.84798 19.1463 7.06042L15.2744 11.0704V7.94923C15.2477 7.62868 15.1015 7.32989 14.8648 7.1121C14.6281 6.89431 14.3181 6.77343 13.9965 6.77343C13.6748 6.77343 13.3649 6.89431 13.1282 7.1121C12.8915 7.32989 12.7452 7.62868 12.7185 7.94923V17.2615C12.7452 17.582 12.8915 17.8808 13.1282 18.0986C13.3649 18.3164 13.6748 18.4373 13.9965 18.4373C14.3181 18.4373 14.6281 18.3164 14.8648 18.0986C15.1015 17.8808 15.2477 17.582 15.2744 17.2615V13.507L19.9572 18.3565C20.1932 18.599 20.5155 18.7384 20.8538 18.7443C21.1922 18.7502 21.5191 18.6221 21.7634 18.388C22.0062 18.152 22.1458 17.8295 22.1517 17.4909C22.1576 17.1524 22.0294 16.8252 21.795 16.5808L17.6508 12.2887Z"
                                    fill="white"></path>
                                <path
                                    d="M9.95939 6.00685C11.5726 6.00685 12.8803 4.6991 12.8803 3.08591C12.8803 1.47272 11.5726 0.164978 9.95939 0.164978C8.3462 0.164978 7.03845 1.47272 7.03845 3.08591C7.03845 4.6991 8.3462 6.00685 9.95939 6.00685Z"
                                    fill="white"></path>
                                <path
                                    d="M7.72009 2.64691H12.1671V3.61168C12.1086 4.07396 11.906 4.50608 11.588 4.84674C11.1692 5.27124 10.5991 5.51245 10.0028 5.51754C9.85087 5.51754 8.83086 5.52641 8.17683 4.70666C7.91886 4.37793 7.76037 3.98222 7.72009 3.5663V2.64691Z"
                                    fill="#00AAF0"></path>
                                <path
                                    d="M23.9751 6.10945C25.5883 6.10945 26.8961 4.8017 26.8961 3.18851C26.8961 1.57532 25.5883 0.267578 23.9751 0.267578C22.3619 0.267578 21.0542 1.57532 21.0542 3.18851C21.0542 4.8017 22.3619 6.10945 23.9751 6.10945Z"
                                    fill="white"></path>
                                <path
                                    d="M21.7358 2.74951H26.1819V3.71625C26.1239 4.1787 25.9212 4.61099 25.6028 4.95131C25.1838 5.37545 24.6138 5.6163 24.0175 5.62112C23.8656 5.62112 22.8456 5.63099 22.1916 4.81123C21.9342 4.48189 21.7761 4.08595 21.7358 3.66989V2.74951Z"
                                    fill="#00AAF0"></path>
                            </svg>
                            Kết nối gian hàng Tiki
                        </button>
                    </div>
                    <div class="connect-shop">
                        <a href="{{route('market_place.sendo.connect')}}">
                            <button type="button" class="btn-login" id="btn-login-sendo">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M3.7524 17.2773C3.7524 18.1365 3.08035 18.8333 2.25182 18.8333C1.42253 18.8333 0.75048 18.1365 0.75048 17.2773C0.75048 16.4188 1.42253 15.7222 2.25182 15.7222C3.08035 15.7222 3.7524 16.4188 3.7524 17.2773ZM11.2572 17.2773C11.2572 18.1365 10.5854 18.8333 9.75561 18.8333C8.92761 18.8333 8.25528 18.1365 8.25528 17.2773C8.25528 16.4188 8.92761 15.7222 9.75561 15.7222C10.5854 15.7222 11.2572 16.4188 11.2572 17.2773ZM12.4123 6.28305C11.3064 5.66201 10.5125 5.19657 10.5125 4.43989C10.5125 3.76832 11.1446 2.53449 12.4439 2.53369C12.9612 2.53316 13.634 2.61986 13.748 2.6555L14.7149 0.465256C13.0712 0.0546012 12.3302 0.187053 12.3302 0.187053C9.78069 0.282536 7.56626 2.47598 7.56626 4.90586C7.56626 6.61285 8.88391 7.62166 10.28 8.37834C11.4818 8.99911 12.0437 9.48477 12.0437 10.222C12.0437 11.1468 11.2426 11.6474 10.2922 11.7373L10.2159 11.7444L2.56745 11.8006L3.01172 10.3114H7.30002L8.08253 8.33659H2.38703C1.64437 8.33659 1.33695 8.59032 1.20462 8.84326L0.0261967 13.0365C-0.101079 13.4903 0.247799 13.9746 0.803931 14.1299C0.850696 14.1427 0.895867 14.1469 0.9421 14.1546L0.939443 14.1653L1.05423 14.1634C1.11587 14.1685 1.17779 14.1671 1.23677 14.1629L10.2135 14.1427L10.2922 14.1382C12.9246 13.944 15.0096 12.4461 15.0096 9.73638C15.0096 8.18419 14.0018 7.11739 12.4123 6.28305Z"
                                          fill="white"></path>
                                </svg>
                                Kết nối gian hàng Sendo
                            </button>
                        </a>
                        <button type="button" class="btn-login" id="btn-login-lazada">
                            <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.0052 18.4305C10.849 18.4316 10.6953 18.3916 10.5593 18.3146C9.39569 17.6413 0.777285 12.2375 0.451812 12.0726C0.204115 11.957 0.0349765 11.7202 0.00595609 11.4484V3.86883C-0.000453269 3.58591 0.139414 3.31965 0.376015 3.16438L0.438435 3.12871C1.27219 2.61152 4.06323 0.908354 4.50463 0.663133C4.60592 0.603026 4.72128 0.570727 4.83902 0.569504C4.94942 0.570753 5.05792 0.598262 5.15559 0.649758C5.15559 0.649758 9.06129 3.19559 9.65873 3.42298C10.0779 3.61557 10.535 3.71156 10.9963 3.70387C11.519 3.71479 12.0355 3.58875 12.4944 3.33827C13.0784 3.03063 16.8103 0.663133 16.8504 0.663133C16.9444 0.606306 17.0526 0.576961 17.1625 0.578421C17.2803 0.578998 17.3958 0.611343 17.4969 0.67205C18.0051 0.952938 21.465 3.07075 21.6121 3.16438C21.8555 3.3112 22.003 3.57575 22 3.85992V11.4395C21.9727 11.7119 21.803 11.9495 21.5542 12.0637C21.2287 12.242 12.637 17.6458 11.4511 18.3056C11.316 18.3858 11.1622 18.4288 11.0052 18.4305Z"
                                    fill="white"></path>
                            </svg>
                            Kết nối gian hàng Lazada
                        </button>
                    </div>
                    <div class="register"><p>Bạn chưa có gian hàng? <a href="#" onclick="modalRegister()">Đăng ký tại
                                đây</a></p></div>
                </div>
            </div>
        </div>
    </div>
    <div id="notification-wrapper"></div>

</div>
@include('backend.market-place.modal.register-market')
@include('backend.market-place.cdn.library')

<script>
    function modalRegister() {
        $('#market_place_modal_connect').css('display', 'block').modal('show');
    }

    $('#btn-login-tiki').on('click', function () {
        window.top.location.href = '{{$connectOther['tiki']}}/'
    })
    $('#btn-login-lazada').on('click', function () {
        window.top.location.href = '{{$connectOther['lazada']}}/'
    })
</script>
