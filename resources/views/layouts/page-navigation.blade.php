<div class="col-sm-12 col-md-12 d-flex justify-content-end">
    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
        <ul class="pagination" id="page_nav_container">
        </ul>
    </div>
</div>

<script>
    function setTablePageNavigation(total_pages, current_page) {
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

        nav_tag+='<li class="paginate_button page-item previous ' + prev_status + '" id="dataTable_previous">';
        nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_number_' + prenum + '">';
        nav_tag+='{{ __('userpage.prev_page') }}';
        nav_tag+='</a>';
        nav_tag+='</li>';

        for (let i = 1; i <= total_pages; i++) {
            let page_active = "";
            let number = i;
            if (i === parseInt(current_page)) {
                page_active = "active";
                number = current_page

            }
            nav_tag+='<li class="paginate_button page-item ' + page_active + '" id="dataTable_pages">';
            nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_number_' + number + '">';
            nav_tag+=number;
            nav_tag+='</a>';
            nav_tag+='</li>';
        }

        nav_tag+='<li class="paginate_button page-item next ' + next_status + '" id="dataTable_next">';
        nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_number_' + nextnum + '">';
        nav_tag+='{{ __('userpage.next_page') }}';
        nav_tag+='</a>';
        nav_tag+='</li>';
        $('#page_nav_container').html(nav_tag);

        $('a[id^="page_nav_number_"]').click(function(){
            let oid=$(this).attr("id");
            pstart=oid.split('_')[3];
            showTableList();
        });
    }

</script>

