@extends('layouts.app')

@section('title','Edit')

@section('content')

<table>
    <form  action="/content/edit" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $content->id }}">
        <input type="hidden" name="action" value="update">

        @for ($i = 0; $i <= 3; $i++)
            @php
                $error_file = 'file.'.$i;
            @endphp
            @if ($errors->has($error_file))
                <tr>
                    <th>ERROR</th><td>{{ $errors->first($error_file) }}</td>
                </tr>
            @endif
            <tr>
                <th>画像{{ $i + 1 }}</th>
                <td style="margin:5px;">

                    @if (!empty($content_imgs[$i]))
                        <img style="width:200px;" src="{!! asset('storage/content_images/'.$content->id.'/'.$content_imgs[$i]->img) !!}" alt="教材イメージ"><br />
                        {{-- <form action="/content/content_image/delete"  style="margin:0; padding:0;" method="post">
                            <input type="hidden" name="content_img_id" value="{{ $content_imgs[$i]->img }}">
                            <input type="submit" value="画像削除">
                        </form> --}}
                        <a href="/content/content_image/delete?img={{ $content_imgs[$i]->img }}">画像削除</a>
                    @endif

                    <input type="file" name="file[{{$i}}]" >
                </td>
            </tr>
        @endfor

        @if ($errors->has('title'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('title') }}</td>
            </tr>
        @endif
        <tr>
            <th>タイトル</th>
            <td>
                <input type="text" name="title" value="{{ $content->title }}">
            </td>
        </tr>

        @if ($errors->has('detail'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('detail') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材詳細</th>
            <td>
                <textarea name="detail" id="detail" rows="8" cols="80">{{ $content->detail }}</textarea>
            </td>
        </tr>

        @if ($errors->has('price'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('price') }}</td>
            </tr>
        @endif
        <tr>
            <th>販売価格</th>
            <td>
                <input type="text" id="price" name="price" value="{{ $content->price }}">
            </td>
        </tr>

        @if ($errors->has('teaching_material'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('teaching_material') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材コンテンツ</th>
            <td>
                <input type="file" name="teaching_material" multiple>
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <input type="submit" value="更新">
            </td>
        </tr>
    </form>
</table>

<a href="/content/show?id={{ $content->id }}">もどる</a>




@endsection
