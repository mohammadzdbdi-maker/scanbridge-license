<div class="g-video">
    @if(!empty($videos[$key] ?? ''))
        <div class="g-video-frame">
            <iframe src="https://www.aparat.com/video/video/embed/videohash/{{ $videos[$key] }}/vt/frame" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
        </div>
        <div class="g-video-cap">🎥 ویدیوی آموزشی: {{ $title }}</div>
    @else
        <div class="g-video-soon">
            <span class="big">🎥</span>
            <div><b>{{ $title }}</b> — ویدیوی آموزشی این بخش به‌زودی منتشر می‌شود</div>
        </div>
    @endif
</div>
