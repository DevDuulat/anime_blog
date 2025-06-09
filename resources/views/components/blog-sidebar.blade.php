<div class="col-lg-4 col-md-6 col-sm-8">
  <div class="product__sidebar">
    <div class="product__sidebar__view">
      <div class="section-title">
        <h5>{{ $title ?? 'Наш блог' }}</h5>
      </div>

      @if($showFilters)
      <ul class="filter__controls">
        <li class="active" data-filter="*">День</li>
        <li data-filter=".week">Неделя</li>
        <li data-filter=".month">Месяц</li>
        <li data-filter=".years">Год</li>
      </ul>
      @endif


      <div class="filter__gallery">
        @foreach($posts as $post)
        <div class="product__sidebar__view__item set-bg mix day years"
          data-setbg="{{ asset('storage/' . $post->image) }}"">
          <div class=" ep">{{ $post->category->name }}</div>
        <div class="view">
          <i class="fa fa-comments"></i> {{ $post->comments_count }}
        </div>
        <h5>
          <a href="{{ $post->link }}">{{ $post->title }}</a>
        </h5>
      </div>
      @endforeach
    </div>
  </div>
</div>
</div>