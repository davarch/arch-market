@foreach($filter->values() as $name => $options)
    <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">{{ $name }}</h5>
        @foreach($options as $option)
            <div class="form-checkbox">
                <input
                    name="{{ $filter->name($option['id']) }}"
                    type="checkbox"
                    value="{{ $option['id'] }}"
                    @checked($filter->requestValue($option['id']))
                    id="{{ $filter->id($option['id']) }}"
                >
                <label for="{{ $filter->id($option['id']) }}" class="form-checkbox-label">{{ $option['title'] }}</label>
            </div>
        @endforeach
    </div>
@endforeach
