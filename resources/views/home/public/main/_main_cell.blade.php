<div class="row add-top-half {{ $extra_class or '' }} home-list">

    <div class="block-header">
        <h2>{{ $category_name }}
            @if (isset($category_id))
                <span class="pull-right read-more">
                    <a href="/main/list/{{ $category_id }}"><i class="fa fa-plus" aria-hidden="true"></i> 更多</a>
                </span>
            @endif
        </h2>
    </div>

    @foreach ($category_data as $data)
        <article class="col-md-4 pic-block">
            <a class="shodow-box" href="/main/detail/{{ $data->id }}">
                <img class="img-responsive" alt="{{ $data->title }}" src="{{ $data->cover }}" width="720" height="376" />
                <h4>{{ $data->keywords }}</h4>
            </a>
        </article>
    @endforeach

</div>
