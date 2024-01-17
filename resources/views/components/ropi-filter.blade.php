<div>
    @foreach($categories as $key => $category)

        <details>
            <summary>{{ $key }}</summary>
            @foreach($category as $label)
                <p>{{ $label['label'] }}</p>
            @endforeach
        </details>

    @endforeach
</div>