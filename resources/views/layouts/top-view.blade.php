<ul class="navbar-nav ml-lg-1">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-title_1"></span>
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-board"></span>
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-value_1"></span>
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-title_2"></span>
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-value_2"></span>
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-title_3"></span>
    <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="top-value_3"></span>
</ul>

<ul class="navbar-nav ml-auto">
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow d-flex">
        <div class="d-flex align-items-center mr-5">
            <span id="span_time"></span>
        </div>
        <div class="d-flex align-items-center" style="font-size: 1.2rem;">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                {{ session()->get('user_name') }}
            </span>
        </div>
        <div class="d-flex align-items-center">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa fa-cog fa-fw"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <div class="dropdown-header">{{ __('userpage.lang') }}</div>
                <div id="selected_language">

                </div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-header">{{ __('userpage.number_per_page') }}</div>
                <div id="selected_show_count">

                </div>
            </div>
        </div>
    </li>

</ul>

<script>
    const languages = ["한국어", "English", "中文", "日语"];
    const lang_mark = ["ko", "en", "zh-CN", "ja"];
    const lang_urls = [
        '{{ route('lang.switch', 'ko') }}',
        '{{ route('lang.switch', 'en') }}',
        '{{ route('lang.switch', 'zh-CN') }}',
        '{{ route('lang.switch', 'ja') }}'
    ];

    const show_counts = ["10", "20", "50"];
    const number_urls = [
        '{{ url('/' . $page='admin.pages10') }}',
        '{{ url('/' . $page='admin.pages20') }}',
        '{{ url('/' . $page='admin.pages50') }}'
    ];
    $(document).ready(function () {
        showTime();
        getSettingInfo();
        $('#top-title_1').text('');
        $('#top-board').text('');
        $('#top-value_1').text('');
        $('#top-title_2').text('');
        $('#top-value_2').text('');
        $('#top-title_3').text('');
        $('#top-value_3').text('');
    });

    function showTime() {
        setInterval(function(){
            let now = new Date();

            let hr = now.getHours();//시간
            let min = now.getMinutes();//분
            let sec = now.getSeconds();//초

            if(hr < 10){
                hr = '0' + hr;
            }
            if(min < 10){
                min = '0' + min;
            }
            if(sec < 10){
                sec = '0' + sec;
            }
            let time = hr + ':' + min + ':' + sec;
            $('#span_time').text(time);
        }, 1000);
    }

    function setTopViewValue(title1, val1, title2, val2, title3, val3) {
        $('#top-title_1').text(title1);
        $('#top-board').text('|');
        $('#top-value_1').text(val1);
        $('#top-title_2').text(title2);
        $('#top-value_2').text(val2);
        $('#top-title_3').text(title3);
        $('#top-value_3').text(val3);
    }

    function getSettingInfo() {
        $.ajax({
            url: '/admin.getWebSetting',
            headers: {'Authorization': `Bearer ${window.localStorage.authToken}`},
            type: 'POST',
            success: function (data) {
                if (data.msg === "ok") {
                    let show_language = data.show_language;
                    let show_count = data.show_count;

                    let tag_lang = "";
                    for (let i = 0; i < lang_mark.length; i++) {
                        let lang_checked = "";
                        if (lang_mark[i] === show_language) {
                            lang_checked = "checked"
                        }
                        tag_lang += '<a class="dropdown-item" href="' + lang_urls[i] + '">';
                        tag_lang += '<input type="radio" name="lang_selected" ' + lang_checked + ' /> ' + languages[i];
                        tag_lang += '</a>';
                    }
                    $('#selected_language').html(tag_lang);

                    let tag_count = "";
                    for (let i = 0; i < show_counts.length; i++) {
                        let count_checked = "";
                        if (show_counts[i] === show_count) {
                            count_checked = "checked"
                        }
                        tag_count += '<a class="dropdown-item" href="' + number_urls[i] + '">';
                        tag_count += '<input type="radio" name="number_per_page" value="one" ' + count_checked + ' /> ' + show_counts[i];
                        tag_count += '</a>';
                    }
                    $('#selected_show_count').html(tag_count);
                }
            },
            error: function (jqXHR, errdata, errorThrown) {
                console.log(errdata);
            }
        });
    }
</script>
