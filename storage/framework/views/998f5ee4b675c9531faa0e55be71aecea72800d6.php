<div class="col-sm-12 col-md-12 d-flex justify-content-center">
    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate2">
        <ul class="pagination" id="page_nav_container2">
        </ul>
    </div>
</div>

<script>
    function setPageNavigation2(total_pages, current_page, list_func) {
        let nav_tag = '';
        let prev_status = 'disabled';
        let next_status = 'disabled';
        if (current_page !== 1) {
            prev_status = 'active';
        }
        if (current_page !== total_pages) {
            next_status = 'active';
        }

        let prenum = parseInt(current_page) - 1;
        let nextnum= parseInt(current_page) + 1;

        nav_tag+='<li class="paginate_button page-item previous ' + prev_status + '" id="dataTable_previous2">';
        nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_number2_' + prenum + '">';
        nav_tag+='<i class="fa fa-angle-left" aria-hidden="true"></i>';
        nav_tag+='</a>';
        nav_tag+='</li>';

        for (let i = 1; i <= total_pages; i++) {
            let page_active = "";
            let number = i;
            if (i === parseInt(current_page)) {
                page_active = "active";
                number = current_page

            }
            nav_tag+='<li class="paginate_button page-item ' + page_active + '" id="dataTable_pages2">';
            nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_number2_' + number + '">';
            nav_tag+=number;
            nav_tag+='</a>';
            nav_tag+='</li>';
        }

        nav_tag+='<li class="paginate_button page-item next ' + next_status + '" id="dataTable_next2">';
        nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_number2_' + nextnum + '">';
        nav_tag+='<i class="fa fa-angle-right" aria-hidden="true"></i>';
        nav_tag+='</a>';
        nav_tag+='</li>';
        $('#page_nav_container2').html(nav_tag);

        $('a[id^="page_nav_number2_"]').click(function(){
            let oid=$(this).attr("id");
            mpstart=oid.split('_')[3];
            list_func();
        });
    }

</script>

<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/layouts/page-navigation2.blade.php ENDPATH**/ ?>