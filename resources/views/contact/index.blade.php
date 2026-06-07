@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<h2 class="content__heading">Contact</h2>

<form action="{{ route('contact.confirm') }}" method="post">
    @csrf

    <div>
        <label>お問い合わせの種類</label>
        <select name="categry_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->content }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <button class="button" type="submit">確認画面</button>
    </div>
</form>
@endsection