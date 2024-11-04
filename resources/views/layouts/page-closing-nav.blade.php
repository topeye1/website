<div class="col-sm-12 col-md-12 d-flex justify-content-center">
    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate_closing">
        <ul class="pagination" id="page_nav_closing">
        </ul>
    </div>
</div>

<script>
    function setPageNavClosing(total_pages, current_page, list_func) {
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

        nav_tag+='<li class="paginate_button page-item previous ' + prev_status + '" id="dataTable_previous_closing">';
        nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_closing_' + prenum + '">';
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
            nav_tag+='<li class="paginate_button page-item ' + page_active + '" id="dataTable_pages_closing">';
            nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_closing_' + number + '">';
            nav_tag+=number;
            nav_tag+='</a>';
            nav_tag+='</li>';
        }

        nav_tag+='<li class="paginate_button page-item next ' + next_status + '" id="dataTable_next_closing">';
        nav_tag+='<a href="#" aria-controls="dataTable" tabindex="0" class="page-link" id="page_nav_closing_' + nextnum + '">';
        nav_tag+='<i class="fa fa-angle-right" aria-hidden="true"></i>';
        nav_tag+='</a>';
        nav_tag+='</li>';
        $('#page_nav_closing').html(nav_tag);

        $('a[id^="page_nav_closing_"]').click(function(){
            let oid=$(this).attr("id");
            page_start=oid.split('_')[3];
            list_func();
        });
    }

</script>

