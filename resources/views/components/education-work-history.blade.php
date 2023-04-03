<div class="education-work-history">
    <h2>Education and Work History</h2>
    <ul>
        @foreach ($educationWorkHistory as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>
