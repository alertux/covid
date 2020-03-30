@if (!($pageObj->page == 1 && !$pageObj->has_more_page))
    <div class="clearfix">
        <div class="pull-left">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($pageObj->page == 1)
                    <li class="disabled"><span>&laquo;</span></li>
                @else
                    <li><a href="{{ route($page_url ) }}?page_action=prev&page={{ $pageObj->page }}" >&laquo;</a></li>
                @endif

                <li class="active"><span>-- {{ $pageObj->page }} --</span></li>

                {{-- Next Page Link --}}
                @if ($pageObj->has_more_page)
                    <li><a href="{{ route($page_url) }}?page_action=next&page={{ $pageObj->page }}" >&raquo;</a></li>
                @else
                    <li class="disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        </div>
    </div>
@endif
